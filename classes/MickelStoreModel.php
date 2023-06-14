<?php

require_once "DB.php";

class MickelStoreModel extends DB
{
    protected string $tableSellers = "sellers";
    protected string $tableClothes = "clothes";

    public function getAllSellers(): array
    {
        // Hämta alla säljare från tabellen "sellers" och sortera efter förnamn
        $sql = "SELECT * FROM {$this->tableSellers} ORDER BY first_name ASC";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getAllClothes(): array
    {
        // Anropa funktionen "getAll" för att hämta alla kläder från tabellen "clothes"
        return $this->getAll($this->tableClothes);
    }

    public function getSellerById(int $id): array
    {
        // Hämta en säljare baserat på IDet från tabellen "sellers"
        $sql = "SELECT * FROM {$this->tableSellers} WHERE id = :id";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindParam(":id", $id);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function getClothesBySellerId(int $sellerId): array
    {
        // Hämta kläder baserat på säljar-ID från tabellen "clothes"
        $sql = "SELECT * FROM {$this->tableClothes} WHERE seller_id = :seller_id";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindParam(":seller_id", $sellerId);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function addSeller(string $firstName, string $lastName): void
    {
        // Lägg till en säljare i tabellen "sellers"
        $sql = "INSERT INTO {$this->tableSellers} (first_name, last_name) VALUES (:first_name, :last_name)";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindParam(":first_name", $firstName);
        $stmt->bindParam(":last_name", $lastName);
        $stmt->execute();
    }

    public function addClothes(string $clothing, float $price, int $sellerId): void
    {
        // Lägg till kläder i tabellen "clothes"
        $sql = "INSERT INTO {$this->tableClothes} (clothing, price, seller_id) VALUES (:clothing, :price, :seller_id)";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindParam(":clothing", $clothing);
        $stmt->bindParam(":price", $price);
        $stmt->bindParam(":seller_id", $sellerId);
        $stmt->execute();
    }

    public function buyClothes(int $clothingId): void
    {
        // Markera kläder som sålda baserat på klädes-ID i tabellen "clothes"
        $sql = "UPDATE {$this->tableClothes} SET sold = true WHERE id = :id";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindParam(":id", $clothingId);
        $stmt->execute();
    }


    public function getNumberOfSoldClothesBySellerId(int $sellerId): int
    {
        // Hämta antalet sålda kläder baserat på säljar-ID från tabellen "clothes"
        $sql = "SELECT COUNT(*) FROM {$this->tableClothes} WHERE seller_id = :seller_id AND sold = true";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindParam(":seller_id", $sellerId);
        $stmt->execute();
        return $stmt->fetchColumn();
    }

    public function getTotalSalesBySellerId(int $sellerId): float
    {
        // Hämta den totala försäljningen baserat på säljar-ID från tabellen "clothes"
        $sql = "SELECT SUM(price) FROM {$this->tableClothes} WHERE seller_id = :seller_id AND sold = true";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindParam(":seller_id", $sellerId);
        $stmt->execute();
        return $stmt->fetchColumn();
    }
}
