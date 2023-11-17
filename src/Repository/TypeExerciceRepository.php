<?php

namespace App\Repository;

use App\Entity\TypeExercice;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<TypeExercice>
 *
 * @method TypeExercice|null find($id, $lockMode = null, $lockVersion = null)
 * @method TypeExercice|null findOneBy(array $criteria, array $orderBy = null)
 * @method TypeExercice[]    findAll()
 * @method TypeExercice[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class TypeExerciceRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, TypeExercice::class);
    }

//    /**
//     * @return TypeExercice[] Returns an array of TypeExercice objects
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

//    public function findOneBySomeField($value): ?TypeExercice
//    {
//        return $this->createQueryBuilder('t')
//            ->andWhere('t.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
