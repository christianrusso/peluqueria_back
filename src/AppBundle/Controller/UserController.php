<?php
/**
 * Created by PhpStorm.
 * User: manuel
 * Date: 22/08/18
 * Time: 20:51
 */

namespace AppBundle\Controller;
use AppBundle\Entity\Peluqueria_Patient;
use AppBundle\Entity\User;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use JMS\Serializer\SerializationContext;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Lexik\Bundle\JWTAuthenticationBundle\Encoder\JWTEncoderInterface;

/**
 * Comment controller.
 *
 * @Route("user")
 */
class UserController extends Controller
{
    /**
     * Creates a new comment entity.
     *
     * @Route("/{id}/edit", name="user_edit")
     * @Method("POST")
     */
    public function editAction(Request $request,User $user=null)
    {
        if (!($user)) {
            return new JsonResponse(["msg"=>"User dont exist"],400);
        }
        $userManager = $this->get('fos_user.user_manager');
        $data = $request->request->all();

        $user->setUsername($data["username"]);
        $user->setPlainPassword($data["password"]);
        $user->setEmail($data["email"]);
        $userManager->updateUser($user);

        return new JsonResponse(["msg"=>"User edit successfully"],201);
    }

    /**
     * Creates a new comment entity.
     *
     * @Route("/{id}/delete", name="user_delete")
     * @Method("DELETE")
     */
    public function deleteAction(User $user=null)
    {
        if (!($user)) {
            return new JsonResponse(["msg"=>"User dont exist"],400);
        }

        $em = $this->getDoctrine()->getManager();
        $em->remove($user);
        $em->flush();

        return new JsonResponse(["msg"=>"User deleted successfully"],201);
    }
    /**
     * Creates a new comment entity.
     *
     * @Route("/logout", name="user_logout")
     * @Method("GET")
     */
    public function logoutAction()
    {

        return new JsonResponse(["msg"=>"Logout"],201);

    }
}