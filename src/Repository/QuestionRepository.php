<?php

namespace App\Repository;

use App\Entity\Question;
use App\Entity\Thematic;
use App\Repository\Traits\PaginateTrait;
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

    use PaginateTrait;

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

    public function getThreeQuestionsWithThematicSport($thematicName)
    {
        return $this->createQueryBuilder('q')
            ->join('q.thematic_id', 't')
            ->where('t.name = :thematicName')
            ->setParameter('thematicName', $thematicName)
            ->orderBy('q.createdAt', 'DESC')
            ->setMaxResults(3)
            ->getQuery()
            ->getResult();
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

    public function getQuestionByDescCreatedAt()
    {
        return $this->createQueryBuilder('q')
            ->orderBy('q.createdAt','DESC')
            ->getQuery()
            ->getResult();
    }

    public function searchQuestionByTitleAuthorThematic($title, $author, $thematicName, $page, $itemsPerPage){
        return $this->createQueryBuilder('question')
            ->where('question.thematic_id = :thematicName')
            ->andWhere('question.author = :authorName')
            ->andWhere('question.title LIKE :title')
            ->setParameter('thematicName', $thematicName)
            ->setParameter('authorName', $author)
            ->setParameter('title', '%'.$title.'%')
            ->getQuery()
            ->getResult();
    }

    public function searchQuestionByTitle($title, $page, $itemsPerPage){
        return $this->createQueryBuilder('question')
            ->where('question.title = :title')
            ->setParameter('title', $title)
            ->setFirstResult(($page -1) * $itemsPerPage)
            ->setMaxResults($itemsPerPage)
            ->getQuery()
            ->getResult();
    }

    public function searchQuestionByAuthor($author, $page, $itemsPerPage){
        return $this->createQueryBuilder('question')
            ->where('question.author = :authorName')
            ->setParameter('authorName', $author)
            ->setFirstResult(($page -1) * $itemsPerPage)
            ->setMaxResults($itemsPerPage)
            ->getQuery()
            ->getResult();
    }

    public function searchQuestionByThematic($thematic, $page, $itemsPerPage){
        return $this->createQueryBuilder('question')
            ->where('question.thematic_id = :thematicName')
            ->setParameter('thematicName', $thematic)
            ->setFirstResult(($page -1) * $itemsPerPage)
            ->setMaxResults($itemsPerPage)
            ->getQuery()
            ->getResult();
    }

    public function searchQuestionByTitleAuthor($title, $author, $page, $itemsPerPage){
        return $this->createQueryBuilder('question')
            ->where('question.title = :title')
            ->andWhere('question.author = :authorName')
            ->setParameter('title', $title)
            ->setParameter('authorName', $author)
            ->setFirstResult(($page -1) * $itemsPerPage)
            ->setMaxResults($itemsPerPage)
            ->getQuery()
            ->getResult();
    }

    public function searchQuestionByTitleThematic($title, $thematic, $page, $itemsPerPage){
        return $this->createQueryBuilder('question')
            ->where('question.title = :title')
            ->andWhere('question.thematic_id = :thematicName')
            ->setParameter('title', $title)
            ->setParameter('thematicName', $thematic)
            ->setFirstResult(($page -1) * $itemsPerPage)
            ->setMaxResults($itemsPerPage)
            ->getQuery()
            ->getResult();
    }

    public function searchQuestionByAuthorThematic($author, $thematic, $page, $itemsPerPage){
        return $this->createQueryBuilder('question')
            ->where('question.author = :authorName')
            ->andWhere('question.thematic_id = :thematicName')
            ->setParameter('authorName', $author)
            ->setParameter('thematicName', $thematic)
            ->setFirstResult(($page -1) * $itemsPerPage)
            ->setMaxResults($itemsPerPage)
            ->getQuery()
            ->getResult();
    }

    public function findQuestionsByUser($userId): array
    {
        return $this->createQueryBuilder('q')
            ->where('q.author = :author')
            ->setParameter('author', $userId)
            ->orderBy('q.createdAt', 'DESC')
            ->getQuery()
            ->getResult();
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
