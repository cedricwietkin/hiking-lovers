<?php
declare(strict_types=1);

namespace Models;

use Controllers\UserController;
use Models\Database;
use PDO;


class User extends Database
{


    public function findAll(int $limit = 0): array
    {
        if ($limit === 0) {
            $sql = "SELECT * FROM Users";
        } else {
            $sql = "SELECT * FROM Users LIMIT " . $limit;
        }
        $stmt = $this->query($sql);
        $users = $stmt->fetchAll(PDO::FETCH_ASSOC);

        return $users;
    }
    public function searchUsersByNameOrNickname($searchTerm)
    {
        $sql = "SELECT * FROM Users WHERE firstname LIKE :search OR nickname LIKE :search";
        $stmt = $this->query($sql, ['search' => '%' . $searchTerm . '%']);
        $searchedUsers = $stmt->fetchAll(PDO::FETCH_ASSOC);

        return $searchedUsers;
    }


}


