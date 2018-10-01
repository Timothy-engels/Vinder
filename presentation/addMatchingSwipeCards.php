<?php foreach($swipingInfo as $account): ?>

    <div class="profile__card" id="<?= $account->getId();?>">
        <div class="profile__card__top brown">
                <div class="profile__card__img" <?php if ($account->getLogo()){
                    echo "style='background: url(images/".$account->getLogo().")'";
                } ?>></div>
            <p class="profile__card__name"><?php echo $account->getName();?></p>
        </div>
        <div class="profile__card__btm">
            <p class="profile__card__we"><?php echo $account->getInfo();?></p>
        </div>
        <div class="profile__card__choice m--reject"></div>
        <div class="profile__card__choice m--like"></div>
        <div class="profile__card__drag"></div>
    </div>

<?php endforeach; ?>