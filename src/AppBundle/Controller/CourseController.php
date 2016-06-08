<?php

namespace AppBundle\Controller;

use AppBundle\Api\Model\StudentEnrollmentDetails;
use AppBundle\Entity\Course;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class CourseController extends Controller
{
    /**
     * @Route("/courses", name="course_list")
     */
    public function listAction()
    {
        $courses = $this->getDoctrine()
            ->getRepository('AppBundle:Course')
            ->findAll();
        
        return $this->render('course/list.html.twig', [
            'courses' => $courses,
        ]);
    }

    /**
     * @Route("/courses/{id}", name="course_edit")
     */
    public function editAction(Course $course)
    {
        $enrollmentDetails = [];

        foreach ($course->getStudentEnrollments() as $studentEnrollment) {
            $enrollmentDetails[] = new StudentEnrollmentDetails(
                $studentEnrollment->getId(),
                $studentEnrollment->getStudent()->getEmail(),
                $studentEnrollment->getStudent()->getFirstName(),
                $studentEnrollment->getStudent()->getLastName(),
                $studentEnrollment->getEnrolledAt(),
                $this->generateUrl('api_enrollment_delete', ['id' => $studentEnrollment->getId()])
            );
        }

        return $this->render('course/edit.html.twig', [
            'course' => $course,
            'enrollmentDetails' => $enrollmentDetails
        ]);
    }
}
