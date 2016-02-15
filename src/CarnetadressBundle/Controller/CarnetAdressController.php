<?php

namespace CarnetadressBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
//use Symfony\Component\DependencyInjection\ContainerAware;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use CarnetadressBundle\Entity\CarnetAdress;
use CarnetadressBundle\Form\CarnetAdressForm;
use Symfony\Component\HttpFoundation\Request;


class CarnetAdressController extends Controller
{
    public function listerAction()
    {
	   $em = $this->container->get('doctrine')->getEntityManager();

    $cAdress= $em->getRepository('CarnetadressBundle:CarnetAdress')->findAll();

    return $this->container->get('templating')->renderResponse('CarnetadressBundle:Carnetadress:lister.html.twig', 
    array(
    'carnet_adress' => $cAdress
    ));
   // return $this->container->get('templating')->renderResponse(
   // 'CarnetadressBundle:Carnetadress:lister.html.twig');
    
    }
    
    public function editerAction($id = null)
    {

        $message='';
    $em = $this->container->get('doctrine')->getEntityManager();

    if (isset($id)) 
    {
        // modification d'un contact existant : on recherche ses données
        $cAdress = $em->find('CarnetadressBundle:CarnetAdress', $id);

        if (!$cAdress)
        {
            $message='Aucun contact trouvé';
        }
    }
    else 
    {
        // ajout d'un nouveau contact
       $cAdress = new CarnetAdress();
    }


      $form = $this->container->get('form.factory')->create(new CarnetAdressForm(), $cAdress);
      $request = $this->container->get('request');

      if ($request->getMethod() == 'POST') 
      {
        //$form->bindRequest($request);

        if ($form->handleRequest($request)->isValid()) 
        {
          $em = $this->container->get('doctrine')->getEntityManager();
          $em->persist($cAdress);
          $em->flush();
          if (isset($id)) 
        {
            $message='Contact modifié avec succès !';
            return $this->redirect($this->generateUrl('carnet_adress_lister', array('id' => $cAdress->getId())));
        }
        else 
        {
            $message='Contact ajouté avec succès !';
             return $this->redirect($this->generateUrl('carnet_adress_ajouter', array('id' => $cAdress->getId())));
        }
          
        
        }

      }
    
       return $this->render('CarnetadressBundle:Carnetadress:editer.html.twig', array(
      'form' => $form->createView(),
       'message' => $message,
    )); 
    }

    public function supprimerAction($id)
    {

      $em = $this->container->get('doctrine')->getEntityManager();
      $cAdress = $em->find('CarnetadressBundle:CarnetAdress', $id);
            
      if (!$cAdress) 
      {
        throw new NotFoundHttpException("Contact non trouvé");
      }
            
      $em->remove($cAdress);
      $em->flush();        
      return new RedirectResponse($this->container->get('router')->generate('carnet_adress_lister'));
    }
}