<!DOCTYPE HTML> <!-- presentation/commentlist.php -->
<html>
<head>
    <meta charset=utf-8>
    <title>Vinder | Matchings verwijderen?</title>
</head>
<body>

    <?php include('menu.php'); ?>
    
    <main>
        
        <form name="frmDeleteMatching" method="POST" action="deleteMatching.php">
            
            <h1>Matchings verwijderen?</h1>

            <p>Weet u zeker dat u de matchings wil verwijderen?</p>

            <p>Als de matchings zijn verwijderd, kunt u deze niet meer herstellen.</p>

            <input type="submit" name="submit" value="Verwijderen">
        
        </form>
        
    </main>

</body>
</html>