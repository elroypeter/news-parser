<?php

namespace App\DataFixtures;

use App\Entity\User;
use App\Constants\Roles;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class UserFixture extends Fixture
{
    private $passwordHasher;

    public function __construct(UserPasswordHasherInterface $passwordHasher)
    {
        $this->passwordHasher = $passwordHasher;
    }

    public function load(ObjectManager $manager): void
    {
        // create administrator
        $manager->persist($this->getUser("admin@gmail.com", "test", 'ROLE_ADMINISTRATOR'));

        // create moderator
        $manager->persist($this->getUser("moder@gmail.com", "test", 'ROLE_MODERATOR'));

        $manager->flush();
    }

    private function getUser($email, $password, $role) {
        $user = new User();
        $user->setRole($role);
        $user->setEmail($email);
        $user->setPassword($this->passwordHasher->hashPassword($user, $password));
        return $user;
    }
}
