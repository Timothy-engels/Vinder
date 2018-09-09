<!DOCTYPE html>
<html lang="nl">
    <head>
        <meta charset="UTF-8">
        <title>Vinder | Wijzig de mail instellingen</title>
        <style>
            label, input, .error, .message {
                display: block;
            }
            
            .error {
                color: red;
                font-weight: bold;
            }
            
            .message {
                color: green;
                font-weight: bold;
            }

            .ck-editor__editable {
                height: 400px;
            }

        </style>
        <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
        <script src="https://cdn.ckeditor.com/ckeditor5/11.0.1/classic/ckeditor.js"></script>
        <script>
            $(document).ready(function() {
                ClassicEditor
                    .create(document.querySelector('#mail'))
                    .then(editor => {
                        console.log( editor );
                    })
                    .catch(error => {
                        console.error(error);
                    });
            })
        </script>    
    </head>
    <body>
        <section id="updateMail">
            <h1>Wijzig de mail instellingen </h1>
            
            <form name="frmUpdateMail" method="POST" action="mailUpdate.php">
                
                <?php if ($message !== '') : ?>
                    <div class="message"><?= $message; ?></div>
                <?php endif; ?>
                    
                <p><small>Velden met een * zijn verplicht in te vullen.</small></p>
                    
                <label for="mail">Mail *</label>
                <textarea id="mail" name="mail" style="height:200px;"><?= $mail; ?></textarea>
                <?php if (array_key_exists('mail', $errors)) : ?>
                    <div class="error"><?= $errors['mail']; ?></div>
                <?php endif; ?>
                
                <input type="submit" value="Wijzigen" />
                
            </form>
        </section>
    </body>
</html>