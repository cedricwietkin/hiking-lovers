<?php
declare(strict_types=1);

namespace Controllers;

error_reporting(E_ALL);

ini_set('display_errors', '1');


use Exception;
use Models\Database;
use Models\Hike;
use PDO;


class HikeController
{
    private Database $db;

    public function __construct()
    {
        $this->db = new Database();
    }
    public function showAll(): void
    {
        try {
            $hikes = (new Hike())->findAll();

            include 'views/layout/header.view.php';
            include 'views/hike_list.view.php';
            include 'views/layout/footer.view.php';

        } catch (Exception $e) {
            print_r($e->getMessage());
        }
    }
    public function show(string $id): void
    {
        try {
            $hike = (new Hike())->find($id);

            // 3 - Afficher la page
            include 'views/layout/header.view.php';
            include 'views/hike.view.php';
            include 'views/layout/footer.view.php';

        } catch (Exception $e) {
            print_r($e->getMessage());
        }
    }




    public function addHike(int $user_id,string $hikenameInput, string $distanceInput, string $durationInput, string $elevation_gainInput, string $descriptionInput, string $tagsInput)
    {
        if (empty($hikenameInput) ||empty($distanceInput) || empty($durationInput) || empty($elevation_gainInput) || empty($descriptionInput || empty($tagsInput))) {
            throw new Exception('Formulaire non complet');
        }

        $hikename = htmlspecialchars($hikenameInput);
        $distance = htmlspecialchars($distanceInput);
        $duration = htmlspecialchars($durationInput);
        $elevation_gain =htmlspecialchars($elevation_gainInput);
        $description =htmlspecialchars($descriptionInput);
        $tags =htmlspecialchars($tagsInput);

        $this->db->query(
            "
            INSERT INTO Hikes (user_id,name,distance,duration, elevation_gain, description) 
            VALUES (?, ?, ?, ?, ?,?)
        ",
            [$user_id,$hikename, $distance, $duration, $elevation_gain, $description]
        );

        $_SESSION['user'] = [
            'id' => $this->db->lastInsertId(),
            'firstname' => $firstname,
            'lastname' => $lastname,
            'nickname' => $nickname,
            'email' => $email
        ];

        http_response_code(302);
        header('location: /');
    }

    public function showAddHikeForm()
    {
        include 'views/layout/header.view.php';
        include 'views/addhike.view.php';
        include 'views/layout/footer.view.php';
    }

    // Method to retrieve user's hikes (replace this with your actual method)
    private function getHikesOfUser($userId) {
        // Implement logic to retrieve user's hikes from the database
        // For example:
        $query = "SELECT * FROM Hikes WHERE user_id = ?";

        $stmt = $this->db->query($query, [$userId]); // Use the user's ID as a parameter
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }



    public function editHike()
    {
        if (isset($_SESSION['user'])) {
            $user = $_SESSION['user'];

            $hikeId = $_GET['hike_id'];
            $hike = $this->fetchHike($hikeId);

            include 'views/layout/header.view.php';
            include 'views/edithike.view.php'; // Create this view file to display the edit profile form
            include 'views/layout/footer.view.php';
        } else {
            // User is not logged in, redirect to login page or handle accordingly
            http_response_code(302);
            header('location: /'); // Redirect to the home page or login page
        }
    }

    private function fetchHike($hikeId) {
        // Implement logic to retrieve hike information by $hikeId from the database
        // For example:
        $query = "SELECT * FROM Hikes WHERE id = ?";

        $stmt = $this->db->query($query, [$hikeId]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }


    public function updateHike(string $hikeId,string $nameInput, string $distanceInput, string $durationInput, string $elevation_gainInput, string $descriptionInput)
    {
        if (empty($nameInput) ||empty($distanceInput) || empty($durationInput) || empty($elevation_gainInput) || empty($descriptionInput)) {
            throw new Exception('Formulaire non complet');
        }

        $hikename = htmlspecialchars($nameInput);
        $distance = htmlspecialchars($distanceInput);
        $duration = htmlspecialchars($durationInput);
        $elevation_gain = htmlspecialchars($elevation_gainInput);
        $description = htmlspecialchars($descriptionInput);

        // Retrieve user information from session
        $user = $_SESSION['user'];
        $hikeId = (string) $hikeId;
        try{
            // Update user profile information in the database
            $this->db->query(
                "UPDATE Hikes SET name = ?, distance = ?, duration = ?, elevation_gain = ?, description = ? WHERE id = ?",
                [$hikename, $distance, $duration, $elevation_gain, $description, $hikeId]
            );
        }catch (PDOException $e) {
            // Log the error or display a message
            echo "Error updating hike: " . $e->getMessage();
        }


        // Update session data with new profile information
        $_SESSION['hike']['name'] = $nameInput;
        $_SESSION['hike']['distance'] = $distanceInput;
        $_SESSION['hike']['duration'] = $durationInput;
        $_SESSION['hike']['elevation_gain'] = $elevation_gainInput;
        $_SESSION['hike']['description'] = $descriptionInput;


        var_dump("Update query executed");         // Debugging output
        var_dump($_SESSION['hike']);

        http_response_code(302);
        header('location: /?hike_updated=true');
    }
}
