<?php

namespace CatchmeBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction()
    {
        return $this->render('CatchmeBundle:Default:index.html.twig');
    }

    public function classementAction()
    {
        return $this->render('CatchmeBundle:Default:classement.html.twig');
    }
}
