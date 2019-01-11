<?php

namespace Models\Database;

use \PDO;

class PDOConnect {

    /**
     *  Instance de PDO
     * @var \PDO 
     */
    private $pdo;

    /**
     * L'hote de la base de donnée
     * @var string 
     */
    private $db_host;

    /**
     * Le nom de l'utillisateur
     * @var string 
     */
    private $db_user;

    /**
     * le mot de passe de l'utillisateur
     * @var string 
     */
    private $db_password;

    /**
     * le nom de la base de donnée
     * @var string 
     */
    private $db_name;

    /**
     * Stockage des donnée dans les attributs de la classe.
     * @param string $db_name
     * @param string $db_host
     * @param string $db_user
     * @param string $db_password
     */
    public function __construct($db_name = 'hospitalE2N', $db_host = 'localdev', $db_user = 'ichigochini', $db_password = 'L1610L1993') {
        $this->db_host = $db_host;
        $this->db_password = $db_password;
        $this->db_user = $db_user;
        $this->db_name = $db_name;
    }

    /**
     * Récuperer l'instance de la classe PDO de php.
     * @return PDO
     */
    public function getPDO() {
        if ($this->pdo === null) {
            try {
                $pdo = new PDO('mysql:dbname=' . $this->db_name . ';host=' . $this->db_host.';charset=utf8', $this->db_user, $this->db_password);
                $this->pdo = $pdo;
                $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                $this->pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_OBJ);
            } catch (Exception $error) {
                die('Erreur : ' . $error->getMessage());
            }
        }
        return $this->pdo;
    }

    /**
     * Execute la commande query sinon si il' n'y a pas de paramètres sinon execute la commande prepare et execute.
     * @param string $statement
     * @param bool|array $parameters
     * @return \PDOStatement
     */
    public function query($statement, $parameters = false) {
        if ($parameters) {
            $req = $this->getPDO()->prepare($statement);
            $req->execute($parameters);
        } else {
            $req = $this->getPDO()->query($statement);
        }
        return $req;
    }
    
    /**
     * Pour faire plaisir a Anousone
     */
    public function __destruct() {
        
    }

}
