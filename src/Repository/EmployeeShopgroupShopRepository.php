<?php

namespace App\Repository;

use App\Entity\EmployeeShopgroupShop;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<EmployeeShopgroupShop>
 *
 * @method EmployeeShopgroupShop|null find($id, $lockMode = null, $lockVersion = null)
 * @method EmployeeShopgroupShop|null findOneBy(array $criteria, array $orderBy = null)
 * @method EmployeeShopgroupShop[]    findAll()
 * @method EmployeeShopgroupShop[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class EmployeeShopgroupShopRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, EmployeeShopgroupShop::class);
    }

    public function add(EmployeeShopgroupShop $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(EmployeeShopgroupShop $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

//    /**
//     * @return EmployeeShopgroupShop[] Returns an array of EmployeeShopgroupShop objects
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

//    public function findOneBySomeField($value): ?EmployeeShopgroupShop
//    {
//        return $this->createQueryBuilder('e')
//            ->andWhere('e.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
