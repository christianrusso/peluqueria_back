<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Peluqueria_Patient;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;use Symfony\Component\HttpFoundation\Request;

/**
 * Peluqueria_patient controller.
 *
 * @Route("peluqueria_patient")
 */
class Peluqueria_PatientController extends Controller
{
    /**
     * Lists all peluqueria_Patient entities.
     *
     * @Route("/", name="peluqueria_patient_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $peluqueria_Patients = $em->getRepository('AppBundle:Peluqueria_Patient')->findAll();

        return $this->render('peluqueria_patient/index.html.twig', array(
            'peluqueria_Patients' => $peluqueria_Patients,
        ));
    }

    /**
     * Creates a new peluqueria_Patient entity.
     *
     * @Route("/new", name="peluqueria_patient_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $peluqueria_Patient = new Peluqueria_patient();
        $form = $this->createForm('AppBundle\Form\Peluqueria_PatientType', $peluqueria_Patient);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($peluqueria_Patient);
            $em->flush();

            return $this->redirectToRoute('peluqueria_patient_show', array('id' => $peluqueria_Patient->getId()));
        }

        return $this->render('peluqueria_patient/new.html.twig', array(
            'peluqueria_Patient' => $peluqueria_Patient,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a peluqueria_Patient entity.
     *
     * @Route("/{id}", name="peluqueria_patient_show")
     * @Method("GET")
     */
    public function showAction(Peluqueria_Patient $peluqueria_Patient)
    {
        $deleteForm = $this->createDeleteForm($peluqueria_Patient);

        return $this->render('peluqueria_patient/show.html.twig', array(
            'peluqueria_Patient' => $peluqueria_Patient,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing peluqueria_Patient entity.
     *
     * @Route("/{id}/edit", name="peluqueria_patient_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, Peluqueria_Patient $peluqueria_Patient)
    {
        $deleteForm = $this->createDeleteForm($peluqueria_Patient);
        $editForm = $this->createForm('AppBundle\Form\Peluqueria_PatientType', $peluqueria_Patient);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('peluqueria_patient_edit', array('id' => $peluqueria_Patient->getId()));
        }

        return $this->render('peluqueria_patient/edit.html.twig', array(
            'peluqueria_Patient' => $peluqueria_Patient,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a peluqueria_Patient entity.
     *
     * @Route("/{id}", name="peluqueria_patient_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, Peluqueria_Patient $peluqueria_Patient)
    {
        $form = $this->createDeleteForm($peluqueria_Patient);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($peluqueria_Patient);
            $em->flush();
        }

        return $this->redirectToRoute('peluqueria_patient_index');
    }

    /**
     * Creates a form to delete a peluqueria_Patient entity.
     *
     * @param Peluqueria_Patient $peluqueria_Patient The peluqueria_Patient entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Peluqueria_Patient $peluqueria_Patient)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('peluqueria_patient_delete', array('id' => $peluqueria_Patient->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
