<?php

namespace GoldLink\UserBundle\Controller;
use GoldLink\LienBundle\Entity\Parametre;
use GoldLink\LienBundle\Entity\publication;
use GoldLink\UserBundle\Entity;
use GoldLink\LienBundle\Entity\Tag;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Security\Core\Encoder;

class MembreController extends Controller
{

    private $lastUserId; //dernier user inscris
    private $lastLinkId; //dernier lien publié
    private $lastUserAfficher; //dernier user afficher
    private $lastLinkAfficher; //dernier lien afficher

    public function indexAction(){

        $publications = $this->getDoctrine()->getRepository('GoldLinkLienBundle:publication')->findAll();
        $thematiques = $this->getDoctrine()->getRepository('GoldLinkLienBundle:thematique')->findAll();

        $visibilites = $this->getDoctrine()->getRepository('GoldLinkLienBundle:Visibilite')->findAll();
        $newsUsers = $this->getDoctrine()
            ->getRepository('GoldLinkUserBundle:User')
            ->getNewsUsers();
        $newsLinks = $this->getDoctrine()
            ->getRepository('GoldLinkLienBundle:Publication')
            ->getNewsPubs();
        $this->get('session')->set('lastUserId',$newsUsers[0]->getId());
        $this->get('session')->set('lastLinkId',isset($newsLinks[0]) ? $newsLinks[0]->getId() : 0);
        $parametres = $this->getDoctrine()
            ->getRepository('GoldLinkLienBundle:Parametre')
            ->findAll();
        $parametre = isset($parametres[0]) ? $parametres[0] : new Parametre();

        $this->get('session')->set('lastLinkAfficher',count($newsLinks));
        $this->get('session')->set('lastUserAfficher',count($newsUsers));
        $donnees = \array_merge($newsUsers,$newsLinks);
        \uasort($donnees,array($this,'trieByDate'));
        return $this->render("GoldLinkUserBundle:Membre:membres.html.twig" ,
            [
                'publications'  => $publications ,
                'thematiques'   => $thematiques,
                'tags'          => array('lol'),
                'visibilites'   => $visibilites,
                'donnees'       => $donnees,
                'parametre'     => $parametre
            ]);
    }

    public function parametreAction(){
        $requete = $this->get('request');

        if($requete->isMethod('POST')){
            $compte = $requete->request->get('compte_change');
            $profil = $requete->request->get('profil_change');
            $password = $requete->request->get('password_change');

            $em = $this->getDoctrine()->getEntityManager();
            $user = $this->getUser();
            $success='';
            $errors='';
            if($profil=='profil_change'){

                $nomUtilisateur = $requete->request->get('username');
                $bio = $requete->request->get('biographie');

                if(!\is_numeric($nomUtilisateur) && \strlen($nomUtilisateur) > 2 ){
                    $user->setUserName($nomUtilisateur);
                    $user->setBiographie($bio);
                    $em->persist($user);
                    $em->flush();
                    $success='Mise à jour éffectuer.';
                } else {
                    $errors='Veuillez choisir un autre nom d\'utilisateur.';
                }

            } else if($compte=='compte_change'){
                $email = $requete->request->get('email');
                if(\filter_var($email,FILTER_VALIDATE_EMAIL)){
                    $oldmail = $user->getEmail();
                    $user->setEmail($email);
                    $em->persist($user);
                    try{
                        $em->flush();
                        $success='Mise à jour éffectuer.';
                    }catch (\Exception $e){
                        $errors='Adresse email utilisé par un autre utilisateur.';
                        $user->setEmail($oldmail);
                    }

                } else {
                    $errors='Adresse email incorrecte.';
                }

            } else if($password=='password_change'){

                $oldPassword = $requete->request->get('old_password');
                $newPassword = $requete->request->get('new_password');
                $conf_password = $requete->request->get('confirme_password');

                $factory = $this->get('security.encoder_factory');
                $encoder = $factory->getEncoder($user);
                $mot1 = $encoder->encodePassword($oldPassword, $user->getSalt());
                $mot = $encoder->encodePassword($newPassword, $user->getSalt());
                if($user->getPassword()==$mot1){
                    if($newPassword==$conf_password && \strlen($newPassword) >= 5 ){
                        $user->setPassword($mot);
                        $em->persist($user);
                        $em->flush($user);
                        $success = 'Mot de passe mise à jour avec succès.';
                    } else {
                        $errors = 'Les deux mots de passe doivent être identique et d\'au moins 5 caractères.';
                    }
                } else {
                    $errors = 'Le mot de passe actuel saisi est incorrecte.';
                }

            }
            return $this->render("GoldLinkUserBundle:Membre:parametre.html.twig",array('success'=>$success,'errors'=>$errors));
        }
        return $this->render("GoldLinkUserBundle:Membre:parametre.html.twig");
    }

    public function changerAvatarAction(){
        $builder = $this->createFormBuilder();
        $builder->add('fichier','file',array('required'=>true,'attr' =>array('class'=>'form-control')));
        $form = $builder->getForm();
        $requete = $this->getRequest();

        if($requete->isMethod('POST')){
            $form->bind($requete);
            $fichier = $form->getData()['fichier'];
            $extension = $fichier->guessExtension();
            if(\in_array($extension,array('png','PNG','JPG','JPEG','jpg','jpeg','jpe','JPE'))){
                $user = $this->getUser();
                $dossier = $this->container->getParameter('dossieravatar');
                $nomFichier = $user->getId().'.'.$extension;
                $user->setAvatar($dossier.$nomFichier);
                $fichier->move($dossier,$nomFichier);
                $em = $this->getDoctrine()->getEntityManager();
                $em->persist($user);
                $em->flush();
                return $this->render("GoldLinkUserBundle:Membre:changer_avatar.html.twig",
                    array('form'=>$form->createView(),'success'=>'Photo de profil modifier avec succès.'));
            } else {
                return $this->render("GoldLinkUserBundle:Membre:changer_avatar.html.twig",
                    array('form'=>$form->createView(),'erreurs'=>'Erreur lors de l\'upload du fichier.'));
            }


        }
        return $this->render("GoldLinkUserBundle:Membre:changer_avatar.html.twig", array('form'=>$form->createView()));
    }


    public function supprimerAvatarAction(){
        $requete = $this->get('request');
        if($requete->isMethod('POST')){
            $post = $requete->request->get('oui');
            if($post==''){
                $user = $this->getUser();
                $user->setAvatar($this->container->getParameter('dossieravatar').'avatar.jpg');
                $em = $this->getDoctrine()->getEntityManager();
                $em->persist($user);
                $em->flush();
                if($user->getAvatar() != $this->container->getParameter('dossieravatar').'avatar.jpg'){
                    \unlink($this->get('kernel')->getRootDir() .'/../web/'.$user->getAvatar());
                }

                return $this->redirect($this->generateUrl('acces_membres'));
            } else {

                return $this->redirect($this->generateUrl('acces_membres'));
            }
        }
        return $this->render("GoldLinkUserBundle:Membre:supprimer_avatar.html.twig");
    }

    function trieByDate($user, $pub){
        if($user instanceof Entity\User){
            $date1 = $this->formateDateTime($user->getDateInscription());
        } else {
            $date1 = $this->formateDateTime($user->getDatePublication());
        }
        if($pub instanceof publication){
            $date2 = $this->formateDateTime($pub->getDatePublication());
        } else {
            $date2 = $this->formateDateTime($pub->getDateInscription());
        }
        $date_1 = new \DateTime($date1['annee'].'-'.$date1['mois'].'-'.$date1['jour']);
        $date_2 = new \DateTime($date2['annee'].'-'.$date2['mois'].'-'.$date2['jour']);

        date_time_set($date_1,$date1['heure'],$date1['heure'],$date1['seconde']);
        date_time_set($date_2,$date2['heure'],$date2['heure'],$date2['seconde']);

        if($date_1==$date_2)
            return 0;
        else
            return ($date_1 < $date_2 ) ? 1 : -1;
    }

    function formateDateTime($date_time){
        $resultats = array();
        $donnee = explode(' ',$date_time->format('Y-m-d H:i:s'));
        $date = $donnee[0];
        $time = $donnee[1];
        $tableau_date = explode('-',$date);
        $tableau_time = explode(':',$time);
        $resultats['annee'] = $tableau_date[0];
        $resultats['mois'] = $tableau_date['1'];
        $resultats['jour'] = $tableau_date['2'];
        $resultats['heure'] = $tableau_time['0'];
        $resultats['minute'] = $tableau_time[1];
        $resultats['seconde'] = $tableau_time['2'];
        return $resultats;
    }

    public function updateFilActualiteAction()
    {

        $requete = $this->get('request');

        if($requete->isXMLHttpRequest()){
            $newsUsers = $this->getDoctrine()
                ->getRepository('GoldLinkUserBundle:User')
                ->getNewsUsers(0,1);
            $newsLinks = $this->getDoctrine()
                ->getRepository('GoldLinkLienBundle:Publication')
                ->getNewsPubs(0,1);
            $newUserId = $newsUsers[0]->getId();
            $newLinkId = isset($newsLinks[0]) ? $newsLinks[0]->getid() : 0;
            if($newUserId > $this->get('session')->get('lastUserId')){
                $this->get('session')->set('lastUserId',$newUserId);
                $user = $newsUsers[0];
                $output = $this->diffdate(\time(),
                    $this->unix_timestamp($user->getDateInscription()
                            ->format('Y-m-d H:i:s')));
                $nom = $this->get('request')->getHttpHost();
                $now = new \DateTime();
                $diff = $now->diff($user->getDateInscription());
                $host = $this->getRequest()->getHttpHost();
                $html =
                    "<div class='newuser animated rotateInDownLeft'>
                        <div> <i class='glyphicon glyphicon-plus'></i></div>
                        <div  class='avatar'>
                            <img src='http://".$nom."/bundles/goldlinkuser/images/avatar.jpg' alt='utilisateur' />
                        </div>
                        <div>&nbsp;
                            <a href=''>".$user->getUsername()."</a> à rejoint la communauté de <a href='#'>GoldLink </a>
                            il y'a environ <b>".$diff->s." secondes</b>
                        </div>
                    </div><hr/>";
                $reponse = new Response($html);


            } else if($newLinkId > $this->get('session')->get('lastLinkId')){
                $lien = $newsLinks[0];
                $this->get('session')->set('lastLinkId',$lien->getId());
                $thematiques = $this->getDoctrine()->getRepository('GoldLinkLienBundle:thematique')->findAll();

                $visibilites = $this->getDoctrine()->getRepository('GoldLinkLienBundle:Visibilite')->findAll();
                $reponse = $this->render('GoldLinkUserBundle:Membre:lienPub.html.twig',array('donnee'=>$lien,
                    'visibilites'=>$visibilites,'thematiques'=>$thematiques));

            } else {
                $reponse = new Response('');
            }

        } else {
            $reponse = new Response('');
        }
        $reponse->headers->set('Content-Type','text/html');
        $reponse->setStatusCode(200);
        return $reponse;
    }

    public function updateFilwhenScrollAction(){
        $requete = $this->get('request');
        if($requete->isXMLHttpRequest()){
            $newsUsers = $this->getDoctrine()
                ->getRepository('GoldLinkUserBundle:User')
                ->getNewsUsers($this->get('session')->get('lastUserAfficher')+1,5);
            $newsLinks = $this->getDoctrine()
                ->getRepository('GoldLinkLienBundle:Publication')
                ->getNewsPubs($this->get('session')->get('lastLinkAfficher')+1,5);
            $id1 = $this->get('session')->get('lastLinkAfficher');
            $id2 = $this->get('session')->get('lastUserAfficher');
            $this->get('session')->set('lastLinkAfficher',count($newsLinks)+$id1);
            $this->get('session')->set('lastUserAfficher',count($newsUsers)+$id2);
            $thematiques = $this->getDoctrine()->getRepository('GoldLinkLienBundle:thematique')->findAll();
            $visibilites = $this->getDoctrine()->getRepository('GoldLinkLienBundle:Visibilite')->findAll();
            $donnees = \array_merge($newsUsers,$newsLinks);
            \uasort($donnees,array($this,'trieByDate'));
            $reponse = $this->render('GoldLinkUserBundle:Membre:updatePage.html.twig',array('thematiques'   => $thematiques,
                    'tags'          => array('lol'),
                    'visibilites'   => $visibilites,
                    'donnees'       => $donnees));
            $reponse->setStatusCode(200);
            return $reponse;
        }
    }

    public function getLastUserId(){
        return $this->lastUserId;
    }
    public function getLastLinkId(){
        return $this->lastLinkId;
    }

    public function diffdate($timestamp1, $timestamp2 )
    {   \ini_set('date.timezone', 'Europe/London'); // GMT +0
        $diff = $timestamp1 - $timestamp2;
        $jours = $diff / (24*60*60);
        list($heures, $minutes, $secondes) = array_map(create_function('$a', "return idate(\$a, $diff);"), array('H', 'i', 's'));
        $output = '';
        foreach(array('jour', 'heure', 'minute', 'seconde') as $unit){
            if($unit == 'seconde' or ${"{$unit}s"} != 0);
                $output .= " ". ${"{$unit}s"}.((${"{$unit}s"} > 1) ? 's' : '');
        }
        ini_restore('date.timezone');
        return trim($output);
    }

    function unix_timestamp($date)
    {
        $date = str_replace(array(' ', ':'), '-', $date);
        $c    = explode('-', $date);
        $c    = array_pad($c, 6, 0);
        array_walk($c, 'intval');

        return mktime($c[3], $c[4], $c[5], $c[1], $c[2], $c[0]);
    }

    public function profilUserAction(\GoldLink\UserBundle\Entity\User $user){
        $nombreGroupe = count($user->getGroupes());
        $nbAdministree = 0;
        $nbLienPublic = 0;
        $listeLiens = $this->getDoctrine()
            ->getManager()
            ->getRepository('GoldLinkLienBundle:Lien')
            ->rechercherPersonnelDate('DESC',$user->getId());
        $nombreLien = count($listeLiens);
        foreach($user->getGroupes() as $groupe){
            if($groupe->getUserAdhesion()->getId()==$user->getId()){
                $nbAdministree++;
            }
        }
        foreach($listeLiens as $lien){
            if($lien->getVisibiliteLien()->getLibelle()=="Public"){
                $nbLienPublic++;
            }
        }
        $thematiques = array();
        foreach($listeLiens as $lien){
            if(!in_array($lien->getThematiqueLien(),$thematiques))
                $thematiques[] = $lien->getThematiqueLien();
        }
        $parametres = $this->getDoctrine()
            ->getRepository('GoldLinkLienBundle:Parametre')
            ->findAll();
        $parametre = isset($parametres[0]) ? $parametres[0] : new Parametre();
        return $this->render('GoldLinkUserBundle:Membre:profil.html.twig',array(
                'user'=>$user,
                'nombreGroupes' => $nombreGroupe,
                'nbAdministree' => $nbAdministree,
                'nbLien'        => $nombreLien,
                'nbLienPublic'  => $nbLienPublic,
                'listeLiens'    => array_slice($listeLiens,0,10),
                'thematiques'   => $thematiques,
                'parametre'     => $parametre
            ));
    }
}
