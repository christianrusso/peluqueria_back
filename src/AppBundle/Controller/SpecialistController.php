<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Specialist;
use AppBundle\Entity\WorkingHours;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use JMS\Serializer\SerializationContext;

/**
 * Specialist controller.
 *
 * @Route("specialist")
 */
class SpecialistController extends Controller
{
    /**
     * Lists all specialist entities.
     *
     * @Route("/", name="specialist_index")
     * @Method("GET")
     */
    public function indexAction()
    {

        $em = $this->getDoctrine()->getManager();

        $specialists = $em->getRepository('AppBundle:Specialist')->findAll();

        return $this->render('specialist/index.html.twig', array(
            'specialists' => $specialists,
        ));
    }

    /**
     * Creates a new specialist entity.
     *
     * @Route("/new", name="specialist_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $data = $request->request->all();
        $specialist = new Specialist();
        $form = $this->createForm('AppBundle\Form\SpecialistType', $specialist);
        $form->submit($data);
        $workingHour = json_decode($data["WorkingHours"],true);
        if (!$form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($specialist);
            $em->flush();
        }
        foreach ($workingHour as $WH){
            $WorkingHours = new WorkingHours();
            $WorkingHours->setDayNumber($WH["DayNumber"]);
            $WorkingHours->setStart(new \DateTime($WH["Start"]));
            $WorkingHours->setEnd(new \DateTime($WH["End"]));
            $WorkingHours->setSpecialist($specialist);
            $em->persist($WorkingHours);
            $em->flush();
        }
        return new JsonResponse(['msg' => 'Specialist created successfully!'], 201);

    }

    /**
     * Finds and displays a specialist entity.
     *
     * @Route("/{id}", name="specialist_show")
     * @Method("GET")
     */
    public function showAction(Specialist $specialist)
    {
        $deleteForm = $this->createDeleteForm($specialist);

        return $this->render('specialist/show.html.twig', array(
            'specialist' => $specialist,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing specialist entity.
     *
     * @Route("/{id}/edit", name="specialist_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, Specialist $specialist)
    {
        $deleteForm = $this->createDeleteForm($specialist);
        $editForm = $this->createForm('AppBundle\Form\SpecialistType', $specialist);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('specialist_edit', array('id' => $specialist->getId()));
        }

        return $this->render('specialist/edit.html.twig', array(
            'specialist' => $specialist,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a specialist entity.
     *
     * @Route("/{id}", name="specialist_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, Specialist $specialist)
    {
        $form = $this->createDeleteForm($specialist);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($specialist);
            $em->flush();
        }

        return $this->redirectToRoute('specialist_index');
    }

    /**
     * Creates a form to delete a specialist entity.
     *
     * @param Specialist $specialist The specialist entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Specialist $specialist)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('specialist_delete', array('id' => $specialist->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }


}
