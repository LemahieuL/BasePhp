<?php

namespace Models\Patients;

use Models\Database\PDOConnect;
use App\Protections\FormInputErrorMessage;

class Patient {

    /**
     * @var PDOconnect
     */
    private $db;

    /**
     * Stocke le Nom du patient
     * @var string
     */
    private $lastName;

    /**
     * @var string
     */
    private $firstName;

    /**
     * @var string
     */
    private $birthDate;

    /**
     * @var int 
     */
    private $phone;

    /**
     *
     * @var string
     */
    private $mail;

    /**
     *
     * @var id
     */
    private $id;

    /**
     * Function qui va recuperer les informations du patient si il existe.
     * @param bool|int $id
     * @return boolean
     */
    public function __construct($id = false) {
        $this->db = new PDOConnect();
        if ($id) {
            $req = $this->db->query('SELECT * FROM `patients` WHERE `id`= ?', [$id]);
            if ($req->rowCount() > 0) {
                $patient = $req->fetch();
                $this->id = $patient->id;
                $this->lastName = $patient->lastname;
                $this->firstName = $patient->firstname;
                $this->birthDate = $patient->birthdate;
                $this->phone = $patient->phone;
                $this->mail = $patient->mail;
                return true;
            }
        }
        return false;
    }

    public function id() {
        return $this->id;
    }

    public function getLastName() {
        return $this->lastName;
    }

    public function getFirstName() {
        return $this->firstName;
    }

    public function getBirthDate() {
        return $this->birthDate;
    }

    public function getPhone() {
        return $this->phone;
    }

    public function getMail() {
        return $this->mail;
    }

    /**
     * Function qui va créer le patient a partie des valeur recuperer
     * @param string $lastName
     * @param string $firstName
     * @param string $birthDate
     * @param int $phone
     * @param string $mail
     * @return boolean
     */
    public function addPatient($lastName, $firstName, $birthDate, $phone, $mail) {
        $verifications = new FormInputErrorMessage();
        $error = false;
        if (!$verifications->isValidName('firstName', $firstName)) {
            $error = true;
        }
        if (!$verifications->isValidName('lastName', $lastName)) {
            $error = true;
        }
        if (!$verifications->isValidBirthDate('birthDate', $birthDate)) {
            $error = true;
        }
        if (!$verifications->isValidPhoneNumber('phone', $phone)) {
            $error = true;
        }
        if (!$verifications->isValidMail('mail', $mail)) {
            $error = true;
        }
        if (!$error) {
            $birthDate = date('Y/m/d', strtotime(str_replace('/', '-', $birthDate)));
            $this->queryAddPatient([$lastName, $firstName, $birthDate, $phone, $mail]);
        }
        return $verifications->getErrors();
    }

    public function showPatient($lastName, $firstName, $birthDate, $phone, $mail, $id) {
        //$this->queryShowPatient([$lastName, $firstName, $birthDate, $phone, $mail, $id]);
    }

    /**
     * Ajout d'un patient dans la table patients.
     * @param array|string $params
     * @return boolean
     */
    private function queryAddPatient($params = []) {
        $req = $this->db->query('INSERT INTO `patients`(lastname, firstname, birthdate, phone, mail) VALUE (?,?,?,?,?)', $params);
        if ($req) {
            return true;
        }
        return false;
    }

    /**
     * Faire plaisir a Anousone.
     */
    public function __destruct() {
        ;
    }

}
