<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <title>Vinder | Wijzig de datum instellingen</title>
    
    <!-- 

    <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
    <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>

    -->
    
    <style>
        label, input, .error {
            display: block;
        }
        
        .error{
            color      : red;
            font-weight: bold;
        }
        
        .message{
            color      : green;
            font-weight: bold;
        }
    </style>
    <script>
        
        // werkt niet wegens eerdere comment
        $(document).ready(function() {
            $("#registerDate").datepicker({
                dateFormat: "dd-mm-yy"
            });
            
            $("#swipeDate").datepicker({
                dateFormat: "dd-mm-yy"
            });
         
            $("#registerDate").datepicker("setDate", "<?= $registerDate; ?>");
            $("#swipeDate").datepicker("setDate", "<?= $swipeDate; ?>");
         
            $("#registerDate").click(function() {
                $("#registerDate").focus();
            });
            
         });
    </script>
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
                    <div class="col-12 col-sm-10 offset-sm-1 col-md-8 offset-md-2 col-lg-8 offset-lg-2 col-xl-8 offset-xl-2">
                        <div class="login-brand">
                            <a href="logIn.php"><img src="images/logo.png" alt="Vinder" style="width: 15rem;"></a>
                        </div>
                        <div class="card card-primary">
                            <div class="card-header">
                                <h4>Datums instellen</h4>
                            </div>
                            <div class="card-body">
                            
                                <?php if (isset($registerMsg) && $registerMsg !== '') :  $registerMsg; else : ?>
                                
                                    <form name="frmRegisterDate" method="POST" action="updateDateSettings.php">
                                        
                                        <?php if ($message !== '') : ?>
                                            <div class="message"><?= $message; ?></div>
                                        <?php endif; ?>
                                        
                                        <div class="form-group">
                                            <label for="registerDate">Einddatum registratie/ Startdatum swipen *</label>
                                            <input type="text" id="registerDate" name="registerDate" maxlength="10" autofocus/>
                                            <?php if (array_key_exists('registerDate', $errors)) : ?>
                                            <div class="error"><?= $errors['registerDate']; ?></div>
                                            <?php endif; ?>
                                        </div>
                                        <div class="form-group">
                                            <label for="swipeDate">Einddatum swipen *</label>
                                            <input type="text" id="swipeDate" name="swipeDate" maxlength="10" />
                                            <?php if (array_key_exists('swipeDate', $errors)) : ?>
                                                <div class="error"><?= $errors['swipeDate']; ?></div>
                                            <?php endif; ?>
                                        </div>
                                        <div class="form-group">
                                            <button type="submit" class="btn btn-primary btn-block">Wijzig</button>
                                        </div>
                                    </form>
                                    <p>
                                        <small>Velden met een * zijn verplicht in te vullen.</small>
                                    </p>
                                
                                <?php endif; ?>
                                
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

