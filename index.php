<?php
/**
 * Created by PhpStorm.
 * User: Quentin
 * Date: 27/03/2019
 * Time: 17:05
 */

session_start();

require('controller/frontend.php');

if (isset ($_GET['action']))
{
    if ($_GET['action'] == 'sendContactMail') {

            if (!empty($_POST['first_name']) AND !empty($_POST['last_name']) AND !empty($_POST['email']) AND !empty($_POST['subject']) AND !empty($_POST['message'])) {

            sendContactMail($_POST['first_name'], $_POST['last_name'], $_POST['email'], $_POST['subject'], $_POST['message']);
            $action = "MailOK";
            home($action);
            }
            else {
                echo 'Erreur : tous les champs ne sont pas remplis !';
            }
        }
    elseif ($_GET['action'] == 'blog') {
        if (isset($_GET['p'])) {
            homeBlog($_GET['p']);
        }
        else {
            homeBlog(1);
        }
    }
    elseif ($_GET['action'] == 'viewPost') {
        if (isset($_GET['i'])) {
            viewPost($_GET['i']);
        }
        else {
            echo 'Erreur : aucun identifiant de billet renseigné !';
        }
    }
    elseif ($_GET['action'] == 'signup') {
        if (isset($_POST['lastName']) OR isset($_POST['firstName']) OR isset($_POST['email']) OR isset($_POST['password'])) {
            $retour = registerUser($_POST['lastName'], $_POST['firstName'], $_POST['email'], $_POST['password']);
            if ($retour == "OK") {
                signUp('validate');
            }
            else
            {
                signUp('userExist');
            }
        }
        else {
            signUp('view');
        }
    }
    elseif ($_GET['action'] == "login") {
        if (isset($_POST['email']) OR isset($_POST['password'])) {
            $retour = userLogIn($_POST['email'], $_POST['password']);
            if ($retour == "OK") {
                logIn('validate');
            }
            else
            {
                logIn('userDoesNotExist');
            }
        }
        else {
            logIn('view');
        }
    }
    elseif ($_GET['action'] == "logout") {
        logOut();
    }
}

else {
    $action = "NULL";
    home($action);
}