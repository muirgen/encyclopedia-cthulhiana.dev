<?php

namespace Encyclopedia\LibraryBundle;

use Symfony\Component\HttpKernel\Bundle\Bundle;
use Symfony\Component\DependencyInjection\ContainerBuilder;
//use Encyclopedia\LibraryBundle\DependencyInjection\Compiler\ValidatorPass;


class EncyclopediaLibraryBundle extends Bundle {

    //To charge the Compiler ValidatorPass extends compilerPassInterface
    //this compiler allow the multiple files for validation by entity name
    //In the folder : LibraryBundle/Ressources/config/validation.
    /*public function build(ContainerBuilder $container) {
        
        parent::build($container);

        $container->addCompilerPass(new ValidatorPass());
    }*/

}
