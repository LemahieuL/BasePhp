<?php

namespace App\Protections;

class Security {

    /**
     * Vérifier les injections SQL dans l'url.
     */
    public function __construct() {
        $injection = 'INSERT|UNION|SELECT|NULL|COUNT|FROM|LIKE|DROP|TABLE|WHERE|COUNT|COLUMN|TABLES|INFORMATION_SCHEMA|OR';
        foreach ($_GET as $getSearchs) {
            $getSearch = explode(' ', $getSearchs);
            foreach ($getSearch as $k => $v) {
                if (in_array(strtoupper(trim($v)), explode('|', $injection))) {
                    exit;
                }
            }
        }
    }

    /**
     * Tu recuperer le nom de la route et je la redirige.
     * @param string $link
     * @param array $params
     */
    public function safeLocalRedirect($link, $params = []) {
        $updateLink = $GLOBALS['router']->getFullUrl($link, $params);
        $this->safeExternalRedirect($updateLink, $exit);
    }

    /**
     * Redirection sécurisée
     * @param string $link
     * @param bool $exit
     */
    public function safeExternalRedirect($link, $exit = true) {
        if (!headers_sent()) {
            header('HTTP/1.1 301 Moved Permanently');
            header('Location: ' . $link);
            header('Connection: close');
        }
        print '<html>';
        print '<head><title>Redirection...</title>';
        print "<meta http-equiv='Refresh' content='0;url='{$link}' />";
        print '</head>';
        print "<body onload='location.replace('{$link}')'>";
        print 'Vous rencontrez peut-être un problème.<br />';
        print "<a href='{$link}'>Se faire rediriger</a><br />";
        print 'Si ceci est une erreur, merci de cliquer sur le lien.<br />';
        print '</body>';
        print '</html>';
        if ($exit) {
            exit;
        }
    }

    /**
     * Afficher les variables à sécuriser.
     * @param string $string
     * @return string
     */
    public function Show($string) {
        return htmlspecialchars($string, ENT_QUOTES, 'UTF-8');
    }

    /**
     * Pour faire plaisir a Anousone
     */
    public function __destruct() {
        
    }

}
