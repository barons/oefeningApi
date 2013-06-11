<?php
// dit alles staat op een tweede systeem dat systeem 1 (apicontroller) op afstand
// kan besturen, zolang je GET POST PUT en DELETE ingeeft. 

// door te extenden van Zend_Rest_Controller gebruiken we de echte controller om API's te bouwen
// dan moet je wel de headaction en de indexAction aanmaken

// putactie werkt maar vanaf ZF 10.6 !!
// (anders melding ivm abstract classes)
class Api_PageController extends Zend_Rest_Controller
{

    public function init()
    {
        $this->_helper->viewRenderer->setNoRender(true);
        $this->_helper->layout->disableLayout();
    }
    
    public function headAction()
    {
        
    }
    
    public function indexAction() 
    {
        
    }
    
    public function getAction()
    {
        $this->getResponse()
                ->appendBody('getAction() return');
    }
    
    // Pagina bijmaken
    public function postAction()
    {
       $form                = new Admin_Form_Producten();
        $this->view->form   = $form;
        
        // zorgen dat nieuws in de database raakt
        if ($this->getRequest()->isPost()){
            $postParams     = $this->getRequest()->getPost();
            
            // controle, als alles correct is
            if ($this->view->form->isValid($postParams)){
                unset($postParams['send']); // we schrijven de knop niet weg....
                $productModel = new Admin_Model_Producten();
                
                $productModel->addProducts($postParams);
                // vervangen door functies van Zend dus ->
                $this->_redirect($this->view->url(array('controller' => 'Index', 'action' => 'list-products')));
                die ('redirect gelukt');
            }
            
        } 
    }
    
    // Pagina aanpassen
    public function putAction()
    {
        $id             = $this->_getParam('id'); 
        
        $productModel   = new Application_Model_Producten();
        $product        = $productModel->find($id)->current(); // SELECT * FROM nieuws WHERE id = $id
        $form           = new Application_Form_Producten();
        
        // populate, juiste veldjes opvullen met data die je wilt
        $form->populate($product->toArray()); // omzetten in array om het formulier op te vullen
        
        // populate form
        $this->view->form = $form;
        
        // zorgen dat nieuws in de database raakt
        if ($this->getRequest()->isPost()){
            $postParams = $this->getRequest()->getPost();
            
            // controle, als alles correct is
            if ($this->view->form->isValid($postParams)){
                
                unset($postParams['send']);
                
                $productModel->modProducts($postParams, $id);
                $this->_redirect('/producten/overzicht');
                
            }
            
        }
    }
    
    // Pagina verwijderen
    public function deleteAction()
    {
        $this->getResponse()
                ->appendBody('deleteAction() return');
    }


}

