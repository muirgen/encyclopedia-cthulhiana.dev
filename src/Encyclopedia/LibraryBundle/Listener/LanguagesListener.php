<?php

namespace Encyclopedia\LibraryBundle\Listener;

use Symfony\Component\HttpKernel\Event\GetResponseEvent;
use Symfony\Component\HttpKernel\HttpKernel;
use Symfony\Bundle\FrameworkBundle\Routing\Router;

class LanguagesListener {

    /**
     * URL
     * http://stackoverflow.com/questions/7656114/symfony2-wrong-locale-detection
     * http://stackoverflow.com/questions/12916439/symfony2-redirect-for-event-listener
     * http://stackoverflow.com/questions/15458580/generateurl-outside-controller
     * 
     */
    
    
    public function __construct($container, $availableLocales) {
        
        $this->container = $container;
        $this->availableLocales = $availableLocales;
    }

    public function onKernelRequest(GetResponseEvent $e) {
        
        $req = $e->getRequest();
        $locale = $req->getPreferredLanguage($this->availableLocales);
        $request_uri = $req->server->get('REQUEST_URI');
      
        $track_uri = explode('/', $request_uri);
        $array_excp = array('_wdt','sf2','admin');
        $test_uri = array_diff($track_uri, $array_excp);

        $routeName = $req->attributes->get('_route');
        $routeParams = $req->attributes->get('_route_params');
        
        if(empty($test_uri)){
            
            if($track_uri[1] == '_wdt'){
                return;
            }
            if($track_uri[1] == 'admin'){
                
                $localizedUrl = $this->container->get('router')->generate($routeName,$routeParams);
                $response = new \Symfony\Component\HttpFoundation\RedirectResponse($localizedUrl);
            
                $e->setResponse($response);
            }
            
        }
        if(!empty($test_uri) && ($track_uri[1] != 'admin') && $track_uri[1] != '_wdt'){
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

}
