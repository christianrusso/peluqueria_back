<?php

namespace AppBundle\Controller;

use AppBundle\Entity\PeluqueriaSpeciality;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use JMS\Serializer\SerializationContext;

/**
 * Peluqueriaspeciality controller.
 *
 * @Route("peluqueriaspeciality")
 */
class PeluqueriaSpecialityController extends Controller
{
    /**
     * Lists all peluqueriaSpeciality entities.
     *
     * @Route("/", name="peluqueriaspeciality_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $peluqueriaSpecialities = $em->getRepository('AppBundle:PeluqueriaSpeciality')->findAll();

        return $this->render('peluqueriaspeciality/index.html.twig', array(
            'peluqueriaSpecialities' => $peluqueriaSpecialities,
        ));
    }

    /**
     * Creates a new peluqueriaSpeciality entity.
     *
     * @Route("/new", name="peluqueriaspeciality_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $data = $request->request->all();
        $peluqueriaSpeciality = new Peluqueriaspeciality();
        $form = $this->createForm('AppBundle\Form\PeluqueriaSpecialityType', $peluqueriaSpeciality);
        $data["user"] = $this->getUser()->getId();
        $form->submit($data);

        if (!$form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($peluqueriaSpeciality);
            $em->flush();

        }

        return new JsonResponse(['msg' => 'Specialist created successfully!'], 201);

    }

    /**
     * Finds and displays a peluqueriaSpeciality entity.
     *
     * @Route("/{id}", name="peluqueriaspeciality_show")
     * @Method("GET")
     */
    public function showAction(PeluqueriaSpeciality $peluqueriaSpeciality)
    {
        $deleteForm = $this->createDeleteForm($peluqueriaSpeciality);

        return $this->render('peluqueriaspeciality/show.html.twig', array(
            'peluqueriaSpeciality' => $peluqueriaSpeciality,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing peluqueriaSpeciality entity.
     *
     * @Route("/{id}/edit", name="peluqueriaspeciality_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, PeluqueriaSpeciality $peluqueriaSpeciality)
    {
        $deleteForm = $this->createDeleteForm($peluqueriaSpeciality);
        $editForm = $this->createForm('AppBundle\Form\PeluqueriaSpecialityType', $peluqueriaSpeciality);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('peluqueriaspeciality_edit', array('id' => $peluqueriaSpeciality->getId()));
        }

        return $this->render('peluqueriaspeciality/edit.html.twig', array(
            'peluqueriaSpeciality' => $peluqueriaSpeciality,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a peluqueriaSpeciality entity.
     *
     * @Route("/{id}", name="peluqueriaspeciality_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, PeluqueriaSpeciality $peluqueriaSpeciality)
    {
        $form = $this->createDeleteForm($peluqueriaSpeciality);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($peluqueriaSpeciality);
            $em->flush();
        }

        return $this->redirectToRoute('peluqueriaspeciality_index');
    }

    /**
     * Creates a form to delete a peluqueriaSpeciality entity.
     *
     * @param PeluqueriaSpeciality $peluqueriaSpeciality The peluqueriaSpeciality entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(PeluqueriaSpeciality $peluqueriaSpeciality)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('peluqueriaspeciality_delete', array('id' => $peluqueriaSpeciality->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
