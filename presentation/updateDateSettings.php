<!DOCTYPE html>
<html lang="nl">
    <head>
        <meta charset="UTF-8">
        <title>Vinder | Wijzig de datum instellingen</title>
        <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
        <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
        <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
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
            $(document).ready(function() {

                $("#registerDate").datepicker({
                    dateFormat: "dd-mm-yy"
                });
                
                $("#swipeDate").datepicker({
                    dateFormat: "dd-mm-yy"
                });
                
                $("#registerDate").datepicker("setDate", "<?= $registerDate; ?>");
                $("#swipeDate").datepicker("setDate", "<?= $swipeDate; ?>");
              
            });
        </script>
    </head>
    <body>
        <?php include('menu.php'); ?>
        
        <main>
            <section id="updateDateSettings">
                <h1>Wijzig de datum instellingen</h1>
                
                <form name="frmUpdateDateSettings" method="POST" action="updateDateSettings.php">
                    
                    <?php if ($message !== '') : ?>
                        <div class="message"><?= $message; ?></div>
                    <?php endif; ?>
                    
                    <p><small>Velden met een * zijn verplicht in te vullen</small></p>
                
                    <label for="registerDate">Startdatum registratie *</label>
                    <input type="text" id="registerDate" name="registerDate" maxlength="10" />
                    <?php if (array_key_exists('registerDate', $errors)) : ?>
                        <div class="error"><?= $errors['registerDate']; ?></div>
                    <?php endif; ?>

                    <label for="swipeDate">Startdatum swipen *</label>
                    <input type="text" id="swipeDate" name="swipeDate" maxlength="10" />
                    <?php if (array_key_exists('swipeDate', $errors)) : ?>
                        <div class="error"><?= $errors['swipeDate']; ?></div>
                    <?php endif; ?>

                    <input type="submit" value="Wijzigen" />
                
                </form>
                
            </section>
        </main>
    </body>
</html>

