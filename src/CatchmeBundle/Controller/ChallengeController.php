<?php

namespace CatchmeBundle\Controller;

use CatchmeBundle\Entity\Challenge;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

/**
 * Challenge controller.
 *
 */
class ChallengeController extends Controller
{
    /**
     * Lists all challenge entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $challenges = $em->getRepository('CatchmeBundle:Challenge')->findAll();

        return $this->render('challenge/index.html.twig', array(
            'challenges' => $challenges,
        ));
    }

    /**
     * Creates a new challenge entity.
     *
     */
    public function newAction(Request $request)
    {
        $challenge = new Challenge();
        $form = $this->createForm('CatchmeBundle\Form\ChallengeType', $challenge);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($challenge);
            $em->flush($challenge);

            return $this->redirectToRoute('challenge_show', array('id' => $challenge->getId()));
        }

        return $this->render('challenge/new.html.twig', array(
            'challenge' => $challenge,
            'form' => $form->createView(),
        ));
    }

    // Fonction pour retrouver les coordonnées de l'image
    public function gps2Num($coordPart) {
          $parts = explode('/', $coordPart);
          if (count($parts) <= 0)
              return 0;
          if (count($parts) == 1)
              return $parts[0];
          return floatval($parts[0]) / floatval($parts[1]);
    }

    // Fonction pour retrouver les coordonnées de l'image
    public function getGps($exifCoord, $hemi) {
          $degrees = count($exifCoord) > 0 ? $this->gps2Num($exifCoord[0]) : 0;
          $minutes = count($exifCoord) > 1 ? $this->gps2Num($exifCoord[1]) : 0;
          $seconds = count($exifCoord) > 2 ? $this->gps2Num($exifCoord[2]) : 0;
          $flip = ($hemi == 'W' or $hemi == 'S') ? -1 : 1;
          return $flip * ($degrees + $minutes / 60 + $seconds / 3600);
    }


    /**
     * Finds and displays a challenge entity.
     *
     */
    public function showAction(Challenge $challenge)
    {
/*        $deleteForm = $this->createDeleteForm($challenge);*/

    $nomImage = $challenge->getImage()->getUrl();
    $chemin = ('../web/uploads/images/' . $nomImage);
    $exif = exif_read_data($chemin);
    if(array_key_exists('GPSLongitude', $exif) && array_key_exists('GPSLatitude', $exif)) {
        $lng = $this->getGps($exif["GPSLongitude"], $exif['GPSLongitudeRef']);
        $lat = $this->getGps($exif["GPSLatitude"], $exif['GPSLatitudeRef']);
        $response = array(
            "status" => "success",
            "reason" => "",
            "gps" => array(
                "lat" => $lat,
                "lng" => $lng
            ),
        );
    }
    else {
        $response = array(
            "status" => "fail",
            "reason" => "The uploaded picture does not have GPS information.",
            "exif" => $exif
        );
    }

  // Isole lat et long de la photo
  $latitudePhoto = ($response['gps']['lat']);
  $longitudePhoto = ($response['gps']['lng']);
  // calcul nouvelle lat et long pour centre zone de recherche
  $randomFloatLat = (rand(0, 1) / 10000);
  // var_dump(floatval($randomFloatLat));
  $randomFloatLong = (rand(0, 99) / 10000);
  // var_dump(floatval($randomFloatLong));
  $latitudeCentreDecale = ($response['gps']['lat']-$randomFloatLat);
  $longitudeCentreDecale = ($response['gps']['lng']+$randomFloatLong);



        return $this->render('challenge/show.html.twig', array(
            'challenge' => $challenge,
            'longitudeCentre' => $longitudeCentreDecale,
            'latitideCentre' => $latitudeCentreDecale,
//            'image'=> $challenge->getImages(),
/*            'delete_form' => $deleteForm->createView(),*/
        ));
    }

    /**
     * Displays a form to edit an existing challenge entity.
     *
     */
    public function editAction(Request $request, Challenge $challenge)
    {
        $em = $this->getDoctrine()->getManager();
        $image = $em->getRepository('CatchmeBundle:Image')->findOneById($challenge->getImage()->getId());
/*        $deleteForm = $this->createDeleteForm($challenge);*/
        $editForm = $this->createForm('CatchmeBundle\Form\ChallengeType', $challenge);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $image->preUpload();
            $em->persist($challenge);
            $em->flush();

            return $this->redirectToRoute('challenge_edit', array('id' => $challenge->getId()));
        }

        return $this->render('challenge/edit.html.twig', array(
            'challenge' => $challenge,
            'edit_form' => $editForm->createView(),
/*            'delete_form' => $deleteForm->createView(),*/
        ));
    }

    /**
     * Deletes a challenge entity.
     *
     */
    public function deleteAction(Request $request, Challenge $challenge)
    {
        if ($id) {
            $em = $this->getDoctrine()->getManager();
// Recherche LE MODELE à supprimer parmi LES MODELES
            $modele = $em->getRepository('CatchmeBundle:Challenge')->findOneById($id);
// Recherche L'IMAGE DU MODELE visé
            $image = $em->getRepository('CatchmeBundle:Image')->findOneById($challenge->getImage()->getId());
// Supprime LE MODELE et SON IMAGE associée
            $em->remove($challenge);
            $em->remove($image);
// Envoie la requête à la BDD
            $em->flush();

            return $this->redirectToRoute('challenge_index');
        } else
            return $this->redirectToRoute('challenge_index');

    }
}
