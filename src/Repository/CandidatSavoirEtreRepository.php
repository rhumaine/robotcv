<?php

namespace App\Repository;

use App\Entity\CandidatSavoirEtre;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<CandidatSavoirEtre>
 *
 * @method CandidatSavoirEtre|null find($id, $lockMode = null, $lockVersion = null)
 * @method CandidatSavoirEtre|null findOneBy(array $criteria, array $orderBy = null)
 * @method CandidatSavoirEtre[]    findAll()
 * @method CandidatSavoirEtre[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CandidatSavoirEtreRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, CandidatSavoirEtre::class);
    }

    public function save(CandidatSavoirEtre $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(CandidatSavoirEtre $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

//    /**
//     * @return CandidatSavoirEtre[] Returns an array of CandidatSavoirEtre objects
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

//    public function findOneBySomeField($value): ?CandidatSavoirEtre
//    {
//        return $this->createQueryBuilder('c')
//            ->andWhere('c.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
