<?php
declare(strict_types=1);

namespace Models;

use PDO;

class Hike extends Database
{
    public function findAll(int $limit = 0): array
    {
        $sql = "SELECT * FROM Hikes LIMIT 20";
        $stmt = $this->query($sql);
        $hikes = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $hikes;
    }

    public function find(string $id): array|bool
    {
        $stmt = $this->query(
            "SELECT * FROM Hikes WHERE id = :id",
            [':id' => $id]
        );
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
}