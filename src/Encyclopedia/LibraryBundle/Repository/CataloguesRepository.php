<?php

namespace Encyclopedia\LibraryBundle\Repository;

use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\Query\ResultSetMapping;

class CataloguesRepository extends EntityRepository {

    public function findByAutocompleteWithAlias($term) {

        $results = null;

        $sql = 'SELECT id, name FROM catalogues WHERE name LIKE ? '
                . ' UNION '
                . 'SELECT id_catalogue as id, name FROM catalogues_alias WHERE name LIKE ? ';

        $rsm = new ResultSetMapping();
        $rsm->addEntityResult('EncyclopediaLibraryBundle:Catalogues', 'c');
        $rsm->addEntityResult('EncyclopediaLibraryBundle:CataloguesAlias', 'ca');
        $rsm->addFieldResult('c', 'id', 'id');
        $rsm->addFieldResult('c', 'name', 'name');
        $rsm->addFieldResult('ca', 'id', 'id');
        $rsm->addFieldResult('ca', 'name', 'name');

        $query = $this->_em->createNativeQuery($sql, $rsm);

        $query->setParameter(1, '%' . $term . '%');
        $query->setParameter(2, '%' . $term . '%');


        $results = $query->getScalarResult();

        return $results;
    }

    public function findByAutocompleteWithAliasExceptIdCatalogue($term, $idCatalogue) {

        $results = null;

        $sql = 'SELECT id, name FROM catalogues '
                . ' LEFT JOIN catalogues_related ON ( catalogues_related.id_related != catalogues.id ) '
                . ' WHERE catalogues_related.id_related != ? AND name LIKE ? '
                . ' UNION '
                . ' SELECT catalogues_alias.id_catalogue as id, name FROM catalogues_alias '
                . ' LEFT JOIN catalogues_related ON ( catalogues_related.id_related != catalogues_alias.id_catalogue ) '
                . ' WHERE catalogues_related.id_related != ? AND name LIKE ? ';

        $rsm = new ResultSetMapping();
        $rsm->addEntityResult('EncyclopediaLibraryBundle:Catalogues', 'c');
        $rsm->addEntityResult('EncyclopediaLibraryBundle:CataloguesAlias', 'ca');
        $rsm->addFieldResult('c', 'id', 'id');
        $rsm->addFieldResult('c', 'name', 'name');
        $rsm->addFieldResult('ca', 'id', 'id');
        $rsm->addFieldResult('ca', 'name', 'name');

        $query = $this->_em->createNativeQuery($sql, $rsm);

        $query->setParameter(1, $idCatalogue);
        $query->setParameter(2, '%' . $term . '%');
        $query->setParameter(3, $idCatalogue);
        $query->setParameter(4, '%' . $term . '%');


        $results = $query->getScalarResult();

        return $results;
    }

    public function findAllWithLimit($limit = 5) {

        $results = null;

        $qb = $this->createQueryBuilder('c');
        $qb->setMaxResults($limit);

        $results = $qb->getQuery()->getResult();

        return $results;
    }

    public function findByRand($idlocale = 2) {

        $results = null;
        $lid = array();
        
        $qb = $this->createQueryBuilder('c');
        $qb->select('c.id');

        $listid = $qb->getQuery()->getResult();
        
        foreach ($listid as $l) {
            $lid[$l['id']] = $l['id'];
        }

        $rid = array_rand($lid);
        
        //$results = $this->findOneBy(array('id' => $rid));
        
        $qb = $this->createQueryBuilder('c');
        $qb->Select('c.id,c.name,cc.name as category, cct.name_trans as translation')
                ->leftJoin('c.category', 'cc')
                ->leftJoin('cc.translation', 'cct', 'WITH', 'cct.languages = :idlang')
                ->setParameter('idlang', $idlocale)
                ->where('c.id = :rid')
                ->setParameter('rid', $rid)
                ;
        
        $results = $qb->getQuery()->getSingleResult();
        
        return $results;
    }
    
    public function findByNameFirstLetterLike($letter,$lang){
        
        $sql = 'SELECT catalogues.id, catalogues.name as name, cc.name as category, cct.name_trans as nameTrans '
                . ' FROM catalogues'
                . ' LEFT JOIN catalogues_categories as cc ON (cc.id = catalogues.category)'
                . ' LEFT JOIN catalogues_categories_trans as cct ON (cct.id_category = catalogues.category AND cct.id_lang = ?) '
                . ' WHERE catalogues.name LIKE ? '
                . ' UNION '
                . ' SELECT id_catalogue as id, '
                . ' CONCAT( catalogues_alias.name,  "( ", catalogues.name, " alias )" ) AS name, '
                . ' cc.name as category, '
                . ' cct.name_trans as nameTrans'
                . ' FROM catalogues_alias '
                . ' LEFT JOIN catalogues ON (catalogues_alias.id_catalogue = catalogues.id) '
                . ' LEFT JOIN catalogues_categories as cc ON (cc.id = catalogues.category) '
                . ' LEFT JOIN catalogues_categories_trans as cct ON (cct.id_category = catalogues.category AND cct.id_lang = ?) '
                . ' WHERE catalogues_alias.name LIKE ? '
                ;

        $rsm = new ResultSetMapping();
        $rsm->addEntityResult('EncyclopediaLibraryBundle:Catalogues', 'c');
        $rsm->addEntityResult('EncyclopediaLibraryBundle:CataloguesCategories', 'cc');
        $rsm->addEntityResult('EncyclopediaLibraryBundle:CataloguesCategoriesTrans', 'cct');
        $rsm->addFieldResult('c', 'id', 'id');
        $rsm->addFieldResult('c', 'name', 'name');
        $rsm->addFieldResult('cc', 'category', 'name');
        $rsm->addFieldResult('cct', 'nameTrans', 'name_trans');

        $query = $this->_em->createNativeQuery($sql, $rsm);

        $query->setParameter(1, $lang);
        $query->setParameter(2, $letter . '%');
        $query->setParameter(3, $lang);
        $query->setParameter(4, $letter . '%');

        $results = $query->getScalarResult();
        
        return $results;
        
    }

}
