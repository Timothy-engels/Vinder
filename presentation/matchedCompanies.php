<!DOCTYPE HTML>
<html>
    <head>
        <meta charset="utf-8">
        <title>Vinder | Lijst gematchte bedrijven</title>
        <style>
            #companyInfoFlexBoxContainer {
                display: flex;
                flex-direction: row;
                flex-wrap: row;
                justify-content: flex-start; 
            }
            
            .companyInfoFlexBox {
                width: 14rem;
                height: 12rem;
                text-align: center;
                border: 1px solid lightgray;
                padding: 1rem;
                margin: 1rem;
            }
            
            .logoImg {
                max-height: 9rem;
                max-width: 9rem;
            }
        </style>
    </head>
</html>

<body>
    <?php include ('menu.php'); ?>
    
    <main>
        <h1>Lijst gematchte bedrijven</h1>
        
        <?php if (!empty($matchedCompanies)) : ?>
            <div id="companyInfoFlexBoxContainer">
                <?php foreach ($matchedCompanies as $company) : ?>
                    <div class="companyInfoFlexBox">
                        <?php if ($company->getLogo() !== null && $company->getLogo() !== '') : ?>
                            <img src="images/<?= $company->getLogo(); ?>" class="logoImg"><br/>
                        <?php endif; ?>
                        <?= $company->getName(); ?><br/>
                        <a href="matchedCompaniesTo.php?companyId=<?= $company->getID(); ?>">
                            <?= $amountMatches[$company->getID()]; ?> match(es)
                        </a>
                    </div>
                <?php endforeach; ?>
            </div>
        <?php else: ?>
            <p>Er zijn nog geen bedrijven gematched.</p>
        <?php endif; ?>
        
    </main>
</body>