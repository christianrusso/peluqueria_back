<?php
/**
 * Created by PhpStorm.
 * User: manuel
 * Date: 31/07/18
 * Time: 20:14
 */

namespace AppBundle\Controller;
use AppBundle\Entity\Peluqueria_Patient;
use AppBundle\Entity\Profile;
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
 * @Route("user")
 */
class UserRegisterController extends Controller
{
    /**
     * Creates a new comment entity.
     *
     * @Route("/register", name="user_register")
     * @Method("POST")
     */
    public function registerAction(Request $request)
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
        $user->addRole($data["role"]);
        $user->setCity($data["city"]);
        $user->setDescription($data["description"]);
        $user->setAddress($data["address"]);
        $user->setLatitude($data["latitude"]);
        $user->setLongitude($data["longitude"]);
        $user->setLogo($data["logo"]);
        $user->setEnabled(true);
        $userManager->updateUser($user);

        return $this->generateToken($user, 201);
    }



    protected function generateToken($user, $statusCode = 200)
    {
        // Generate the token
        $token = $this->get('lexik_jwt_authentication.jwt_manager')->create($user);

        $response = array(
            'token' => $token,
            'user'  => $user->getUsername() // Assuming $user is serialized, else you can call getters manually
        );

    return new JsonResponse($response, $statusCode); // Return a 201 Created with the JWT.
}
}