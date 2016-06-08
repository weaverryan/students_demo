<?php

namespace AppBundle\Controller\Api;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Form\Form;
use Symfony\Component\HttpFoundation\Request;

abstract class ApiBaseController extends Controller
{
    /**
     * @param Request $request
     * @param Form $form
     */
    protected function submitForm(Request $request, Form $form)
    {
        $data = json_decode($request->getContent(), true);
        $form->submit($data);
    }
}