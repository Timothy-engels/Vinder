<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8" />
        <title>Profiel Pagina</title>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
        <script>
            var expertises = [];
            <?php foreach ($allExps as $expertise) : ?>
                expertises.push("<?php echo $expertise->getId(); ?>");
            <?php endforeach; ?>
        </script>
    </head>
    <body>

        <?php include('menu.php'); ?>
        
        <div class="container" >
            
            <h1> Profiel wijzigen </h1>
            <input action="aanpassenProfiel.php" method="post" type="hidden">
            <img src="images/<?php echo $account->getLogo(); ?>" alt="Logo" style="max-width: 150px">
            <span class="btn btn-file" > Browse <input type="file"></span>
            <div class="container" >
                <div class="row">
                    <span class="col-4">naam :</span> 
                    <input class="col-8" type="text" name="naam" placeholder="" value = "<?php echo $account->getName(); ?>"/>
                </div>

                <div class="row">
                    <span class="col-4">meer informatie :</span>
                    <input class="col-8" type="text" name="Info" placeholder="" value = "<?php echo $account->getInfo(); ?>">
                </div>

                <div class="row">
                    <span class="col-4">website :</span>
                    <input class="col-8" type="url" name="website" placeholder="" value = "<?php echo $account->getWebsite(); ?>">
                </div>
            </div>


            <div class="container">
                <h3>Mijn expertise:</h3>
                <div class="row">
                    <?php foreach ($allExps as $expertise) : ?>
                        <div class="custom-control custom-checkbox container">
                            <?php
                            $status = '';
                            foreach($exps as $exp) {
                                if ($exp===$expertise) $status = "checked";
                            };
                            ?>
                            <input type="checkbox" class="row expertise custom-control-input" id="expertise<?php echo $expertise->getId(); ?>" <?= $status; ?> >
                            <label class="row custom-control-label" for="expertise<?php echo $expertise->getId(); ?>"><?php echo $expertise->getExpertise();?></label>
                        </div>
                    <?php endforeach; ?>
                </div>

                <h3>Waarover wil ik informatie?:</h3>
                <div class="row">
                    <?php foreach ($allExps as $expertise) : ?>
                        <div class="custom-control custom-checkbox container">
                            <?php
                            $status = '';
                            foreach($expExps as $exp) {
                                if ($exp === $expertise) $status = "checked";
                            }
                            ?>
                            <input type="checkbox" class="row expectedExpertise custom-control-input" id="expected<?php echo $expertise->getId(); ?>" <?= $status; ?>>
                            <label class="row custom-control-label" for="expected<?= $expertise->getId(); ?>"><?php echo $expertise->getExpertise(); ?></label>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>

            <input type="submit" class="btn" name="submit" value="aanpassen">
        </div>
        <script src="javascript/javascript.js"></script>
    </body>
</html>