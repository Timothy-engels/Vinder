<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no, shrink-to-fit=no" name="viewport">
  <title>Log in</title>
    
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
            <div class="login-brand"><a href="logIn.php"><img src="images/logo.png" alt="Vinder" style="width: 15rem;"></a></div>

            <div class="card card-primary">
              <div class="card-header"><h4>Login</h4></div>

              <div class="card-body">
                <form method="POST" action="logIn.php" method="POST" class="needs-validation" novalidate="">
                    
                    <?php
                    if (array_key_exists('general', $errors)) : ?>
                    <div class="error"><?= $errors['general']; ?></div>
                    <?php endif; ?>
                    
                  <div class="form-group">
                    <label for="email">Email</label>
                    <input id="mail" type="email" class="form-control" name="mail" tabindex="1" required autofocus>
                    <div class="invalid-feedback">
                      Please fill in your email
                    </div>
                  </div>
                    
                    <?php if (array_key_exists('mail', $errors)) : ?>
                    <div class="error"><?= $errors['mail']; ?></div>
                    <?php endif; ?>

                  <div class="form-group">
                    <label for="password" class="d-block">Password
                      <div class="float-right">
                        <a href="forgotPassword.php">
                          Forgot Password?
                        </a>
                      </div>
                    </label>
                    <input id="pass" type="password" class="form-control" name="pass" tabindex="2" required>
                    <div class="invalid-feedback">
                      please fill in your password
                    </div>
                  </div>
                    
                    <?php if (array_key_exists('pass', $errors)) : ?>
                    <div class="error"><?= $errors['pass']; ?></div>
                    <?php endif; ?>

                  <div class="form-group">
                    <button type="submit" class="btn btn-primary btn-block" tabindex="4">
                      Login
                    </button>
                  </div>
                </form>
              </div>
            </div>
            <div class="mt-5 text-muted text-center">
              Don't have an account? <a href="register.php">Create One</a>
            </div>
            <div class="simple-footer">
              Copyright &copy; Stisla 2018
            </div>
          </div>
        </div>
      </div>
    </section>
  </div>

  <script src="../dist/modules/jquery.min.js"></script>
  <script src="../dist/modules/popper.js"></script>
  <script src="../dist/modules/tooltip.js"></script>
  <script src="../dist/modules/bootstrap/js/bootstrap.min.js"></script>
  <script src="../dist/modules/nicescroll/jquery.nicescroll.min.js"></script>
  <script src="../dist/modules/moment.min.js"></script>
  <script src="../dist/modules/scroll-up-bar/dist/scroll-up-bar.min.js"></script>
  <script src="../dist/js/sa-functions.js"></script>
  
  <script src="../dist/js/scripts.js"></script>
  <script src="../dist/js/custom.js"></script>
  <script src="../dist/js/demo.js"></script>
</body>
</html>