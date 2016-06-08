<?php

namespace AppBundle\Api\Model;

use Hateoas\Configuration\Annotation as Hateoas;

/**
 * @Hateoas\Relation(
 *      "self",
 *      href = @Hateoas\Route(
 *          "api_enrollment_delete",
 *          parameters={
                "id": "expr(object.getId())"
 *          }
 *      )
 * )
 */
class StudentEnrollmentDetails
{
    private $id;

    private $email;

    private $firstName;

    private $lastName;

    private $enrolledAt;

    private $url;

    public function __construct($id, $email, $firstName, $lastName, \DateTime $enrolledAt, $url)
    {
        $this->id = $id;
        $this->email = $email;
        $this->firstName = $firstName;
        $this->lastName = $lastName;
        $this->enrolledAt = $enrolledAt;
        $this->url = $url;
    }

    public function getId()
    {
        return $this->id;
    }

    public function getEmail()
    {
        return $this->email;
    }

    public function getFirstName()
    {
        return $this->firstName;
    }

    public function getLastName()
    {
        return $this->lastName;
    }

    public function getEnrolledAt()
    {
        return $this->enrolledAt;
    }

    public function getUrl()
    {
        return $this->url;
    }
}
