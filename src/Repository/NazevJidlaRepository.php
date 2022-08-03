<?php

namespace App\Repository;

use App\Entity\NazevJidla;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<NazevJidla>
 *
 * @method NazevJidla|null find($nazev_id, $lockMode = null, $lockVersion = null)
 * @method NazevJidla|null findOneBy(array $criteria, array $orderBy = null)
 * @method NazevJidla[]    findAll()
 * @method NazevJidla[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class NazevJidlaRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, NazevJidla::class);
    }

    public function add(NazevJidla $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(NazevJidla $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

//    /**
//     * @return NazevJidla[] Returns an array of NazevJidla objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('n')
//            ->andWhere('n.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('n.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?NazevJidla
//    {
//        return $this->createQueryBuilder('n')
//            ->andWhere('n.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
