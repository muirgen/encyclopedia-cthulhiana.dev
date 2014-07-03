<?php

namespace Encyclopedia\LibraryBundle\Listener;

use Symfony\Component\HttpKernel\Event\GetResponseEvent;
use Symfony\Component\HttpKernel\HttpKernel;
use Symfony\Component\HttpKernel\HttpKernelInterface;
use Symfony\Bundle\FrameworkBundle\Routing\Router;
use Symfony\Component\HttpKernel\Event\FilterControllerEvent;

use Doctrine\ORM\EntityManager;
use Symfony\Component\DependencyInjection\ContainerInterface;

class LanguagesListener {

    /**
     * URL
     * http://stackoverflow.com/questions/7656114/symfony2-wrong-locale-detection
     * http://stackoverflow.com/questions/12916439/symfony2-redirect-for-event-listener
     * http://stackoverflow.com/questions/15458580/generateurl-outside-controller
     * 
     */
    
    protected $em;
    
    public function __construct(EntityManager $em, $container, $availableLocales, $idlang = 2) {
        
        $this->container = $container;
        $this->availableLocales = $availableLocales;
        $this->idLang = $idlang;
        $this->em = $em;
    }

    /**
     * 
     * @param \Symfony\Component\HttpKernel\Event\GetResponseEvent $e
     * @return type
     * Detect the prefered language of the user and set it as local
     * automatically if a link on flag is not clicked
     */
    public function onKernelRequest(GetResponseEvent $e) {
        
        $req = $e->getRequest();
        $locale = $req->getPreferredLanguage($this->availableLocales);
        $request_uri = $req->server->get('REQUEST_URI');
      
        $track_uri = explode('/', $request_uri);
        $array_excp = array('_wdt','_profiler','admin');
        $test_uri = array_diff($track_uri, $array_excp);

        $routeName = $req->attributes->get('_route');
        $routeParams = $req->attributes->get('_route_params');
        
        if (HttpKernelInterface::MASTER_REQUEST !== $e->getRequestType()) {
            return;
        }
        
        if(empty($test_uri)){
            
            if($track_uri[1] == '_wdt' || $track_uri[1] == '_profiler'){
                return;
            }
            if($track_uri[1] == 'admin'){
                
                $localizedUrl = $this->container->get('router')->generate($routeName,$routeParams);
                $response = new \Symfony\Component\HttpFoundation\RedirectResponse($localizedUrl);
            
                $e->setResponse($response);
            }
            
        }
        if(!empty($test_uri) && ($track_uri[1] != 'admin') && ($track_uri[1] != '_wdt') && ($track_uri[1] != '_profiler')){
            
            // generate a new URL from the current route-name and -params, overwriting
            // the current locale
            $routeParams = array_merge($req->attributes->get('_route_params'), array('_locale' => $locale));

            if($routeName == '_homepagewithoutlocale'){
                $routeName = '_homepage';
            }

            if(!$req->attributes->get('_locale')){

                $localizedUrl = $this->container->get('router')->generate($routeName,$routeParams);
                $response = new \Symfony\Component\HttpFoundation\RedirectResponse($localizedUrl);

                $e->setResponse($response);

            }
        
        }
        
        
    }
    /**
     * 
     * @param \Symfony\Component\HttpKernel\Event\FilterControllerEvent $e
     * @return type
     * Get the id of current locale iso code, to reach the good 
     * language parameter in the queries.
     */
    public function onKernelController(FilterControllerEvent $e){
        
        if(HttpKernelInterface::MASTER_REQUEST !== $e->getRequestType()){
            return;
        }
 
        $req = $e->getRequest();
        
        if (0 === strpos($req->getPathInfo(), "/_wdt") || 0 === strpos($req->getPathInfo(), "/_profiler")){
            return;
        }

        $controller = $e->getController();
        
        if (!is_array($controller)) {
            return;
        }
        else{
               
            $locale = $req->attributes->get('_locale');
            
            $entity = $this->em->getRepository('EncyclopediaLibraryBundle:Lang')->findOneBy(array('isoCode' => $locale,'public' => true));
            
            if($entity) { $this->idLang = $entity->getId(); }
            
        }
    }
    
    public function getIdLang(){
        return $this->idLang;
    }
}
