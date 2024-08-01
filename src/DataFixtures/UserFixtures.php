<?php

namespace App\DataFixtures;

use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class UserFixtures extends Fixture
{
    public function __construct(private UserPasswordHasherInterface $passwordHasher)
    {
        $this->passwordHasher = $passwordHasher;
    }

    public const USER = [
        [
            'username' => 'Duduch',
            'email' => 'alexduduch77@gmail.com',
            'role' => ["ROLE_USER"],
            'password' => 'mushumonchat',
        ],
    ];

    public function load(ObjectManager $manager): void
    {
        foreach(self::USER as $attributes)
        {
            $user = new User();
            $user->setUsername($attributes['username']);
            $user->setEmail($attributes['email']);
            $user->setRoles($attributes['role']);
            $user->setPassword($this->passwordHasher->hashPassword($user, $attributes['password']));
            
            $manager->persist($user);
        }
        
        $manager->flush();
    }
}