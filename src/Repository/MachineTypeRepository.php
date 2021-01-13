<?php

namespace App\Repository;

use App\Entity\MachineType;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method MachineType|null find($id, $lockMode = null, $lockVersion = null)
 * @method MachineType|null findOneBy(array $criteria, array $orderBy = null)
 * @method MachineType[]    findAll()
 * @method MachineType[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class MachineTypeRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, MachineType::class);
    }

    // /**
    //  * @return MachineType[] Returns an array of MachineType objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('m')
            ->andWhere('m.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('m.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?MachineType
    {
        return $this->createQueryBuilder('m')
            ->andWhere('m.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
