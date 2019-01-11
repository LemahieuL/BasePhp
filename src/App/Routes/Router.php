<?php

namespace App\Routes;

use App\Protections\Security;

class Router {

    /**
     * stockage du $_GET[$url]
     * @var string
     */
    private $url;

    /**
     * Liste des routes.
     * @var array
     */
    private $routes = [];

    /**
     * Le nom des routes.
     * @var array
     */
    private $namedRoutes = [];

    /**
     * Valeur de defaut de l'url.
     * @param type $url
     */
    public function __construct($url) {
        $this->url = isset($_GET[$url]) ? $_GET[$url] : '/';
    }

    /**
     * Ajoute les routes avec la methode GET
     * @param string $path
     * @param string|array $callable
     * @param string $name
     * @return string
     */
    public function get($path, $callable, $name = NULL) {
        return $this->add($path, $callable, $name, 'GET');
    }

    /**
     * Ajoute les routes avec la methode POST
     * @param string $path
     * @param string $callable
     * @param string|array $name
     * @return string
     */
    public function post($path, $callable, $name = NULL) {
        return $this->add($path, $callable, $name, 'POST');
    }

    /**
     * Function pour eviter de la retaper dans la methode post et get
     * et les ajoutent dans la liste des routes.
     * @param string $path
     * @param string|array $callable
     * @param string $name
     * @param string $method
     * @return \App\Routes\Route
     */
    private function add($path, $callable, $name, $method) {
        $route = new Route($path, $callable);
        $this->routes[$method][] = $route;
        if (is_string($callable) && $name === NULL) {
            $this->namedRoutes[$callable] = $route;
        }
        if ($name) {
            $this->namedRoutes[$name] = $route;
        }
        return $route;
    }

    /**
     * La function qui permet d'appeler les controllers si la route actuelle correspond.
     * @throws RouterExceptions
     */
    public function run() {
        if (!isset($this->routes[$_SERVER['REQUEST_METHOD']])) {//Permet d'aller chercher la methode du client.
            throw new RouterExceptions('REQUEST_METHOD does not exist.');
        }
        $match = false;
        foreach ($this->routes[$_SERVER['REQUEST_METHOD']] as $route) {//Parcours tous le tableau des route post ou get en fonction de la page.
            if ($route->match($this->url)) {
                $route->call();
                $match = true;
            }
        }
        if (!$match) {
            if (isset($this->namedRoutes['default'])) {
                $this->safeLocalRedirect('default');
            } else {
                throw new RouterExceptions('No matching routes.');
            }
        }
    }
    
    /**
     * Instancie Security pour appeler safeLocalRedirect.
     * @param string $link
     * @param string|array $params
     * @param bool $exit
     */
    private function safeLocalRedirect($link, $params = [], $exit = true){
        $security = new Security();
        $security->safeLocalRedirect($link, $params, $exit);
    }

        /**
     * On recupere le name et les parametres SI elles existent.
     * @param string $name
     * @param array $params
     * @return string
     * @throws RouterExceptions
     */
    public function getUrl($name, $params = []) {
        if (!isset($this->namedRoutes[$name])) {
            throw new RouterExceptions('No route found with this name');
        }
        return $this->namedRoutes[$name]->getUrl($params);
    }

    /**
     * On retourne l'url complete a partir du name et des parametres.
     * @param string $name
     * @param array $params
     * @return string
     */
    public function getFullUrl($name, $params = []) {
        return PROJECT_LINK . '/' . $this->getUrl($name, $params);
    }

}
