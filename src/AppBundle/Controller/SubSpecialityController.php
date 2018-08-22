<?php

namespace AppBundle\Controller;

use AppBundle\Entity\SubSpeciality;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use JMS\Serializer\SerializationContext;

/**
 * Subspeciality controller.
 *
 * @Route("subspeciality")
 */
class SubSpecialityController extends Controller
{
    /**
     * Lists all subSpeciality entities.
     *
     * @Route("/", name="subspeciality_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $subSpecialities = $em->getRepository('AppBundle:SubSpeciality')->findAll();
        $subSpecialities = $this->get('jms_serializer')->serialize($subSpecialities, 'json');
        return new Response($subSpecialities);
    }

    /**
     * Creates a new subSpeciality entity.
     *
     * @Route("/new", name="subspeciality_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $subSpeciality = new Subspeciality();
        $form = $this->createForm('AppBundle\Form\SubSpecialityType', $subSpeciality);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($subSpeciality);
            $em->flush();

            return $this->redirectToRoute('subspeciality_show', array('id' => $subSpeciality->getId()));
        }

        return $this->render('subspeciality/new.html.twig', array(
            'subSpeciality' => $subSpeciality,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a subSpeciality entity.
     *
     * @Route("/{id}", name="subspeciality_show")
     * @Method("GET")
     */
    public function showAction(SubSpeciality $subSpeciality)
    {
        $deleteForm = $this->createDeleteForm($subSpeciality);

        return $this->render('subspeciality/show.html.twig', array(
            'subSpeciality' => $subSpeciality,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing subSpeciality entity.
     *
     * @Route("/{id}/edit", name="subspeciality_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, SubSpeciality $subSpeciality)
    {
        $deleteForm = $this->createDeleteForm($subSpeciality);
        $editForm = $this->createForm('AppBundle\Form\SubSpecialityType', $subSpeciality);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('subspeciality_edit', array('id' => $subSpeciality->getId()));
        }

        return $this->render('subspeciality/edit.html.twig', array(
            'subSpeciality' => $subSpeciality,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a subSpeciality entity.
     *
     * @Route("/{id}", name="subspeciality_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, SubSpeciality $subSpeciality)
    {
        $form = $this->createDeleteForm($subSpeciality);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($subSpeciality);
            $em->flush();
        }

        return $this->redirectToRoute('subspeciality_index');
    }

    /**
     * Creates a form to delete a subSpeciality entity.
     *
     * @param SubSpeciality $subSpeciality The subSpeciality entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(SubSpeciality $subSpeciality)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('subspeciality_delete', array('id' => $subSpeciality->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }


    /**
     * Finds and displays a subSpeciality entity.
     *
     * @Route("/byEspecility/{id}", name="subspeciality_show_byEspeciality")
     * @Method("GET")
     */
    public function showBySpecialityAction($id)
    {
        $em = $this->getDoctrine()->getManager();
        $subSpecialities = $em->getRepository('AppBundle:SubSpeciality')->findBySpeciality($id);
        $subSpecialities = $this->get('jms_serializer')->serialize($subSpecialities, 'json', SerializationContext::create()->setGroups(array('subSpeciality_index')));

        return new Response($subSpecialities);
    }

}
