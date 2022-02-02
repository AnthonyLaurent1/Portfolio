<?php

namespace App\DataFixtures;

use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use DateTime;

class UserFixtures extends Fixture
{
    public const USERS = [
        'anthonylrtpro@gmail.com' => [
            'firstname' => 'Anthony',
            'lastname' => 'Laurent',
            'roles' => ['ROLE_ADMIN'],
            'password' => 'anthony33',
            'age' => '23',
            ]
        ];
    private UserPasswordHasherInterface $passwordHasher;

    public function __construct(UserPasswordHasherInterface $passwordHasher)
    {
        $this->passwordHasher = $passwordHasher;
    }

    public function load(ObjectManager $manager): void
    {
        $i = 0;
        foreach (self::USERS as $email => $data) {
            $user = new User();
            $user->setEmail($email);
            $user->setFirstname($data['firstname']);
            $user->setLastname($data['lastname']);
            $user->setRoles($data['roles']);
            $user->setAge($data['age']);
            $hashedPassword = $this->passwordHasher->hashPassword(
                $user,
                $data['password'],
            );
            $user->setPassword($hashedPassword);
            $user->setCreatedAt(new DateTime());
            $user->setUpdatedAt(new DateTime());
            $manager->persist($user);
            $this->addReference('user_' . $i, $user);
            $i++;
        }
        $manager->flush();
    }
}
