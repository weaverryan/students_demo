<?php

namespace AppBundle\Controller\Api;

use AppBundle\Entity\Course;
use AppBundle\Entity\StudentEnrollment;
use AppBundle\Form\StudentEnrollmentForm;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class CourseController extends ApiBaseController
{
    /**
     * @Route("/api/courses/{id}/students", name="api_course_student_add")
     * @Method("POST")
     */
    public function addStudentAction(Course $course, Request $request)
    {
        $enrollment = new StudentEnrollment();
        $enrollment->setCourse($course);

        $form = $this->createForm(StudentEnrollmentForm::class, $enrollment);
        $this->submitForm($request, $form);

        if (!$form->isValid()) {
            return $this->createFailedValidationResponse($form);
        }

        $em = $this->getDoctrine()->getManager();
        $em->persist($enrollment);
        $em->flush();

        return $this->createApiResponse($enrollment, 201);
    }
}
