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
            'category' => 'Film',
            'title' => 'Avengers Endgame à-t-il été bien apprécié ?',
            'nb_answer' => 90,
            'image' => 'image_question',
            'date' => '2023-07-01 12:00:00',
            'author_reference' => 'Theo',
        ],
        [
            'category' => 'Série',
            'title' => 'Pourquoi Evan est un énorme pd ?',
            'nb_answer' => 678,
            'image' => 'image_question',
            'date' => '2023-07-01 12:00:00',
            'author_reference' => 'Duduch',
        ],
        [
            'category' => 'Jeux vidéos',
            'title' => 'League of Legends, bonne ou mauvaise réputation ?',
            'nb_answer' => 123,
            'image' => 'image_question',
            'date' => '2023-07-01 12:00:00',
            'author_reference' => 'PauPau',
        ],
        [
            'category' => 'Sport',
            'title' => 'Pourquoi il faut boire de l\'eau ?',
            'nb_answer' => 10,
            'image' => 'image_question',
            'date' => '2023-07-01 12:00:00',
            'author_reference' => 'Evan',
        ],
    ];

    public function load(ObjectManager $manager): void
    {
        foreach(self::QUESTION as $attributes)
        {
            $question = new Question();
            $question->setCategory($attributes['category']);
            $question->setTitle($attributes['title']);
            $question->setNbAnswer($attributes['nb_answer']);
            $question->setImage($attributes['image']);
            $question->setDate(new \DateTime($attributes['date']));

            $author = $this->getReference($attributes['author_reference']);
            $question->setAuthor($author);
            
            $manager->persist($question);
        }
        
        $manager->flush();
    }

    public function getDependencies()
    {
        return[
            UserFixtures::class,
        ];
    }
}