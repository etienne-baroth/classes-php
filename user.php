<?php

class User {

    // ATTRIBUTS

    private $id;
    public $login;
    public $password;
    public $email;
    public $firstname;
    public $lastname;
    public $bdd;

    // CONSTRUCTEUR

    public function __construct() {

        $this->bdd = mysqli_connect("localhost", "root", "", "classes");
        echo "Connexion établie";

    }

    // METHODES

    public function register($login, $password, $email, $firstname, $lastname) {

        if($login != '' && $password != '' && $email != '' && $firstname != '' && $lastname != '') {

            $password = sha1($password);
            $insert = mysqli_query($this->bdd, "INSERT INTO utilisateurs (login, password, email, firstname, lastname) VALUES ('$login', '$password', '$email', '$firstname', '$lastname')");
            $request = mysqli_query($this->bdd, "SELECT * FROM utilisateurs WHERE login = '$login'");
            $result = $request->fetch_array(MYSQLI_ASSOC);


        }

    }

    public function connect($login, $password) {

        if($login != '' && $password != '') {
            $this->bdd->password_verify($password); {

            }
        }
    }

    public function disconnect() {

    }

    public function delete() {

    }

    public function update($login, $password, $email, $firstname, $lastname) {

    }

    public function isConnected() {

    }

    public function getAllInfos() {


    }

    public function getLogin() {

        return $this->login;
    }

    public function getEmail() {

        return $this->email;
    }

    public function getFirstname() {

        return $this->firstname;
        
    }

    public function getLastname() {

        return $this->lastname;
    }

}


$testUser = new User();

$testUser->register('test', 'test', 'test', 'test', 'test');

$testUser->getFirstname();
