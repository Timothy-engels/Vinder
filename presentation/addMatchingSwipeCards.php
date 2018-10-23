<?php foreach($swipingInfo as $account) : ?>

    <div class="profile__card" id="<?= $account->getId();?>">

        <div class="card card-primary">
            <div class="card-header">
                <?php
                $logo = 'no-image.png';
                if ($account->getLogo() !== null && $account->getLogo() !== '') {
                    $logo = $account->getLogo();
                }
                ?>
                <img style="vertical-align:middle; max-height: 3rem; max-width: 3rem;" src="images/<?= $logo; ?>">
                <span class="h6"><?= $account->getName(); ?></span>
            </div>
            <div class="card-body">
                <?php if ($account->getInfo() !== null && $account->getInfo() !== '') : ?>
                    <p><?= $account->getInfo();?></p>
                <?php endif; ?>

                <?php if (!empty($account->getAccountExpertises()) OR $account->getAccountExpertiseExtra() !== null) : ?>
                    <h6>Expertises</h6>
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
                    <h6>Gewenste expertises</h6>
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