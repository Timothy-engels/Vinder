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
    <div id="app">
        <div class="main-wrapper">
            <?php //include('includes/mainHeader.php'); ?>
            <div class="main-sidebar">
                <?php //include('includes/mainSideBar.php'); ?>
            </div>
            <div class="main-content">
                <section class="section">
                    <h1 class="section-header">
                        <div><a href="dashboard.php"><img src="images/icon.png" alt="Vinder" style="width: 2rem;"></a>&nbsp;&nbsp;Vinder</div>
                    </h1>

                    <div class="section-body">

                        <div class="row">
                            <div class="col-12 col-md-12">
                                <div class="card">
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
                                        <form name="frmDeleteMatching" method="POST" action="deleteMatching.php">
                                            <div class="form-group">
                                                <button type="submit" name="delete" class="btn btn-sm btn-primary">Verwijder</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
            </div>
            <?php include('includes/mainFooter.php'); ?>
        </div>
    </div>
</body>
</html>