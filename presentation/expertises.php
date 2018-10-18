<!DOCTYPE HTML>
<html lang="nl">
<head>
    <meta charset=utf-8>
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no, shrink-to-fit=no" name="viewport">
    <title>Vinder | Expertises</title>
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
        <div class="main-wrapper">
            <?php include('includes/mainHeader.php'); ?>
            <div class="main-sidebar">
                <?php include('includes/mainSideBar.php'); ?>
            </div>
            <div class="main-content">
                <section class="section">
                    <h1 class="section-header">
                        <div><a href="dashboard.php"><img src="images/icon.png" alt="Vinder" style="width: 2rem;"></a>&nbsp;&nbsp;Expertises</div>
                    </h1>
                    <div class="section-body">
                        <div class="row">
                            <div class="col-12 col-md-12">
                                <div class="card">
                                    <div class="card-header">
                                        <h4>Expertises</h4>
                                    </div>
                                    <div class="card-body p-0">
                                        <div class="table-responsive">
                                            <table class="table table-striped">
                                                <thead>
                                                    <tr>
                                                        <th>Naam</th>
                                                        <th>Status</th>
                                                        <th>Opties</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php foreach($expertises as $expertise) : ?>
                                                        <tr>
                                                            <td>   
                                                                <?= $expertise->getExpertise(); ?>
                                                            </td>
                                                            <td>
                                                                <?= ($expertise->getActive() === "1" ? "<div class='badge badge-success'>Actief</div>" : "<div class='badge badge-danger'>Inactief</div>"); ?>
                                                            </td>
                                                            <td>
                                                                <a href='expertise-wijzigen.php?id=<?= $expertise->getId(); ?>'>Wijzigen</a>
                                                                | 
                                                                <a href='expertiseDelete.php?edid=<?= $expertise->getId(); ?>'>Verwijderen</a>
                                                            </td>
                                                        </tr>
                                                    <?php endforeach; ?>
                                                </tbody>
                                            </table>
                                        </div>
                                        <div class="card-body">
                                            <form action="expertises.php" method="POST" class="needs-validation" novalidate="">
                                                <div class="form-group">
                                                    <label for="newExpertise">Nieuwe expertise toevoegen:</label>
                                                    <input type="text" name="newExpertise" class="form-control <?php if ($validation !== '') : ?>is-invalid<?php endif; ?>" tabindex="1" value="<?= $newExpertise; ?>">
                                            
                                                    <?php if ($validation !== '') : ?>
                                                        <div class="invalid-feedback"><?= $validation; ?></div>
                                                    <?php endif; ?>
                                            
                                                </div>
                                                <div class="form-group">
                                                    <input type="submit" class="btn btn-sm btn-primary" tabindex="4"  value="Toevoegen">
                                                </div>
                                            </form>
                                        </div>
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