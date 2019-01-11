<?php

namespace App\Routes;


class RouterExceptions extends \Exception {

    /**
     * Affichages des erreurs lier aux routes.
     * @param string $message
     */
    public function __construct($message) {
        parent::__construct($message);
    }
    
    /**
     * Pour plaisir à Anousone
     */
    public function __destruct() {
        
    }

}
