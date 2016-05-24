<?php

namespace GoldLink\ReseauBundle\Controller;

use GoldLink\LienBundle\Entity\membres;
use GoldLink\UserBundle\Entity\Demande;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use GoldLink\UserBundle\Entity\User;
use GoldLink\UserBundle\Entity\Groupe;
use GoldLink\UserBundle\Form\GroupeType;
use Symfony\Component\HttpFoundation\Response;

class ReseauController extends Controller
{
    public function __construct(){
        if(isset($_SERVER['HTTP_REFERER'])){
            $this->pagePrecedente = $_SERVER['HTTP_REFERER'] ;
        }else{
            $this->pagePrecedente = null;
        }

    }
    public function groupeAction()
    {

        $form= $this->createForm(new GroupeType());
        $user=$this->getUser();
        $groupe= $this->getDoctrine()->getRepository('GoldLinkUserBundle:Groupe')->findToutGroupe($user->getId());

        $demande = $this->getDoctrine()->getRepository('GoldLinkUserBundle:Demande')->getDemandeOfUser($this->getUser()->getId());
        $nombreDemande = count($demande);
        $ajouter = false;
        $request=$this->get('request');
        if($request->isMethod('POST') && $request->request->get('ajouter')=='ajouter'){
            $this->ajout($form);
            $ajouter = true;
        }

        $all = $this->getDoctrine()->getRepository('GoldLinkUserBundle:Groupe')->findAll();



        $vars = array(
            'form'=>$form->createView(),
            'mesgroupes'=>$groupe,
            'formulaire'=>$form->createView(),
            'all' => $all,
            'nombreDemande' => $nombreDemande,
            'demandes' => $demande,
            'ajouter' => $ajouter
        );

        if($this->get('session')->has('sup')){
            $vars['sup'] = $this->get('session')->get('sup');
            $this->get('session')->remove('sup');
         }


        return $this->render('GoldLinkReseauBundle:Reseau:reseau.html.twig',$vars);
    }


    // fonction qui permet d'ajouter un groupe
    public function ajout($form){
        $request=$this->get('request');
        if($request->isMethod('POST')){
            $form->bind($request);
            if($form->isValid()){
                $groupe=$form->getData();
                $user=$this->getUser();
                $groupe->setAdministrateur($user);
                $em = $this->getDoctrine()->getManager();
                if(!$user->groupeNom($groupe->getNomDuGroupe())){
                    $membre = new membres();

                    $em->persist($user);
                    $em->persist($groupe);
                    $em->flush();

                    $membre->setDateAdhesion(new \DateTime())
                        ->setUserAdhesion($user)
                        ->setGrouperAdhesion($groupe);

                    $em->persist($membre);
                    $em->flush();
                    return true;
                }else{
                    return false;
                }

            }
        }
        return false;
    }
// fonction qui permet de supprimer

    public function supprimerAction(Groupe $id){
        $em=$this->getDoctrine()->getManager();

        $rep = $this->getDoctrine()->getRepository('GoldLinkUserBundle:Groupe');
        $rep->deleteCascade($id->getId());
        try{
            $em->remove($id);
            $em->flush();
                $this->get('session')->set('sup',true);
        }catch (\Exception $e){
            $this->get('session')->set('sup',false);
        }

        return $this->redirect($this->generateUrl('groupe'));
    }

// fonction qui permet de modifier
    public function envoyerAction(){
        $request=$this->get('request');
        if($request->isMethod('POST')){

            $form->bind($request);
            if($form->isValid()){
                $groupe=$form->getData();
                $user=$this->getUser();
                $groupe->setAdministrateur($user);
                $em = $this->getDoctrine()->getManager();
                if($user->groupeNom($groupe->getNomDuGroupe())){
                    $user->addGroupe($groupe);
                    $em->persist($groupe);
                    $em->persist($user);
                    $em->flush();
                    return true;
                }else{
                    return false;
                }

            }
        }
        return false;
    }


    public function modifierAction(Groupe $id){
        $request=$this->getRequest();
        $res = array();
        if($request->isMethod('POST')){
            $post = $request->request;
            $id
                ->setDescription($post->get('description'))
                ->setDroit($post->get('droit'))
                ->setNomDuGroupe($post->get('nom'));
            $em = $this->getDoctrine()->getManager();
            $em->persist($id);
            $em->flush();

            $id = $id;
            $res['success'] = true;
        }
        $res['listes'] = $id ;
        return $this->render('GoldLinkReseauBundle:Reseau:modifier.html.twig',$res);
    }


    // fonction qui permet de rechercher

    public function rechercherAction(){
        $liste=array();
        $request=$this->get('request');
        if($request->isMethod('POST')){
            $nom=$request->request->get('username');
            $repository= $this->getDoctrine()->getRepository('GoldLinkUserBundle:Groupe');
            $liste=$repository->findGroupes($nom);;
        }
        $liste = is_null($liste) ? array() : $liste;

        return $this->render('GoldLinkReseauBundle:Reseau:rechercher.html.twig',array('listes'=>$liste));

    }
// fonction qui permet de voir les groupes
    public function voirAction( Groupe $id){
       $groupe = $id->getPublicationGroupe();
       $utilisateurs=$id->getMembres();
       return $this->render('GoldLinkReseauBundle:Reseau:voir.html.twig'
            ,array('lesliens'=>$groupe,'users'=>$utilisateurs, 'groupe' => $id));
    }




    // fonction qui permet de suivre
    public function suivreAction(Groupe $grp)
    {
        $form= $this->createForm(new GroupeType());
        $user=$this->getUser();
        $groupe= $this->getDoctrine()->getRepository('GoldLinkUserBundle:Groupe')->findToutGroupe($user->getId());
        $all = $this->getDoctrine()->getRepository('GoldLinkUserBundle:Groupe')->findAll();

        $em = $this->getDoctrine()->getManager();
        $goupes = $this->getUser()->getGroupes();
        $bool = false;

        foreach($goupes as $gr){
            $x = $gr->getGrouperAdhesion();
            if($x->getNomDuGroupe()==$grp->getNomDuGroupe() &&
                $grp->getAdministrateur()->getId() == $x->getAdministrateur()->getId() ){
                $bool = true;
                break;
            }
        }
        if($bool){
            return $this->render('GoldLinkReseauBundle:Reseau:reseau.html.twig',array('form'=>$form->createView()
                ,'mesgroupes'=>$groupe,'formulaire'=>$form->createView(),'all' => $all,'erreur'=>true));
        } else{
            if($grp->getDroit()==="public"){
                $membre = new membres();
                $membre
                    ->setUserAdhesion($user)
                    ->setGrouperAdhesion($grp)
                    ->setDateAdhesion(new \DateTime());
                $em->persist($membre);
                $em->flush();
                return $this->render('GoldLinkReseauBundle:Reseau:reseau.html.twig',array('form'=>$form->createView()
                    ,'mesgroupes'=>$groupe,'formulaire'=>$form->createView(),'all' => $all,'success'=>true));

            } else{
                $demande=new Demande();
                $demande->setEmetteur($this->getUser());
                $demande->setGroupe($grp);
                $em->persist($demande);
                $em->flush();
            }
            return $this->render('GoldLinkReseauBundle:Reseau:reseau.html.twig',array('form'=>$form->createView()
                ,'mesgroupes'=>$groupe,'demande' =>"Votre demande a été envoyé avec succès ",'formulaire'=>$form->createView(),'all' => $all,'success'=>true));

        }

    }

    public function demandeAction($type , Groupe $groupe, User $emetteur){
        $em = $this->getDoctrine()->getEntityManager();

        $demande  = $this->getDoctrine()
            ->getRepository('GoldLinkUserBundle:Demande');

        $existe = $demande
            ->demandeExiste($this->getUser()->getId() , $groupe->getId() , $emetteur->getId());
        if($existe){
            if($type === 'oui'){
                $membre = new membres();
                $membre->setUserAdhesion($emetteur);
                $membre->setGrouperAdhesion($groupe);
                $membre->setDateAdhesion(new \DateTime());

                $demande->deleteDemande($groupe->getId() , $emetteur->getId());
                $em->persist($membre);
                $em->flush();
                $demande->deleteDemande($groupe->getId() , $emetteur->getId());
            }else if($type === 'non'){
                $demande->deleteDemande($groupe->getId() , $emetteur->getId());
            }
        }

        return $this->redirect($this->generateUrl('groupe'));
    }

}
