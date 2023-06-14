<?php

require_once "partials/header.php";
require_once "partials/nav.php";

require_once "classes/MickelStoreModel.php";
require_once "classes/MickelStoreView.php";

// Mickel ( databasanslutning )
$host = "localhost";
$db = "mickel_store";
$user = "root";
$password = "root";

$model = new MickelStoreModel($host, $db, $user, $password);
$view = new MickelStoreView();

$action = isset($_GET['action']) ? $_GET['action'] : '';

if ($action === "add_seller") {
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $firstName = $_POST['first_name'];
        $lastName = $_POST['last_name'];

        if (!empty($firstName) && !empty($lastName)) {
            $model->addSeller($firstName, $lastName);
            header("Location: index.php");
            exit;
        }
    }
    include "partials/add_seller_form.php";
} elseif ($action === "add_clothes") {
    $sellers = $model->getAllSellers();

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $clothing = $_POST['clothing'];
        $price = $_POST['price'];
        $sellerId = $_POST['seller_id'];

        if (!empty($clothing) && is_numeric($price) && is_numeric($sellerId)) {
            $model->addClothes($clothing, $price, $sellerId);
            header("Location: index.php");
            exit;
        }
    }
    include "partials/add_clothes_form.php";
} elseif ($action === "buy_clothes") {
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $clothingId = $_POST['clothing_id'];
        $model->buyClothes($clothingId);
        header("Location: index.php");
        exit;
    }
} elseif ($action === "seller") {
    if (isset($_GET['id'])) {
        $sellerId = $_GET['id'];
        $seller = $model->getSellerById($sellerId);
        $clothes = $model->getClothesBySellerId($sellerId);
        include "partials/seller.php";
    }
} else {
    $sellers = $model->getAllSellers();
    include "partials/all_sellers.php";
}

require_once "partials/footer.php";
?>
