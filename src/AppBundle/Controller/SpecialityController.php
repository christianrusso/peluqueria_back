<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Speciality;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use JMS\Serializer\SerializationContext;

/**
 * Speciality controller.
 *
 * @Route("speciality")
 */
class SpecialityController extends Controller
{
    /**
     * Lists all speciality entities.
     *
     * @Route("/", name="speciality_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();
        $specialities = $em->getRepository('AppBundle:Speciality')->findAll();
        $specialities = $this->get('jms_serializer')->serialize($specialities, 'json', SerializationContext::create()->setGroups(array('specility_index')));
        return new Response($specialities);
    }

    /**
     * Creates a new speciality entity.
     *
     * @Route("/new", name="speciality_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $speciality = new Speciality();
        $form = $this->createForm('AppBundle\Form\SpecialityType', $speciality);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($speciality);
            $em->flush();

            return $this->redirectToRoute('speciality_show', array('id' => $speciality->getId()));
        }

        return $this->render('speciality/new.html.twig', array(
            'speciality' => $speciality,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a speciality entity.
     *
     * @Route("/{id}", name="speciality_show")
     * @Method("GET")
     */
    public function showAction(Speciality $speciality)
    {
        $deleteForm = $this->createDeleteForm($speciality);

        return $this->render('speciality/show.html.twig', array(
            'speciality' => $speciality,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing speciality entity.
     *
     * @Route("/{id}/edit", name="speciality_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, Speciality $speciality)
    {
        $deleteForm = $this->createDeleteForm($speciality);
        $editForm = $this->createForm('AppBundle\Form\SpecialityType', $speciality);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('speciality_edit', array('id' => $speciality->getId()));
        }

        return $this->render('speciality/edit.html.twig', array(
            'speciality' => $speciality,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a speciality entity.
     *
     * @Route("/delete/{id}", name="speciality_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, Speciality $speciality)
    {
        
        $em = $this->getDoctrine()->getManager();
        $subSpecialities = $em->getRepository('AppBundle:SubSpeciality')->findBySpeciality($speciality->getId());
        
        foreach ($subSpecialities as $subEspecialidad ) {
            $em->remove($subEspecialidad);
            $em->flush();
        }

        $em->remove($speciality);
        $em->flush();
        
        return new JsonResponse(['msg' => 'Specialist deleted successfully!'], 201);
    }

    /**
     * Creates a form to delete a speciality entity.
     *
     * @param Speciality $speciality The speciality entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Speciality $speciality)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('speciality_delete', array('id' => $speciality->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
    /**
     * Finds and displays a speciality entity.
     *
     * @Route("/byLetter/{letter}", name="speciality_ByLetter")
     * @Method("GET")
     */
    public function findByLetterAction($letter)
    {

        $em = $this->getDoctrine()->getManager();
        if ($letter=="All" or $letter =="all"){
            $specialities = $em->getRepository('AppBundle:Speciality')->findAll();

        }else{
            $repository = $em->getRepository("AppBundle:Speciality");
            $query = $repository->createQueryBuilder('s')
                ->select(array(
                        's.id',
                        's.description',
                    )
                )
                ->where('s.description LIKE :letter')
                ->setParameter('letter', $letter.'%')

                ->setMaxResults(10000)
            ;
            $specialities=$query->getQuery()->getResult(\Doctrine\ORM\Query::HYDRATE_ARRAY);

        }

        $specialities = $this->get('jms_serializer')->serialize($specialities, 'json', SerializationContext::create()->setGroups(array('specility_index')));
        return new Response($specialities);
    }
    /**
     * Finds and displays a speciality entity.
     *
     * @Route("/byText/{text}", name="speciality_ByText")
     * @Method("GET")
     */
    public function findByTextAction($text)
    {

        $em = $this->getDoctrine()->getManager();

        $repository = $em->getRepository("AppBundle:Speciality");
        $query = $repository->createQueryBuilder('s')
            ->select(array(
                    's.id',
                    's.description',
                )
            )
            ->where('s.description LIKE :letter')
            ->setParameter('letter', '%'.$text.'%')

            ->setMaxResults(10000)
        ;
        $specialities=$query->getQuery()->getResult(\Doctrine\ORM\Query::HYDRATE_ARRAY);

        $specialities = $this->get('jms_serializer')->serialize($specialities, 'json', SerializationContext::create()->setGroups(array('specility_index')));
        return new Response($specialities);
    }

}
