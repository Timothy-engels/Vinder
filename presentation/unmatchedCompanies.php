<!DOCTYPE HTML>
<html>
    <head>
        <meta charset="utf-8">
        <title>Vinder | Bedrijven zonder matches</title>
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
        <h1>Bedrijven zonder matches</h1>
        
        <?php if (!empty($unmatchedCompanies)) : ?>
        
            <div id="companyInfoFlexBoxContainer">
                <?php foreach ($unmatchedCompanies as $company) : ?>
                    <div class="companyInfoFlexBox">
                        <?php if ($company->getLogo() !== null && $company->getLogo() !== '') : ?>
                            <img src="images/<?= $company->getLogo(); ?>" class="logoImg"><br/>
                        <?php endif; ?>
                        <?= $company->getName(); ?><br/>
                    </div>
                <?php endforeach; ?>
            </div>
        <form action="unmatchedCompanies.php" method="post" name="matchMet">
            <input type="submit" value="hallo" name="VDAB"/>
        </form>
        <?php else: ?>
        
            <p>Alle bedrijven zijn gematched.</p>
            
        <?php endif; ?>
        
    </main>
</body>