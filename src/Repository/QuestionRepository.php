<?php

namespace App\Repository;

use App\Entity\Question;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Question>
 */
class QuestionRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Question::class);
    }

    public function getLastQuestion(){
        return $this->createQueryBuilder('q')
        ->orderBy('q.id', 'DESC')
        ->setMaxResults(1)
        ->getQuery()
        ->getResult();
    }

    public function getThreeLastQuestion(){
        return $this->createQueryBuilder('t')
        ->orderBy('t.id', 'DESC')
        ->setMaxResults(3)
        ->getQuery()
        ->getResult();
    }

    public function getThreeQuestionSameThematic(){
        $conn = $this->getEntityManager()->getConnection();

        $sql = '
            SELECT * 
            FROM question 
            WHERE thematic_id_id = (
                SELECT thematic_id_id
                FROM question 
                ORDER BY RAND() 
                LIMIT 1
            )
            ORDER BY RAND() 
            LIMIT 3;
        ';

        $stmt = $conn->prepare($sql);
        $resultSet = $stmt->executeQuery(); // Utilisation de executeQuery pour DBAL 3.x
        
        return $resultSet->fetchAllAssociative();
    }

    public function getThreeRandomQuestion()
    {
        $questions = $this->createQueryBuilder('q')
            ->getQuery()
            ->getResult();

        if (count($questions) <= 3) {
            return $questions;
        }

        $randomKeys = array_rand($questions, 3);
        
        $threeRandomQuestion = [
            $questions[$randomKeys[0]],
            $questions[$randomKeys[1]],
            $questions[$randomKeys[2]],
        ];

        // Ajouter les questions aux tableaux séparés
        $bigRandomQuestion = [$threeRandomQuestion[0]];
        $twoLittleRandomQuestion = [$threeRandomQuestion[1], $threeRandomQuestion[2]];

        // Retourner les questions ou les utiliser comme nécessaire
        return [
            'bigRandomQuestion' => $bigRandomQuestion,
            'twoLittleRandomQuestion' => $twoLittleRandomQuestion
        ];
    }

    //    /**
    //     * @return Question[] Returns an array of Question objects
    //     */
    //    public function findByExampleField($value): array
    //    {
    //        return $this->createQueryBuilder('q')
    //            ->andWhere('q.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->orderBy('q.id', 'ASC')
    //            ->setMaxResults(10)
    //            ->getQuery()
    //            ->getResult()
    //        ;
    //    }

    //    public function findOneBySomeField($value): ?Question
    //    {
    //        return $this->createQueryBuilder('q')
    //            ->andWhere('q.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->getQuery()
    //            ->getOneOrNullResult()
    //        ;
    //    }
}
