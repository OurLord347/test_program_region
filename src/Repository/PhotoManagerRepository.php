<?php

namespace App\Repository;

use App\Entity\PhotoManager;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method PhotoManager|null find($id, $lockMode = null, $lockVersion = null)
 * @method PhotoManager|null findOneBy(array $criteria, array $orderBy = null)
 * @method PhotoManager[]    findAll()
 * @method PhotoManager[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class PhotoManagerRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, PhotoManager::class);
    }

    // /**
    //  * @return PhotoManager[] Returns an array of PhotoManager objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('p')
            ->andWhere('p.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('p.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?PhotoManager
    {
        return $this->createQueryBuilder('p')
            ->andWhere('p.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
