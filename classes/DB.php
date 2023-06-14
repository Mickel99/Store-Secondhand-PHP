<?php

class DB
{
    protected PDO $pdo;

    public function __construct(string $host, string $db, string $user, string $password)
    {
        $dsn = "mysql:host=$host;dbname=$db;charset=utf8mb4";
        $options = [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
            PDO::ATTR_EMULATE_PREPARES => false,
        ];
        try {
            $this->pdo = new PDO($dsn, $user, $password, $options);
        } catch (PDOException $e) {
            throw new PDOException($e->getMessage(), (int)$e->getCode());
        }
    }

    protected function getAll(string $table): array
    {
        // Hämta alla rader från en tabell
        $stmt = $this->pdo->query("SELECT * FROM $table");
        return $stmt->fetchAll();
    }
}
