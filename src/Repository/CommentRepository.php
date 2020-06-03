<?php

namespace App\Repository;

use App\Entity\Comment;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method Comment|null find($id, $lockMode = null, $lockVersion = null)
 * @method Comment|null findOneBy(array $criteria, array $orderBy = null)
 * @method Comment[]    findAll()
 * @method Comment[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CommentRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Comment::class);
    }

    // /**
    //  * @return Comment[] Returns an array of Comment objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('c')
            ->andWhere('c.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('c.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Comment
    {
        return $this->createQueryBuilder('c')
            ->andWhere('c.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */



    public function getAllComments(): array
    {

        $connection=$this->getEntityManager()->getConnection();

        $sql='
            SELECT C.*, u.name,u.surname, u.image, a.title FROM comment c
            JOIN user u ON u.id=c.userid
            JOIN activity a ON a.id=c.activityid
            WHERE c.id > :id
        ';
        $stmt=$connection->prepare($sql);
        //$stmt->execute(['id'=>$id]);

        return $stmt->fetchAll();
    }

    public function getAllComments2($id): array
    {

        $qb=$this->createQueryBuilder('c')
            ->select('c.id,c.ip,c.rate,c.subject,c.comment,c.created_at,c.status,a.title,u.image,u.name,u.surname')
            ->leftJoin('App\Entity\User','u','WITH','u.id=c.userid')
            ->leftJoin('App\Entity\Activity','a','WITH','a.id=c.activityid')
            ->where('c.id= :id')
            ->setParameters(array(':id'=>$id))
            ->orderBy('c.id','DESC');
        $query=$qb->getQuery();
        return $query->execute();
    }

    public function findAllComments(): array
    {

        $qb=$this->createQueryBuilder('c')
            ->select('c.id,c.ip,c.rate,c.subject,c.comment,c.created_at,c.status,a.title,u.image,u.name,u.surname')
            ->leftJoin('App\Entity\User','u','WITH','u.id=c.userid')
            ->leftJoin('App\Entity\Activity','a','WITH','a.id=c.activityid');
        $query=$qb->getQuery();
        return $query->execute();
    }


}
