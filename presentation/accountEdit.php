<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8" />
        <title>Profiel Pagina</title>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
        <link rel="stylesheet" href="style/photoupload.css">
        <script>
            var expertises = [];
            <?php
            foreach ($allExps as $expertise){ ?>
            expertises.push("<?php echo $expertise->getId(); ?>");
            <?php }?>
        </script>
    </head>

    <body>

        <?php include('menu.php'); ?>
        <form action="editProfile.php" method="post" enctype="multipart/form-data">
        <div class="container" >
            <h1> Profiel wijzigen </h1>

            <img src="images/<?php echo $account->getLogo(); ?>" alt="Logo" style="max-width: 150px">
            <div class="container">
                <div class="row" style="max-height: 160px">
                    <div class="col-sm-6 offset-sm-3">
                        <button type="button" class="btn btn-primary btn-block" onclick="document.getElementById('inputFile').click()">Add Image</button>
                        <div class="form-group inputDnD">
                            <label class="sr-only" for="inputFile">File Upload</label>
                            <input  type="file" name="fileToUpload" class="form-control-file text-primary font-weight-bold" id="inputFile" accept="image/*" onchange="readUrl(this)" data-title="Drag and drop a file">
                        </div>
                    </div>
                </div>
            </div>







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
                            $info = '';
                            foreach($exps as $exp) {
                                if ($exp->getId()===$expertise->getId()) {
                                    $status = "checked";
                                    $info = $exp->getInfo();
                                }
                            };
                            ?>
                            <input type="checkbox" class="row expertise custom-control-input" id="expertise<?php echo $expertise->getId(); ?>" name="expertise<?php echo $expertise->getId(); ?>" <?php echo $status; ?> >
                            <label class="row custom-control-label" for="expertise<?php echo $expertise->getId(); ?>"><?php echo $expertise->getExpertise();?></label>
                            <?php if ($status === "checked"){?>
                                <label id="inputlabelexpertise<?php echo $expertise->getId(); ?>" class="row">More info: </label>
                                <input id="inputexpertise<?php echo $expertise->getId(); ?>" name="inputexpertise<?php echo $expertise->getId(); ?>" type="text" class="row" value = "<?php echo $info; ?>">
                            <?php } ?>
                        </div>
                    <?php endforeach; ?>
                    <div class="container">
                        <label id="extraexpected" class="row">Extra expertise: </label>
                    <input id="extraexpertise" name="extraexpertise" type="text" class="row" value = "<?php if($extraExp){ echo $extraExp->getExpertise();}?>">
                    <label id="extraexpertiseinfo" class="row">More info: </label>
                    <input id="extraexpertiseinfo" name="extraexpertiseinfo" type="text" class="row" value = "<?php if($extraExp){ echo $extraExp->getInfo();}?>">
                    </div>
                </div>

                <h3>Waarover wil ik informatie?:</h3>
                <div class="row">
                    <?php foreach ($allExps as $expertise) : ?>
                        <div class="custom-control custom-checkbox container">
                            <?php
                            $status = '';
                            $info = '';
                            foreach($expExps as $exp2) {
                                if ($exp2->getId() === $expertise->getId()){
                                    $status = "checked";
                                    $info = $exp2->getInfo();
                                }
                            }
                            ?>
                            <input type="checkbox" class="row expectedExpertise custom-control-input" id="expected<?php echo $expertise->getId(); ?>" name="expected<?php echo $expertise->getId(); ?>" <?= $status; ?>>
                            <label class="row custom-control-label" for="expected<?= $expertise->getId(); ?>"><?php echo $expertise->getExpertise(); ?></label>
                            <?php if ($status=== "checked"){?>
                                <label id="inputlabelexpected<?php echo $expertise->getId(); ?>" class="row">More info: </label>
                                <input id="inputexpected<?php echo $expertise->getId(); ?>" name="inputexpected<?php echo $expertise->getId(); ?>" type="text" class="row" value = "<?php echo $info; ?>">
                            <?php } ?>
                        </div>
                    <?php endforeach; ?>
                    <div class="container">

                        <label id="extraexpected" class="row">Extra expertise: </label>
                        <input id="extraexpected" name="extraexpected" type="text" class="row" value = "<?php if($extraExpExp){ echo $extraExpExp->getExpertise();}?>">
                        <label id="extraexpectedinfo" class="row">More info: </label>
                        <input id="extraexpectedinfo" name="extraexpectedinfo" type="text" class="row" value = "<?php if($extraExpExp){ echo $extraExpExp->getInfo();}?>">
                    </div>
                </div>
            </div>

            <input type="submit" class="btn" name="submit" value="Save">
        </div>
    </form>
        <script src="javascript/photoupload.js"></script>
        <script src="javascript/javascript.js"></script>
    </body>
</html>