<?php

namespace AppBundle\Controller;

use AppBundle\Entity\PeluqueriaSubSpeciality;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use JMS\Serializer\SerializationContext;
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
        $data = $request->request->all();

        $peluqueriaSubSpeciality = new Peluqueriasubspeciality();
        $form = $this->createForm('AppBundle\Form\PeluqueriaSubSpecialityType', $peluqueriaSubSpeciality);
        $form->submit($data);

        if (! $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($peluqueriaSubSpeciality);
            $em->flush();
        }

        return new JsonResponse(['msg' => 'Specialist created successfully!'], 201);

    }

    /**
     * Finds and displays a peluqueriaSubSpeciality entity.
     *
     * @Route("/{id}", name="peluqueriasubspeciality_show")
     * @Method("GET")
     */
    public function showAction(PeluqueriaSubSpeciality $peluqueriaSubSpeciality)
    {

        return $this->render('peluqueriasubspeciality/show.html.twig', array(
            'peluqueriaSubSpeciality' => $peluqueriaSubSpeciality,
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
        $editForm = $this->createForm('AppBundle\Form\PeluqueriaSubSpecialityType', $peluqueriaSubSpeciality);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('peluqueriasubspeciality_edit', array('id' => $peluqueriaSubSpeciality->getId()));
        }

        return $this->render('peluqueriasubspeciality/edit.html.twig', array(
            'peluqueriaSubSpeciality' => $peluqueriaSubSpeciality,
            'edit_form' => $editForm->createView(),
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

            $em = $this->getDoctrine()->getManager();
            $em->remove($peluqueriaSubSpeciality);
            $em->flush();


        return $this->redirectToRoute('peluqueriasubspeciality_index');
    }

    /**
     * Finds and displays a speciality entity.
     *
     * @Route("/get/AllForSelect", name="speciality_ByLetter_peluqueriaSubSpeciality")
     * @Method("POST")
     */
    public function getAllForSelectAction(Request $request)
    {
        $data = json_decode($request->getContent(),true);
        $em = $this->getDoctrine()->getManager();
        $repository = $em->getRepository("AppBundle:PeluqueriaSpeciality");

        if ($data["id"]==-1){
            $query = $repository->createQueryBuilder('s')
                ->select(array(
                        'sp.id',
                        'sp.description as text',
                    )
                )
                ->innerJoin('AppBundle:PeluqueriaSubSpeciality', 'sp', 'WITH', 'sp.peluqueria_speciality = s.id')
                ->andWhere('s.user = :id')
                ->setParameter('id', $this->getUser()->getId())
                ->setMaxResults(10000);
        }else{
            $query = $repository->createQueryBuilder('s')
                ->select(array(
                        'sp.id',
                        'sp.description as text',
                    )
                )
                ->innerJoin('AppBundle:PeluqueriaSubSpeciality', 'sp', 'WITH', 'sp.peluqueria_speciality = s.id')
                ->where('sp.peluqueria_speciality= :idSub')
                ->andWhere('s.user = :id')
                ->setParameter('id', $this->getUser()->getId())
                ->setParameter('idSub', $data["id"])
                ->setMaxResults(10000);
        }


        $specialities=$query->getQuery()->getResult(\Doctrine\ORM\Query::HYDRATE_ARRAY);


        return new JsonResponse($specialities);

    }
}
