<?php

namespace App\Views;

class View{
    
    /**
     *
     * @var array 
     */
    private $data = [];
    
    /**
     *
     * @var bool|string 
     */
    private $render = false;
    
    /**
     * 
     * @param string $templateFile
     * @throws ViewsExceptions
     */
    public function __construct($templateFile) {
        $file = PROJECT_LIBS . '/public/views/' . $templateFile .'.php';
        if(file_exists($file)){
            $this->render = $file;
        } else {
            throw new ViewsExceptions('Erreur... La template : ' . $file . ' est introuvable');
        }
    }
     /**
      * Assigne les variable a extraire dans la vue.
      * @param array $dataArray
      */
    public function assign($dataArray = []){
        $this->data = $dataArray;
    }
    
    public function __destruct() {
        extract($this->data);
         if ($this->render){
             require $this->render;
         }
    }
}