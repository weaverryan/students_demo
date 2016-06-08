<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="student_enrollment")
 */
class StudentEnrollment
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity="Course")
     */
    private $course;

    /**
     * @ORM\ManyToOne(targetEntity="Student")
     */
    private $student;

    public function getId()
    {
        return $this->id;
    }

    public function getCourse()
    {
        return $this->course;
    }

    public function setCourse($course)
    {
        $this->course = $course;
    }

    public function getStudent()
    {
        return $this->student;
    }

    public function setStudent($student)
    {
        $this->student = $student;
    }
}
