<?php

namespace App\Repository;

use App\Entity\ExperienceProfessionnelle;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<ExperienceProfessionnelle>
 *
 * @method ExperienceProfessionnelle|null find($id, $lockMode = null, $lockVersion = null)
 * @method ExperienceProfessionnelle|null findOneBy(array $criteria, array $orderBy = null)
 * @method ExperienceProfessionnelle[]    findAll()
 * @method ExperienceProfessionnelle[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ExperienceProfessionnelleRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, ExperienceProfessionnelle::class);
    }

    public function save(ExperienceProfessionnelle $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(ExperienceProfessionnelle $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

//    /**
//     * @return ExperienceProfessionnelle[] Returns an array of ExperienceProfessionnelle objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('e')
//            ->andWhere('e.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('e.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?ExperienceProfessionnelle
//    {
//        return $this->createQueryBuilder('e')
//            ->andWhere('e.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
