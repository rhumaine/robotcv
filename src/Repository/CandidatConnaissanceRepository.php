<?php

namespace App\Repository;

use App\Entity\CandidatConnaissance;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<CandidatConnaissance>
 *
 * @method CandidatConnaissance|null find($id, $lockMode = null, $lockVersion = null)
 * @method CandidatConnaissance|null findOneBy(array $criteria, array $orderBy = null)
 * @method CandidatConnaissance[]    findAll()
 * @method CandidatConnaissance[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CandidatConnaissanceRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, CandidatConnaissance::class);
    }

    public function save(CandidatConnaissance $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(CandidatConnaissance $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

//    /**
//     * @return CandidatConnaissance[] Returns an array of CandidatConnaissance objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('c')
//            ->andWhere('c.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('c.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?CandidatConnaissance
//    {
//        return $this->createQueryBuilder('c')
//            ->andWhere('c.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
