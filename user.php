<?php

session_start();

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
        if (!$this->bdd) {
            die("Impossible de se connecter");
        } else {
            // echo "Vous êtes connecté à la Base de Données.";
        }
    }

    // METHODES

    public function register($login, $password, $email, $firstname, $lastname) {

        if($login != '' && $password != '' && $email != '' && $firstname != '' && $lastname != '') {

            $this->bdd->query("INSERT INTO `utilisateurs` (`login`, `password`, `email`, `firstname`, `lastname`) VALUES ('$login', '$password', '$email', '$firstname', '$lastname')");
            echo "L'utilisateur s'est bien enregistré.";
            $request = mysqli_query($this->bdd, "SELECT * FROM utilisateurs WHERE login = '$login'");
            $result = $request->fetch_array(MYSQLI_ASSOC);
        }
    }

    public function connect($login, $password) {

        $RecupUser = $this->bdd->query("SELECT * FROM utilisateurs WHERE login = '" . $login . "' AND password = '" . $password . "'");

        if (mysqli_num_rows($RecupUser) == 0) {
            $message = "Le login ou le mot de passe est incorrect, le compte n'a pas été trouvé";
        } else {
            $_SESSION['login'] = $login;
            $_SESSION['password'] = $password;
            echo "L'utilisateur vient de se connecter.";
        }
    }

    public function disconnect() {

        session_destroy();
        echo "L'utilisateur est bien déconnecté";
    }

    public function delete() {

        $request = $this->bdd->query("DELETE FROM utilisateurs WHERE login = '" . $_SESSION['login'] . "'");
        session_destroy();
        echo "L'utilisateur a été supprimé.";
    }

    public function update($login, $password, $email, $firstname, $lastname) {

        $request = $this->bdd->query("UPDATE utilisateurs SET login = '$login', password = '$password', email = '$email', firstname = '$firstname', lastname = '$lastname' WHERE login = '" . $_SESSION["login"] . "'");
        echo "Les informations de l'utilisateur ont été modifiées.";
    }

    public function isConnected() {

        if (isset($_SESSION['login'])) {
            echo "L'utilisateur est bien connecté.";
            return true;
        } else {
            echo "L'utilisateur n'est pas connecté.";
            return false;
        }
    }

    public function getAllInfos() {

        $request = $this->bdd->query("SELECT * FROM utilisateurs WHERE login = '" . $_SESSION['login'] . "'");
        $request = $request->fetch_all(MYSQLI_ASSOC);
        var_dump($request);
        return $request;
    }

    public function getLogin() {

        $request = $this->bdd->query("SELECT login FROM utilisateurs WHERE login = '" . $_SESSION['login'] . "'");
        $request = $request->fetch_all(MYSQLI_ASSOC);
        var_dump($request);
        return $request;
    }

    public function getEmail() {

        $request = $this->bdd->query("SELECT email FROM utilisateurs WHERE login = '" . $_SESSION['login'] . "'");
        $request = $request->fetch_all(MYSQLI_ASSOC);
        var_dump($request);
        return $request;
    }

    public function getFirstname() {

        $request = $this->bdd->query("SELECT firstname FROM utilisateurs WHERE login = '" . $_SESSION['login'] . "'");
        $request = $request->fetch_all(MYSQLI_ASSOC);
        var_dump($request);
        return $request;
    }

    public function getLastname() {

        $request = $this->bdd->query("SELECT lastname FROM utilisateurs WHERE login = '" . $_SESSION['login'] . "'");
        $request = $request->fetch_all(MYSQLI_ASSOC);
        var_dump($request);
        return $request;
    }

}


// TESTS DE FONCTIONNEMENT

var_dump($_SESSION);

$testUser = new User();

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