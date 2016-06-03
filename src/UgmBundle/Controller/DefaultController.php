<?php

namespace UgmBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction()
    {
        return $this->render('UgmBundle:Default:index.html.twig');
    }
}
