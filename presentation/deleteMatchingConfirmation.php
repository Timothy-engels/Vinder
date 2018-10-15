<!DOCTYPE HTML>
<html>
<head>
    <meta charset=utf-8>
    <title>Vinder | Matchings verwijderen</title>
    <link rel="stylesheet" href="modules/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="modules/ionicons/css/ionicons.min.css">
    <link rel="stylesheet" href="modules/fontawesome/web-fonts-with-css/css/fontawesome-all.min.css">
    <link rel="stylesheet" href="css/style.css">    
    <link rel="stylesheet" href="css/skins/vinder.css">
    <link rel="stylesheet" href="css/custom.css">
    <?php include('includes/nativeAppMeta.php'); ?>
</head>
<body>
    <div id="app">
        <section class="section">
            <div class="container mt-5">
                <div class="row">
                    <div class="col-12 col-md-12">
                        <div class="login-brand">
                            <a href="logIn.php"><img src="images/logo.png" alt="Vinder" style="width: 15rem;"></a>
                        </div> 
                        <div class="card card-primary">
                            <div class="card-header">
                                <h4>Matchings verwijderen</h4>
                            </div>
                            <div class="card-body">
                                <p class="text-muted">
                                    <?= $result; ?> 
                                </p>
                            </div>
                        </div>
                        <?php include('includes/mainFooter.php'); ?>
                    </div>
                </div>
            </div>
        </section>
    </div>
</body>
</html>

