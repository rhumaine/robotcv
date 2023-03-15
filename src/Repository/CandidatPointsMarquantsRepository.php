<?php

namespace App\Repository;

use App\Entity\CandidatPointsMarquants;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<CandidatPointsMarquants>
 *
 * @method CandidatPointsMarquants|null find($id, $lockMode = null, $lockVersion = null)
 * @method CandidatPointsMarquants|null findOneBy(array $criteria, array $orderBy = null)
 * @method CandidatPointsMarquants[]    findAll()
 * @method CandidatPointsMarquants[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CandidatPointsMarquantsRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, CandidatPointsMarquants::class);
    }

    public function save(CandidatPointsMarquants $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(CandidatPointsMarquants $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

//    /**
//     * @return CandidatPointsMarquants[] Returns an array of CandidatPointsMarquants objects
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

//    public function findOneBySomeField($value): ?CandidatPointsMarquants
//    {
//        return $this->createQueryBuilder('c')
//            ->andWhere('c.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
