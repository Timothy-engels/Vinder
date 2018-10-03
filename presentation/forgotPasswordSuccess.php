<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <title>Vinder | Wachtwoord vergeten</title>
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
                    <div class="col-12 col-sm-8 offset-sm-2 col-md-6 offset-md-3 col-lg-6 offset-lg-3 col-xl-4 offset-xl-4">
                        <div class="login-brand">
                            <a href="logIn.php"><img src="images/logo.png" alt="Vinder" style="width: 15rem;"></a>
                        </div>
                        <div class="card card-primary">
                            <div class="card-header">
                                <h4>Wachtwoord vergeten</h4>
                            </div>
                            <div class="card-body">
                                <p class="text-muted">            
                                    Er is een mail verstuurd naar je e-mailadres (<?= $mail; ?>) om je wachtwoord te resetten.
                                </p>
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