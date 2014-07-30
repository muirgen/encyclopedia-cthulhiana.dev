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
    public function getFunctions() {
        return array(
          //'russianAlphaLetter' => new \Twig_Function_Method($this, 'russianAlphaLetterFunction'),
          'russianAlphaLetter' => new \Twig_SimpleFunction('russianAlphaLetter', array($this, 'russianAlphaLetterFunction')),
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
    
    public function russianAlphaLetterFunction(){
        
        $s = array();
        $i = 1040;	  
	while ($i <= 1071){        # dernier code
 	
		//$s[] = chr($i);
		$str = mb_convert_encoding('&#' . intval($i) . ';', 'UTF-8', 'HTML-ENTITIES');
 		$s[] = mb_strtoupper($str, 'UTF-8');
		$i = $i + 1;
	
	}
        return $s;
    }
    
    public function getName(){
        
        return 'library_extension';
        
    }
    
    
}

