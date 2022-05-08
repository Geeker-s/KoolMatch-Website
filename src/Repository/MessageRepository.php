<?php

namespace App\Repository;

use App\Entity\Message;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\Query;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Message|null find($idMessage, $lockMode = null, $lockVersion = null)
 * @method Message|null findOneBy(array $criteria, array $orderBy = null)
 * @method Message[]    findAll()
 * @method Message[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class MessageRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Message::class);
    }

//    public function findByarchiver($idMessage) : Query
//    {
//        return $this->createQueryBuilder('c')
//            ->andWhere('c.archive = :val')
//            ->andWhere('c.parent  = 0 ')
//            ->setParameter('val', $idMessage)->getQuery();
//    }
    /*
    public function findOneByidconversation($idconversation)
    {
        return $this->createQueryBuilder('p')
            ->andWhere('p.idconversation = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */


}