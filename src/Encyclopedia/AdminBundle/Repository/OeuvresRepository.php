<?php

namespace Encyclopedia\AdminBundle\Repository;

use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\Query\ResultSetMapping;

/**
 * Description of OeuvresRepository
 *
 * @author Jenny
 */
class OeuvresRepository extends EntityRepository {

    public function findByAutocompleteWithAlias($term) {

        $results = null;

        $sql = 'SELECT id, CONCAT(name," (", format ,") ") AS name FROM oeuvres WHERE name LIKE ? '
                . ' UNION'
                . ' SELECT id_oeuvre as id,'
                . ' CONCAT(name," [Alias : " , '
                . '(SELECT CONCAT( name,  " (", format,  ") " ) AS name FROM oeuvres WHERE oeuvres_alias.id_oeuvre = oeuvres.id LIMIT 1) '
                . ',"]") AS name'
                . ' FROM oeuvres_alias WHERE name LIKE ? ';

        $rsm = new ResultSetMapping();
        $rsm->addEntityResult('EncyclopediaAdminBundle:Oeuvres', 'o');
        $rsm->addEntityResult('EncyclopediaAdminBundle:OeuvresAlias', 'oa');
        $rsm->addFieldResult('o', 'id', 'id');
        $rsm->addFieldResult('o', 'name', 'name');
        $rsm->addFieldResult('oa', 'id', 'id');
        $rsm->addFieldResult('oa', 'name', 'name');

        $query = $this->_em->createNativeQuery($sql, $rsm);

        $query->setParameter(1, '%' . $term . '%');
        $query->setParameter(2, '%' . $term . '%');


        $results = $query->getScalarResult();

        return $results;
    }

    public function findByAutocompleteWithAliasExceptIdCatalogue($term, $idCatalogue) {

        $results = null;

        $sql = 'SELECT id, CONCAT(name," (", format ,") ") AS name FROM oeuvres'
                . ' LEFT JOIN catalogues_oeuvres ON (oeuvres.id = catalogues_oeuvres.id_oeuvre) WHERE name LIKE ? AND catalogues_oeuvres.id_catalogue IS NULL '
                . ' UNION'
                . ' SELECT id_oeuvre as id,'
                . ' CONCAT(name," [Alias : " , '
                . '(SELECT CONCAT( name,  " (", format,  ") " ) AS name FROM oeuvres LEFT JOIN catalogues_oeuvres ON (oeuvres.id = catalogues_oeuvres.id_oeuvre) WHERE oeuvres_alias.id_oeuvre = oeuvres.id AND catalogues_oeuvres.id_catalogue IS NULL LIMIT 1)'
                . ',"]") AS name'
                . ' FROM oeuvres_alias WHERE name LIKE ? ';

        $rsm = new ResultSetMapping();
        $rsm->addEntityResult('EncyclopediaAdminBundle:Oeuvres', 'o');
        $rsm->addEntityResult('EncyclopediaAdminBundle:OeuvresAlias', 'oa');
        $rsm->addFieldResult('o', 'id', 'id');
        $rsm->addFieldResult('o', 'name', 'name');
        $rsm->addFieldResult('oa', 'id', 'id');
        $rsm->addFieldResult('oa', 'name', 'name');

        $query = $this->_em->createNativeQuery($sql, $rsm);

        $query->setParameter(1, '%' . $term . '%');
        $query->setParameter(2, '%' . $term . '%');


        $results = $query->getScalarResult();

        return $results;
    }

    public function findAllWithLimit($limit = 5) {

        $results = null;

        $qb = $this->createQueryBuilder('o');
        $qb->setMaxResults($limit);

        $results = $qb->getQuery()->getResult();

        return $results;
    }

}
