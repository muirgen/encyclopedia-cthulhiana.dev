<?php

namespace Encyclopedia\LibraryBundle\Twig;

/**
 * 
 * @author Jenny
 * 
 */
class LibraryExtension extends \Twig_Extension{
    
    public function getFilters(){
        
        return array(
          'categorytoclass' => new \Twig_Filter_Method($this,'categoryNameToCssClass'),  
          'slugify'  => new \Twig_Filter_Method($this,'slugifyFilter')
        );
        
    }
    
    public function categoryNameToCssClass($name){
        
        $name = strtolower($name);
        $name = str_replace(' ','',$name);
        
        return $name;
    }
    
    public function slugifyFilter($name){
        
        $name = strtolower($name);
        $slug = str_replace(' ','-',$name);
        
        return $slug;
        
    }
    
    public function getName(){
        
        return 'library_extension';
        
    }
    
    
}

