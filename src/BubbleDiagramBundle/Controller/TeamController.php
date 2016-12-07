<?php

namespace BubbleDiagramBundle\Controller;

use BubbleDiagramBundle\Entity\Team;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;

/**
 * Team controller.
 *
 * @Route("team")
 */
class TeamController extends Controller {

    /**
     * Lists all team entities.
     *
     * @Route("/", name="team_index")
     * @Method("GET")
     */
    public function indexAction() {
        $em = $this->getDoctrine()->getManager();

        $teams = $em->getRepository('BubbleDiagramBundle:Team')->findAll();

        return $this->render('team/index.html.twig', array(
                    'teams' => $teams,
        ));
    }

    /**
     * Creates a new team entity.
     *
     * @Route("/new", name="team_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request) {
        $team = new Team();
        $form = $this->createForm('BubbleDiagramBundle\Form\TeamType', $team);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($team);
            $em->flush($team);

            return $this->redirectToRoute('team_show', array(
                        'id' => $team->getId()));
        }

        return $this->render('team/new.html.twig', array(
                    'team' => $team,
                    'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a team entity.
     *
     * @Route("/{id}", name="team_show")
     * @Method("GET")
     */
    public function showAction(Team $team) {

        return $this->render('team/show.html.twig', array(
                    'team' => $team,
        ));
    }

    /**
     * Displays a form to edit an existing team entity.
     *
     * @Route("/{id}/edit", name="team_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, Team $team) {
        $editForm = $this->createForm('BubbleDiagramBundle\Form\TeamType', $team);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('team_edit', array(
                        'id' => $team->getId()));
        }

        return $this->render('team/edit.html.twig', array(
                    'team' => $team,
                    'edit_form' => $editForm->createView(),
        ));
    }

    /**
     * Deletes a team entity.
     *
     * @Route("/delete/{id}", name="team_delete")
     */
    public function deleteAction($id) {

        $em = $this->getDoctrine()->getManager();
        $team = $em->getRepository("BubbleDiagramBundle:Team")->find($id);

        if ($team->getBuilding() == null) {
            $em->remove($team);
            $em->flush();
        } else {
            $teams = $em->getRepository("BubbleDiagramBundle:Team")->findAll();

            return $this->render('team/index.html.twig', array(
                        'teams' => $teams,
                        'message' => "Nie można usunąć: najpierw usuń projekt, którym zajmuje się ten zespół",
            ));

        }

        $teams = $em->getRepository("BubbleDiagramBundle:Team")->findAll();

        return $this->redirectToRoute('team_index', array(
                    'teams' => $teams,
        ));
    }

}