<!DOCTYPE HTML>
<html>
    <head>
        <meta charset="utf-8">
        <title>Vinder | Lijst gematchte bedrijven voor <?= $companyInfo->getName(); ?></title>
        <style>            
            .logoImg {
                max-height: 6rem;
                max-width: 6rem;
            }
        </style>
    </head>
    <body>

        <h1>
            <?php if ($companyInfo->getLogo() !== null && $companyInfo->getLogo() !== '') : ?>
                <img src="images/<?= $companyInfo->getLogo(); ?>" class="logoImg">
            <?php endif; ?>
            <?= $companyInfo->getName(); ?>
        <h1>
                        
        <?php if (!empty($matchedCompanies)) : ?>
        
            <h2>Gematchte bedrijven</h2>
            <ul>
                <?php foreach ($matchedCompanies as $matchedCompany) : ?>
                    <li><?= $matchedCompany->getName(); ?></li>
                <?php endforeach; ?>
            </ul>
            
        <?php else: ?>
            
            <p>Er zijn geen matches gevonden!</p>
            
        <?php endif; ?>
            
        <a href="matchedCompanies.php">Terug naar overzicht</a>
    </body>
</html>