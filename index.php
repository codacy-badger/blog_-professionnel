<?php
session_start();
require('app/Controllers/PostController.php');
require('app/Controllers/UserController.php');
require('app/Controllers/AdminController.php');
require('app/Controllers/MainController.php');

use blogProfessionnel\App\Controllers\UserController;
use blogProfessionnel\App\Controllers\PostController;
use blogProfessionnel\App\Controllers\MainController;
use blogProfessionnel\App\Controllers\AdminController;

try { // On essaie de faire des choses
    if (isset($_GET['action'])) {
        if ($_GET['action'] == 'home') {
            $controller = new MainController();
            $controller->home();
        } elseif ($_GET['action'] == 'post') {
            if (isset($_GET['id']) && $_GET['id'] > 0) {
                $controller = new PostController();
                $controller->post();
            } else {
                // Erreur ! On arrête tout, on envoie une exception, donc au saute directement au catch
                throw new Exception('Aucun identifiant de billet envoyé');
            }
            //  } elseif ($_GET['action'] == 'admin') {
            // $controller = new AdminController();
            // $controller->admin();
        } elseif ($_GET['action'] == 'listPosts') {
            $controller = new PostController();
            $controller->listPosts();
        } elseif ($_GET['action'] == 'addPostForm') {
            $controller = new AdminController();
            $controller->addPostForm();
        } elseif ($_GET['action'] == 'login') {
            if (!empty($_POST['login']) && !empty($_POST['password'])) {
                if (isset($_POST['login']) && strlen($_POST['password']) > 0) {
                    if (!empty($_POST['login']) && !empty($_POST['password'])) {
                        $controller = new UserController();
                        $controller->login();
                    } else {
                        // Autre exception
                        $_SESSION['error'] = "Tous les champs ne sont pas remplis !";
                        header('Location: index.php?action=connection');
                    }
                }
            } else {
                // Autre exception
                $_SESSION['error'] = "Tous les champs ne sont pas remplis !";
                header('Location: index.php?action=connection');
            }
        } elseif ($_GET['action'] == 'managementCommentPage') {
            $controller = new AdminController();
            $controller->managementCommentPage();
        } elseif ($_GET['action'] == 'ViewPostComment') {
            if (isset($_GET['id']) && $_GET['id'] > 0) {
                $controller = new AdminController();
                $controller->ViewPostComment();
            } else {
                throw new Exception('Aucun identifiant de billet envoyé');
            }
        } elseif ($_GET['action'] == 'deleteComment') {
            $controller = new AdminController();
            $controller->deleteComment();
        } elseif ($_GET['action'] == 'updateStatusComment') {
            $controller = new AdminController();
            $controller->updateStatusComment();
        } elseif ($_GET['action'] == 'postModify') {
            $controller = new AdminController();
            $controller->postModify();
        } elseif ($_GET['action'] == 'modifyBlogPost') {
            $controller = new AdminController();
            $controller->modifyBlogPost();
        } elseif ($_GET['action'] == 'postDelete') {
            $controller = new AdminController();
            $controller->postDelete();
        } elseif ($_GET['action'] == 'connection') {
            $controller = new UserController();
            $controller->connection();
        } elseif ($_GET['action'] == 'logout') {
            $controller = new UserController();
            $controller->logout();
        } elseif ($_GET['action'] == 'inscriptionForm') {
            $controller = new UserController();
            $controller->inscriptionForm();
        } elseif ($_GET['action'] == 'inscription') {
            if (!empty($_POST['login']) && !empty($_POST['password']) && !empty($_POST['mail']  && !empty($_POST['cPassword']))) {
                $controller = new UserController();
                $controller->inscription($_POST['login'],  $_POST['password'], $_POST['mail']); //$hashPassword
            } elseif (!isset($_SESSION[$_POST['login']])) {
                $_SESSION['error'] = "Tous les champs ne sont pas remplis !!";
                header('Location: index.php?action=inscriptionForm');
            }
        } elseif ($_GET['action'] == 'postContact') {
            $controller = new MainController();
            $controller->postContact();
        } elseif ($_GET['action'] == 'addComment') {
            if (isset($_GET['id']) && $_GET['id'] > 0) {
                if (!empty($_POST['content']) && !empty($_POST['title'])) {
                    $controller = new PostController();
                    $controller->addComment($_GET['id'], $_SESSION['User']['id'], $_POST['content'], $_POST['title']);
                } else {
                    // Autre exception
                    $_SESSION['error'] = "Tous les champs ne sont pas remplis !";
                    header('Location: index.php?action=post&id=' . $_GET['id']);
                }
            } else {
                // Autre exception
                throw new Exception('Aucun identifiant de billet envoyé');
            }
        } elseif ($_GET['action'] == 'addBlogPost') {
            //  if (isset($_GET['id']) && $_GET['id'] > 0) {

            if (!empty($_POST['title']) && !empty($_POST['chapo']) && !empty($_POST['content'])) {
                $controller = new AdminController();
                $controller->addBlogPost(
                    /**$_GET['id'],**/
                    $_POST['title'],
                    $_POST['chapo'],
                    $_POST['content'],
                    $_SESSION['User']['id']
                );
            } else {
                // Autre exception
                $_SESSION['error'] = "Tous les champs ne sont pas remplis !!";
                header('Location: index.php?action=addPostForm');
            }
            // }
            // else {
            //     // Autre exception
            //     throw new Exception('Aucun identifiant de billet envoyé');
            // }
        }
    } else {
        $controller = new MainController();
        $controller->home();
    }
} catch (Exception $e) {
    $errorMessage = $e->getMessage();
    require('app/Views/errorView.php');
}
