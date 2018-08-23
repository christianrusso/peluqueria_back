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
        $data["user"] = $this->getUser()->getId();
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

        return $this->render('specialist/show.html.twig', array(
            'specialist' => $specialist,
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
        $data = $request->request->all();
        $editForm = $this->createForm('AppBundle\Form\SpecialistType', $specialist);
        $editForm->submit($data);

        if (!$editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();
            return new JsonResponse(['msg' => 'Specialist update successfully!'], 201);
        }

    }

    /**
     * Deletes a specialist entity.
     *
     * @Route("/{id}/delete", name="specialist_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, Specialist $specialist=null)
    {
        if (!($specialist)) {
            return new JsonResponse(["msg"=>"Specialist dont exist"],400);
        }

        $em = $this->getDoctrine()->getManager();
        $workinHours = $em->getRepository('AppBundle:WorkingHours')->findBySpecialist($specialist->getId());

        foreach ($workinHours as $workinHour ) {
            $em->remove($workinHour);
            $em->flush();
        }
        $em->remove($specialist);
        $em->flush();


        return new JsonResponse(['msg' => 'Specialist created successfully!'], 201);
    }



}
