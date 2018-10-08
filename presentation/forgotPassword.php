<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no, shrink-to-fit=no" name="viewport">
    <title>Wachtwoord vergeten</title>
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
              <div class="card-header"><h4>Wachtwoord vergeten</h4></div>

              <div class="card-body">
                <p class="text-muted">
                    We sturen u een link via mail om uw wachtwoord te resetten. 
                </p>
                <form method="POST" action="forgotPassword.php">
                    <div class="form-group">
                        <label for="email">Email *</label>
                        <input type="email" id="mail" name="mail" class="form-control <?php if (array_key_exists('mail', $errors)) : ?>is-invalid <?php endif; ?>" maxlength="255" />
                        <?php if (array_key_exists('mail', $errors)) : ?>
                            <div class="invalid-feedback"><?= $errors['mail']; ?></div>
                        <?php endif; ?>
                    </div>
                    <?php if (array_key_exists('mail', $errors)) : ?>
                        <div class="invalid-feedback"><p><?= $errors['mail']; ?></p></div>
                    <?php endif; ?>

                    <div class="form-group">
                        <button type="submit" class="btn btn-sm btn-primary" tabindex="4">
                        Verzend
                        </button>
                    </div>
                </form>
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