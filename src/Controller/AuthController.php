<?php


namespace App\Controller;


use App\Entity\User;
use Doctrine\ORM\EntityManagerInterface;
use Lexik\Bundle\JWTAuthenticationBundle\Services\JWTTokenManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Symfony\Component\Serializer\SerializerInterface;

class AuthController extends AbstractController
{
    private $em;

    public function __construct(EntityManagerInterface $em)
    {
        $this->em = $em;
    }

    /**
     * @Route(
     *     name="user_register",
     *     path="/api/register",
     *     methods={"POST"}
     * )
     * @param Request $request
     * @param UserPasswordEncoderInterface $encoder
     * @param SerializerInterface $serializer
     * @param JWTTokenManagerInterface $tokenManager
     * @return JsonResponse
     */
    public function register(Request $request, UserPasswordEncoderInterface $encoder, SerializerInterface $serializer, JWTTokenManagerInterface $tokenManager)
    {
        $content = $request->getContent();
        $user = $serializer->deserialize($content, User::class, 'json');


        if ($this->em->getRepository(User::class)->findBy(['username' => $user->getUsername()])) return new JsonResponse(['error' => 'Ce nom d\'utilisateur est déjà utilisé']);

        $user->setPassword($encoder->encodePassword($user, $user->getPassword()));
        $user->setRoles(['ROLE_USER']);

        $this->em->persist($user);
        $this->em->flush();

        return new JsonResponse(['success' => 'Utilisateur bien enregistré', 'token' => $tokenManager->create($user)]);
    }
}
