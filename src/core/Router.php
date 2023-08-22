<?php

namespace core;

use Controllers\AuthController;
use Controllers\TagsController;
use Controllers\UserController;
use Controllers\PageController;
use Controllers\HikeController;

class Router
{
    public function route(string $url_path, string $method): void
    {
        $authController = new AuthController();
        $isLoggedIn = $authController->isLoggedIn();



        if (isset($_GET['profile_updated']) && $_GET['profile_updated'] === 'true') {
            echo '<script>alert("Your profile is updated!");</script>';
        }

        if (isset($_GET['addhike']) && $_GET['addhike'] === 'true') {
            echo '<script>alert("Your hike has been added");</script>';
        }


        try {
            $url_path = trim(parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH), "/");
            $method = $_SERVER['REQUEST_METHOD']; // GET -- POST

            switch ($url_path) {
            case "":
            case "/":
                    $authController = new AuthController();
                    if (!$authController->isLoggedIn()) {
                        // Utilisateur non connecté : afficher le formulaire de connexion
                        if ($method === "GET") {
                            $authController->showLoginForm();
                        } elseif ($method === "POST") {
                            $authController->login($_POST['nickname'], $_POST['password']);
                        }
                    } else {
                        // Utilisateur connecté : rediriger vers la page /user
                        header("Location: /profil");
                        exit();
                    }
                    break;
            case "logout":
                    $authController = new AuthController();
                    $authController->logout();
                    break;
             case "register":
                    $authController = new AuthController();
                    if ($method === "GET") $authController->showRegistrationForm();
                    if ($method === "POST") $authController->register($_POST['firstname'], $_POST['lastname'], $_POST['nickname'], $_POST['email'], $_POST['password']);
                    break;
            case "userlist":
                $userController = new UserController();
                $userController->index();
                    break;
            case "search-user":
                    $userController = new UserController();
                    if ($method === "GET") {
                        $searchTerm = $_GET['search'] ?? '';
                        $userController->searchUserAndRedirect($searchTerm);
                    }
                    break;
                case "user":
                    $userController = new UserController();
                    if ($method === "GET") {
                        $userId = $_GET['id'] ?? null;
                        $searchTerm = $_GET['search'] ?? null;

                        if ($userId) {
                            $userController->showUser($userId);
                        } elseif ($searchTerm) {
                            $userController->searchUserAndRedirect($searchTerm);
                        } else {
                            // Handle the case when neither 'id' nor 'search' is provided
                            // You might want to display an error or redirect to a default page
                        }
                    }
                    break;
            case "profil":
                $userController = new UserController();
                if ($method === "GET") $userController->showUserInfo();
                break;
            case "editprofile":
                $userController = new UserController();
                if ($method === "GET") $userController->editProfile();
                break;
            case "updateprofile":
                $userController = new UserController();
                if ($method === "POST") $userController->updateProfile($_POST['firstname'], $_POST['lastname'], $_POST['nickname'], $_POST['email'], $_POST['password']);
                break;
            case "hikes-list":
                $hikeController = new HikeController();
                if ($method === "GET") $hikeController->showAll();
                break;
            case "hike":
                $hikeController = new HikeController();
                $hikeController->show($_GET['id']);
                break;

            case "addhike":
                $hikeController = new HikeController();
                if ($method === "GET") $hikeController->showAddHikeForm();

                if ($method === "POST") $hikeController->addHike($_SESSION['user']['id'], $_POST['hikename'], $_POST['distance'], $_POST['duration'], $_POST['elevation_gain'], $_POST['description'], $_POST['tags']);
                break;

            case "editHike":
                $hikeController = new HikeController();
                if ($method === "GET") {
                $hikeId = $_GET['hike_id'] ?? null;
                $hikeController->editHike($hikeId);
                    }
                break;

            case "updatehike":
                    $hikeController = new HikeController();
                    if ($method === "POST") $hikeController->updatehike($_POST['name'], $_POST['distance'], $_POST['duration'], $_POST['elevation_gain'], $_POST['description'], $_POST['tags']);
                    break;
            case "tags":
                    $tagsController = new TagsController();
                    $tagsController->index();



            default:
                    $pageController = new PageController();
                    $pageController->page_404();
            }
        } catch (Exception $e) {
            $pageController = new PageController();
            $pageController->page_500($e->getMessage());
        }
    }
}