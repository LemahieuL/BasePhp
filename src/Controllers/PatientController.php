<?php

namespace Controllers;
use Models\Patients\Patient;

class PatientController extends Controller {
       
 
    public function addPatient() {
        $this->render('patients/addPatient');
    }
    
    public function showPatient() {
        $this->render('patients/showPatient');
    }

    public function createPatient() {
        $patient = [];
        if(isset($_POST['inputFirstName'], $_POST['inputLastName'], $_POST['inputBirthDate'], $_POST['inputPhone'], $_POST['inputEmail'])){
            $addPatient = new Patient();
            $patient=$addPatient->addPatient($_POST['inputLastName'], $_POST['inputFirstName'], $_POST['inputBirthDate'], $_POST['inputPhone'], $_POST['inputEmail']);
            
        }
        
        $this->render('patients/addPatient',['errors'=>$patient]);
        
    }
}