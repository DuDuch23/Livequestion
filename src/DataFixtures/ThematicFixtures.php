<?php

namespace App\DataFixtures;

use App\Entity\Thematic;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;

class ThematicFixtures extends Fixture
{
    public const FILMS = 'THEMATIC_FILMS';
    public const SERIES = 'THEMATIC_SERIES';
    public const SPORT = 'THEMATIC_SPORT';
    public const JEUXVIDEOS = 'THEMATIC_JEUX_VIDEOS';
    public const POLITIQUE = 'THEMATIC_POLITIQUE';
    public const SANTE = 'THEMATIC_SANTE';
    public const BUSINESS = 'THEMATIC_BUSINESS';
    public const MUSIQUE = 'THEMATIC_MUSIQUE';

    public const THEMATIC = [
        self::FILMS => [
            'name' => 'Films'
        ],
        self::SERIES => [
            'name' => 'Séries'
        ],
        self::SPORT => [
            'name' => 'Sport'
        ],
        self::JEUXVIDEOS => [
            'name' => 'Jeux vidéos'
        ],
        self::POLITIQUE => [
            'name' => 'Politique'
        ],
        self::SANTE => [
            'name' => 'Santé'
        ],
        self::BUSINESS => [
            'name' => 'Business'
        ],
        self::MUSIQUE => [
            'name' => 'Musique'
        ],
    ];

    public function load(ObjectManager $manager): void
    {
        foreach($this::THEMATIC as $code => $attributes)
        {
            $thematic = new Thematic();
            $thematic->setName($attributes['name']);

            $manager->persist($thematic);

            $this->addReference($code, $thematic);
        }

        $manager->flush();
    }
}