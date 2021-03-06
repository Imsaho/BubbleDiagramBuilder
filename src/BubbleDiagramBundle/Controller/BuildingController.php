<?php

namespace BubbleDiagramBundle\Controller;

use BubbleDiagramBundle\Entity\Building;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

/**
 * Building controller.
 *
 * @Route("building")
 */
class BuildingController extends Controller {

    /**
     * Lists all building entities.
     *
     * @Route("/", name="building_index")
     * @Method("GET")
     */
    public function indexAction() {
        $em = $this->getDoctrine()->getManager();

        $buildings = $em->getRepository('BubbleDiagramBundle:Building')->findAll();

        return $this->render('building/index.html.twig', array(
                    'buildings' => $buildings,
        ));
    }

    /**
     * Creates a new building entity.
     *
     * @Route("/new", name="building_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request) {
        $building = new Building();
        $form = $this->createForm('BubbleDiagramBundle\Form\BuildingType', $building);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($building);
            $em->flush($building);

            return $this->redirectToRoute('building_show', array(
                        'id' => $building->getId()));
        }

        return $this->render('building/new.html.twig', array(
                    'building' => $building,
                    'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a building entity.
     *
     * @Route("/{id}", name="building_show")
     * @Method("GET")
     */
    public function showAction($id) {
        
        $em = $this->getDoctrine()->getManager();
        $building = $em->getRepository("BubbleDiagramBundle:Building")->find($id);

        return $this->render('building/show.html.twig', array(
                    'building' => $building,
        ));
    }

    /**
     * Displays a form to edit an existing building entity.
     *
     * @Route("/{id}/edit", name="building_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, Building $building, $id) {
        $this->denyAccessUnlessGranted('edit', $building);

        $editForm = $this->createForm('BubbleDiagramBundle\Form\BuildingType', $building);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('building_index', array(
                        'id' => $building->getId()));
        }

        return $this->render('building/edit.html.twig', array(
                    'building' => $building,
                    'edit_form' => $editForm->createView(),
                    'id' => $building->getId(),
        ));
    }

    /**
     * Deletes a building entity.
     *
     * @Route("/delete/{id}", name="building_delete")
     */
    public function deleteAction($id) {

        $em = $this->getDoctrine()->getManager();
        $building = $em->getRepository("BubbleDiagramBundle:Building")->find($id);
        $em->remove($building);
        $em->flush();

        $buildings = $em->getRepository("BubbleDiagramBundle:Building")->findAll();

        return $this->redirectToRoute('building_index', array(
                    'buildings' => $buildings,
        ));
    }

    /**
     * Displays page with all building rooms selected by level
     * 
     * @Route("/{id}/room/byLevel", name="all_rooms_by_level")
     * @Template()
     */
    public function showRoomsByLevel($id) {

        $em = $this->getDoctrine()->getManager();
        $building = $em->getRepository("BubbleDiagramBundle:Building")->find($id);
        $levels = $em->getRepository("BubbleDiagramBundle:Level")->findByBuilding($id);
        return array(
            'building' => $building,
            'building_id' => $id,
            'levels' => $levels);
    }

    /**
     * Displays page with all building rooms selected by zone
     * 
     * @Route("/{id}/room/byZone", name="all_rooms_by_zone")
     * @Template()
     */
    public function showRoomsByZone($id) {
        $em = $this->getDoctrine()->getManager();
        $building = $em->getRepository("BubbleDiagramBundle:Building")->find($id);
        $zones = $em->getRepository("BubbleDiagramBundle:Zone")->findByBuilding($id);
        return array(
            'building' => $building,
            'building_id' => $id,
            'zones' => $zones);
    }

}