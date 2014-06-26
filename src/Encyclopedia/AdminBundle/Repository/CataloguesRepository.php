<?php

namespace Encyclopedia\AdminBundle\Repository;

use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\Query\ResultSetMapping;

class CataloguesRepository extends EntityRepository{
   
    public function findByAutocompleteWithAlias($term){
        
        $results = null;
        
        $sql =  'SELECT id, name FROM catalogues WHERE name LIKE ? '
                . ' UNION '
                . 'SELECT id_catalogue as id, name FROM catalogues_alias WHERE name LIKE ? ';
        
        $rsm = new ResultSetMapping();
        $rsm->addEntityResult('EncyclopediaAdminBundle:Catalogues', 'c');
        $rsm->addEntityResult('EncyclopediaAdminBundle:CataloguesAlias', 'ca');
        $rsm->addFieldResult('c', 'id', 'id');
        $rsm->addFieldResult('c', 'name', 'name');
        $rsm->addFieldResult('ca', 'id', 'id');
        $rsm->addFieldResult('ca', 'name', 'name');
        
        $query = $this->_em->createNativeQuery($sql,$rsm);
                
        $query->setParameter(1, '%' . $term . '%');
        $query->setParameter(2, '%' . $term . '%'); 
                
                
        $results = $query->getScalarResult();
        
        return $results;
        
    }
    
    public function findByAutocompleteWithAliasExceptIdCatalogue($term,$idCatalogue){
        
        $results = null;
        
        $sql =  'SELECT id, name FROM catalogues '
                . ' LEFT JOIN catalogues_related ON ( catalogues_related.id_related != catalogues.id ) '
                . ' WHERE catalogues_related.id_related != ? AND name LIKE ? '
                . ' UNION '
                . ' SELECT catalogues_alias.id_catalogue as id, name FROM catalogues_alias '
                . ' LEFT JOIN catalogues_related ON ( catalogues_related.id_related != catalogues_alias.id_catalogue ) '
                . ' WHERE catalogues_related.id_related != ? AND name LIKE ? ';
        
        $rsm = new ResultSetMapping();
        $rsm->addEntityResult('EncyclopediaAdminBundle:Catalogues', 'c');
        $rsm->addEntityResult('EncyclopediaAdminBundle:CataloguesAlias', 'ca');
        $rsm->addFieldResult('c', 'id', 'id');
        $rsm->addFieldResult('c', 'name', 'name');
        $rsm->addFieldResult('ca', 'id', 'id');
        $rsm->addFieldResult('ca', 'name', 'name');
        
        $query = $this->_em->createNativeQuery($sql,$rsm);
                
        $query->setParameter(1, $idCatalogue);
        $query->setParameter(2, '%' . $term . '%');
        $query->setParameter(3, $idCatalogue);
        $query->setParameter(4, '%' . $term . '%');
                
                
        $results = $query->getScalarResult();
        
        return $results;
        
    }
    
    public function findAllWithLimit($limit = 5){
        
        $results = null;
        
        $qb = $this->createQueryBuilder('c');
        $qb->setMaxResults($limit);
        
        $results = $qb->getQuery()->getResult();
        
        return $results;
        
    }
}
