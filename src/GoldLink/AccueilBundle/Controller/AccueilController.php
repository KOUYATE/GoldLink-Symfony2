<?php

namespace GoldLink\AccueilBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class AccueilController extends Controller
{
    public function indexAction($accueil)
    {

        if($this->get('security.context')->isGranted('ROLE_USER')){
            return $this->redirect($this->generateUrl('acces_membres'));
        }
        if($this->get('security.context')->isGranted('ROLE_ADMIN')){
            return $this->redirect($this->generateUrl('sonata_admin_redirect'));
        }

        return $this->render("GoldLinkAccueilBundle:Accueil:index.html.twig");
    }

    public function inscriptionAction()
    {
        return $this->render("GoldLinkAccueilBundle:Accueil:inscription.html.twig");
    }

    public function connexionAction()
    {
        return $this->render("GoldLinkAccueilBundle:Accueil:connexion.html.twig");
    }

    public function accessMembresAction(){
        return $this->render("GoldLinkAccueilBundle:Accueil:membres.html.twig");
    }

}
