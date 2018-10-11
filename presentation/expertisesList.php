<!DOCTYPE HTML> <!-- presentation/commentlist.php -->
<html>
<head>
    <meta charset=utf-8>
    <title>Vinder | Expertises</title>
    <link rel="stylesheet" href="modules/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="modules/ionicons/css/ionicons.min.css">
    <link rel="stylesheet" href="modules/fontawesome/web-fonts-with-css/css/fontawesome-all.min.css">
    <link rel="stylesheet" href="css/style.css">    
    <link rel="stylesheet" href="css/skins/vinder.css">
    <link rel="stylesheet" href="css/custom.css">
    <link href="https://fonts.googleapis.com/css?family=Lato" rel="stylesheet">
</head>
<body>
    <div id="app">
        <div class="main-wrapper">
            <?php //include('includes/mainHeader.php'); ?>
            <div class="main-sidebar">
                <?php //include('includes/mainSideBar.php'); ?>
            </div>
            <div class="main-content">
                <section class="section">
                    <div class="container mt-5">
                        <div class="row">
                            <div class="col-12 col-md-6 col-lg-6">
                                <div class="card">
                                    <div class="card-header">
                                        <h4>Expertises</h4>
                                    </div>
                                    <div class="card-body p-0">
                                        <div class="table-responsive">
                                            <table class="table table-striped">
                                                <tbody>
                                                    <tr>
                                                        <th>Expertise</th>
                                                        <th>Status</th>
                                                        <th>Opties</th>
                                                    </tr>
                                                    <?php foreach($expertises as $expertise) : ?>
                                                        <tr>
                                                            <td>   
                                                                <?= $expertise->getExpertise(); ?>
                                                            </td>
                                                            <td>
                                                        <?= ($expertise->getActive() === "1" ? "Actief" : "Inactief"); ?>
                                                            </td>
                                                            <td>
                                                                <a href='expertiseAdjust.php?eaid=<?= $expertise->getId(); ?>'>Wijzigen</a>
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
                                                    <input type="text" name="newExpertise" class="form-control <?php if (array_key_exists('newExpertise', $errors)) : ?>is-invalid<?php endif; ?>" tabindex="1" value="<?= $newExpertise; ?>">
                                            
                                                    <?php if (array_key_exists('newExpertise', $errors)) : ?>
                                                        <div class="invalid-feedback"><?= $errors['newExpertise']; ?></div>
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
        </div>
    </div>
</body>
</html>