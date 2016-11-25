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
 * @Route("building/{building_id}/level")
 */
class LevelController extends Controller {

    /**
     * Lists all level entities.
     *
     * @Route("/", name="level_index")
     * @Method("GET")
     */
    public function indexAction($building_id) {
        $em = $this->getDoctrine()->getManager();

        $levels = $em->getRepository('BubbleDiagramBundle:Level')->findAll();

        return $this->render('level/index.html.twig', array(
                    'building_id' => $building_id,
                    'levels' => $levels,
        ));
    }

    /**
     * Creates a new level entity.
     *
     * @Route("/new", name="level_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request, $building_id) {
        $level = new Level();
        $form = $this->createForm('BubbleDiagramBundle\Form\LevelType', $level);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($level);
            $em->flush($level);

            return $this->redirectToRoute('level_show', array(
                        'building_id' => $building_id,
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


        return $this->render('level/show.html.twig', array(
                    'level' => $level
        ));
    }

    /**
     * Displays a form to edit an existing level entity.
     *
     * @Route("/{id}/edit", name="level_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, Level $level, $building_id) {

        $editForm = $this->createForm('BubbleDiagramBundle\Form\LevelType', $level);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('level_edit', array(
                        'building_id' => $building_id,
                        'id' => $level->getId()));
        }

        return $this->render('level/edit.html.twig', array(
                    'level' => $level,
                    'edit_form' => $editForm->createView(),
        ));
    }

    /**
     * Deletes a level entity.
     *
     * @Route("/delete/{id}", name="level_delete")
     * 
     */
    public function deleteAction($id, $building_id) {

        $em = $this->getDoctrine()->getManager();
        $level = $em->getRepository("BubbleDiagramBundle:Level")->find($id);
        $em->remove($level);
        $em->flush();

        $levels = $em->getRepository("BubbleDiagramBundle:Level")->findAll();

        return $this->redirectToRoute('level_index', array(
                    'building_id' => $building_id,
                    'levels' => $levels
        ));
    }

    /**
     * Displays page with all building rooms selected by level
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