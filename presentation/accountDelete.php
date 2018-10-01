<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <title>Profiel Pagina</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <link rel="stylesheet" href="style/photoupload.css">
    <script>
        $( document ).ready(function () {
            var $eButton = document.getElementById("button");
            $eButton.addEventListener("click", function (e) {
                var $pass = document.getElementById("pass");
                $pass.style.display = 'block';
            })
        })

    </script>
</head>
<body>

<?php include('menu.php'); ?>

<form action="deleteAccount.php" method="post" enctype="multipart/form-data">
    <div class="container" >
        <h1> Profiel verwijderen  </h1>
        <h3 style="color: red"><?php if($message)echo $message?></h3>
        <h2>Ben je zeker om account <?php echo $account->getEmail(); ?> te verwijderen?</h2>
        <button id="button" type="button" class="btn btn-dark">Ja</button>
        <div id="pass" class="container" style="display: none" >
            <div class="row">
                <span >Password :</span>
                <input  type="password" name="pass" placeholder="" value = "">
            </div>
            <input type="submit" class="btn" name="submit" value="Verwijder account">
        </div>
    </div>
</form>
</body>
</html>