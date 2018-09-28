<?php if ($company->getLogo() !== null && $company->getLogo() !== '') : ?>
    <img src="images/<?= $company->getLogo(); ?>" style="max-height: 9rem; max-width: 9rem;">
<?php endif; ?>

<h1><?= $company->getName(); ?></h1>

<?php if ($company->getInfo() !== null && $company->getInfo() !== '') : ?>
    <p><?= $company->getInfo(); ?></p>
<?php endif; ?>

<?php if (!empty($company->getAccountExpertises()) OR $company->getAccountExpertiseExtra() !== null) : ?>
    
    <h3>De firma heeft de volgende expertises:</h3>

    <ul>
        <?php if (!empty($company->getAccountExpertises())) : ?>
            <?php foreach ($company->getAccountExpertises() as $accountExpertise) : ?>
                <li>
                    <strong><?= $accountExpertise->getExpertise()->getExpertise(); ?></strong>: <br/>
                    <?= $accountExpertise->getInfo(); ?>
                </li>
            <?php endforeach; ?>
        <?php endif; ?>
        <?php if ($company->getAccountExpertiseExtra() !== null) : ?>
            <?php $accountExpertiseExtra = $company->getAccountExpertiseExtra(); ?>
            <li>
                <strong><?= $accountExpertiseExtra->getName(); ?></strong>: <br/>
                <?= $accountExpertiseExtra->getInfo(); ?>
            </li>                        
        <?php endif; ?>
    </ul>
    
<?php endif; ?>
            
<?php if (!empty($company->getAccountMoreInfo()) OR $company->getAccountMoreInfoExtra() !== null) : ?>
    
    <h3>De firma wenst meer info te hebben over</h3>

    <ul>
        <?php if (!empty($company->getAccountMoreInfo())) : ?>
            <?php foreach ($company->getAccountMoreInfo() as $accountMoreInfo) : ?>
                <li>
                    <strong><?= $accountMoreInfo->getExpertise()->getExpertise(); ?></strong>: <br/>
                    <?= $accountMoreInfo->getInfo(); ?>
                </li>
            <?php endforeach; ?>
        <?php endif; ?>
        <?php if ($company->getAccountMoreInfoExtra() !== null) : ?>
            <?php $accountMoreInfoExtra = $company->getAccountMoreInfoExtra(); ?>
            <li>
                <strong><?= $accountMoreInfoExtra->getName(); ?></strong>: <br/>
                <?= $accountMoreInfoExtra->getInfo(); ?>
            </li>                        
        <?php endif; ?>                                  
    </ul>
    
<?php endif; ?>
