<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no, shrink-to-fit=no" name="viewport">
    <title>Vinder | Swipe</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    
    <link rel="stylesheet" href="modules/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="modules/ionicons/css/ionicons.min.css">
    <link rel="stylesheet" href="dist/modules/fontawesome/web-fonts-with-css/css/fontawesome-all.min.css">

    <link rel="stylesheet" href="style/swipe.css">
    <link rel="stylesheet" href="css/style.css">    
    <link rel="stylesheet" href="css/skins/vinder.css"> 
    <link rel="stylesheet" href="css/custom.css">

    <script>
        $(document).ready(function() {

            var animating = false;
            var cardsCounter = 0;
            var numOfCards = <?= $numOfCards; ?>;
            var amountAddSwipeCards = 4;
            var decisionVal = 80;
            var pullDeltaX = 0;
            var deg = 0;
            var $card, $cardReject, $cardLike;
            
            function addSwipeCards() {
                
                // Get the ID's of the current swipecards
                vCurrentSwipeCardIds = '';
                $('.profile__card').each(function() {
                     vCurrentSwipeCardIds += $(this).attr("id") + ',';
                });

                vCurrentSwipeCardIds = vCurrentSwipeCardIds.slice(0, -1);

                // Generate the swipecards & set them in the container
                $.ajax({
                    url      : "<?= $currentPath; ?>addMatchingSwipeCards.php",
                    data     : {
                        'currentSwipeCardIds' : vCurrentSwipeCardIds
                    },
                    dataType : 'html'
                }).done(function(msg) {
                    if (msg != '') {
                        $('#profile__card__container').prepend(msg);
                        numOfCards   = $(".profile__card").length;
                        cardsCounter = 0;
                    }
                });
                
            }

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
                      url      : "<?= $currentPath; ?>addMatchingResult.php",
                      data     : {
                        'swipingCompanyId' : vId,
                        'answer'           : vResult
                      },
                    });
                    
                    // Remove the current card
                    $card.remove();
                    
                } else if (pullDeltaX <= -decisionVal) {
                    $card.addClass("to-left");

                    // Change status in database
                    vId     = $card.attr('id');
                    vResult = "no";
                    
                    $.ajax({
                      url      : "<?= $currentPath; ?>addMatchingResult.php",
                      data     : {
                        'swipingCompanyId' : vId,
                        'answer'           : vResult
                      },
                    });
                    
                    // Remove the current card
                    $card.remove();

                }
                       
                if (Math.abs(pullDeltaX) >= decisionVal) {
                    $card.addClass("inactive");

                    setTimeout(function() {
                        $card.addClass("below").removeClass("inactive to-left to-right");
                        cardsCounter++;
                        
                        if ((numOfCards - cardsCounter) === amountAddSwipeCards) {
                            addSwipeCards();
                        }
                    
                        if (cardsCounter === numOfCards) {
                            addSwipeCards();
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

<body class="sidebar-gone">

    <div id="app">
        <div class="main-wrapper">
            <div class="navbar-bg"></div>
            <nav class="navbar navbar-expand-lg main-navbar">
                <form class="form-inline mr-auto">
                </form>
                <ul class="navbar-nav navbar-right">
                    <li class="dropdown"><a href="#" data-toggle="dropdown" class="nav-link dropdown-toggle nav-link-lg">
                        <i class="ion ion-android-person d-lg-none"></i>
                        <div class="d-sm-none d-lg-inline-block">Hoi, <?= $account->getContactPerson(); ?></div></a>
                        <div class="dropdown-menu dropdown-menu-right">
                            <?php include('menu.php'); ?>
                        </div>
                    </li>
                </ul>
            </nav>

            <div class="main-content">
                <section class="section">
                    <h1 class="section-header">
                        <div><a href="dashboard.php"><img src="images/icon.png" alt="Vinder" style="width: 2rem;"></a>&nbsp;&nbsp;Swipe</div>
                    </h1>

                    <div class="section-body">
                                                
                        <div class="row">
                            <div class="col-12 col-md-12">
                                <div class="card">
                                    <div class="card-header">
                                        <div class="float-right">
                                            <div class="btn-group">
                                                <a href="#default" data-tab="alerts" class="btn active"><i class="ion ion-heart"></i></a>
                                                <a href="#default" data-tab="alerts" class="btn active"><i class="ion ion-close"></i></a>
                                                <a href="#default" data-tab="alerts" class="btn active">Volgende <i class="ion ion-arrow-right-c"></i></a>
                                                
                                            </div>
                                        </div>
                                        <h4>Swipe naar links of naar rechts</h4>
                                    </div>
                                    <div class="card-body">

                                        <?php if (isset($errorMsg)) : ?>

                                            <p class="profile__error"><?= $errorMsg; ?></p>

                                        <?php elseif (isset($warningMsg)) : ?>

                                            <p class="profile__warning"><?= $warningMsg; ?></p>

                                        <?php else : ?>

                                                <div class="profile__content">
                                                    <div id="profile__card__container" class="profile__card-cont">

                                                        <?php foreach($swipingInfo as $row) : ?>

                                                        <div class="profile__card" id="<?php echo $row->getId();?>">
                                                            

                                                            
                                                            <div class="card card-primary">
                                                                <div class="card-header">
                                                                    <h1>Card Title</h1>
                                                                </div>

                                                                <?php echo $row->getLogo(); ?>
                                                                <?php echo $row->getName();?>
                                                                <?php echo $row->getInfo();?>

                                                            </div>
                                                              

                                                     
                                                            <div class="profile__card__choice m--reject"></div>
                                                            <div class="profile__card__choice m--like"></div>
                                                            <div class="profile__card__drag"></div>
                                                        </div>

                                                        <?php endforeach; ?>

                                                    </div>

                                                </div>
                                        <?php endif; ?>                                        
                                        
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                </section>

            </div>
            <footer class="main-footer">
                <div class="footer-left">
                    Copyright &copy; 2018 <div class="bullet"></div> Design By <a href="https://multinity.com/">Multinity</a>
                </div>
                <div class="footer-right"></div>
            </footer>
        </div>
    </div>
   
    
    <script src="modules/jquery.min.js"></script>
    <script src="modules/bootstrap/js/bootstrap.min.js"></script>

</body>