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
        [
            'username' => 'Paupau',
            'email' => 'pauline@gmail.com',
            'role' => ["ROLE_USER"],
            'password' => 'mushumonchat',
        ],
        [
            'username' => 'Le_chat_blanc',
            'email' => 'theo@gmail.com',
            'role' => ["ROLE_USER"],
            'password' => 'mushumonchat',
        ],
        [
            'username' => 'Aquila',
            'email' => 'evan@gmail.com',
            'role' => ["ROLE_USER"],
            'password' => 'mushumonchat',
        ],
        [
            'username' => 'Ekaiser',
            'email' => 'florie@gmail.com',
            'role' => ["ROLE_USER"],
            'password' => 'mushumonchat',
        ],
        [
            'username' => 'Anyoubis',
            'email' => 'brian@gmail.com',
            'role' => ["ROLE_USER"],
            'password' => 'mushumonchat',
        ],
        [
            'username' => 'Davsoquer',
            'email' => 'david@gmail.com',
            'role' => ["ROLE_USER"],
            'password' => 'mushumonchat',
        ],
        [
            'username' => 'Furidax',
            'email' => 'stan@gmail.com',
            'role' => ["ROLE_USER"],
            'password' => 'mushumonchat',
        ],
        [
            'username' => 'Teo',
            'email' => 'teo@gmail.com',
            'role' => ["ROLE_USER"],
            'password' => 'mushumonchat',
        ],
        [
            'username' => 'Halandalous',
            'email' => 'halan@gmail.com',
            'role' => ["ROLE_USER"],
            'password' => 'mushumonchat',
        ],
        [
            'username' => 'Anubis',
            'email' => 'florient@gmail.com',
            'role' => ["ROLE_USER"],
            'password' => 'mushumonchat',
        ],
    ];

    public function load(ObjectManager $manager): void
    {
        foreach(self::USER as $reference => $attributes)
        {
            $user = new User();
            $user->setUsername($attributes['username']);
            $user->setEmail($attributes['email']);
            $user->setRoles($attributes['role']);
            $user->setPassword($this->passwordHasher->hashPassword($user, $attributes['password']));
            
            $manager->persist($user);

            $this->addReference($attributes['username'], $user);
            echo "Utilisateur créé : " . $reference . "\n"; // Vérifiez si les utilisateurs sont créés
        }

        $manager->flush();
    }
}