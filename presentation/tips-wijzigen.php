<!DOCTYPE HTML>
<html lang="nl">
<head>
    <meta charset=utf-8>
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no, shrink-to-fit=no" name="viewport">
    <title>Vinder | Tips wijzigen</title>
    <link rel="stylesheet" href="modules/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="modules/ionicons/css/ionicons.min.css">
    <link rel="stylesheet" href="modules/fontawesome/web-fonts-with-css/css/fontawesome-all.min.css">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/skins/vinder.css">
    <link rel="stylesheet" href="css/custom.css">
    <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
    <script src="https://cdn.ckeditor.com/4.10.1/standard/ckeditor.js"></script>
    <script>
        $(document).ready(function() {
            
            CKEDITOR.stylesSet.add('my_styles', [
                // Inline styles
                { name: 'Blauwe tekst', element: 'span', attributes: { 'class': 'text-primary' } },
                { name: 'Grijze tekst', element: 'span', attributes: { 'class': 'text-muted' } }
            ] );

            
            CKEDITOR.replace(
                'mail',
                {
                    startupFocus : true,
                    htmlEncodeOutput:true,
                    entities: true,
                    contentsCss: [ 'modules/bootstrap/css/bootstrap.min.css', 'css/style.css', "css/skins/vinder.css", "css/custom.css"],
                    format_tags: 'p;h6;address;div',
                    format_h6: { element: 'h6' },
                    stylesSet: 'my_styles'
                });
            

        })
    </script>
    <?php include('includes/nativeAppMeta.php'); ?>
</head>
<body>
<div id="app">
    <div class="main-wrapper">
        <?php include('includes/mainHeader.php'); ?>
        <div class="main-sidebar">
            <?php include('includes/mainSideBar.php'); ?>
        </div>
        <div class="main-content">
            <section class="section">
                <h1 class="section-header">
                    <div><a href="dashboard.php"><img src="images/logo.png" alt="Vinder" class="logo-small"></a></div>
                </h1>
                <div class="section-body">
                    <div class="row">
                        <div class="col-12 col-md-12">
                            <div class="card">
                                <div class="card-header">
                                    <h4>Tips wijzigen</h4>
                                </div>
                                <div class="card-body">
                                    <section id="updateMail">
                                        <form name="frmUpdateMail" method="POST" action="tips-wijzigen.php">

                                            <?php if ($message !== '') : ?>
                                                <div class="alert alert-success"><?= $message; ?></div>
                                            <?php endif; ?>
                                                
                                            <div class="form-group">
                                                <label for="mail">Mail <i class="ion ion-android-star"></i></label>
                                                <textarea id="mail" name="mail" style="height:200px;"><?= $mail; ?></textarea>
                                                <?php if (array_key_exists('mail', $errors)) : ?>
                                                    <div class="error"><?= $errors['mail']; ?></div>
                                                <?php endif; ?>
                                            </div>

                                            <div class="form-group">
                                                <input class="btn btn-sm btn-primary mt-2 mb-3" type="submit" value="Wijzig" />
                                            </div>
                                                
                                            <p class="text-muted italic"><small>Velden met een <i class="ion ion-android-star"></i> zijn verplicht in te vullen.</small></p>

                                        </form>
                                    </section>
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

<script src="modules/jquery.min.js"></script>
<script src="modules/popper.js"></script>
<script src="modules/tooltip.js"></script>
<script src="modules/bootstrap/js/bootstrap.min.js"></script>
<script src="modules/nicescroll/jquery.nicescroll.min.js"></script>
<script src="modules/scroll-up-bar/dist/scroll-up-bar.min.js"></script>
<script src="js/sa-functions.js"></script>

<script src="js/scripts.js"></script>
<script src="js/custom.js"></script>

</html>