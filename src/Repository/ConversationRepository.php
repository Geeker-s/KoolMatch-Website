<?php

namespace App\Repository;

use App\Entity\Conversation;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\Query;
use Doctrine\Persistence\ManagerRegistry;
/**
 * @method Conversation|null find($idConversation, $lockMode = null, $lockVersion = null)
 * @method Conversation|null findOneBy(array $criteria, array $orderBy = null)
 * @method Conversation[]    findAll()
 * @method Conversation[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */

class ConversationRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Conversation::class);
    }
    public function search($term)
    {
        return $this->createQueryBuilder('Conversation')
            ->andWhere('Conversation.titreConversation = :nom')
            ->setParameter('nom', $term)
            ->getQuery()
            ->execute();
    }

//    public function findByarchiver($idConversation) : Query
//    {
//        return $this->createQueryBuilder('c')
//            ->andWhere('c.archive = :val')
//            ->andWhere('c.parent  = 0 ')
//            ->setParameter('val', $idMessage)->getQuery();
//    }
//    public function findBytitreConversation($idConversation) : Query
//    {
//        return $this->createQueryBuilder('c')
//            ->andWhere('c.titreConversation = :val')
//            ->setParameter('val', $idConversation)->getQuery();
//    }

}