<?php
/**
 * Created by PhpStorm.
 * User: manuel
 * Date: 22/08/18
 * Time: 16:11
 */

namespace AppBundle\Controller;
use AppBundle\Entity\Peluqueria_Patient;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use JMS\Serializer\SerializationContext;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use AppBundle\Traits\FormErrorValidator;
use Lexik\Bundle\JWTAuthenticationBundle\Encoder\JWTEncoderInterface;

/**
 * Comment controller.
 *
 * @Route("patient")
 */
class UserRegisterPatientController extends Controller
{
    /**
     * Creates a new comment entity.
     *
     * @Route("/register", name="user_register_patient")
     * @Method("POST")
     */
    public function registerPatientAction(Request $request)
    {

        $userManager = $this->get('fos_user.user_manager');
        $data = $request->request->all();
        $em = $this->getDoctrine()->getManager();

        $findUser = $em->getRepository('AppBundle:User')->findByUsername($data['username']);
        if ( $findUser){
            return new JsonResponse(["msg"=>"Usuario Existente"],401);
        }

        // Do a check for existing user with userManager->findByUsername

        $user = $userManager->createUser();
        $user->setUsername($data['username']);
        $user->setEmail($data['email']);
        $user->setPlainPassword($data['password']);
        $user->setEnabled(true);
        $userManager->updateUser($user);

        $patient= new Peluqueria_Patient();
        $patient->setUserComapny($this->getUser());
        $patient->setUserPatient($user);
        $patient->setCreatedAt();
        $em->persist($patient);
        $em->flush();

        return new JsonResponse(["msg"=>"User created successfully"],201);
    }
}