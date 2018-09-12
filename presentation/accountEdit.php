<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8" />
        <title>Profiel Pagina</title>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    </head>
    <body>
        
        <?php include('menu.php'); ?>
        
        <h1> Profiel wijzigen </h1>
        
        <div class="container">
            <input action="aanpassenProfiel.php" method="post" type="hidden">
                <img src="images/<? echo $account->getLogo(); ?>" alt="Logo" style="max-width: 150px">
            <span class="btn btn-file" > Browse <input type="file">
</span>
                
                <div class="row"><span class="col">naam :</span> <span class="col"><input type="text" name="naam" placeholder="" value = "<? echo $account->getName(); ?>"/></span></div>

            <div class="row"><span class="col">meer informatie :</span> <span class="col"><input type="text" name="Info" placeholder="" value = "<? echo $account->getInfo(); ?>"></span></div>

            <div class="row"><span class="col">website :</span> <span class="col"><input type="url" name="website" placeholder="" value = "<? echo $account->getWebsite(); ?>"></span></div>


            <div class="custom-control custom-checkbox">
                <?
                foreach ($allExps as $expertise){ ?>
                <input type="checkbox" class="custom-control-input" id="defaultUnchecked">
                <label class="custom-control-label" for="defaultUnchecked"><? $expertise->getExpertise(); ?></label>
                <? } ?>
            </div>

                <input type="submit" class="btn name="submit" value ="aanpassen">
            </form>
        </div>
    </body>
</html>