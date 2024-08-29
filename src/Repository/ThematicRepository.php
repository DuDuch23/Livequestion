<?php

namespace App\Repository;

use App\Entity\Thematic;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Thematic>
 */
class ThematicRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Thematic::class);
    }

    public function getRandomThematic()
    {
        $thematic = $this->createQueryBuilder('t')
            ->getQuery()
            ->getResult();

        if(count($thematic) < 1)
        {
            return null;
        }

        $randomKey = array_rand($thematic);

        $randomThematic = $thematic[$randomKey];
        
        return $randomThematic;
    }

    //    /**
    //     * @return Thematic[] Returns an array of Thematic objects
    //     */
    //    public function findByExampleField($value): array
    //    {
    //        return $this->createQueryBuilder('t')
    //            ->andWhere('t.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->orderBy('t.id', 'ASC')
    //            ->setMaxResults(10)
    //            ->getQuery()
    //            ->getResult()
    //        ;
    //    }

    //    public function findOneBySomeField($value): ?Thematic
    //    {
    //        return $this->createQueryBuilder('t')
    //            ->andWhere('t.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->getQuery()
    //            ->getOneOrNullResult()
    //        ;
    //    }
}
