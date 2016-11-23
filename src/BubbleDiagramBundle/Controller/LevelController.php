<?php

namespace BubbleDiagramBundle\Controller;

use BubbleDiagramBundle\Entity\Level;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

/**
 * Level controller.
 *
 * @Route("level")
 */
class LevelController extends Controller {

    /**
     * Lists all level entities.
     *
     * @Route("/", name="level_index")
     * @Method("GET")
     */
    public function indexAction() {
        $em = $this->getDoctrine()->getManager();

        $levels = $em->getRepository('BubbleDiagramBundle:Level')->findAll();

        return $this->render('level/index.html.twig', array(
                    'levels' => $levels,
        ));
    }

    /**
     * Creates a new level entity.
     *
     * @Route("/new", name="level_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request) {
        $level = new Level();
        $form = $this->createForm('BubbleDiagramBundle\Form\LevelType', $level);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($level);
            $em->flush($level);

            return $this->redirectToRoute('level_show', array(
                        'id' => $level->getId()));
        }

        return $this->render('level/new.html.twig', array(
                    'level' => $level,
                    'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a level entity.
     *
     * @Route("/{id}", name="level_show")
     * @Method("GET")
     */
    public function showAction(Level $level) {
        $deleteForm = $this->createDeleteForm($level);

        return $this->render('level/show.html.twig', array(
                    'level' => $level,
                    'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing level entity.
     *
     * @Route("/{id}/edit", name="level_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, Level $level) {
        $deleteForm = $this->createDeleteForm($level);
        $editForm = $this->createForm('BubbleDiagramBundle\Form\LevelType', $level);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('level_edit', array(
                        'id' => $level->getId()));
        }

        return $this->render('level/edit.html.twig', array(
                    'level' => $level,
                    'edit_form' => $editForm->createView(),
                    'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a level entity.
     *
     * @Route("/{id}", name="level_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, Level $level) {
        $form = $this->createDeleteForm($level);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($level);
            $em->flush($level);
        }

        return $this->redirectToRoute('level_index');
    }

    /**
     * Creates a form to delete a level entity.
     *
     * @param Level $level The level entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Level $level) {
        return $this->createFormBuilder()
                        ->setAction($this->generateUrl('level_delete', array(
                                    'id' => $level->getId())))
                        ->setMethod('DELETE')
                        ->getForm()
        ;
    }

    /**
     * Redirects to page with all building rooms selected by level
     * 
     * @Route("/{id}/room/onLevel", name="all_rooms_on_level")
     * @Template()
     */
    public function showRoomsOnLevel($id) {

        $em = $this->getDoctrine()->getManager();
        $rooms = $em->getRepository('BubbleDiagramBundle:Room')->findByLevel($id);
        $level = $em->getRepository("BubbleDiagramBundle:Level")->find($id);
        return array(
            'rooms' => $rooms,
            'level' => $level);
    }

}