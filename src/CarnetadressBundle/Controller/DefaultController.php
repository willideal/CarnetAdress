<?php

namespace CarnetadressBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction()
    {
      $message = 'Bienvenue sur mon carnet d\'adresse';

  		return $this->container->get('templating')->renderResponse('CarnetadressBundle:Default:index.html.twig',
    	array('message' => $message)
  );
       // return $this->render('CarnetadressBundle:Default:index.html.twig');
    }
}
