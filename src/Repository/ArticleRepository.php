<?php

namespace App\Repository;

use App\Entity\Article;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Article>
 *
 * @method Article|null find($id, $lockMode = null, $lockVersion = null)
 * @method Article|null findOneBy(array $criteria, array $orderBy = null)
 * @method Article[]    findAll()
 * @method Article[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ArticleRepository extends ServiceEntityRepository
{
    /** @inheritdoc */
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Article::class);
    }
    /**
     * Vrátí článek z databáze podle jeho URL.
     * @param string $url URl článku
     * @return Article|null první článek, který má danou URL nebo null pokud takový neexistuje
     */
    public function findOneByUrl(string $url): ?Article
    {
        return $this->findOneBy(['url' => $url]);
    }
 /*   public function add(Article $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
   */
    /**
     * Uloží článek do systému.
     * Pokud není nastaveno ID, vloží nový, jinak provede editaci.
     * @param Article $article článek
     * @throws ORMException Jestliže nastane chyba při ukládání článku.
     */
    public function save(Article $article): void
    {
        $this->getEntityManager()->persist($article);
        $this->getEntityManager()->flush($article);
    }

    public function removeByUrl(string $url): void
    {
        if ($article = $this->findOneByUrl($url)) {
            $this->getEntityManager()->remove($article);
            $this->getEntityManager()->flush();
        }
    }

   public function remove(Article $entity, bool $flush = false): void
   {
       $this->getEntityManager()->remove($entity);

       if ($flush) {
           $this->getEntityManager()->flush();
       }
   }

    /**
     * @return Article[] Returns an array of Article objects
     */
    public function findByExampleField($value): array
    {
        return $this->createQueryBuilder('a')
            ->andWhere('a.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('a.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }

    public function findOneBySomeField($value): ?Article
    {
        return $this->createQueryBuilder('a')
            ->andWhere('a.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
}
