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
     * @ORM\JoinColumn(nullable=false)
     */
    private $course;

    /**
     * @ORM\ManyToOne(targetEntity="Student")
     * @ORM\JoinColumn(nullable=false)
     */
    private $student;

    public function getId()
    {
        return $this->id;
    }

    /**
     * @return Course
     */
    public function getCourse()
    {
        return $this->course;
    }

    public function setCourse(Course $course)
    {
        $this->course = $course;
    }

    /**
     * @return Student
     */
    public function getStudent()
    {
        return $this->student;
    }

    public function setStudent(Student $student)
    {
        $this->student = $student;
    }
}
