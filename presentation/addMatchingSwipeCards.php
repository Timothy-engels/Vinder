<?php foreach($swipingInfo as $account) : ?>

    <div class="profile__card" id="<?= $account->getId();?>">

        <div class="card card-primary">
            <div class="card-header">
                <h1>
                    <?php if ($account->getLogo() !== null && $account->getLogo() !== '') : ?>
                        <img src="images/<?= $account->getLogo(); ?>" style="max-height: 5rem;">
                    <?php endif;?>
                    <?= $account->getName();?>
                </h1>
            </div>
            <div class="card-body">
                <?php if ($account->getInfo() !== null && $account->getInfo() !== '') : ?>
                    <p><?= $account->getInfo();?></p>
                <?php endif; ?>

                <?php if (!empty($account->getAccountExpertises()) OR $account->getAccountExpertiseExtra() !== null) : ?>
                    <h4><?= $account->getName(); ?> heeft de volgende expertises:</h4>
                    <ul>
                        <?php if (!empty($account->getAccountExpertises())) : ?>
                            <?php foreach ($account->getAccountExpertises() as $accountExpertise) : ?>
                                <li>
                                    <strong><?= $accountExpertise->getExpertise()->getExpertise(); ?></strong>: <br/>
                                    <?= $accountExpertise->getInfo(); ?>
                                </li>
                            <?php endforeach; ?>
                        <?php endif; ?>
                        <?php if ($account->getAccountExpertiseExtra() !== null) : ?>
                            <?php $accountExpertiseExtra = $account->getAccountExpertiseExtra(); ?>
                            <li>
                                <strong><?= $accountExpertiseExtra->getName(); ?></strong>: <br/>
                                <?= $accountExpertiseExtra->getInfo(); ?>
                            </li>                        
                        <?php endif; ?>
                    </ul>                                     

                <?php endif; ?>

                <?php if (!empty($account->getAccountMoreInfo()) OR $account->getAccountMoreInfoExtra() !== null) : ?>
                    <h4><?= $account->getName(); ?> wenst meer info te hebben over</h4>

                    <ul>
                        <?php if (!empty($account->getAccountMoreInfo())) : ?>
                            <?php foreach ($account->getAccountMoreInfo() as $accountMoreInfo) : ?>
                                <li>
                                    <strong><?= $accountMoreInfo->getExpertise()->getExpertise(); ?></strong>: <br/>
                                    <?= $accountMoreInfo->getInfo(); ?>
                                </li>
                            <?php endforeach; ?>
                        <?php endif; ?>
                        <?php if ($account->getAccountMoreInfoExtra() !== null) : ?>
                            <?php $accountMoreInfoExtra = $account->getAccountMoreInfoExtra(); ?>
                            <li>
                                <strong><?= $accountMoreInfoExtra->getName(); ?></strong>: <br/>
                                <?= $accountMoreInfoExtra->getInfo(); ?>
                            </li>                        
                        <?php endif; ?>                                  
                    </ul>
                <?php endif; ?>                                                                        

            </div>
        </div>

        <div class="profile__card__choice m--reject"></div>
        <div class="profile__card__choice m--like"></div>
        <div class="profile__card__drag"></div>

    </div>

<?php endforeach; ?>