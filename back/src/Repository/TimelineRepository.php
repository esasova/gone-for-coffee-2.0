<?php

namespace App\Repository;

use App\Entity\Timeline;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Timeline|null find($id, $lockMode = null, $lockVersion = null)
 * @method Timeline|null findOneBy(array $criteria, array $orderBy = null)
 * @method Timeline[]    findAll()
 * @method Timeline[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class TimelineRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Timeline::class);
    }
}
