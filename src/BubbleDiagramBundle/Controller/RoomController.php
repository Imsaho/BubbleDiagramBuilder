<?php

namespace BubbleDiagramBundle\Controller;

use BubbleDiagramBundle\Entity\Room;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;

/**
 * Room controller.
 *
 * @Route("building/{building_id}/room")
 */
class RoomController extends Controller {

    /**
     * Lists all room entities.
     *
     * @Route("/", name="room_index")
     * @Method("GET")
     */
    public function indexAction($building_id) {
        $em = $this->getDoctrine()->getManager();

        $building = $em->getRepository("BubbleDiagramBundle:Building")->find($building_id);
        $rooms = $em->getRepository('BubbleDiagramBundle:Room')->findByBuilding($building);

        return $this->render('room/index.html.twig', array(
                    'rooms' => $rooms,
                    'building_id' => $building_id,
        ));
    }

    /**
     * Creates a new room entity.
     *
     * @Route("/new", name="room_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request, $building_id) {
        $room = new Room();
        $form = $this->createForm('BubbleDiagramBundle\Form\RoomType', $room);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $building = $em->getRepository("BubbleDiagramBundle:Building")->find($building_id);
            $room->setBuilding($building);
            $em->persist($room);
            $em->flush($room);

            return $this->redirectToRoute('room_show', array(
                        'id' => $room->getId(),
                        'building_id' => $building_id));
        }

        return $this->render('room/new.html.twig', array(
                    'building_id' => $building_id,
                    'room' => $room,
                    'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a room entity.
     *
     * @Route("/{id}", name="room_show")
     * @Method("GET")
     */
    public function showAction(Room $room, $building_id) {
        
        return $this->render('room/show.html.twig', array(
                    'building_id' => $building_id,
                    'room' => $room
        ));
    }

    /**
     * Displays a form to edit an existing room entity.
     *
     * @Route("/{id}/edit", name="room_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, Room $room, $building_id) {
        $deleteForm = $this->createDeleteForm($room);
        $editForm = $this->createForm('BubbleDiagramBundle\Form\RoomType', $room);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('room_edit', array(
                        'id' => $room->getId(),
                        'building_id' => $building_id,
                    ));
        }

        return $this->render('room/edit.html.twig', array(
                    'room' => $room,
                    'edit_form' => $editForm->createView(),
                    'delete_form' => $deleteForm->createView(),
                    'building_id' => $building_id,
        ));
    }

    /**
     * Deletes a room entity.
     *
     * @Route("/delete/{id}", name="room_delete")
     */
    public function deleteAction($id, $building_id) {
        
        $em = $this->getDoctrine()->getManager();
        $room = $em->getRepository("BubbleDiagramBundle:Room")->find($id);
        $em->remove($room);
        $em->flush();
        
        $rooms = $em->getRepository("BubbleDiagramBundle:Room")->findAll();

        return $this->redirectToRoute('room_index', array(
            'building_id' => $building_id,
            'rooms' => $rooms,
        ));
    }

    /**
     * Creates a form to delete a room entity.
     *
     * @param Room $room The room entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Room $room) {
        return $this->createFormBuilder()
                        ->setAction($this->generateUrl('room_delete', array(
                                    'id' => $room->getId())))
                        ->setMethod('DELETE')
                        ->getForm()
        ;
    }

}