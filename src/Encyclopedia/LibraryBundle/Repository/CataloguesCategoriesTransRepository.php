<?php

namespace Encyclopedia\LibraryBundle\Repository;

use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\Query\ResultSetMapping;

class CataloguesCategoriesTransRepository extends EntityRepository {

    public function findAllByLocaleId($locale = 2) {

        $results = null;

        $qb = $this->createQueryBuilder('cct');
        $qb->join('cct.languages', 'l')
            ->where('l.id = :locale')
            ->setParameter('locale',$locale);

        $results = $qb->getQuery()->getResult();

        return $results;
    }


}
