<?php

namespace CatchmeBundle\Controller;

use CatchmeBundle\Entity\User;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

/**
 * User controller.
 *
 */
class UserController extends Controller
{
    /**
     * Lists all user entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $users = $em->getRepository('CatchmeBundle:User')->findAll();

        return $this->render('user/index.html.twig', array(
            'users' => $users,
        ));
    }

    /**
     * Creates a new user entity.
     *
     */
    public function newAction(Request $request)
    {
        $user = new User();
        $form = $this->createForm('CatchmeBundle\Form\UserType', $user);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($user);
            $em->flush($user);

            return $this->redirectToRoute('user_show', array('id' => $user->getId()));
        }

        return $this->render('user/new.html.twig', array(
            'user' => $user,
            'form' => $form->createView(),

    ));
    }

    /**
     * Finds and displays a user entity.
     *
     */
    public function showAction(User $user)
    {
        $deleteForm = $this->createDeleteForm($user);

        return $this->render('user/show.html.twig', array(
            'user' => $user,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing user entity.
     *
     */
    public function editAction(Request $request, User $user)
    {
        $em = $this->getDoctrine()->getManager();
        $image = $em->getRepository('CatchmeBundle:Image')->findOneById($user->getImage()->getId());

        $deleteForm = $this->createDeleteForm($user);
        $editForm = $this->createForm('CatchmeBundle\Form\UserType', $user);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('user_edit', array('id' => $user->getId()));
        }

        return $this->render('user/edit.html.twig', array(
            'user' => $user,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a user entity.
     *
     */
    public function deleteAction($id)
    {
//        Si l'$id est définie alors :
        if ($id) {
            $em = $this->getDoctrine()->getManager();
            // Recherche L'ARTICLE à supprimer parmi LES ARTICLES
            $article = $em->getRepository('CatchmeBundle:User')->findOneById($id);
            // Recherche L'IMAGE DE L'ARTICLE visé
            $image = $em->getRepository('CatchmeBundle:Image')->findOneById($article->getImage()->getId());
            // Supprime L'ARTICLE et SON IMAGE associée
            $em->remove($user);
            $em->remove($image);
            // Envoie la requête à la BDD
            $em->flush();
            return $this->redirectToRoute('user_index');
        } else
            return $this->redirectToRoute('user_index');
    }
}





//    GENERATED CODE FROM CRUD
//    public function deleteAction(Request $request, User $user)
//    {
//        $form = $this->createDeleteForm($user);
//        $form->handleRequest($request);
//
//        if ($form->isSubmitted() && $form->isValid()) {
//            $em = $this->getDoctrine()->getManager();
//            $em->remove($user);
//            $em->flush($user);
//        }
//
//        return $this->redirectToRoute('user_index');
//    }
//
//    /**
//     * Creates a form to delete a user entity.
//     *
//     * @param User $user The user entity
//     *
//     * @return \Symfony\Component\Form\Form The form
//     */
//    private function createDeleteForm(User $user)
//    {
//        return $this->createFormBuilder()
//            ->setAction($this->generateUrl('user_delete', array('id' => $user->getId())))
//            ->setMethod('DELETE')
//            ->getForm()
//        ;
//    }
//}
