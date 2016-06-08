<?php

namespace AppBundle\Api\Model;

class StudentEnrollmentDetails
{
    private $id;

    private $email;

    private $firstName;

    private $lastName;

    private $enrolledAt;

    public function __construct($id, $email, $firstName, $lastName, \DateTime $enrolledAt)
    {
        $this->id = $id;
        $this->email = $email;
        $this->firstName = $firstName;
        $this->lastName = $lastName;
        $this->enrolledAt = $enrolledAt;
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
}
