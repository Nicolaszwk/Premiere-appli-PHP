<?php
session_start();

var_dump($_POST);

// switch si il y a une action 
if (isset($_POST['action'])) {

    //Récupère toute les données transmise au serveur concernant l'index
    $index = $_POST['index'];

    switch ($_POST['action']) {
        case "add":
            if (isset($_POST["submit"])) {
                $name = filter_input(INPUT_POST, "name", FILTER_SANITIZE_STRING);
                $price = filter_input(INPUT_POST, "price", FILTER_VALIDATE_FLOAT, FILTER_FLAG_ALLOW_FRACTION);
                $qtt = filter_input(INPUT_POST, "qtt", FILTER_VALIDATE_INT);

                if ($name && $price && $qtt) {
                    $product = [
                        "name" => $name,
                        "price" => $price,
                        "qtt" => $qtt,
                        "total" => $price * $qtt
                    ];

                    $_SESSION["product"][] = $product;
                }
            }
            break;

        //Cas dans lequel on supprime tout les produits
        case "deleteAll":
            unset($_SESSION["product"]);
            break;

        //Cas dans lequel on supprime un produit spécifique
        case "deleteProduct":
            if (isset($_POST['index'])) {
                if (isset($_SESSION["product"][$index])) {
                    unset($_SESSION["product"][$index]);
                }
            }
            break;
        
        //Cas dans lequel on ajoute une quantité à un objet
        case "addQuantity":
            if (isset($_POST['index'])) {
                if (isset($_SESSION["product"][$index])) {
                    $_SESSION["product"][$index]["qtt"]++;
                    $_SESSION["product"][$index]["total"] = $_SESSION["product"][$index]["price"] * $_SESSION["product"][$index]["qtt"];
                }
            }
            break;

        //Cas dans lequel on soustrait une quantité à un objet
        case "subtractQuantity":
            if (isset($_POST['index'])) {
                if (isset($_SESSION["product"][$index]) && $_SESSION["product"][$index]["qtt"] > 1) {
                    $_SESSION["product"][$index]["qtt"]--;
                    $_SESSION["product"][$index]["total"] = $_SESSION["product"][$index]["price"] * $_SESSION["product"][$index]["qtt"];
                }
            }
            break;

        default:

            // Redirection vers la page spécifiée
            // header("Location: index.php");
            // exit();
    }
}

?>
