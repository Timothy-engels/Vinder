<!DOCTYPE html>
<html lang="nl">
    <head>
        <meta charset="UTF-8">
        <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no, shrink-to-fit=no" name="viewport">
        <title>Vinder | Registratie bevestigen</title>
        <link rel="stylesheet" href="modules/bootstrap/css/bootstrap.min.css">
        <link rel="stylesheet" href="modules/ionicons/css/ionicons.min.css">
        <link rel="stylesheet" href="modules/fontawesome/web-fonts-with-css/css/fontawesome-all.min.css">
        <link rel="stylesheet" href="css/style.css">    
        <link rel="stylesheet" href="css/skins/vinder.css"> 
    </head>
    <body>
        <div id="app">
            <section class="section">
                <div class="container mt-5">
                    <div class="row">
                        <div class="col-12 col-sm-10 offset-sm-1 col-md-8 offset-md-2 col-lg-8 offset-lg-2 col-xl-8 offset-xl-2">
                            <div class="login-brand"><a href="logIn.php"><img src="images/logo.png" alt="Vinder" style="width: 15rem;"></a></div>

                            <div class="card card-primary">
                                <div class="card-header"><h4>Registratie bevestigen</h4></div>

                                <div class="card-body">
                                    <?= $result; ?>
                                </div>
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