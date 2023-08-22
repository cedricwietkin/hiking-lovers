<?php
declare(strict_types=1);

namespace Models;

use PDO;


class Tags extends Database
{
    public function findAll(int $limit = 0): array
    {
        $sql = "SELECT * FROM Tags LIMIT 20";

        $stmt = $this->query($sql);
        $tag = $stmt->fetchAll(PDO::FETCH_ASSOC);

        return $tag;
    }

    public function find(string $id): array|false
    {
        $stmt = $this->query(
            "SELECT * FROM Tags WHERE id = ?",
            [$id]
        );
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
    public function findByName(string $name): array|false
    {
        $stmt = $this->query(
            "SELECT * FROM Tags WHERE name = ?",
            [$name]
        );
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
}

