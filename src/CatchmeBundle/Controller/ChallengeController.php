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

        return $this->render('@Catchme/challenge/index.html.twig', array(
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

        return $this->render('@Catchme/challenge/new.html.twig', array(
            'challenge' => $challenge,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a challenge entity.
     *
     */
    public function showAction(Challenge $challenge)
    {
/*        $deleteForm = $this->createDeleteForm($challenge);*/

        return $this->render('@Catchme/challenge/show.html.twig', array(
            'challenge' => $challenge,
//            'image'=> $challenge->getImages(),
/*            'delete_form' => $deleteForm->createView(),*/
        ));
    }

    public function validationAction(Challenge $challenge, Request $request)
    {
        $form = $this->createForm('CatchmeBundle\Form\ChallengeType', $challenge);
        $form->handleRequest($request);

        return $this->render('@Catchme/challenge/validation.html.twig', array(
            'challenges' => $challenge,
            'form' => $form->createView(),
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

        return $this->render('@Catchme/challenge/edit.html.twig', array(
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
