<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use JMS\Serializer\Annotation as Serializer;

/**
 * @ORM\Entity
 * @ORM\Table(name="student_enrollment")
 * @Serializer\ExclusionPolicy("all")
 */
class StudentEnrollment
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     * @ORM\Column(type="integer")
     * @Serializer\Expose()
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

    /**
     * @ORM\Column(type="date")
     */
    private $enrolledAt;

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

    /**
     * @Serializer\VirtualProperty()
     */
    public function getStudentId()
    {
        return $this->getStudent()->getId();
    }

    public function getEnrolledAt()
    {
        return $this->enrolledAt;
    }

    public function setEnrolledAt(\DateTime $enrolledAt)
    {
        $this->enrolledAt = $enrolledAt;
    }
}
