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
        $specialities= $em->getRepository('AppBundle:PeluqueriaSpeciality')->findBy( ['user' =>$this->getUser()->getId()]);
        $specialities = $this->get('jms_serializer')->serialize($specialities, 'json', SerializationContext::create()->setGroups(array('peluqueria_speciality_index')));
        return new Response($specialities);
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

        return $this->render('peluqueriaspeciality/show.html.twig', array(
            'peluqueriaSpeciality' => $peluqueriaSpeciality,
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
        $data = $request->request->all();

        $editForm = $this->createForm('AppBundle\Form\PeluqueriaSpecialityType', $peluqueriaSpeciality);
        $editForm->submit($data);

        if (!$editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return new JsonResponse(['msg' => 'Specialist edit successfully!'], 201);
        }


    }

    /**
     * Deletes a peluqueriaSpeciality entity.
     *
     * @Route("/{id}/delete", name="peluqueriaspeciality_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, PeluqueriaSpeciality $peluqueriaSpeciality)
    {

            $em = $this->getDoctrine()->getManager();
            $subSpecialities = $em->getRepository('AppBundle:PeluqueriaSubSpeciality')->findBySpeciality($peluqueriaSpeciality->getId());

            foreach ($subSpecialities as $subEspecialidad ) {
                $em->remove($subEspecialidad);
                $em->flush();
            }
            $em = $this->getDoctrine()->getManager();
            $em->remove($peluqueriaSpeciality);
            $em->flush();


        return new JsonResponse(['msg' => 'Specialist delete successfully!'], 201);
    }

    /**
     * Finds and displays a speciality entity.
     *
     * @Route("/byLetter/{letter}", name="speciality_ByLetter_peluqueriaSpeciality")
     * @Method("GET")
     */
    public function findByLetterAction($letter)
    {

        $em = $this->getDoctrine()->getManager();
        if ($letter=="All" or $letter =="all"){
            $repository = $em->getRepository("AppBundle:PeluqueriaSpeciality");
            $query = $repository->createQueryBuilder('s')
                ->select(array(
                        's.id',
                        'sp.description as text',
                    )
                )
                ->innerJoin('AppBundle:Speciality', 'sp', 'WITH', 'sp.id = s.speciality')

                ->andWhere('s.user = :id')
                ->setParameter('id', $this->getUser()->getId())
                ->setMaxResults(10000)
            ;
            $specialities=$query->getQuery()->getResult(\Doctrine\ORM\Query::HYDRATE_ARRAY);

        }else{
            $repository = $em->getRepository("AppBundle:PeluqueriaSpeciality");
            $query = $repository->createQueryBuilder('s')
                ->select(array(
                        's.id',
                        'sp.description as text',
                    )
                )
                ->innerJoin('AppBundle:Speciality', 'sp', 'WITH', 'sp.id = s.speciality')
                ->andWhere('s.user = :id')
                ->setParameter('id', $this->getUser()->getId())
                ->setMaxResults(10000)
            ;
            $specialities=$query->getQuery()->getResult(\Doctrine\ORM\Query::HYDRATE_ARRAY);

        }

        return new JsonResponse($specialities);

    }

    /**
     * Finds and displays a speciality entity.
     *
     * @Route("/byText/{text}", name="speciality_ByText_peluqueriaSpeciality")
     * @Method("GET")
     */
    public function findByTextAction($text)
    {

        $em = $this->getDoctrine()->getManager();

        $repository = $em->getRepository("AppBundle:PeluqueriaSpeciality");
        $query = $repository->createQueryBuilder('s')
            ->select(array(
                    's.id',
                    'sp.description',
                )
            )
            ->innerJoin('AppBundle:Speciality', 'sp', 'WITH', 'sp.id = s.speciality')
            ->where('sp.description LIKE :letter')
            ->andWhere('s.user = :idUser')
            ->setParameter('letter', '%'.$text.'%')
            ->setParameter('idUser', $this->getUser()->getId())
            ->setMaxResults(10000)
        ;
        $specialities=$query->getQuery()->getResult(\Doctrine\ORM\Query::HYDRATE_ARRAY);

        $specialities = $this->get('jms_serializer')->serialize($specialities, 'json', SerializationContext::create()->setGroups(array('peluqueria_speciality_index')));
        return new Response($specialities);
    }



}
