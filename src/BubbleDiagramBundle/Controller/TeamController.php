<?php

namespace BubbleDiagramBundle\Controller;

use BubbleDiagramBundle\Entity\Team;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

/**
 * Team controller.
 *
 * @Route("team")
 */
class TeamController extends Controller
{
    public function createAddUserForm($team) {
        $form = $this->createFormBuilder($team)
                ->setAction($this->generateUrl('add_user_to_team'))
                ->setMethod('POST')
                ->add('users')
                ->add('save', SubmitType::class)
                ->getForm();
        return $form;
    }
    
    /**
     * Lists all team entities.
     *
     * @Route("/", name="team_index")
     * @Method("GET")
     */
    public function indexAction()
    {
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
    public function newAction(Request $request)
    {
        //$user = $this->getUser();
        $team = new Team();
        $form = $this->createForm('BubbleDiagramBundle\Form\TeamType', $team);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $user = $this->getUser()->addTeam($team);
            $em->persist($team);
            $em->persist($user);
            $em->flush();

            return $this->redirectToRoute('team_show', array('id' => $team->getId()));
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
    public function showAction(Team $team)
    {
        $deleteForm = $this->createDeleteForm($team);
        //dump($team); die();

        return $this->render('team/show.html.twig', array(
            'team' => $team,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing team entity.
     *
     * @Route("/{id}/edit", name="team_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, Team $team)
    {
        $deleteForm = $this->createDeleteForm($team);
        $editForm = $this->createForm('BubbleDiagramBundle\Form\TeamType', $team);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('team_edit', array('id' => $team->getId()));
        }

        return $this->render('team/edit.html.twig', array(
            'team' => $team,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }
    
    /**
     * Adds selected user to the team
     * 
     * @Route("/{id}/addUser", name="add_user_to_team")
     * @Method({"GET", "POST"})
     */
    public function addUserToTeamAction(Request $request, Team $team) {
        $addUserForm = $this->createAddUserForm($team);
        $addUserForm->handleRequest($request);
        
        if ($addUserForm->isSubmitted() && $addUserForm->isValid()) {
            ;
        }
    }

    /**
     * Deletes a team entity.
     *
     * @Route("/{id}", name="team_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, Team $team)
    {
        $form = $this->createDeleteForm($team);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($team);
            $em->flush($team);
        }

        return $this->redirectToRoute('team_index');
    }

    /**
     * Creates a form to delete a team entity.
     *
     * @param Team $team The team entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Team $team)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('team_delete', array('id' => $team->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
