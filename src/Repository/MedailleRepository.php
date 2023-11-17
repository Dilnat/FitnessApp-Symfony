<?php

namespace App\Repository;

use App\Entity\Medaille;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Medaille>
 *
 * @method Medaille|null find($id, $lockMode = null, $lockVersion = null)
 * @method Medaille|null findOneBy(array $criteria, array $orderBy = null)
 * @method Medaille[]    findAll()
 * @method Medaille[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class MedailleRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Medaille::class);
    }

//    /**
//     * @return Medaille[] Returns an array of Medaille objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('m')
//            ->andWhere('m.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('m.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?Medaille
//    {
//        return $this->createQueryBuilder('m')
//            ->andWhere('m.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
