<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <title>Profiel Pagina</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <link rel="stylesheet" href="style/swipe.css">
    <script>
        $(document).ready(function() {

            var animating = false;
            var cardsCounter = 0;
            var numOfCards = 6;
            var decisionVal = 80;
            var pullDeltaX = 0;
            var deg = 0;
            var $card, $cardReject, $cardLike;

            function pullChange() {
                animating = true;
                deg = pullDeltaX / 10;
                $card.css("transform", "translateX("+ pullDeltaX +"px) rotate("+ deg +"deg)");

                var opacity = pullDeltaX / 100;
                var rejectOpacity = (opacity >= 0) ? 0 : Math.abs(opacity);
                var likeOpacity = (opacity <= 0) ? 0 : opacity;
                $cardReject.css("opacity", rejectOpacity);
                $cardLike.css("opacity", likeOpacity);
            };

            function release() {

                if (pullDeltaX >= decisionVal) {
                    $card.addClass("to-right");   

                    // Change status in database
                    vId     = $card.attr('id');
                    vResult = "yes";
                    
                    $.ajax({
                      url      : "<?= $currentPath; ?>addMatchingResultTest.php",
                      data     : {
                        'swipingCompanyId' : vId,
                        'answer'           : vResult
                      },
                    });
                    
                    // Remove the current card
                    $card.remove();

                   //if list_of_profiles < 10 {add new profile to the (jquery)

                } else if (pullDeltaX <= -decisionVal) {
                    $card.addClass("to-left");

                    // Change status in database
                    vId     = $card.attr('id');
                    vResult = "no";
                    
                    $.ajax({
                      url      : "<?= $currentPath; ?>addMatchingResultTest.php",
                      data     : {
                        'swipingCompanyId' : vId,
                        'answer'           : vResult
                      },
                    });
                    
                    // Remove the current card
                    $card.remove();

                    //if list_of_profiles < 10 {add new profile to the list (jquery)
                }

                if (Math.abs(pullDeltaX) >= decisionVal) {
                    $card.addClass("inactive");

                    setTimeout(function() {
                        $card.addClass("below").removeClass("inactive to-left to-right");
                        cardsCounter++;
                        if (cardsCounter === numOfCards) {
                            cardsCounter = 0;
                            $(".profile__card").removeClass("below");
                        }
                    }, 300);
                }

                if (Math.abs(pullDeltaX) < decisionVal) {
                    $card.addClass("reset");
                }

                setTimeout(function() {
                    $card.attr("style", "").removeClass("reset")
                        .find(".profile__card__choice").attr("style", "");

                    pullDeltaX = 0;
                    animating = false;
                }, 300);

            };


            $("#profile__skip").click(function (e) {
                $( ".profile__card").last().remove();
            });

            $(document).on("mousedown touchstart", ".profile__card:not(.inactive)", function(e) {




                if (animating) return;



                $card = $(this);


                $cardReject = $(".profile__card__choice.m--reject", $card);
                $cardLike = $(".profile__card__choice.m--like", $card);
                var startX =  e.pageX || e.originalEvent.touches[0].pageX;

                $(document).on("mousemove touchmove", function(e) {
                    var x = e.pageX || e.originalEvent.touches[0].pageX;
                    pullDeltaX = (x - startX);
                    if (!pullDeltaX) return;
                    pullChange();
                });

                $(document).on("mouseup touchend", function() {
                    $(document).off("mousemove touchmove mouseup touchend");
                    if (!pullDeltaX) return; // prevents from rapid click events
                    release();
                });
            });

        });
    </script>
</head>
<body>



<div class="profile">
    <header class="profile__header"></header>
    <div class="profile__content">
        <div class="profile__card-cont">

        <?php foreach($swipingInfo as $row) : ?>

            <div class="profile__card" id="<?php echo $row->getId();?>">
                <div class="profile__card__top brown">
                        <div class="profile__card__img" <?php if ($row->getLogo()){
                            echo "style='background: url(images/".$row->getLogo().")'";
                        } ?>></div>
                    <p class="profile__card__name"><?php echo $row->getName();?></p>
                </div>
                <div class="profile__card__btm">
                    <p class="profile__card__we"><?php echo $row->getInfo();?></p>
                </div>
                <div class="profile__card__choice m--reject"></div>
                <div class="profile__card__choice m--like"></div>
                <div class="profile__card__drag"></div>
            </div>

        <?php endforeach; ?>


        </div>
        <p class="profile__tip">Swipe left or right or<br>
        <span id="profile__skip">>>(Skip)<<</span></p>

    </div>
</div>
</body>