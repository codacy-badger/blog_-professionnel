<?php

namespace blogProfessionnel\app\Controllers;

require_once('app/Models/PostManager.php');
require_once('app/Models/CommentManager.php');

use \blogProfessionnel\app\Models\PostManager;
use \blogProfessionnel\app\Models\CommentManager;

class PostController
{
    /**
     *  Gere la vue ou s'affiche la lise des posts publié
     */
    public function listPosts()
    {
        if (isset($_GET['page']) && !empty($_GET['page'])) {
            $currentPage = (int) $_GET['page'];
        } else {
            $currentPage = 1;
        }
        $postManager = new PostManager();
        $posts = $postManager->getPosts($currentPage);
        $pageOfNumber = $postManager->countPost();

        require('app/Views/listPostsView.php');
    }

    /**
     * pour voir sur la vue d'un post, un post defini par son id
     */
    public function post()
    {
        if (isset($_GET['page']) && !empty($_GET['page'])) {
            $currentPage = (int) $_GET['page'];
        } else {
            $currentPage = 1;
        }
        $postManager = new PostManager;
        $commentManager = new CommentManager();
        $posts = $postManager->getPost($_GET['id']);
        $comments = $commentManager->getComments($_GET['id'], $currentPage);
        $pageOfNumber = $commentManager->countComment($_GET['id'], $currentPage);
        require('app/Views/postView.php');
    }

    /**
     * gere la partie pour ajouter un commentaire
     */
    public function addComment($postId, $userId, $content, $title)
    {
        $commentManager = new CommentManager();

        if (isset($_SESSION['User']) || isset($_SESSION['Admin'])) {
            $affectedLines = $commentManager->postComment($postId, $userId, $content, $title);
            if ($affectedLines === false) {
                $_SESSION['error'] = 'Impossible d\'ajouter le commentaire !';
                header('Location: index.php?action=post&id=' . $postId);
            } else {
                $_SESSION['flash']['success'] = "Votre commentaire a été pris en compte et sera traité par un administrateur dans les meilleurs délais.";
                header('Location: index.php?action=post&id=' . $postId);
            }
        } else {
            $_SESSION['error'] = 'Vous devez être connecté pour ajouter un commentaire.';
            header('Location: index.php?action=connection');
        }
    }
}
