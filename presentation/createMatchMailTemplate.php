<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <title>Vinder | Match gevonden</title>
    <style>
        *, ::after, ::before {
            box-sizing: border-box;
        }

        body {
            display: block;
            background-color: #F6F6F6;
            font-size: 14px;
            margin: 0;
            font-weight: 400;
            line-height: 1.5;
            color: #212529;
            text-align: left;
            font-family: -apple-system,BlinkMacSystemFont,'Segoe UI',Roboto,'Helvetica Neue',Arial,sans-serif,'Apple Color Emoji','Segoe UI Emoji','Segoe UI Symbol';
        }

        .container {
            width: 90%;
            padding-right: 15px;
            padding-left: 15px;
            margin-right: auto;
            margin-left: auto;
        }

        .row {
            margin-right: -15px;
            margin-left: -15px;
        }

        .col-12 {
            max-width: 100%;
        }

        .login-brand {
            margin: 20px 0;
            margin-bottom: 40px;
            font-size: 24px;
            text-transform: uppercase;
            letter-spacing: 4px;
            color: #666;
            text-align: center;
        }

        .card {
            min-width: 0;
            word-wrap: break-word;
            background-clip: border-box;
            box-shadow: 0 0 40px rgba(0,0,0,.05);
            background-color: #fff;
            border-radius: 3px;
            border: 1px solid #ededed;
            position: relative;
            margin-bottom: 30px;
        }

        .card.card-primary {
            border-top: 2px solid #0466A3;
        }

        .card .card-header, .card .card-footer, .card .card-body {
            background-color: #fff;;
        }

        .card-header {
            padding: .75rem 1.25rem;
            margin-bottom: 0;
            background-color: #fff;
            border-radius: 3px 3px 0 0;
            border-bottom: 1px solid #f9f9f9;
            line-height: 30px;
            width: 100%;
        }

        .card-body {
            padding: 1.25rem;
        }

        .card .card-body {
            padding-top: 20px;
            padding-bottom: 20px;
        }

        p {
            margin-top: 0;
            margin-bottom: 1rem;
        }

        a {
            text-decoration: none;
            font-weight: bold;
            color: #0466A3;
        }

        .simple-footer {
            text-align: center;
            margin-top: 40px;
            margin-bottom: 40px;
            color: #666;
        }

        .card-header h4 {
            display: block;
            font-size: 10px;
            font-weight: 700;
            letter-spacing: 1px;
            text-transform: uppercase;
            margin: 2px 0 -2px 0;
            line-height: 30px;
        }
        
        .logoImg {
            max-height: 3.5rem;
            max-width: 3.5rem;
        }

        h1, h2, h3, h4, h5, h6 {
            margin-top: 0;
            margin-bottom: .5rem;
        }

        .h1, .h2, .h3, .h4, .h5, .h6, h1, h2, h3, h4, h5, h6 {
            font-family: inherit;
            font-weight: 500;
            line-height: 1.2;
            color: inherit;
        }

        .h1, h1 {
            font-size: 2.5rem;
        }

        .h2, h2 {
            font-size: 2rem;
        }

        .h3, h3 {
            font-size: 1.75rem;
        }

        .h4, h4 {
            font-size: 1.5rem;
        }

        .h5, h5 {
            font-size: 1.25rem;
        }

        .h6, h6 {
            font-size: 1rem;
        }

        .mt-3 {
            margin-top: 1rem!important;
        }
        
        .mt-4 {
            margin-top: 2rem!important;
        }

    </style> 
</head>
<body>
    <section class='section'>
        <div class='container mt-3'>
            <div class='row'>
                <div class='col-12'>
                    <div class='login-brand'><a href='<?= $currentPath; ?>"logIn.php'><img src='<?= $currentPath; ?>images/logo.png' alt='Vinder' style='width: 8rem;'></a></div>

                    <div class='card card-primary'>
                        <div class='card-header'><h4>Match gevonden</h4></div>

                        <div class='card-body'>

                            <p>Beste <?= $company1->getContactPerson(); ?>,</p>
                            <p>Je hebt een match met de volgende firma:</p>
                            
                            <div>
                                <?php if ($company2->getLogo() !== null && $company2->getLogo() !== '') : ?>
                                    <img style="vertical-align:middle" src="<?= $currentPath; ?>images/<?= $company2->getLogo(); ?>" class="logoImg">
                                <?php endif; ?>
                                <span class="h6"><?= $company2->getName(); ?></span>
                            </div>

                            <?php if ($company2->getInfo() !== null && $company2->getInfo() !== '') : ?>
                                <p><?= $company2->getInfo(); ?></p>
                            <?php endif; ?>

                            <h5 class="mt-4">Contactgegevens</h5>
                               Contactpersoon: <?= $company2->getContactPerson(); ?><br/>
                               E-mail: <a href="mailto::<?= $company2->getEmail(); ?>"><?= $company2->getEmail(); ?></a>
                               <?php if ($company2->getWebsite() !== null && $company2->getWebsite() !== '') : ?>
                               <br>Website: <a href="<?= $company2->getWebsite(); ?>" target="_blank"><?= $company2->getWebsite(); ?></a>
                               <?php endif; ?>
                            </p>

                            <?php if (!empty($company2->getAccountExpertises()) OR $company2->getAccountExpertiseExtra() !== null) : ?>
                                <h5 class="mt-4">De firma heeft de volgende expertises:</h5>

                                <ul>
                                    <?php if (!empty($company2->getAccountExpertises())) : ?>
                                        <?php foreach ($company2->getAccountExpertises() as $accountExpertise) : ?>
                                            <li>
                                                <strong><?= $accountExpertise->getExpertise()->getExpertise(); ?></strong>: <br/>
                                                <?= $accountExpertise->getInfo(); ?>
                                            </li>
                                        <?php endforeach; ?>
                                    <?php endif; ?>
                                    <?php if ($company2->getAccountExpertiseExtra() !== null) : ?>
                                        <?php $accountExpertiseExtra = $company2->getAccountExpertiseExtra(); ?>
                                        <li>
                                            <strong><?= $accountExpertiseExtra->getName(); ?></strong>: <br/>
                                            <?= $accountExpertiseExtra->getInfo(); ?>
                                        </li>                        
                                    <?php endif; ?>
                                </ul>
                            <?php endif; ?>

                            <?php if (!empty($company2->getAccountMoreInfo()) OR $company2->getAccountMoreInfoExtra() !== null) : ?>
                                <h5 class="mt-4">De firma wenst meer info te hebben over:</h5>

                                <ul>
                                    <?php if (!empty($company2->getAccountMoreInfo())) : ?>
                                        <?php foreach ($company2->getAccountMoreInfo() as $accountMoreInfo) : ?>
                                            <li>
                                                <strong><?= $accountMoreInfo->getExpertise()->getExpertise(); ?></strong>: <br/>
                                                <?= $accountMoreInfo->getInfo(); ?>
                                            </li>
                                        <?php endforeach; ?>
                                    <?php endif; ?>
                                    <?php if ($company2->getAccountMoreInfoExtra() !== null) : ?>
                                        <?php $accountMoreInfoExtra = $company2->getAccountMoreInfoExtra(); ?>
                                        <li>
                                            <strong><?= $accountMoreInfoExtra->getName(); ?></strong>: <br/>
                                            <?= $accountMoreInfoExtra->getInfo(); ?>
                                        </li>                        
                                    <?php endif; ?>                                  
                                </ul>
                            <?php endif; ?>

                            <?php if ($tips !== NULL && $tips !== '') : ?>
                                <h5 class="mt-4">Tips</h5>
                                <?= $tips; ?>
                            <?php endif; ?>
        
                        </div>
                    </div>

                    <div class='simple-footer'>
                        Copyright &copy; VDAB 2018
                    </div>
                </div>
            </div>
        </div>
    </section>
</body>
</html>