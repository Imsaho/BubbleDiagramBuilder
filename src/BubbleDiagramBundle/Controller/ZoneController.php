<?php

namespace BubbleDiagramBundle\Controller;

use BubbleDiagramBundle\Entity\Zone;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

/**
 * Zone controller.
 *
 * @Route("building/{building_id}/zone")
 */
class ZoneController extends Controller {

    /**
     * Lists all zone entities.
     *
     * @Route("/", name="zone_index")
     * @Method("GET")
     */
    public function indexAction() {
        $em = $this->getDoctrine()->getManager();

        $zones = $em->getRepository('BubbleDiagramBundle:Zone')->findAll();

        return $this->render('zone/index.html.twig', array(
                    'zones' => $zones,
        ));
    }

    /**
     * Creates a new zone entity.
     *
     * @Route("/new", name="zone_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request, $building_id) {
        $zone = new Zone();
        $form = $this->createForm('BubbleDiagramBundle\Form\ZoneType', $zone);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($zone);
            $em->flush($zone);

            return $this->redirectToRoute('zone_show', array(
                        'building_id' => $building_id,
                        'id' => $zone->getId()));
        }

        return $this->render('zone/new.html.twig', array(
                    'zone' => $zone,
                    'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a zone entity.
     *
     * @Route("/{id}", name="zone_show")
     * @Method("GET")
     */
    public function showAction(Zone $zone) {

        return $this->render('zone/show.html.twig', array(
                    'zone' => $zone
        ));
    }

    /**
     * Displays a form to edit an existing zone entity.
     *
     * @Route("/{id}/edit", name="zone_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, Zone $zone, $building_id) {

        $editForm = $this->createForm('BubbleDiagramBundle\Form\ZoneType', $zone);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('zone_edit', array(
                        'building_id' => $building_id,
                        'id' => $zone->getId()));
        }

        return $this->render('zone/edit.html.twig', array(
                    'zone' => $zone,
                    'edit_form' => $editForm->createView()
        ));
    }

    /**
     * Deletes a zone entity.
     *
     * @Route("/delete/{id}", name="zone_delete")
     * 
     */
    public function deleteAction($id, $building_id) {

        $em = $this->getDoctrine()->getManager();
        $zone = $em->getRepository("BubbleDiagramBundle:Zone")->find($id);
        $em->remove($zone);
        $em->flush();

        $zones = $em->getRepository("BubbleDiagramBundle:Zone")->findAll();

        return $this->redirectToRoute('zone_index', array(
                    'building_id' => $building_id,
                    'zones' => $zones
        ));
    }

    /**
     * Displays page with all building rooms selected by zone
     * 
     * @Route("/{id}/room/inZone", name="all_rooms_in_zone")
     * @Template()
     */
    public function showRoomsInZone($id) {

        $em = $this->getDoctrine()->getManager();
        $rooms = $em->getRepository('BubbleDiagramBundle:Room')->findByZone($id);
        $zone = $em->getRepository("BubbleDiagramBundle:Zone")->find($id);
        return array(
            'rooms' => $rooms,
            'zone' => $zone);
    }

}