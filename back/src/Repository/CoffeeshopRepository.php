<?php

namespace App\Repository;

use App\Entity\Coffeeshop;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Coffeeshop|null find($id, $lockMode = null, $lockVersion = null)
 * @method Coffeeshop|null findOneBy(array $criteria, array $orderBy = null)
 * @method Coffeeshop[]    findAll()
 * @method Coffeeshop[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CoffeeshopRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Coffeeshop::class);
    }

    // /**
    //  * @return Coffeeshop[] Returns an array of Coffeeshop objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('c')
            ->andWhere('c.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('c.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Coffeeshop
    {
        return $this->createQueryBuilder('c')
            ->andWhere('c.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
