<?php

namespace AppBundle\Controller\Api;

use AppBundle\Entity\StudentEnrollment;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Response;

class EnrollmentController extends ApiBaseController
{
    /**
     * @Route("/api/enrollments/{id}", name="api_enrollment_delete")
     */
    public function deleteAction(StudentEnrollment $enrollment)
    {
        $em = $this->getDoctrine()->getManager();
        $em->remove($enrollment);
        $em->flush();

        sleep(1);

        return new Response(null, 204);
    }
}
