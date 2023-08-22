<?php
declare(strict_types=1);

namespace Controllers;

use Exception;
use Models\Database;
use Models\Tags;
use PDO;

class TagsController
{
    private Database $db;

    public function __construct()
    {
        $this->db = new Database();
    }

    public function index()
    {
        try {
            $tagsModel = new Tags();
            $tags = $tagsModel->findAll(20);

            include 'views/layout/header.view.php';
            include 'views/tags.view.php'; // Cette vue affichera la liste des tags
            include 'views/layout/footer.view.php';
        } catch (Exception $e) {
            print_r($e->getMessage());
        }
    }

    public function show(string $name)
    {
        try {
            $tag = (new Tags())->findByName($name);

            if (!$tag) {
                (new PageController())->page_404();
                die;
            }

            // Afficher la page
            include 'views/layout/header.view.php';
            include 'views/tags.view.php';
            include 'views/layout/footer.view.php';

        } catch (Exception $e) {
            print_r($e->getMessage());
        }
    }

    public function addTags(string $tagnameInput)
    {
        if (empty($tagnameInput)) {
            throw new Exception('Nom du tag vide');
        }

        $tagname = htmlspecialchars($tagnameInput);

        $this->db->query(
            "INSERT INTO Tags (name) VALUES (?)",
            [$tagname]
        );

        http_response_code(302);
        header('location:/tags');
    }
}


