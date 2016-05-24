<?php
  namespace GoldLink\LienBundle\Controller;
  use GoldLink\LienBundle\Entity\Lien;
  use Symfony\Bundle\FrameworkBundle\Controller\Controller;

  /**
   * Class AjaxController
   * @package GoldLink\LienBundle\Controller
   */
  class AjaxController extends Controller{
      public function rechercherAction($type,$categorie,$ordre){
          $rep =$this
              ->getDoctrine()
              ->getRepository('GoldLinkLienBundle:Lien');
          $userId = $this->getUser()->getId();
          switch($categorie){
              case "personnel" :
                  switch($type) {
                      case "date":
                          $result = $rep->rechercherPersonnelDate($ordre,$userId);
                          return $this->render('GoldLinkLienBundle:Recherche:rechercherPersonnelDate.html.twig',array('result' => $result));
                      case "note":
                          $result = $rep->rechercherPersonnelNote($ordre,$userId);
                          return $this->render('GoldLinkLienBundle:Recherche:rechercherPersonnelNote.html.twig',array('result' => $result));
                      case "clics":
                          $result = $rep->rechercherPersonnelClic($ordre,$userId);
                          return $this->render('GoldLinkLienBundle:Recherche:rechercherPersonnelClic.html.twig',array('result' => $result));
                      case "popularite":
                          $result = $rep->rechercherPersonnelPopularite($ordre,$userId);
                          return $this->render('GoldLinkLienBundle:Recherche:rechercherPersonnelPopularite.html.twig',array('result' => $result));
                      default:
                          break;
                  }
                  break;
              case "groupe":
                  switch($type) {
                      case "date":
                          $result = $rep->rechercherGroupeDate($ordre,$userId);
                          return $this->render('GoldLinkLienBundle:Recherche:rechercherGroupeDate.html.twig',array('result' => $result));
                      case "note":
                          $result = $rep->rechercherGroupeNote($ordre,$userId);
                          return $this->render('GoldLinkLienBundle:Recherche:rechercherGroupeNote.html.twig',array('result' => $result));
                      case "clics":
                          $result = $rep->rechercherGroupeClic($ordre,$userId);
                          return $this->render('GoldLinkLienBundle:Recherche:rechercherGroupeClic.html.twig',array('result' => $result));
                      case "popularite":

                          $result = $rep->rechercherGroupePopularite($ordre,$userId);
                          return $this->render('GoldLinkLienBundle:Recherche:rechercherGroupePopularite.html.twig',array('result' => $result));
                      default:
                          break;
                  }
                  break;
              case "public":
                  switch($type) {
                      case "date":
                          $result = $rep->rechercherPublicDate($ordre,$userId);
                          return $this->render('GoldLinkLienBundle:Recherche:rechercherPublicDate.html.twig',array('result' => $result));
                      case "note":
                          $result = $rep->rechercherPubliclNote($ordre,$userId);
                          return $this->render('GoldLinkLienBundle:Recherche:rechercherPublicNote.html.twig',array('result' => $result));
                      case "clics":
                          $result = $rep->rechercherPublicClic($ordre,$userId);
                          return $this->render('GoldLinkLienBundle:Recherche:rechercherPublicClic.html.twig',array('result' => $result));
                      case "popularite":
                          $result = $rep->rechercherPublicPopularite($ordre,$userId);
                          return $this->render('GoldLinkLienBundle:Recherche:rechercherPublicPopularite.html.twig',array('result' => $result));
                      default:
                          break;
                  }
                  break;
              default:
                  break;
          }
          //teste des resultats
          die();
          return $this->render('GoldLinkLienBundle:Lien:rechercher-note.html.twig',
              array(
                  'recherches' => $result,
                  'userId'     => $this->getUser()->getId()
              )
          );
      }
  }