<?php

namespace App\DataFixtures;

use App\Entity\Question;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;

class QuestionFixtures extends Fixture implements DependentFixtureInterface
{
    public const QUESTION = [
        [
            'title' => 'Avengers Endgame à-t-il été bien apprécié ?',
            'nb_answer' => 90,
            'image' => 'image_question.png',
            'date' => '2023-07-01 12:00:00',
        ],
        [
            'title' => 'Pourquoi Evan est un énorme pd ?',
            'nb_answer' => 678,
            'image' => 'image_question.png',
            'date' => '2023-07-01 12:00:00',
        ],
        [
            'title' => 'League of Legends, bonne ou mauvaise réputation ?',
            'nb_answer' => 123,
            'image' => 'image_question.png',
            'date' => '2023-07-01 12:00:00',
        ],
        [
            'title' => 'Pourquoi il faut boire de l\'eau ?',
            'nb_answer' => 10,
            'image' => 'image_question.png',
            'date' => '2023-07-01 12:00:00',
        ],
        [
            'title' => 'CS2 vs Valorant, quel jeu est le meilleur au quotidien ?  ?',
            'nb_answer' => 12,
            'image' => 'image_question.png',
            'date' => '2023-07-01 12:00:00',
        ],
        [
            'title' => 'League of Legends, bonne ou mauvaise réputation ?',
            'nb_answer' => 123,
            'image' => 'image_question.png',
            'date' => '2023-07-01 12:00:00',
        ],
        [
            'title' => 'Que pensez-vous de la performance de Pierre Niney dans le comte de Monte Cristo ?',
            'nb_answer' => 87,
            'image' => 'image_question.png',
            'date' => '2023-07-01 12:00:00',
        ],
        [
            'title' => 'Dernière maj de lol, qu\'en pensez vous ?',
            'nb_answer' => 38,
            'image' => 'image_question.png',
            'date' => '2023-07-01 12:00:00',
        ],
        [
            'title' => 'Est-ce que la France est à la hauteur sur cette coupe d’Euro ?',
            'nb_answer' => 33,
            'image' => 'image_question.png',
            'date' => '2023-07-01 12:00:00',
        ],
        [
            'title' => 'Suivez-vous le tour de France cette année ?',
            'nb_answer' => 76,
            'image' => 'image_question.png',
            'date' => '2023-07-01 12:00:00',
        ],
        [
            'title' => 'MMA : match de Saint-Denis a vaincu son adversaire Marc Diakiese, qui a suivi ?',
            'nb_answer' => 34,
            'image' => 'image_question.png',
            'date' => '2023-07-01 12:00:00',
        ],
        [
            'title' => 'Que pensez-vous des JO dans la seine ?',
            'nb_answer' => 123,
            'image' => 'image_question.png',
            'date' => '2023-07-01 12:00:00',
        ],
        [
            'title' => 'Que pensez-vous de la série Game of thrones house of the dragon ?',
            'nb_answer' => 87,
            'image' => 'image_question.png',
            'date' => '2023-07-01 12:00:00',
        ],
    ];

    public function load(ObjectManager $manager): void
    {
        $userData = UserFixtures::USER;
        foreach(self::QUESTION as $attributes)
        {
            $question = new Question();
            $question->setTitle($attributes['title']);
            $question->setNbAnswer($attributes['nb_answer']);
            $question->setImageNameQuestion($attributes['image']);
            $question->setDate(new \DateTime($attributes['date']));

            $randomUser = $userData[array_rand($userData)];
            $userReference = $randomUser['username'];
            $user = $this->getReference($userReference);
            $question->setAuthor($user);

            $thematicReference = array_rand(ThematicFixtures::THEMATIC);
            $question->setThematicId($this->getReference($thematicReference));
            
            $manager->persist($question);
        }
        
        $manager->flush();
    }

    public function getDependencies()
    {
        return[
            UserFixtures::class,
            ThematicFixtures::class,
        ];
    }
}