<?php

namespace AppBundle\Controller\Api;

use JMS\Serializer\SerializationContext;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Form\Form;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

abstract class ApiBaseController extends Controller
{
    /**
     * @param Request $request
     * @param Form $form
     */
    protected function submitForm(Request $request, Form $form)
    {
        $data = json_decode($request->getContent(), true);
        $form->submit($data, !$request->isMethod('PATCH'));
    }

    /**
     * @param $data
     * @param integer $statusCode
     * @return Response
     */
    protected function createApiResponse($data, $statusCode = 200)
    {
        $context = new SerializationContext();
        $context->setSerializeNull(true);

        $json = $this->container->get('jms_serializer')
            ->serialize($data, 'json', $context);

        return new Response($json, $statusCode, [
            'Content-Type' => 'application/json'
        ]);
    }

    protected function createFailedValidationResponse(Form $form)
    {
        $errors = $this->getErrorsFromForm($form);

        return new JsonResponse([
            'message' => 'Validation failed',
            'errors' => $errors,
        ], 400);
    }

    private function getErrorsFromForm(FormInterface $form)
    {
        $errors = array();
        foreach ($form->getErrors() as $error) {
            $errors[] = $error->getMessage();
        }

        foreach ($form->all() as $childForm) {
            if ($childForm instanceof FormInterface) {
                if ($childErrors = $this->getErrorsFromForm($childForm)) {
                    $errors[$childForm->getName()] = $childErrors;
                }
            }
        }

        return $errors;
    }
}

