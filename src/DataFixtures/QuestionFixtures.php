<?php

namespace App\DataFixtures;

use App\Entity\Question;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;

class QuestionFixtures extends Fixture implements DependentFixtureInterface
{
    public const QUESTION = [
        // Business
        [
            'title' => 'Quels sont les meilleurs investissements pour 2024 ?',
            'nb_answer' => 45,
            'image' => 'image_question.png',
            'date' => '2024-01-10 09:30:00',
            'thematic' => ThematicFixtures::BUSINESS,
        ],
        [
            'title' => 'Comment le télétravail impacte-t-il la productivité des entreprises ?',
            'nb_answer' => 60,
            'image' => 'image_question.png',
            'date' => '2024-02-15 14:00:00',
            'thematic' => ThematicFixtures::BUSINESS,
        ],
        [
            'title' => 'Startups vs entreprises traditionnelles : lesquelles sont plus résilientes en temps de crise ?',
            'nb_answer' => 75,
            'image' => 'image_question.png',
            'date' => '2024-03-05 11:20:00',
            'thematic' => ThematicFixtures::BUSINESS,
        ],
        [
            'title' => 'Comment la blockchain transforme-t-elle les transactions commerciales ?',
            'nb_answer' => 50,
            'image' => 'image_question.png',
            'date' => '2024-04-12 10:45:00',
            'thematic' => ThematicFixtures::BUSINESS,
        ],
        [
            'title' => 'Quel avenir pour les cryptomonnaies en tant qu’actifs financiers ?',
            'nb_answer' => 110,
            'image' => 'image_question.png',
            'date' => '2024-05-21 16:30:00',
            'thematic' => ThematicFixtures::BUSINESS,
        ],

        // Santé
        [
            'title' => 'Pourquoi il faut boire de l\'eau ?',
            'nb_answer' => 10,
            'image' => 'image_question.png',
            'date' => '2023-07-01 12:00:00',
            'thematic' => ThematicFixtures::SANTE,
        ],
        [
            'title' => 'Les bénéfices du jeûne intermittent sur la santé ?',
            'nb_answer' => 90,
            'image' => 'image_question.png',
            'date' => '2024-02-01 08:00:00',
            'thematic' => ThematicFixtures::SANTE,
        ],
        [
            'title' => 'Comment le stress affecte-t-il le système immunitaire ?',
            'nb_answer' => 65,
            'image' => 'image_question.png',
            'date' => '2024-03-20 13:15:00',
            'thematic' => ThematicFixtures::SANTE,
        ],
        [
            'title' => 'Les avantages et inconvénients de la médecine alternative ?',
            'nb_answer' => 78,
            'image' => 'image_question.png',
            'date' => '2024-04-02 09:30:00',
            'thematic' => ThematicFixtures::SANTE,
        ],
        [
            'title' => 'La nutrition végétarienne est-elle suffisante pour les athlètes de haut niveau ?',
            'nb_answer' => 83,
            'image' => 'image_question.png',
            'date' => '2024-05-10 11:45:00',
            'thematic' => ThematicFixtures::SANTE,
        ],
        [
            'title' => 'Quels sont les risques des régimes alimentaires restrictifs ?',
            'nb_answer' => 92,
            'image' => 'image_question.png',
            'date' => '2024-06-07 15:20:00',
            'thematic' => ThematicFixtures::SANTE,
        ],

        // Films
        [
            'title' => 'Avengers Endgame à-t-il été bien apprécié ?',
            'nb_answer' => 90,
            'image' => 'image_question.png',
            'date' => '2023-07-01 12:00:00',
            'thematic' => ThematicFixtures::FILMS,
        ],
        [
            'title' => 'Que pensez-vous de la performance de Pierre Niney dans le comte de Monte Cristo ?',
            'nb_answer' => 87,
            'image' => 'image_question.png',
            'date' => '2023-07-01 12:00:00',
            'thematic' => ThematicFixtures::FILMS,
        ],
        [
            'title' => 'Quels films sont pressentis pour les Oscars 2024 ?',
            'nb_answer' => 120,
            'image' => 'image_question.png',
            'date' => '2024-01-18 10:45:00',
            'thematic' => ThematicFixtures::FILMS,
        ],
        [
            'title' => 'Les remakes de films sont-ils nécessaires ?',
            'nb_answer' => 85,
            'image' => 'image_question.png',
            'date' => '2024-02-20 12:30:00',
            'thematic' => ThematicFixtures::FILMS,
        ],
        [
            'title' => 'Quel est le meilleur film de science-fiction de tous les temps ?',
            'nb_answer' => 140,
            'image' => 'image_question.png',
            'date' => '2024-03-15 15:00:00',
            'thematic' => ThematicFixtures::FILMS,
        ],
        [
            'title' => 'Les films d’animation sont-ils réservés aux enfants ?',
            'nb_answer' => 60,
            'image' => 'image_question.png',
            'date' => '2024-04-29 11:20:00',
            'thematic' => ThematicFixtures::FILMS,
        ],
        [
            'title' => 'Quel réalisateur a le plus marqué l’histoire du cinéma ?',
            'nb_answer' => 95,
            'image' => 'image_question.png',
            'date' => '2024-05-06 14:10:00',
            'thematic' => ThematicFixtures::FILMS,
        ],

        // Musique
        [
            'title' => 'Quel impact a eu le streaming sur l’industrie musicale ?',
            'nb_answer' => 55,
            'image' => 'image_question.png',
            'date' => '2024-01-22 10:00:00',
            'thematic' => ThematicFixtures::MUSIQUE,
        ],
        [
            'title' => 'Quels sont les albums les plus attendus en 2024 ?',
            'nb_answer' => 45,
            'image' => 'image_question.png',
            'date' => '2024-03-14 14:45:00',
            'thematic' => ThematicFixtures::MUSIQUE,
        ],
        [
            'title' => 'Les concerts en ligne remplaceront-ils les spectacles en direct ?',
            'nb_answer' => 65,
            'image' => 'image_question.png',
            'date' => '2024-04-18 17:30:00',
            'thematic' => ThematicFixtures::MUSIQUE,
        ],
        [
            'title' => 'La musique classique est-elle en déclin ou en renaissance ?',
            'nb_answer' => 40,
            'image' => 'image_question.png',
            'date' => '2024-05-22 11:10:00',
            'thematic' => ThematicFixtures::MUSIQUE,
        ],
        [
            'title' => 'Quels sont les genres musicaux émergents en 2024 ?',
            'nb_answer' => 70,
            'image' => 'image_question.png',
            'date' => '2024-06-15 13:50:00',
            'thematic' => ThematicFixtures::MUSIQUE,
        ],

        // Politique
        [
            'title' => 'Pourquoi Evan est un énorme pd ?',
            'nb_answer' => 678,
            'image' => 'image_question.png',
            'date' => '2023-07-01 12:00:00',
            'thematic' => ThematicFixtures::POLITIQUE,
        ],
        [
            'title' => 'Comment les réseaux sociaux influencent-ils les élections ?',
            'nb_answer' => 85,
            'image' => 'image_question.png',
            'date' => '2024-01-30 16:00:00',
            'thematic' => ThematicFixtures::POLITIQUE,
        ],
        [
            'title' => 'Quel est l’impact des mouvements populistes en Europe ?',
            'nb_answer' => 50,
            'image' => 'image_question.png',
            'date' => '2024-03-11 12:15:00',
            'thematic' => ThematicFixtures::POLITIQUE,
        ],
        [
            'title' => 'Le réchauffement climatique doit-il être une priorité politique ?',
            'nb_answer' => 100,
            'image' => 'image_question.png',
            'date' => '2024-04-25 09:30:00',
            'thematic' => ThematicFixtures::POLITIQUE,
        ],
        [
            'title' => 'Les sanctions économiques sont-elles efficaces contre les dictatures ?',
            'nb_answer' => 65,
            'image' => 'image_question.png',
            'date' => '2024-05-18 14:20:00',
            'thematic' => ThematicFixtures::POLITIQUE,
        ],
        [
            'title' => 'Quel avenir pour l’Union Européenne après le Brexit ?',
            'nb_answer' => 78,
            'image' => 'image_question.png',
            'date' => '2024-06-12 17:00:00',
            'thematic' => ThematicFixtures::POLITIQUE,
        ],

        // Séries
        [
            'title' => 'Que pensez-vous de la série Game of thrones house of the dragon ?',
            'nb_answer' => 87,
            'image' => 'image_question.png',
            'date' => '2023-07-01 12:00:00',
            'thematic' => ThematicFixtures::SERIES,
        ],
        [
            'title' => 'Quelle série a marqué l’année 2024 ?',
            'nb_answer' => 130,
            'image' => 'image_question.png',
            'date' => '2024-01-25 13:00:00',
            'thematic' => ThematicFixtures::SERIES,
        ],
        [
            'title' => 'Les adaptations de livres en séries sont-elles meilleures que les films ?',
            'nb_answer' => 80,
            'image' => 'image_question.png',
            'date' => '2024-02-12 16:30:00',
            'thematic' => ThematicFixtures::SERIES,
        ],
        [
            'title' => 'Pourquoi les séries criminelles sont-elles si populaires ?',
            'nb_answer' => 95,
            'image' => 'image_question.png',
            'date' => '2024-03-08 10:45:00',
            'thematic' => ThematicFixtures::SERIES,
        ],
        [
            'title' => 'Les plateformes de streaming ont-elles changé la manière dont nous regardons les séries ?',
            'nb_answer' => 110,
            'image' => 'image_question.png',
            'date' => '2024-04-17 09:00:00',
            'thematic' => ThematicFixtures::SERIES,
        ],
        [
            'title' => 'Quelle série mérite une suite en 2024 ?',
            'nb_answer' => 70,
            'image' => 'image_question.png',
            'date' => '2024-05-25 14:00:00',
            'thematic' => ThematicFixtures::SERIES,
        ],

        // Jeux vidéos
        [
            'title' => 'League of Legends, bonne ou mauvaise réputation ?',
            'nb_answer' => 123,
            'image' => 'image_question.png',
            'date' => '2023-07-01 12:00:00',
            'thematic' => ThematicFixtures::JEUXVIDEOS,
        ],
        [
            'title' => 'CS2 vs Valorant, quel jeu est le meilleur au quotidien ?  ?',
            'nb_answer' => 12,
            'image' => 'image_question.png',
            'date' => '2023-07-01 12:00:00',
            'thematic' => ThematicFixtures::JEUXVIDEOS,
        ],
        [
            'title' => 'League of Legends, bonne ou mauvaise réputation ?',
            'nb_answer' => 123,
            'image' => 'image_question.png',
            'date' => '2023-07-01 12:00:00',
            'thematic' => ThematicFixtures::JEUXVIDEOS,
        ],
        [
            'title' => 'Dernière maj de lol, qu\'en pensez vous ?',
            'nb_answer' => 38,
            'image' => 'image_question.png',
            'date' => '2023-07-01 12:00:00',
            'thematic' => ThematicFixtures::JEUXVIDEOS,
        ],
        [
            'title' => 'Quel est le jeu le plus attendu en 2024 ?',
            'nb_answer' => 150,
            'image' => 'image_question.png',
            'date' => '2024-01-15 15:30:00',
            'thematic' => ThematicFixtures::JEUXVIDEOS,
        ],
        [
            'title' => 'Les jeux vidéo peuvent-ils être considérés comme de l’art ?',
            'nb_answer' => 95,
            'image' => 'image_question.png',
            'date' => '2024-02-22 12:10:00',
            'thematic' => ThematicFixtures::JEUXVIDEOS,
        ],
        [
            'title' => 'Quel est l’impact des microtransactions sur l’expérience de jeu ?',
            'nb_answer' => 85,
            'image' => 'image_question.png',
            'date' => '2024-03-11 14:50:00',
            'thematic' => ThematicFixtures::JEUXVIDEOS,
        ],
        [
            'title' => 'Les jeux en réalité virtuelle sont-ils l’avenir du gaming ?',
            'nb_answer' => 100,
            'image' => 'image_question.png',
            'date' => '2024-04-28 17:00:00',
            'thematic' => ThematicFixtures::JEUXVIDEOS,
        ],
        [
            'title' => 'Les jeux compétitifs sont-ils trop stressants pour les joueurs ?',
            'nb_answer' => 75,
            'image' => 'image_question.png',
            'date' => '2024-05-30 16:00:00',
            'thematic' => ThematicFixtures::JEUXVIDEOS,
        ],

        // Sport
        [
            'title' => 'Est-ce que la France est à la hauteur sur cette coupe d’Euro ?',
            'nb_answer' => 33,
            'image' => 'image_question.png',
            'date' => '2023-07-01 12:00:00',
            'thematic' => ThematicFixtures::SPORT,
        ],
        [
            'title' => 'Suivez-vous le tour de France cette année ?',
            'nb_answer' => 76,
            'image' => 'image_question.png',
            'date' => '2023-07-01 12:00:00',
            'thematic' => ThematicFixtures::SPORT,
        ],
        [
            'title' => 'MMA : match de Saint-Denis a vaincu son adversaire Marc Diakiese, qui a suivi ?',
            'nb_answer' => 34,
            'image' => 'image_question.png',
            'date' => '2023-07-01 12:00:00',
            'thematic' => ThematicFixtures::SPORT,
        ],
        [
            'title' => 'Que pensez-vous des JO dans la seine ?',
            'nb_answer' => 123,
            'image' => 'image_question.png',
            'date' => '2023-07-01 12:00:00',
            'thematic' => ThematicFixtures::SPORT,
        ],
        [
            'title' => 'Quel est le plus grand exploit sportif de l’année 2024 ?',
            'nb_answer' => 135,
            'image' => 'image_question.png',
            'date' => '2024-01-12 08:45:00',
            'thematic' => ThematicFixtures::SPORT,
        ],
        [
            'title' => 'Les Jeux Olympiques 2024 : quels pays domineront le tableau des médailles ?',
            'nb_answer' => 105,
            'image' => 'image_question.png',
            'date' => '2024-02-19 10:20:00',
            'thematic' => ThematicFixtures::SPORT,
        ],
        [
            'title' => 'Le football est-il toujours le sport le plus populaire au monde ?',
            'nb_answer' => 120,
            'image' => 'image_question.png',
            'date' => '2024-03-13 11:45:00',
            'thematic' => ThematicFixtures::SPORT,
        ],
        [
            'title' => 'Les compétitions de e-sport peuvent-elles rivaliser avec les sports traditionnels ?',
            'nb_answer' => 90,
            'image' => 'image_question.png',
            'date' => '2024-04-05 15:00:00',
            'thematic' => ThematicFixtures::SPORT,
        ],
        [
            'title' => 'Les athlètes devraient-ils être plus impliqués dans les causes sociales ?',
            'nb_answer' => 115,
            'image' => 'image_question.png',
            'date' => '2024-05-14 12:30:00',
            'thematic' => ThematicFixtures::SPORT,
        ],
    ];

    public function load(ObjectManager $manager): void
    {
        $userData = UserFixtures::USER;
        foreach (self::QUESTION as $attributes) {
            $question = new Question();
            $question->setTitle($attributes['title']);
            $question->setNbAnswer($attributes['nb_answer']);
            $question->setImageNameQuestion($attributes['image']);
            $question->setDate(new \DateTime($attributes['date']));

            // Associer un utilisateur au hasard parmi ceux définis dans UserFixtures
            $randomUser = UserFixtures::USER[array_rand(UserFixtures::USER)];
            $userReference = $randomUser['username'];
            $user = $this->getReference($userReference);
            $question->setAuthor($user);

            // Associer la thématique manuellement spécifiée
            $thematicReference = $attributes['thematic'];
            $thematic = $this->getReference($thematicReference);
            $question->setThematicId($thematic);

            // Persist la question dans la base de données
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