<?php

namespace App\Manager;

use App\Entity\User;
use App\Repository\UserRepository;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpKernel\Exception\BadRequestHttpException;
use Symfony\Component\HttpFoundation\JsonResponse;

class UserManager
{
    /**
     * @var EntityManagerInterface
     */
    protected $em;

    /**
     * @var UserRepository
     */
    protected $userRepository;

     /**
     * @var UserPasswordEncoderInterface
     */
    protected $passwordEncoder;

    /**
     * UserManager constructor.
     * @param EntityManagerInterface $entityManager
     * @param UserRepository $userRepository
     */
    public function __construct(
        EntityManagerInterface $entityManager,
        UserRepository $userRepository,
        UserPasswordEncoderInterface $passwordEncoder
    ) {
        $this->em = $entityManager;
        $this->userRepository = $userRepository;
        $this->passwordEncoder = $passwordEncoder;
    }

    /**
     * @param string $email
     * @return mixed
     */
    public function findByEmail(string $email)
    {
        $user = $this->userRepository->findByEmail($email);

        if ($user) {
            return true;
        }

        return null;
    }

    /**
     * @param User $user
     * @return array|string
     * @throws \Exception
     */
    public function registerAccount(User $user)
    {
        // dd($user);
        if ($this->findByEmail($user->getEmail())) {           
            return new JsonResponse([
                'message' => 'Cette adresse email a déjà été utilisé.'
            ], 409);
        }

        $pass = $this->passwordEncoder->encodePassword($user,$user->getPassword());
        $user->setPassword($pass);
        $this->em->persist($user);
        $this->em->flush();

        return [
            'message' => 'Création de compte enregistrée.'
        ];
    }
}