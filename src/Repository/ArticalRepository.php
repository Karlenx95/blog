<?php

namespace App\Repository;

use App\Entity\Artical;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\Tools\Pagination\Paginator;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Artical|null find($id, $lockMode = null, $lockVersion = null)
 * @method Artical|null findOneBy(array $criteria, array $orderBy = null)
 * @method Artical[]    findAll()
 * @method Artical[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ArticalRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Artical::class);
    }

    // /**
    //  * @return Artical[] Returns an array of Artical objects
    //  */
    /*
    public function findByExampleField($value)
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
    */

//    public function findArticleWithCategory($categoryName)
//    {
//        return $this->createQueryBuilder('a')
//            ->innerJoin('a.category', 'aC')->addSelect('aC')
//            ->where('aC.name = :name')
//            ->setParameter('name', $categoryName)
//            ->setFirstResult(0)
//            ->setMaxResults(10)
//            ->addOrderBy('a.created', 'DESC')
//            ->getQuery()
//            ->getResult()
//        ;
//
//
////        return $queryBuilder;
//    }


    /**
     * This repo is used to get a paginator for articles.
     *
     * @param string $categoryName
     * @param int $page
     * @param int $limit
     * @return Paginator
     */
    public function findArticlePagination(string $categoryName = '', int $page = 1, int $limit = 10): Paginator
    {
        // create a query builder
        $queryBuilder = $this->createQueryBuilder('a')
            ->innerJoin('a.category', 'aC')->addSelect('aC')
            ->where('aC.name = :name')
            ->setParameter('name', $categoryName)
            ->addOrderBy('a.created', 'DESC')
//            ->where('a.isEnabled = :isT')
//            ->setParameter('isT', true)
        ;

        // check if need to filter by category
        if(strlen($categoryName) >0){

            $queryBuilder->andWhere('aC.name = :aC')
                ->setParameter('aC', $categoryName);
        }

        // add ordering
        $queryBuilder->orderBy('a.id', 'ASC')
            ->getQuery();

        // create a Doctrine pagination
        $paginator = new Paginator($queryBuilder,  $fetchJoinCollection = true);

        // set limits and page first/start result
        $paginator->getQuery()
            ->setFirstResult($limit*($page-1))
            ->setMaxResults($limit)
        ;

        return $paginator;
    }
}
