<?php

class Bootstrap extends Zend_Application_Bootstrap_Bootstrap
{
    
    protected function _initRegisterControllerPlugins()
    {
        $this->bootstrap('frontcontroller');
        $front = $this->getResource('frontcontroller');
        // $front->registerPlugin(new Syntra_Controller_Plugin_Translate());
        // $front->registerPlugin(new Syntra_Controller_Plugin_Navigation());
        // $front->registerPlugin(new Syntra_Auth_Acl());
        // $front->registerPlugin(new Syntra_Auth_Auth());
    }
    
    /**
     * put after _initView
     * Create all custom routes
     * @param array $options
     * @return Zend_Controller_Router_Route
     */
    /*public function _initRouter (array $options = null)
    {
        $router = $this->getResource('frontcontroller')->getRouter();
        
        // custom routes aanmaken
        // : is met variabelen gaan werken = get variable
        // :lang = $_get['lang']
        
        // /:lang/-------/:slug
        // /nl_BE/pagina/titel
        // kan je opvragen met $this_getParam('lang');
        // of                                ('slug');
        // anders zou je moeten: /page/index/lang/nl_BE/slug/nieuws........
        $router->addRoute('lang',
                new Zend_Controller_Router_Route(':lang',array(
                    'controller' => 'index',
                    'action'     => 'index'
                )));
        
        $router->addRoute('login',
                new Zend_Controller_Router_Route(':lang/login',array(
                    'controller' => 'Users',
                    'action'     => 'login'
                )));
        
        $router->addRoute('logout',
                new Zend_Controller_Router_Route(':lang/logout',array(
                    'controller' => 'Users',
                    'action'     => 'logout'
                )));
        
        $router->addRoute('page',
                new Zend_Controller_Router_Route(':lang/pagina/:slug',array(
                    'controller' => 'page',
                    'action'     => 'index'
                )));
        
        $router->addRoute('admin',
                new Zend_Controller_Router_Route(':lang/admin/:controller/:action',array(
                    'module'     => 'admin',
                    'controller' => 'index',
                    'action'     => 'index'
                )));
        
        $router->addRoute('api',
                new Zend_Controller_Router_Route('api/:controller/:action',array(
                    'module'     => 'Api',
                    'controller' => 'Page',
                    'action'     => 'index'
                )));
        
        $router->addRoute('noaccess',
                new Zend_Controller_Router_Route('noaccess',array(
                    'controller' => 'noaccess',
                    'action'     => 'index'
                )));
        
    }*/
    
    
    // als je bepaalde controller hebt zorgen dat put get en post in juiste action komen
    // put get en post uit ApiController
    // juiste protocollen aan juiste actie koppelen
    protected function _initRestRoute()
    {
        // Alle controllers binnen de Api module worden hierdoor REST API controllers
        // Nodig get / post / put / delete action om dit te laten werken!
        $this->bootstrap('frontController');
        $frontController    = Zend_Controller_Front::getInstance();
        $restRoute          = new Zend_Rest_Route($frontController, array(), array('Api'));
        $frontController->getRouter()->addRoute('rest', $restRoute);
        
    }
    
}

