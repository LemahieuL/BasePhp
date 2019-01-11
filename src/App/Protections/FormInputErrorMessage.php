<?php

namespace App\Protections;

class FormInputErrorMessage {

    private $errors = [];

    public function __construct() {
        
    }

    public function getErrors() {
        return $this->errors;
    }

    public function isValidName($inputName, $string) {
        if (!empty($string)) {
            /* Si le champs est vide il renvoit le message et passe la variable error en true */
            if (preg_match('/^[a-zA-ZÂ-ÿ -]+$/i', $string)) {
                /* Si le champs contient des caractere qui ne sont pas pris dans la regex il renvoit le message et oasse la variable error en true */
                if (strlen($string) > 1 && strlen($string) <= 25) {
                    return true;
                } else {
                    $this->errors[$inputName] = 'Le champs doit comprendre entre 3 et 25 caractères.';
                }
            } else {
                $this->errors[$inputName] = 'Mauvais caractères.';
            }
        } else {
            $this->errors[$inputName] = 'Le champs est vide.';
        }
        return false;
    }

    public function isValidBirthDate($inputDate, $string) {
        if (!empty($string)) {
            /* Si le champs est vide il renvoit le message et passe la variable error en true */
            if (preg_match('/^[0-9]{1,2}\/[0-9]{1,2}\/[0-9]{4}$/i', $string)) {
                /* Si le champs contient des caractere qui ne sont pas pris dans la regex il renvoit le message et oasse la variable error en true */
                $dateExplode = explode('/', $string);
                if (checkdate($dateExplode[1], $dateExplode[0], $dateExplode[2])) {
                    if ($string <= date('d/m/Y')) {
                        return true;
                    } else {
                        $this->errors[$inputDate] = 'Date invalide.';
                    }
                } else {
                    $this->errors[$inputDate] = 'Date invalide.';
                }
            } else {
                $this->errors[$inputDate] = 'Date invalide.';
            }
        } else {
            $this->errors[$inputDate] = 'Le champs est vide.';
        }
        return false;
    }

    public function isValidPhoneNumber($inputPhoneNumber, $string) {
        if (!empty($string)) {
            /* Si le champs est vide il renvoit le message et passe la variable error en true */
            if (preg_match('/^(0|\+33)[1-9]([-. ]?[0-9]{2}){4}$/i', $string)) {
                /* Si le champs contient des caractere qui ne sont pas pris dans la regex il renvoit le message et oasse la variable error en true */
                return true;
            } else {
                $this->errors[$inputPhoneNumber] = 'Numéro invalide.';
            }
        } else {
            $this->errors[$inputPhoneNumber] = 'Le champs est vide.';
        }
        return false;
    }

    public function isValidMail($inputPhoneNumber, $string) {
        if (!empty($string)) {
            /* Si le champs est vide il renvoit le message et passe la variable error en true */
            if (filter_var($string, FILTER_VALIDATE_EMAIL)) {
                /* Si le champs contient des caractere qui ne sont pas pris dans la regex il renvoit le message et oasse la variable error en true */
                return true;
            } else {
                $this->errors[$inputPhoneNumber] = 'Email invalide.';
            }
        } else {
            $this->errors[$inputPhoneNumber] = 'Le champs est vide.';
        }
        return false;
    }

    public function __destruct() {
        
    }

}
