<?php

namespace AppBundle\Controller;

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
}
