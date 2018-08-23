<?php

namespace AppBundle\Controller;

use AppBundle\Entity\PeluqueriaSubSpeciality;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;use Symfony\Component\HttpFoundation\Request;

/**
 * Peluqueriasubspeciality controller.
 *
 * @Route("peluqueriasubspeciality")
 */
class PeluqueriaSubSpecialityController extends Controller
{
    /**
     * Lists all peluqueriaSubSpeciality entities.
     *
     * @Route("/", name="peluqueriasubspeciality_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $peluqueriaSubSpecialities = $em->getRepository('AppBundle:PeluqueriaSubSpeciality')->findAll();

        return $this->render('peluqueriasubspeciality/index.html.twig', array(
            'peluqueriaSubSpecialities' => $peluqueriaSubSpecialities,
        ));
    }

    /**
     * Creates a new peluqueriaSubSpeciality entity.
     *
     * @Route("/new", name="peluqueriasubspeciality_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $peluqueriaSubSpeciality = new Peluqueriasubspeciality();
        $form = $this->createForm('AppBundle\Form\PeluqueriaSubSpecialityType', $peluqueriaSubSpeciality);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($peluqueriaSubSpeciality);
            $em->flush();

            return $this->redirectToRoute('peluqueriasubspeciality_show', array('id' => $peluqueriaSubSpeciality->getId()));
        }

        return $this->render('peluqueriasubspeciality/new.html.twig', array(
            'peluqueriaSubSpeciality' => $peluqueriaSubSpeciality,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a peluqueriaSubSpeciality entity.
     *
     * @Route("/{id}", name="peluqueriasubspeciality_show")
     * @Method("GET")
     */
    public function showAction(PeluqueriaSubSpeciality $peluqueriaSubSpeciality)
    {
        $deleteForm = $this->createDeleteForm($peluqueriaSubSpeciality);

        return $this->render('peluqueriasubspeciality/show.html.twig', array(
            'peluqueriaSubSpeciality' => $peluqueriaSubSpeciality,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing peluqueriaSubSpeciality entity.
     *
     * @Route("/{id}/edit", name="peluqueriasubspeciality_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, PeluqueriaSubSpeciality $peluqueriaSubSpeciality)
    {
        $deleteForm = $this->createDeleteForm($peluqueriaSubSpeciality);
        $editForm = $this->createForm('AppBundle\Form\PeluqueriaSubSpecialityType', $peluqueriaSubSpeciality);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('peluqueriasubspeciality_edit', array('id' => $peluqueriaSubSpeciality->getId()));
        }

        return $this->render('peluqueriasubspeciality/edit.html.twig', array(
            'peluqueriaSubSpeciality' => $peluqueriaSubSpeciality,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a peluqueriaSubSpeciality entity.
     *
     * @Route("/{id}", name="peluqueriasubspeciality_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, PeluqueriaSubSpeciality $peluqueriaSubSpeciality)
    {
        $form = $this->createDeleteForm($peluqueriaSubSpeciality);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($peluqueriaSubSpeciality);
            $em->flush();
        }

        return $this->redirectToRoute('peluqueriasubspeciality_index');
    }

    /**
     * Creates a form to delete a peluqueriaSubSpeciality entity.
     *
     * @param PeluqueriaSubSpeciality $peluqueriaSubSpeciality The peluqueriaSubSpeciality entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(PeluqueriaSubSpeciality $peluqueriaSubSpeciality)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('peluqueriasubspeciality_delete', array('id' => $peluqueriaSubSpeciality->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
