<?php

namespace GoldLink\LienBundle\Controller;
use GoldLink\LienBundle\Entity\cliquer;
use GoldLink\LienBundle\Entity\LienEnregistrer;
use GoldLink\LienBundle\Entity\Mailing;
use GoldLink\LienBundle\Entity\notations;
use GoldLink\LienBundle\Entity\Parametre;
use GoldLink\LienBundle\Entity\PublicationGroupe;
use GoldLink\LienBundle\Entity\Tag;
use GoldLink\LienBundle\Entity\Lien;
use Proxies\__CG__\GoldLink\LienBundle\Entity\publication;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Validator\Constraints\DateTime;

class LienController extends Controller
{
    private $pagePrecedente;

    public function __construct(){
        if(isset($_SERVER['HTTP_REFERER'])){
            $this->pagePrecedente = $_SERVER['HTTP_REFERER'] ;
        }else{
            $this->pagePrecedente = null;
        }

    }
    public function ajouterAction(){
        $doctrine = $this->getDoctrine();

        $save = $this->saveAjout();
        $this->savePublication();
        return $this->render('GoldLinkLienBundle:Lien:ajouter.html.twig',
            array(
                'visibilites' => $this->getVisibilites() ,
                'thematiques' => $this->getThematiques(),
                'save'        => $save
            )
        );
    }

    public function savePublication(){
        $request = $this->getRequest();
        $message = array();
        if($request->isMethod('post') and count($request->request->get('publier'))){
            $post = $request->request;
            $lien = $this->getDoctrine()->getRepository('GoldLinkLienBundle:Lien')->findOneById($post->get('lienId'));

            switch($post->get('option')){
                case 'groupe':
                    $groupe = $this->getDoctrine()->getRepository('GoldLinkUserBundle:Groupe')->findOneById($post->get('group'));
                    $p = (new PublicationGroupe())
                            ->setDate(new \DateTime())
                            ->setGroupe($groupe)
                            ->setLien($lien)
                            ->setUtilisateur($this->getUser());
                        break;
                case 'profil':
                    $p = (new publication())
                        ->setDatePublication(new \DateTime())
                        ->setPublicationLien($lien)
                        ->setPublicationUser($this->getUser())
                       ;
                    break;
                default:
                    break;
            }
            if(isset($p)){
                $em = $this->getDoctrine()->getEntityManager();
                $em->persist($p);
                $em->flush();
                $message['success'] = true;
            }else{
                $message['errors'] = true;
            }
        }
        return $message;
    }
    /**
     * @return array
     * fonction qui sauvergarde les liens
     */

    private function saveAjout(){
        $request = $this->getRequest();
        $messages = array();
        // s'il ya un post
        if($request->isMethod('post') and count($request->request->get('sauvegarder'))){

            $post = $request->request;
            $tags = \explode("\n", $post->get('tags'));
            $doctrine = $this->getDoctrine();
            /* Si la visibilite n'existe pas*/
            $visibilite = $doctrine->getRepository('GoldLinkLienBundle:Visibilite')->find($post->get('visibiliteId'));
            $thematique =  $doctrine->getRepository('GoldLinkLienBundle:thematique')->find($post->get('thematiqueId'));
            if(is_null($visibilite)){
                $messages['errors']['visibilite'] = true;
            }
            if(is_null($thematique)){
                $messages['errors']['thematique'] = true;
            }
            if(!$this->check_url($post->get('url'))){
                $messages['url'] = true;
            }

            if(isset($messages['errors']) or isset($messages['url'])){
               return $messages;
            }


            $lien = new Lien();
            // on parourt tous les tags pu on ajout nouveau lien
            foreach($tags as $tag){
                $t = trim($tag);
                if(!empty($t)){
                    $t = new Tag();
                    $t->setLibelle($tag);
                    $lien->addTag($t);
                }
            }
            $lien->setTitre($post->get('titre'))->setUrl($post->get('url'))->setProprietaire($this->getUser())
                ->setThematiqueLien($thematique)->setVisibiliteLien($visibilite)->setDateCreation(new \DateTime());
            $em = $doctrine->getManager();
            if($lien->getVisibiliteLien()->getLibelle()=='Public'){
                $mail = new Mailing();
                $mail->setUrl($lien->getUrl());
                $em->persist($mail);

            }
            $em->persist($lien);
            $em->flush();
            $messages['success'] = true;
            $messages['lien'] = $lien;
            $c = $doctrine->getRepository('GoldLinkLienBundle:membres')->findGroupeMembres($this->getUser()->getId());
            $messages['adherantGroupe'] = $c;
        }
        return $messages;
    }

    /**
     * @param Lien $id
     * fonction pour la modification
     */
    public function modifierAction(\GoldLink\LienBundle\Entity\Lien $id){
       $save =  $this->saveModification($id);
       return  $this->render('GoldLinkLienBundle:Lien:modifier.html.twig',
           array(
               'lien' => $id,
               'thematiques' => $this->getThematiques(),
               'visibilites' => $this->getVisibilites(),
               'save'        => $save
           ));
    }
    public function saveModification(\GoldLink\LienBundle\Entity\Lien &$lien){
        $request=$this->getRequest();
        $message = array();
        if($request->isMethod('post')){
            $post = $request->request;
            $doctrine = $this->getDoctrine();
            /* Si la visibilite n'existe pas */
            $visibilite = $doctrine->getRepository('GoldLinkLienBundle:Visibilite')->find($post->get('visibiliteId'));
            $thematique =  $doctrine->getRepository('GoldLinkLienBundle:thematique')->find($post->get('thematiqueId'));
            if(is_null($visibilite)){
                $messages['errors']['visibilite'] = true;
            }
            if(is_null($thematique)){
                $messages['errors']['thematique'] = true;
            }
            if(isset($messages['errors'])){
                return $messages;
            }

            $lien->setThematiqueLien($thematique)->setTitre($post->get('titre'))->setVisibiliteLien($visibilite);
            $lien->clearTags();
            $tags = \explode("\n", $post->get('tags'));
            foreach($tags as $tag){
                $t = trim($tag);
                if(!empty($t)){
                    $t = new Tag();
                    $t->setLibelle($tag);
                    $lien->addTag($t);
                }
            }
            $em = $doctrine->getManager();
            $em->persist($lien);
            $em->flush();
            $message['success'] = true;

        }
        return $message;
    }


    public function supprimerLienAction(\GoldLink\LienBundle\Entity\Lien $id){

        $em = $this->getDoctrine()->getManager();
        $count = count($id->getNotations());
        for($i = 0 ; $i < $count ; $i++){
            $em->remove($id->getNotations()[$i]);
            $em->flush();
        }
        $count = count($id->getPublication());
        for($i = 0 ; $i < $count ; $i++){
            $em->remove($id->getPublication()[$i]);
            $em->flush();
        }
        $count = count($id->getCliques());
        for($i = 0 ; $i < $count ; $i++){
            $em->remove($id->getCliques()[$i]);
            $em->flush();
        }
        $count = count($id->getEnregistrements());
        for($i = 0 ; $i < $count ; $i++){
            $em->remove($id->getEnregistrements()[$i]);
            $em->flush();
        }
        $count = count($id->getPublicationGroupe());
        for($i = 0 ; $i < $count ; $i++){
            $em->remove($id->getPublicationGroupe()[$i]);
            $em->flush();
        }
        $em->remove($id);
        $em->flush();
        if(is_null($this->pagePrecedente)){
            return $this->redirect($this->generateUrl('acces_membres'));
        }
        return $this->redirect($this->pagePrecedente);
    }

    public function gestionAction(){
        return $this->render('GoldLinkLienBundle:Lien:gestion.html.twig',
        array(
            'thematiques' =>$this->getThematiques()
        ));
    }

    private function getVisibilites(){
        $doctrine = $this->getDoctrine();
        $visibilites = $doctrine->getRepository('GoldLinkLienBundle:Visibilite');
        $visibilites = $visibilites->findAll();
        return $visibilites;
    }

    private function getThematiques(){
        $doctrine = $this->getDoctrine();
        $thematiques = $doctrine->getRepository('GoldLinkLienBundle:thematique');
        $thematiques = $thematiques->findAll();
        return $thematiques;
    }

    public function noterLienAction(){
        $requete = $this->get('request');
        if($requete->isXmlHttpRequest()){
            $em = $this->getDoctrine()->getManager();
            $lien = $this->getDoctrine()->getManager()
            ->getRepository('GoldLinkLienBundle:Lien')
            ->find($requete->request->get('idLien'));
            $note = $requete->request->get('note');
            $notations = $this->getDoctrine()->getManager()
                ->getRepository('GoldLinkLienBundle:notations')->getNotationUser($this->getUser());
            foreach($notations as $nota){
                if($lien->getId() == $nota->getLienNote()->getId()){
                    $nota->setNombreEtoile($note);
                    $em->persist($nota);
                    $em->flush();
                    $reponse = new Response('<pre class="alert alert-success animated bounceInDown">Nouvelle notation effectuer avec succès : Note de '.$note.'</pre>');
                    $reponse->setStatusCode(200);
                    return $reponse;
                }
            }

            $user = $this->getUser();
            $notation = new notations();
            $notation->setUserNote($user);
            $notation->setLienNote($lien);
            $notation->setNombreEtoile($note);

            $em->persist($notation);
            $em->persist($lien);
            $em->persist($user);
            $em->flush();
            $reponse = new Response('<pre class="alert alert-success animated bounceInDown">Notation effectuer avec succès : Note de '.$note.'</pre>');
            $reponse->setStatusCode(200);
            return $reponse;
        }

    }
    function ajouterAutreLienAction(){
        $requete = $this->get('request');
        if($requete->isXmlHttpRequest()){
            $doctrine = $this->getDoctrine();
            $visibilite = $doctrine->getRepository('GoldLinkLienBundle:Visibilite')->find($requete->request->get('idVisibilite'));
            $thematique =  $doctrine->getRepository('GoldLinkLienBundle:thematique')->find($requete->request->get('idThematique'));
            $url = $requete->request->get('url');
            $titre = $requete->request->get('titre');
            $user = $this->getUser();
            $userLiens = $doctrine->getRepository('GoldLinkLienBundle:Lien')
                ->rechercherPersonnelDate('DESC',$user->getId());
            if(is_null($thematique)){
                $reponse = new Response('<pre class="alert alert-danger animated bounceInDown"><b>Erreur : La thématique est invalide.</b></pre>');
                $reponse->setStatusCode(200);
                return $reponse;
            } else if(is_null($visibilite)){
                $reponse = new Response('<pre class="alert alert-danger animated bounceInDown"><b>Erreur : La visibilité du lien est invalide.</b></pre>');
                $reponse->setStatusCode(200);
                return $reponse;
            }
            foreach($userLiens as $lien){
                if($lien->getUrl()==$url){
                    $reponse = new Response('<pre class="alert alert-danger animated bounceInDown"><b>Erreur : Vous possedez un lien avec le même url.</b></pre>');
                    $reponse->setStatusCode(200);
                    return $reponse;
                }
            }
            $lien = new Lien();
            $lienEnre = new LienEnregistrer();
            $lien->setProprietaire($user)
                ->setTitre($titre)
                ->setUrl($url)
                ->setThematiqueLien($thematique)
                ->setVisibiliteLien($visibilite);
            $lienEnre->setUtilisateurAjouteur($user);
            $lienEnre->setLienConcerner($lien);
            $em = $doctrine->getManager();
            $em->persist($lien);
            $em->persist($user);
            $em->persist($lienEnre);
            $em->flush();

            $reponse = new Response('<pre class="alert alert-success animated bounceInDown"><b>Le lien à été ajouter dans votre bibliothèque.</b></pre>');
            $reponse->setStatusCode(200);
            return $reponse;
        }
    }

    public function AjouterCliqueAction(){
        $requete = $this->get('request');
        if($requete->isXmlHttpRequest()){
            $doctrine = $this->getDoctrine();
            $lien = $this->getDoctrine()
                ->getRepository("GoldLinkLienBundle:Lien")
                ->find($requete->request->get('idLien'));
            $user = $this->getUser();
          /*  $cliqueExist = $doctrine->getRepository('GoldLinkLienBundle:cliquer')
                ->cliqueExist($user->getId(),$lien->getId());
            if(!$cliqueExist){*/
                $em = $doctrine->getManager();
                $clique = new cliquer();
                $clique->setLienClique($lien);
                $clique->setDateclique(new \DateTime());
                $clique->setUserClique($user);

            $em->persist($user);
            $em->persist($lien);
            $em->persist($clique);
            $em->flush();

        }
            $reponse = new Response('');
            $reponse->setStatusCode(200);

            return $reponse;
    }


    public function partagerLienAction(Lien $id){
      $g = $this->getDoctrine()->getRepository('GoldLinkLienBundle:membres')->findGroupeMembres($this->getUser()->getId());
      $save = $this->savePublication();
      return  $this->render('GoldLinkLienBundle:Lien:partager.html.twig',array(
           'lien' => $id,
           'groupes' => $g,
           'save' => $save
       ));
    }

    function check_url($url, $timeout = 10, $maxredirs = 10)
    {
        /*$ret = FALSE;

        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_TIMEOUT, $timeout);
        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, $timeout);
        curl_setopt($ch, CURLOPT_NOBODY, TRUE);
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, TRUE);
        curl_setopt($ch, CURLOPT_MAXREDIRS, $maxredirs);
        if (curl_exec($ch)) {
            $ret = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        }
        curl_close($ch);

        return ($ret == 200);*/
        if($headers = @get_headers($url))
            return true;

        return false;

    }
}
