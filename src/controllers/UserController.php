<?php
declare(strict_types=1);

namespace Controllers;

use Exception;
use Models\Database;
use Models\User;
use PDO;

class UserController
{
    private Database $db;

    public function __construct()
    {
        $this->db = new Database();
    }

    public function index()
    {
        try {
            $searchQuery = $_GET['search'] ?? ''; // Get the search query from the URL parameter

            if (!empty($searchQuery)) {
                // Search for users by first name or nickname
                $users = (new User())->searchUsers($searchQuery);
            } else {
                // Retrieve all users
                $users = (new User())->findAll(20);
            }

            include 'views/layout/header.view.php';
            include 'views/users_list.view.php';
            include 'views/layout/footer.view.php';
        } catch (Exception $e) {
            print_r($e->getMessage());
        }
    }
    public function searchUserAndRedirect($searchTerm) {
        $userModel = new User();
        $searchedUsers = $userModel->searchUsersByNameOrNickname($searchTerm);

        if (count($searchedUsers) === 1) {
            $userId = $searchedUsers[0]['firstname'];
            header("Location: /user?id=$userId");
            exit();
        } elseif (count($searchedUsers) > 1) {
            echo '<script>alert("Multiple users found. Please be more specific.");</script>';
        } else {
            echo '<script>alert("User not found.");</script>';
        }
    }
    public function showUser($userId) {
        $userModel = new User();
        $user = $userModel->findUserById($userId); // Utilisation correcte de la méthode

        if ($user) {
            // Chargez la vue user.view.php avec les données de l'utilisateur
            require_once "views/user.view.php";
        } else {
            // Gérer le cas où l'utilisateur n'est pas trouvé
            echo '<script>alert("User not found.");</script>';
        }
    }


    public function showUserInfo()
    {
        if (isset($_SESSION['user'])) {
            $user = $_SESSION['user'];

            include 'views/layout/header.view.php';
            include 'views/profil.view.php'; // Create this view file to display user information
            include 'views/layout/footer.view.php';
        } else {
            // User is not logged in, redirect to login page or handle accordingly
            http_response_code(302);
            header('location:/'); // Redirect to the home page or login page
        }
    }
    public function findUsernameById(string $id): string
    {
        $stmt = $this->db->query(
            "SELECT nickname FROM Users WHERE id = :id",
            ['id' => $id]
        );
        $user = $stmt->fetch(PDO::FETCH_ASSOC);
        return $user['nickname'] ?? 'Unknown User';
    }
    public function editProfile()
    {
        if (isset($_SESSION['user'])) {
            $user = $_SESSION['user'];

            include 'views/layout/header.view.php';
            include 'views/editProfile.view.php'; // Create this view file to display the edit profile form
            include 'views/layout/footer.view.php';
        } else {
            // User is not logged in, redirect to login page or handle accordingly
            http_response_code(302);
            header('location: /'); // Redirect to the home page or login page
        }
    }


    public function updateProfile(string $firstnameInput, string $lastnameInput, string $nicknameInput, string $emailInput, string $passwordInput)
    {
        if (empty($firstnameInput) ||empty($lastnameInput) || empty($nicknameInput) || empty($emailInput) || empty($passwordInput)) {
            throw new Exception('Formulaire non complet');
        }

        $firstname = htmlspecialchars($firstnameInput);
        $lastname = htmlspecialchars($lastnameInput);
        $nickname = htmlspecialchars($nicknameInput);
        $email = filter_var($emailInput, FILTER_SANITIZE_EMAIL);
        $passwordHash = password_hash($passwordInput, PASSWORD_DEFAULT);

        // Retrieve user information from session
        $user = $_SESSION['user'];


        // Update user profile information in the database
        $this->db->query(
            "UPDATE Users SET firstname = ?, lastname = ?, nickname = ?, email = ?, password = ? WHERE id = ?",
            [$firstname, $lastname, $nickname, $email, $passwordHash, $user['id']]
        );


        // Update session data with new profile information
        $_SESSION['user']['firstname'] = $firstnameInput;
        $_SESSION['user']['lastname'] = $lastnameInput;
        $_SESSION['user']['nickname'] = $nicknameInput;
        $_SESSION['user']['email'] = $emailInput;

        http_response_code(302);
        header('location: /?profile_updated=true');
    }

}