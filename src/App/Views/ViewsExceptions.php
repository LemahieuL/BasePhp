<?php

namespace App\Views;

/**
 * Fait appelle a la classe php Exception
 */
class ViewsExceptions extends \Exception {

    /**
     * Affichages des erreurs lier aux vues.
     * @param string $message
     */
    public function __construct($message) {
        parent::__construct($message);
    }

    public function __destruct() {
        
    }

}


