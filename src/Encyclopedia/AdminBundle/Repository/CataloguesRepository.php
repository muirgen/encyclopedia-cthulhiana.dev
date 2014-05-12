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
        $rsm->addEntityResult('EncyclopediaAdminBundle:Catalogue', 'c');
        $rsm->addEntityResult('EncyclopediaAdminBundle:CatalogueAlias', 'ca');
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
    
    public function findAllWithLimit($limit = 5){
        
        $results = null;
        
        $qb = $this->createQueryBuilder('c');
        $qb->setMaxResults($limit);
        
        $results = $qb->getQuery()->getResult();
        
        return $results;
        
    }
}
