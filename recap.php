<?php
    session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="main.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <title>Récapitulatif des produits</title>
</head>
<body>

    <header>
        <div><a href="http://localhost/Nicolas_Zwickel/Premi%C3%A8re%20appli%20PHP%20am%C3%A9lior%C3%A9e/index.php">Index</a></div>
        <div><a href="http://localhost/Nicolas_Zwickel/Premi%C3%A8re%20appli%20PHP%20am%C3%A9lior%C3%A9e/recap.php">Recap</a></div>
    </header>
    <?php
        if(!isset($_SESSION["products"]) || empty($_SESSION["products"])){
            echo "<p>Aucun produit en session ...</p>";
        }
        else{
            echo "<table>",
                    "<thead>",
                        "<tr>",
                            "<th>Nom</th>",
                            "<th>Prix</th>",
                            "<th>Quantité</th>",
                            "<th>Total</th>",
                        "</tr>",
                    "</thead>",
                    "<tbody>";
            $totalGeneral = 0;

            foreach ($_SESSION["products"] as $index => $product){
                echo '<form action="traitement.php" method="POST">',
                        "<tr>",
                            "<td>",
                                $product["name"],
                                '<input type="hidden" name="index" value="' . $index . '" />',
                            "</td>",
                            "<td>". number_format($product["price"], 2, ",", "&nbsp;"). "&nbsp;€</td>",
                            "<td>",
                                '<input type="submit" name="subtractQuantity" value="-" />',
                                // "<i class='fa-solid fa-circle-minus fa-xs' style='color: #ff8000;'></i>",
                                $product["qtt"],
                                // "<i class='fa-solid fa-circle-plus fa-xs' style='color: #ff8000;'></i>",
                                '<input type="submit" name="addQuantity" value="+" />',
                        "</td>",
                            
                            "<td>". number_format($product["total"], 2, ",", "&nbsp;"). "&nbsp;€</td>",
                            "<td>",'<input type="submit" name="deleteProduct" value="Supprimer" />',"</td>",
                            
                        "</tr>",
                    "</form>";
                $totalGeneral += $product["total"];
            }
            echo  "</tr>",
                    "<td coldspan=4>Total général : </td>",
                    "<td><strong>". number_format($totalGeneral, 2, ",", "&nbsp;"). "&nbsp;€</strong></td>",
                "</tr>",
                "</tbody>",
                "</table>";
            
            echo '<form action="traitement.php" method="POST">
                <input type="submit" name="deleteAll" value="Tout supprimer" />
            </form>';

        }



    ?>
</body>
</html>