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

    public function findArticleWithCategory($categoryName){
        $queryBuilder = $this->createQueryBuilder('a')
            ->innerJoin('a.category','aC')->addSelect('aC')
            ->where('aC.name = :name')
            ->setParameter('name',$categoryName)
            ->addOrderBy('a.created','DESC')
        ;

        $paginator = new Paginator($queryBuilder->getQuery(),$fetchJoinCollection = true);
        $limit = 1000;
        $page = 1;

            $paginator->getQuery()

                ->setFirstResult($limit*($page-1))
                ->setMaxResults($limit);
            
        $category = $paginator->getIterator();

        return $category;

        }

}
