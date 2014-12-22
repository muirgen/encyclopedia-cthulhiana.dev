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
        $qb->Select('c.id,c.name,cc.name as category, cct.nameTrans as translation')
                ->leftJoin('c.category', 'cc')
                ->leftJoin('cc.translation', 'cct', 'WITH', 'cct.languages = :idlang')
                ->setParameter('idlang', $idlocale)
                ->where('c.id = :rid')
                ->setParameter('rid', $rid)
                ;
        
        $results = $qb->getQuery()->getSingleResult();
        
        return $results;
    }
    
    public function findByNameFirstLetterLike($letter,$locale){
        
        $localEntity = $this->getEntityManager()->getRepository('EncyclopediaLibraryBundle:Lang')->findOneBy(array('isoCode' => $locale));
        
        $lang = $localEntity->getId();
        
        $sql = 'SELECT c.id, '
                . ' IF((ct.idx_name_trans != NULL OR CHAR_LENGTH(ct.idx_name_trans > 1)) AND (UPPER(ct.idx_name_trans) REGEXP UPPER("^'.$letter.'") OR LOWER(ct.idx_name_trans) REGEXP LOWER("^'.$letter.'") )  ,ct.idx_name_trans,c.idx_name) as name,'
                . ' cc.name as category, '
                . ' IF((cct.name_trans != NULL OR CHAR_LENGTH(cct.name_trans > 1)),cct.name_trans,cc.name) as categoryTrans '
                . ' FROM catalogues c '
                . ' LEFT JOIN catalogues_trans ct ON (ct.id_catalogue = c.id AND ct.iso_code = ?) '
                . ' LEFT JOIN catalogues_categories  cc ON (cc.id = c.category) '
                . ' LEFT JOIN catalogues_categories_trans as cct ON (cct.id_category = c.category AND cct.id_lang = ?) '
                . ' WHERE c.idx_name LIKE ? OR ct.idx_name_trans LIKE ? '
                . ' UNION '
                . ' SELECT ca.id_catalogue as id, '
                . ' CONCAT(IF((cat.idx_name_trans != NULL OR CHAR_LENGTH(cat.idx_name_trans > 1)) AND (UPPER(cat.idx_name_trans) REGEXP UPPER("^'.$letter.'") OR LOWER(cat.idx_name_trans) REGEXP LOWER("^'.$letter.'") ) ,cat.idx_name_trans,ca.idx_name)," ( ",c.idx_name," alias )") AS name, '
                . ' cc.name as category, '
                . ' IF((cct.name_trans != NULL OR CHAR_LENGTH(cct.name_trans > 1)),cct.name_trans,cc.name) as categoryTrans'
                . ' FROM catalogues_alias ca '
                . ' LEFT JOIN catalogues_alias_trans cat ON (cat.id_alias = ca.id AND cat.iso_code = ?) '
                . ' LEFT JOIN catalogues c ON (ca.id_catalogue = c.id) '
                . ' LEFT JOIN catalogues_categories cc ON (cc.id = c.category) '
                . ' LEFT JOIN catalogues_categories_trans cct ON (cct.id_category = c.category AND cct.id_lang = ?) '
                . ' WHERE ca.idx_name LIKE ? OR cat.idx_name_trans LIKE ?'
                ;

        $rsm = new ResultSetMapping();
        $rsm->addEntityResult('EncyclopediaLibraryBundle:Catalogues', 'c');
        $rsm->addEntityResult('EncyclopediaLibraryBundle:CataloguesTrans', 'ct');
        $rsm->addEntityResult('EncyclopediaLibraryBundle:CataloguesCategories', 'cc');
        $rsm->addEntityResult('EncyclopediaLibraryBundle:CataloguesCategoriesTrans', 'cct');
        $rsm->addFieldResult('c', 'id', 'id');
        $rsm->addFieldResult('c', 'name', 'name');
        $rsm->addFieldResult('cc', 'category', 'name');
        $rsm->addFieldResult('cct', 'categoryTrans', 'nameTrans');

        $query = $this->_em->createNativeQuery($sql, $rsm);

        $query->setParameter(1, $locale);
        $query->setParameter(2, $lang);
        $query->setParameter(3, $letter . '%');
        $query->setParameter(4, $letter . '%');
        $query->setParameter(5, $locale);
        $query->setParameter(6, $lang);
        $query->setParameter(7, $letter . '%');
        $query->setParameter(8, $letter . '%');

        $results = $query->getScalarResult();
        
        return $results;
        
    }

}
