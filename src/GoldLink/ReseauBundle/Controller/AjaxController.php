<?php
/**
 * Created by JetBrains PhpStorm.
 * User: dodo
 * Date: 22/03/14
 * Time: 15:03
 * To change this template use File | Settings | File Templates.
 */

namespace GoldLink\ReseauBundle\Controller;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;

class AjaxController extends Controller {
    public function rechercherAction($groupe){
        $doctrine = $this->getDoctrine();
        $result = $doctrine->
            getRepository('GoldLinkUserBundle:Groupe')
            ->rechercherGroupe($groupe,$this->getUser()->getId());
        return $this->render('GoldLinkReseauBundle:Recherche:recherche.html.twig',array('result' => $result));
    }
}