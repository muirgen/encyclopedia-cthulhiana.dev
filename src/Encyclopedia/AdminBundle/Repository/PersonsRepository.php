<?php

namespace Encyclopedia\AdminBundle\Repository;

use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\Query\ResultSetMapping;


class PersonsRepository extends EntityRepository{
    
    public function findByAutocompleteWithAlias($term){
        
        $results = null;
        
        $sql =  'SELECT id, name FROM persons WHERE name LIKE ? '
                . ' UNION '
                . 'SELECT id_person as id, name FROM persons_alias WHERE name LIKE ? ';
        
        $rsm = new ResultSetMapping();
        $rsm->addEntityResult('EncyclopediaAdminBundle:Persons', 'p');
        $rsm->addEntityResult('EncyclopediaAdminBundle:PersonsAlias', 'pa');
        $rsm->addFieldResult('p', 'id', 'id');
        $rsm->addFieldResult('p', 'name', 'name');
        $rsm->addFieldResult('pa', 'id', 'id');
        $rsm->addFieldResult('pa', 'name', 'name');
        
        $query = $this->_em->createNativeQuery($sql,$rsm);
                
        $query->setParameter(1, '%' . $term . '%');
        $query->setParameter(2, '%' . $term . '%'); 
                
                
        $results = $query->getScalarResult();
        
        return $results;
        
    }
    
    public function findAllWithLimit($limit = 5){
        
        $results = null;
        
        $qb = $this->createQueryBuilder('p');
        $qb->setMaxResults($limit);
        
        $results = $qb->getQuery()->getResult();
        
        return $results;
        
    }
    
}
