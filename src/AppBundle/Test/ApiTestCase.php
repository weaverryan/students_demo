<?php

namespace AppBundle\Test;

use Exception;
use GuzzleHttp\Client;
use GuzzleHttp\HandlerStack;
use GuzzleHttp\Middleware;
use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;
use Symfony\Component\Console\Helper\FormatterHelper;
use Symfony\Component\Console\Output\ConsoleOutput;
use Symfony\Component\DomCrawler\Crawler;

class ApiTestCase extends KernelTestCase
{
    use DataHelperTrait;

    private static $staticClient;

    /**
     * @var array
     */
    private static $history = array();

    /**
     * @var Client
     */
    protected $client;

    /**
     * @var ConsoleOutput
     */
    private $output;

    /**
     * @var FormatterHelper
     */
    private $formatterHelper;

    private $responseAsserter;

    public static function setUpBeforeClass()
    {
        $handler = HandlerStack::create();

        $handler->push(Middleware::history(self::$history));
        $handler->push(Middleware::mapRequest(function(RequestInterface $request) {
            $path = $request->getUri()->getPath();
            if (strpos($path, '/app_test.php') !== 0) {
                $path = '/app_test.php' . $path;
            }
            $uri = $request->getUri()->withPath($path);

            return $request->withUri($uri);
        }));

        $baseUrl = getenv('TEST_BASE_URL');
        if (!$baseUrl) {
            throw new \Exception('The TEST_BASE_URL environment variable must be set!');
        }

        self::$staticClient = new Client([
            'base_uri' => $baseUrl,
            'http_errors' => false,
            'handler' => $handler
        ]);

        self::bootKernel();
    }

    protected function setUp()
    {
        $this->client = self::$staticClient;
        // reset the history
        self::$history = array();

        $this->purgeDatabase();
    }

    /**
     * Clean up Kernel usage in this test.
     */
    protected function tearDown()
    {
        // purposefully not calling parent class, which shuts down the kernel
    }

    protected function onNotSuccessfulTest($e)
    {
        if ($lastResponse = $this->getLastResponse()) {
            $this->printDebug('');
            $this->printDebug('<error>Failure!</error> when making the following request:');
            $this->printLastRequestUrl();
            $this->printDebug('');

            $this->debugResponse($lastResponse);
        }

        throw $e;
    }

    protected function getService($id)
    {
        return self::$kernel->getContainer()
            ->get($id);
    }

    protected function printLastRequestUrl()
    {
        $lastRequest = $this->getLastRequest();

        if ($lastRequest) {
            $this->printDebug(sprintf('<comment>%s</comment>: <info>%s</info>', $lastRequest->getMethod(), $lastRequest->getUri()));
        } else {
            $this->printDebug('No request was made.');
        }
    }

    protected function debugResponse(ResponseInterface $response)
    {
        foreach ($response->getHeaders() as $name => $values) {
            $this->printDebug(sprintf('%s: %s', $name, implode(', ', $values)));
        }
        $body = (string) $response->getBody();

        $contentType = $response->getHeader('Content-Type');
        $contentType = $contentType[0];
        if ($contentType == 'application/json' || strpos($contentType, '+json') !== false) {
            $data = json_decode($body);
            if ($data === null) {
                // invalid JSON!
                $this->printDebug($body);
            } else {
                // valid JSON, print it pretty
                $this->printDebug(json_encode($data, JSON_PRETTY_PRINT));
            }
        } else {
            // the response is HTML - see if we should print all of it or some of it
            $isValidHtml = strpos($body, '</body>') !== false;

            if ($isValidHtml) {
                $this->printDebug('');
                $crawler = new Crawler($body);

                // very specific to Symfony's error page
                $isError = $crawler->filter('#traces-0')->count() > 0
                    || strpos($body, 'looks like something went wrong') !== false;
                if ($isError) {
                    $this->printDebug('There was an Error!!!!');
                    $this->printDebug('');
                } else {
                    $this->printDebug('HTML Summary (h1 and h2):');
                }

                // finds the h1 and h2 tags and prints them only
                foreach ($crawler->filter('h1, h2')->extract(array('_text')) as $header) {
                    // avoid these meaningless headers
                    if (strpos($header, 'Stack Trace') !== false) {
                        continue;
                    }
                    if (strpos($header, 'Logs') !== false) {
                        continue;
                    }

                    // remove line breaks so the message looks nice
                    $header = str_replace("\n", ' ', trim($header));
                    // trim any excess whitespace "foo   bar" => "foo bar"
                    $header = preg_replace('/(\s)+/', ' ', $header);

                    if ($isError) {
                        $this->printErrorBlock($header);
                    } else {
                        $this->printDebug($header);
                    }
                }

                $profilerUrl = $response->getHeader('X-Debug-Token-Link');
                if ($profilerUrl) {
                    $fullProfilerUrl = $response->getHeader('Host').$profilerUrl[0];
                    $this->printDebug('');
                    $this->printDebug(sprintf(
                        'Profiler URL: <comment>%s</comment>',
                        $fullProfilerUrl
                    ));
                }

                // an extra line for spacing
                $this->printDebug('');
            } else {
                $this->printDebug($body);
            }
        }
    }

    /**
     * Print a message out - useful for debugging
     *
     * @param $string
     */
    protected function printDebug($string)
    {
        if ($this->output === null) {
            $this->output = new ConsoleOutput();
        }

        $this->output->writeln($string);
    }

    /**
     * Print a debugging message out in a big red block
     *
     * @param $string
     */
    protected function printErrorBlock($string)
    {
        if ($this->formatterHelper === null) {
            $this->formatterHelper = new FormatterHelper();
        }
        $output = $this->formatterHelper->formatBlock($string, 'bg=red;fg=white', true);

        $this->printDebug($output);
    }

    /**
     * @return RequestInterface
     */
    private function getLastRequest()
    {
        if (!self::$history || empty(self::$history)) {
            return null;
        }

        $history = self::$history;

        $last = array_pop($history);

        return $last['request'];
    }

    /**
     * @return ResponseInterface
     */
    private function getLastResponse()
    {
        if (!self::$history || empty(self::$history)) {
            return null;
        }

        $history = self::$history;

        $last = array_pop($history);

        return $last['response'];
    }

    /**
     * @return ResponseAsserter
     */
    protected function asserter()
    {
        if ($this->responseAsserter === null) {
            $this->responseAsserter = new ResponseAsserter();
        }

        return $this->responseAsserter;
    }

    /**
     * Call this when you want to compare URLs in a test
     *
     * (since the returned URL's will have /app_test.php in front)
     *
     * @param string $uri
     * @return string
     */
    protected function adjustUri($uri)
    {
        return '/app_test.php'.$uri;
    }
}