<?php

namespace Encyclopedia\LibraryBundle\Repository;

use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\Query\ResultSetMapping;

class TranslationLexiconCategoryRepository extends EntityRepository {

    public function findAllByIdLocale($locale = 2) {

        $results = null;

        $qb = $this->createQueryBuilder('tlc');
        $qb->join('tlc.language', 'l')
            ->where('l.id = :locale')
            ->setParameter('locale',$locale);

        $results = $qb->getQuery()->getResult();

        return $results;
    }


}
