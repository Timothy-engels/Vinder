<!DOCTYPE HTML> <!-- presentation/commentlist.php -->
<html>
<head>
    <meta charset=utf-8>
    <title>Vinder | Matchings verwijderen?</title>
    <link rel="stylesheet" href="modules/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="modules/ionicons/css/ionicons.min.css">
    <link rel="stylesheet" href="modules/fontawesome/web-fonts-with-css/css/fontawesome-all.min.css">
    <link rel="stylesheet" href="css/style.css">    
    <link rel="stylesheet" href="css/skins/vinder.css">
</head>
<body>
    
    <?php include('menu.php'); ?>
    
    <div id="app">
        <section class="section">
            <div class="container mt-5">
                <div class="row">
                    <div class="col-12 col-sm-8 offset-sm-2 col-md-6 offset-md-3 col-lg-6 offset-lg-3 col-xl-4 offset-xl-4">
                        <div class="login-brand">
                            <a href="logIn.php"><img src="images/logo.png" alt="Vinder" style="width: 15rem;"></a>
                        </div>
                        <div class="card card-primary">
                            <div class="card-header">
                                <h4>Alle matchings verwijderen?</h4>
                            </div>
                            <div class="card-body">
                                <p class="text-muted">
                                    Weet u zeker dat u de matchings wil verwijderen?
                                </p>
                                <p class="text-muted">
                                    Als de matchings zijn verwijderd, kunt u deze niet meer herstellen!
                                </p>
                            </div>
                            <form name="frmDeleteMatching" method="POST" action="deleteMatching.php">
                                <div class="form-group">
                                    <button type="submit" name="delete" class="btn btn-primary btn-block">Verwijder</button>
                                </div>
                            </form>
                        </div>
                        <div class="simple-footer">
                            Copyright &copy; VDAB 2018
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
</body>
</html>