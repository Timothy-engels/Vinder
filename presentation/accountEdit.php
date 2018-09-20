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
    <form action="editProfile.php" method="post">
        <?php include('menu.php'); ?>
        
        <div class="container" >
            
            <h1> Profiel wijzigen </h1>
<<<<<<< HEAD
            <form action="editProfile.php" method="post">
                <img src="images/<?php echo $account->getLogo(); ?>" alt="Logo" style="max-width: 150px">
                <input type="file">

                <p>naam: </p> 
                <input type="text" name="naam" value = "<?php echo $account->getName(); ?>"/>

                <p>meer info: </p>
                <input type="text" name="Info" value = "<?php echo $account->getInfo(); ?>">

                <p>Website: </p>
                <input type="url" name="website" value = "<?php echo $account->getWebsite(); ?>">

<<<<<<< HEAD
                <div class="container">
                    <h3>Mijn expertise:</h3>
                    <div class="row">
                        <?php foreach ($allExps as $expertise) : ?>
                            <div class="custom-control custom-checkbox container">
                                <?php
                                $status = '';
                                $info = '';
                                foreach($exps as $exp) {
                                    if ($exp===$expertise) {
                                        $status = "checked";
                                        $info = $exp->getInfo();
                                    }
                                };
                                ?>
                                <input type="checkbox" class="row expertise custom-control-input" id="expertise<?php echo $expertise->getId(); ?>" <?php echo $status; ?> >
                                <label class="row custom-control-label" for="expertise<?php echo $expertise->getId(); ?>"><?php echo $expertise->getExpertise();?></label>
                                <?php if ($status === "checked"){?>
                                    <label id="inputlabelexpertise<?php echo $expertise->getId(); ?>" class="row">More info: </label>
                                    <input id="inputexpertise<?php echo $expertise->getId(); ?>" name="inputexpertise<?php echo $expertise->getId(); ?>" type="text" class="row" value = "<?php echo $info; ?>">
                                <?php } ?>
                            </div>
                        <?php endforeach; ?>
                        <div class="container">
                        Extra expertise:
                        <label id="extraexpertise" class="row">Expertise: </label>
                        <input id="extraexpertise" name="extraexpertise" type="text" class="row" value = "<?php if($extraExp){ echo $extraExp->getExpertise();}?>">
                        <label id="extraexpertiseinfo" class="row">More info: </label>
                        <input id="extraexpertiseinfo" name="extraexpertiseinfo" type="text" class="row" value = "<?php if($extraExp){ echo $extraExp->getInfo();}?>">
                        </div>
=======
            <div class="container">
                <h3>Mijn expertise:</h3>
                <div class="row">
                    <?php foreach ($allExps as $expertise) : ?>
                        <div class="custom-control custom-checkbox container">
                            <?php
                            $status = '';
                            $info = '';
                            foreach($exps as $exp) {
                                if ($exp===$expertise) {
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
>>>>>>> a632d7dd12ff0f4151fc34a9b080f190b61d6cbe
                    </div>

<<<<<<< HEAD
                    <h3>Waarover wil ik informatie?:</h3>
                    <div class="row">
                        <?php foreach ($allExps as $expertise) : ?>
                            <div class="custom-control custom-checkbox container">
                                <?php
                                $status = '';
                                $info = '';
                                foreach($expExps as $exp) {
                                    if ($exp === $expertise){
                                        $status = "checked";
                                        $info = $exp->getInfo();
                                    }
                                }
                                ?>
                                <input type="checkbox" class="row expectedExpertise custom-control-input" id="expected<?php echo $expertise->getId(); ?>" <?= $status; ?>>
                                <label class="row custom-control-label" for="expected<?= $expertise->getId(); ?>"><?php echo $expertise->getExpertise(); ?></label>
                                <?php if ($status === "checked"){?>
                                    <label id="inputlabelexpected<?php echo $expertise->getId(); ?>" class="row">More info: </label>
                                    <input id="inputexpected<?php echo $expertise->getId(); ?>" name="inputexpected<?php echo $expertise->getId(); ?>" type="text" class="row" value = "<?php echo $info; ?>">
                                <?php } ?>
                            </div>
                        <?php endforeach; ?>
                    </div>
                </div>
                <input type="submit" class="btn" name="submit" value="aanpassen">   
            </form>
=======
                <h3>Waarover wil ik informatie?:</h3>
                <div class="row">
                    <?php foreach ($allExps as $expertise) : ?>
                        <div class="custom-control custom-checkbox container">
                            <?php
                            $status = '';
                            $info = '';
                            print_r($expExps);
                            foreach($expExps as $exp2) {
                                if ($exp2 === $expertise){
                                    $status2 = "checked";
                                    $info2 = $exp2->getInfo();
                                }
                            }
                            ?>
                            <input type="checkbox" class="row expectedExpertise custom-control-input" id="expected<?php echo $expertise->getId(); ?>" name="expected<?php echo $expertise->getId(); ?>" <?= $status2; ?>>
                            <label class="row custom-control-label" for="expected<?= $expertise->getId(); ?>"><?php echo $expertise->getExpertise(); ?></label>
                            <?php if ($status === "checked"){?>
                                <label id="inputlabelexpected<?php echo $expertise->getId(); ?>" class="row">More info: </label>
                                <input id="inputexpected<?php echo $expertise->getId(); ?>" name="inputexpected<?php echo $expertise->getId(); ?>" type="text" class="row" value = "<?php echo $info2; ?>">
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

            <input type="submit" class="btn" name="submit" value="aanpassen">
        </div>
    </form>
>>>>>>> a632d7dd12ff0f4151fc34a9b080f190b61d6cbe
        <script src="javascript/javascript.js"></script>
    </body>
</html>