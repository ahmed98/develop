<?php

namespace EcommerceBundle\Repository;

use Doctrine\ORM\EntityRepository;

/**
 * ProduitsRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class ProduitsRepository extends EntityRepository
{
    /**
     * Search a product by criteria
     * @param string search 
     * @return array list of products
     */
    public function search( $search )
    {
        $qb = $this->createQueryBuilder('p')
                ->select('p')
                ->where('p.nom like :search')
                ->orderBy('p.id')
                ->setParameter('search', '%'.$search.'%');
        return $qb->getQuery()->getResult();
    }
}