<?php
session_start();

//Cas dans lequel on ajoute un nouveau produit
if (isset($_POST['action']) && $_POST['action'] == "add") {
    $name = filter_input(INPUT_POST, "name", FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $price = filter_input(INPUT_POST, "price", FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION);
    $qtt = filter_input(INPUT_POST, "qtt", FILTER_SANITIZE_NUMBER_INT);
    if ($name && $price && $qtt) {
        $product = [
            "name" => $name,
            "price" => $price,
            "qtt" => $qtt,
            "total" => $price * $qtt
        ];
        $_SESSION["products"][] = $product;
    }

    // Redirection vers la page spécifiée
    header("Location: index.php");
}

//Cas dans lequel on supprime tout les produits
elseif (isset($_POST['deleteAll'])) {
    unset($_SESSION["products"]);

//Cas dans lequel on supprime un produit spécifique
} elseif (isset($_POST['deleteProduct']) && isset($_POST['index'])) {
    $index = $_POST['index'];
    if (isset($_SESSION["products"][$index])) {
        unset($_SESSION["products"][$index]);
    }
    
//Cas dans lequel on ajoute une quantité à un objet
} elseif (isset($_POST['addQuantity']) && isset($_POST['index'])) {
    $index = $_POST['index'];
    if (isset($_SESSION["products"][$index])) {
        $_SESSION["products"][$index]["qtt"]++;
        $_SESSION["products"][$index]["total"] = $_SESSION["products"][$index]["price"] * $_SESSION["products"][$index]["qtt"];
    }

//Cas dans lequel on soustrait une quantité à un objet
} elseif (isset($_POST['subtractQuantity']) && isset($_POST['index'])) {
    $index = $_POST['index'];
    if (isset($_SESSION["products"][$index]) && $_SESSION["products"][$index]["qtt"] > 1) {
        $_SESSION["products"][$index]["qtt"]--;
        $_SESSION["products"][$index]["total"] = $_SESSION["products"][$index]["price"] * $_SESSION["products"][$index]["qtt"];
    }

} else {

    // Redirection vers la page spécifiée
    header("Location: index.php");
    // exit();
}

// Redirection vers la page spécifiée
header("Location: recap.php");

?>
