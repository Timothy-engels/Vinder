<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <title>Vinder | Registreer</title>
    <style>
        label, input, .error {
            display: block;
        }

        .error {
            color: red;
        }
        
        .logoImg {
           max-height: 9rem;
           max-width: 9rem;
        }
    </style>
</head>
<body>
    <main>
        
        <h1>Vinder</h1>
        
        <p>Beste <?= $company1->getContactPerson(); ?></p>
        <p>Je hebt een match met de volgende firma:</p>

        <h2><?php if ($company2->getLogo() !== null && $company2->getLogo() !== '') : ?>
                <img src="<?= $currentPath; ?>images/<?= $company2->getLogo(); ?>" class="logoImg">
            <?php endif; ?>
            <?= $company2->getName(); ?></h2>

        <?php if ($company2->getInfo() !== null && $company2->getInfo() !== '') : ?>
            <p><?= $company2->getInfo(); ?></p>
        <?php endif; ?>
        
        <h3>Contactgegevens</h3>
        <p>Contactpersoon: <?= $company2->getContactPerson(); ?><br/>
           E-mail: <a href="mailto::<?= $company2->getEmail(); ?>"><?= $company2->getEmail(); ?></a>
           <?php if ($company2->getWebsite() !== null && $company2->getWebsite() !== '') : ?>
               <br>Website: <a href="<?= $company2->getWebsite(); ?>" target="_blank"><?= $company2->getWebsite(); ?></a>
           <?php endif; ?></p>
        </p>
        
        <?php if (!empty($company2->getAccountExpertises()) OR $company2->getAccountExpertiseExtra() !== null) : ?>
            <h3>De firma heeft de volgende expertises:</h3>

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
            <h3>De firma wenst meer info te hebben over</h3>

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
            <h3>Tips</h3>
            <?= $tips; ?>
        <?php endif; ?>
        
    </main>
</body>
</html>