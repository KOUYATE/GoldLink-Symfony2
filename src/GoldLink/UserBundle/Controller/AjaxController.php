<?php

namespace GoldLink\UserBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class AjaxController extends Controller
{
    public function updateFilActualiteAction()
    {
        $requete = $this->get('request');
        if($requete->isXMLHttpRequest()){
            $lastUserId = $requete->request->get('idLastUser');
            $idLastLink = $requete->request->get('idLastLink');
            $em = $this->getDoctrine()->getEntityManager();
            $builder= $em->createQueryBuilder();



        } else {

        }
    }

    public function updateFilwhenScrollAction(){
        $requete = $this->get('request');
        if($requete->isXMLHttpRequest()){

        }
    }

}
