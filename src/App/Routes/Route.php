<?php
namespace App\Routes;

class Route{
    
    /**
     * Le chemin de la route.
     * @var string
     */
    private $path;
    
    /**
     * NomDeLaClasseController#NomDeLaMethodeDuController
     * @var string|array
     */
    private $callable;
    
    /**
     * Stocke les parametres des url.
     * @var array
     */
    private $matches=[];
    
    /**
     * Stocke le contenue des parametres 
     * @var array
     */
    private $params=[];
    
    /**
     * stocker les données dans les attributs
     * @param string $path
     * @param string|array $callable
     */
    public function __construct($path, $callable) {
        $this->path = trim($path, '/');
        $this->callable = $callable;
    }
    
    /**
     * vérifier le contenue de l'url (regex)
     * @param string $url
     * @return boolean
     */
    public function match($url){
        $url = trim($url, '/');
        $path = preg_replace_callback('#:([\w]+)#', [$this, 'paramMatch'], $this->path);
        $regex = '#^'. $path .'$#i';
        $matches = [];
        if(!preg_match($regex, $url, $matches)){
            return false;
        }
        array_shift($matches);
        $this->matches = $matches;
        return true;
    }
    
    /**
     * Vérification des paramètre de L'url
     * Si les paramèttre existe il les retournent.
     * @param array $match
     * @return string
     */
    private function paramMatch($match){
     if(isset($this->params[$match[1]])){
         return "($this->params[$match[1]])";
     }   
     return '([^/]+)';
    }
    
    /**
     * Instance du controller et appel de la fonction.
     * @return type
     */
    public function call(){
        if(is_string($this->callable)){
            $params = explode('#', $this->callable);
            $controller = '\Controllers\\' . $params[0] . 'Controller';
            $controller = new $controller();
            return call_user_func_array([$controller, $params[1]], $this->matches);
        } else {
            return call_user_func_array($this->callable, $this->matches);
        }
    }
    
    /**
     * remplace les params par les valeurs du parametre.
     * @param array $params
     * @return string
     */
    public function getUrl($params){
        $path = $this->path;
        foreach ($params as $k=>$v){
            $path = str_replace(':'.$k, $v, $path);
        }
        return $path;
    }
}