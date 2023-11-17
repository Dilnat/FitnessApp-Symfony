<?php

namespace App\Repository;

use App\Entity\GroupeMusculaire;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<GroupeMusculaire>
 *
 * @method GroupeMusculaire|null find($id, $lockMode = null, $lockVersion = null)
 * @method GroupeMusculaire|null findOneBy(array $criteria, array $orderBy = null)
 * @method GroupeMusculaire[]    findAll()
 * @method GroupeMusculaire[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class GroupeMusculaireRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, GroupeMusculaire::class);
    }

//    /**
//     * @return GroupeMusculaire[] Returns an array of GroupeMusculaire objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('g')
//            ->andWhere('g.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('g.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?GroupeMusculaire
//    {
//        return $this->createQueryBuilder('g')
//            ->andWhere('g.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
