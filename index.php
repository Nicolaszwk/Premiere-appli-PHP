<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="main.css">
    <title>Ajout produit</title>
</head>
<body>
    <header>
        <div><a href="http://localhost/Nicolas_Zwickel/Premi%C3%A8re%20appli%20PHP%20am%C3%A9lior%C3%A9e/index.php">Index</a></div>
        <div><a href="http://localhost/Nicolas_Zwickel/Premi%C3%A8re%20appli%20PHP%20am%C3%A9lior%C3%A9e/recap.php">Recap</a></div>
    </header>
    
    <h1>Ajouter un produit</h1>
    <!-- <form action="traitement.php?action=add" method="post"> -->
    <form action="traitement.php" method="post">
        <p>
            <label>
                Nom du produit:
                <input type="text" name="name">
            </label>
        </p>
        <p>

            <label>
                Prix du produit:
                <input type="number" step="any" name="price">
            </label>
        </p>
        <p>
            <label>
                Quantité désirée:
                <input type="number" name="qtt" value="1">
            </label>
        </p>
        <p>
            <input type="submit" name="submit" value="Ajouter le produit">
        </p>

        <input type="hidden" name="action" value="add" />
    </form>
        
</body>
</html>