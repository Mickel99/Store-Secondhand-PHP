<?php

class MickelStoreView
{
    public function renderAllSellers(array $sellers): void
    {
        // Rendera alla säljare i HTML-tabellformat
        echo "<div class='all-sellers-container'>";
        echo "<h2>Alla säljare</h2>";
        echo "<table class='table-container'>";
        echo "<tr><th>Förnamn</th><th>Efternamn</th><th>Åtgärd</th></tr>";
        foreach ($sellers as $seller) {
            $id = $seller['id'];
            $firstName = $seller['first_name'];
            $lastName = $seller['last_name'];
            echo "<tr><td>$firstName</td><td>$lastName</td><td><a href='index.php?action=seller&id=$id'>Visa</a></td></tr>";
        }
        echo "</table>";
        echo "</div>";
    }

    public function renderSeller(array $seller, array $clothes): void
    {
        // Rendera en säljare och dess kläder i HTML-format
        $sellerId = $seller['id'];
        $numberOfClothes = count($clothes);
        $numberOfSoldClothes = 0;
        $totalSales = 0;
        foreach ($clothes as $clothing) {
            if ($clothing['sold']) {
                $numberOfSoldClothes++;
                $totalSales += $clothing['price'];
            }
        }

        echo "<div class='seller-container'>";
        echo "<h2>{$seller['first_name']} {$seller['last_name']}</h2>";
        echo "<p>Antal kläder: $numberOfClothes</p>";
        echo "<p>Antal sålda kläder: $numberOfSoldClothes</p>";
        echo "<p>Total försäljning: $totalSales</p>";
        echo "<div class='clothes-container'>";
        echo "<h3>Kläder</h3>";
        echo "<table class='table-container'>";
        echo "<tr><th>Klädnamn</th><th>Pris</th><th>Status</th><th>Åtgärd</th></tr>";
        foreach ($clothes as $clothing) {
            $clothingId = $clothing['id'];
            $clothingName = $clothing['clothing'];
            $price = $clothing['price'];
            $status = $clothing['sold'] ? 'Såld' : 'Tillgänglig';
            echo "<tr><td>$clothingName</td><td>$price</td><td>$status</td>";
            if (!$clothing['sold']) {
                echo "<td><form action='index.php?action=buy_clothes' method='POST'>";
                echo "<input type='hidden' name='clothing_id' value='$clothingId'>";
                echo "<input type='submit' value='Köp'>";
                echo "</form></td>";
            } else {
                echo "<td></td>";
            }
            echo "</tr>";
        }
        echo "</table>";
        echo "</div>";
        echo "</div>";
    }

    public function renderAddSellerForm(): void
    {
        // Rendera formulär för att lägga till en säljare
        echo "<div class='add-seller-form-container'>";
        echo "<h2>Lägg till säljare</h2>";
        echo "<form action='index.php?action=add_seller' method='POST'>";
        echo "<label for='first_name'>Förnamn:</label>";
        echo "<input type='text' id='first_name' name='first_name' required>";
        echo "<label for='last_name'>Efternamn:</label>";
        echo "<input type='text' id='last_name' name='last_name' required>";
        echo "<input type='submit' value='Lägg till säljare'>";
        echo "</form>";
        echo "</div>";
    }

    public function renderAddClothesForm(array $sellers): void
    {
        // Rendera formulär för att lägga till kläder med val för säljare
        echo "<div class='add-clothes-form-container'>";
        echo "<h2>Lägg till kläder</h2>";
        echo "<form action='index.php?action=add_clothes' method='POST'>";
        echo "<label for='clothing'>Klädnamn:</label>";
        echo "<input type='text' id='clothing' name='clothing' required>";
        echo "<label for='price'>Pris:</label>";
        echo "<input type='text' id='price' name='price' required>";
        echo "<label for='seller_id'>Säljare:</label>";
        echo "<select id='seller_id' name='seller_id' required>";
        echo "<option value=''>Välj säljare</option>";
        foreach ($sellers as $seller) {
            $sellerId = $seller['id'];
            $firstName = $seller['first_name'];
            $lastName = $seller['last_name'];
            echo "<option value='$sellerId'>$firstName $lastName</option>";
        }
        echo "</select>";
        echo "<input type='submit' value='Lägg till kläder'>";
        echo "</form>";
        echo "</div>";
    }
}
