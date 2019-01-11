<?php

namespace Controllers;

use App\Views\View;

class Controller {
    
    public function __construct() {
        
    }
    
    /**
     * 
     * @return array
     */
    protected function getRouter(){
        return $GLOBALS['router'];
    }
    
    /**
     * 
     * @param type $path
     * @param array $args
     */
    protected function render($path, $args = []){
        $view = new View($path);
            $args['router'] = $this->getRouter();
        $view->assign($args);
        
    }
    
    public function __destruct() {
        
    }
}
