<?php
declare(strict_types=1);

namespace Controllers;

use Exception;
use Models\Database;

class AuthController
{
    private Database $db;

    public function __construct()
    {
        $this->db = new Database();
    }

    public function isLoggedIn(): bool
    {
        return isset($_SESSION['user']); // Vérifie si la clé 'user' existe dans la session
    }

    public function register(string $firstnameInput, string $lastnameInput, string $nicknameInput, string $emailInput, string $passwordInput)
    {
        if (empty($firstnameInput) || empty($lastnameInput) || empty($nicknameInput) || empty($emailInput) || empty($passwordInput)) {
            throw new Exception('Formulaire non complet');
        }

        $firstname = htmlspecialchars($firstnameInput);
        $lastname = htmlspecialchars($lastnameInput);
        $nickname = htmlspecialchars($nicknameInput);
        $email = filter_var($emailInput, FILTER_SANITIZE_EMAIL);
        $passwordHash = password_hash($passwordInput, PASSWORD_DEFAULT);

        $this->db->query(
            "
                INSERT INTO Users (firstname,lastname,nickname, email, password) 
                VALUES (?, ?, ?, ?, ?)
            ",
            [$firstname, $lastname, $nickname, $email, $passwordHash]
        );

        $_SESSION['user'] = [
            'id' => $this->db->lastInsertId(),
            'firstname' => $firstname,
            'lastname' => $lastname,
            'nickname' => $nickname,
            'email' => $email
        ];

        http_response_code(302);
        header('location: /user');
    }

    public function showRegistrationForm()
    {
        include 'views/layout/header.view.php';
        include 'views/register.view.php';
        include 'views/layout/footer.view.php';
    }

    public function login(string $nicknameInput, string $passwordInput)
    {
        if (empty($nicknameInput) || empty($passwordInput)) {
            throw new Exception('Formulaire non complet');
        }
        // Vérifier si l'utilisateur est déjà connecté
        if ($this->isLoggedIn()) {
            header('Location:/profil');
            exit();
        }

        $nickname = htmlspecialchars($nicknameInput);

        $stmt = $this->db->query(
            "SELECT * FROM Users WHERE nickname = ?",
            [$nickname]
        );

        $user = $stmt->fetch();

        if (empty($user)) {
            throw new Exception('Mauvais nom d\'utilisateur');
        }

        if (password_verify($passwordInput, $user['password']) === false) {
            throw new Exception('Mauvais mot de passe');
        }

        // Enregistrement des informations de l'utilisateur dans la session
        $_SESSION['user'] = [
            'id' => $user['id'],
            'firstname' => $user['firstname'],
            'lastname' => $user['lastname'],
            'nickname' => $user['nickname'],
            'email' => $user['email'],
        ];

        // Redirection vers le profil de l'utilisateur
        http_response_code(302);
        header('location: /profil');
    }

    public function showLoginForm()
    {
        if ($this->isLoggedIn()) {
            header('Location: /profil');
            exit();
        }

        include 'views/layout/header.view.php';
        include 'views/index.view.php';
        include 'views/layout/footer.view.php';
    }

    public function logout()
    {
        unset($_SESSION['user']);
        http_response_code(302);
        header('location: /');
    }

    public function showUserInfo()
    {
        if (isset($_SESSION['user'])) {
            $user = $_SESSION['user'];

            include 'views/layout/header.view.php';
            include 'views/user.view.php';
            include 'views/layout/footer.view.php';
        } else {
            http_response_code(302);
            header('location: /');
        }
    }

    public function editProfile()
    {
        if (isset($_SESSION['user'])) {
            $user = $_SESSION['user'];

            include 'views/layout/header.view.php';
            include 'views/editProfile.view.php';
            include 'views/layout/footer.view.php';
        } else {
            http_response_code(302);
            header('location: /');
        }
    }

    public function updateProfile(string $firstnameInput, string $lastnameInput, string $nicknameInput, string $emailInput, string $passwordInput)
    {
        if (empty($firstnameInput) || empty($lastnameInput) || empty($nicknameInput) || empty($emailInput) || empty($passwordInput)) {
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



