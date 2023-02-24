<?php

session_start();

class Userpdo {

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

        try {
            $this->bdd = new PDO('mysql:host=localhost;dbname=classes', 'root', '');
            echo "Vous êtes connecté à la base de données";
        } catch (PDOException $e) {
            echo "Erreur : " . $e->getMessage();
        }
    }

    // METHODES

    public function register($login, $password, $email, $firstname, $lastname) {

        $insertUser = $this->bdd->prepare("INSERT INTO utilisateurs(login, password, email, firstname, lastname) VALUES(?,?,?,?,?)");
        $insertUser->execute([$login, $password, $email, $firstname, $lastname]);

        $recupUser = $this->bdd->prepare("SELECT * FROM utilisateurs WHERE login = ?");
        $recupUser->execute([$_SESSION['login']]);
        $result = $recupUser->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }

    public function connect($login, $password) {

        $recupUser = $this->bdd->prepare("SELECT login, password FROM utilisateurs WHERE login = ? AND password = ?");
        $recupUser->execute([$login, $password]);

        if ($recupUser->rowCount() > 0) {
            echo "L'utilisateur est bien connecté.";
            $_SESSION['login'] = $login;
            $_SESSION['password'] = $password;
        } else {
            echo "Le mot de passe et/ou le login ne sont pas corrects.";
        }
    }

    public function disconnect() {

        session_destroy();
    }

    public function delete() {

        $deleteUser = $this->bdd->prepare("DELETE FROM utilisateurs WHERE login = ?");
        $deleteUser->execute([$_SESSION['login']]);
        session_destroy();
        echo "L'utilisateur a été supprimé.";
    }

    public function update($login, $password, $email, $firstname, $lastname) {

        $updateUser = $this->bdd->prepare("UPDATE utilisateurs SET login = ?, password = ?, email = ?, firstname = ?, lastname = ? WHERE login = ?");
        $updateUser->execute([$login, $password, $email, $firstname, $lastname, $_SESSION['login']]);
    }

    public function isConnected() {

        if (isset($_SESSION['login'])) {
            return true;
        } else {
            return false;
        }
    }

    public function getAllinfos() {

        $recupUser = $this->bdd->prepare("SELECT * FROM utilisateurs WHERE login = ?");
        $recupUser->execute([$_SESSION['login']]);
        $result = $recupUser->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }

    public function getLogin() {

        $recupUser = $this->bdd->prepare("SELECT * FROM utilisateurs WHERE login = ?");
        $recupUser->execute([$_SESSION['login']]);
        $result = $recupUser->fetchAll(PDO::FETCH_ASSOC);
        return $result[0]['login'];
    }

    public function getEmail() {

        $recupUser = $this->bdd->prepare("SELECT * FROM utilisateurs WHERE login = ?");
        $recupUser->execute([$_SESSION['login']]);
        $result = $recupUser->fetchAll(PDO::FETCH_ASSOC);
        return $result[0]['email'];
    }

    public function getFirstname() {

        $recupUser = $this->bdd->prepare("SELECT * FROM utilisateurs WHERE login = ?");
        $recupUser->execute([$_SESSION['login']]);
        $result = $recupUser->fetchAll(PDO::FETCH_ASSOC);
        return $result[0]['firstname'];
    }

    public function getLastname() {

        $recupUser = $this->bdd->prepare("SELECT * FROM utilisateurs WHERE login = ?");
        $recupUser->execute([$_SESSION['login']]);
        $result = $recupUser->fetchAll(PDO::FETCH_ASSOC);
        return $result[0]['lastname'];
    }
}


// TESTS DE FONCTIONNEMENT

var_dump($_SESSION);

$testUser = new Userpdo();

// $testUser->register('test', 'test', 'test', 'test', 'test');

// $testUser->register('jo', 'jo', 'jo', 'jo', 'jo');



// $testUser->connect('test','test');

// $testUser->connect('jo','jo');



// $testUser->disconnect();


// $testUser->delete();


// $testUser->update('test2', 'test2', 'test2', 'test2', 'test2');


// $testUser->isConnected();


// $testUser->getAllInfos();


// $testUser->getLogin();


// $testUser->getEmail();


// $testUser->getFirstname();


// $testUser->getLastname();