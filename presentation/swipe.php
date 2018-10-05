<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no, shrink-to-fit=no" name="viewport">
    <title>Vinder | Swipe</title>
    <link rel="stylesheet" href="modules/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="modules/ionicons/css/ionicons.min.css">
    <link rel="stylesheet" href="modules/fontawesome/web-fonts-with-css/css/fontawesome-all.min.css">
    <link rel="stylesheet" href="style/swipe.css">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/skins/vinder.css">
    <link rel="stylesheet" href="style/swipe.css">
    <link rel="stylesheet" href="css/custom.css">
</head>

<body>
    <div id="app">
        <div class="main-wrapper">
            <div class="navbar-bg"></div>
            <nav class="navbar navbar-expand-lg main-navbar">
                <form class="form-inline mr-auto">
                    <ul class="navbar-nav mr-3">
                        <li><a href="#" data-toggle="sidebar" class="nav-link nav-link-lg"><i class="ion ion-navicon-round"></i></a></li>
                    </ul>
                </form>
                <ul class="navbar-nav navbar-right">
                    <li>
                        <a href="#" class="nav-link nav-link-lg">
                            <div class="d-sm-none d-lg-inline-block">Welkom, <?= $loggedInAccount->getContactPerson(); ?></div>
                        </a>
                    </li>
                </ul>
            </nav>
            <div class="main-sidebar">
                <aside id="sidebar-wrapper">
                    <div class="sidebar-brand">
                        <a href="dashboard.php"><img src="images/logo.png" alt="Vinder" style="width: 8rem;"></a>
                    </div> 
                    <div class="sidebar-user">
                        <div class="sidebar-user-details" style="padding-left: 7px;">
                            <div class="user-name"><?= $loggedInAccount->getContactPerson(); ?></div>
                            <div class="user-role"><?= $loggedInAccount->getName(); ?></div>
                        </div>
                    </div>
                    <ul class="sidebar-menu">
                        <li class="menu-header">Algemeen</li>
                        <li>
                            <a href="showProfile.php"><i class="ion ion-android-person"></i><span>Mijn profiel</span></a>
                        </li>
                        <?php if ($loggedInAccount->getAdministrator() !== "1") : ?>
                            <li class="active">
                                <a href="swipe.php"><i class="ion ion-android-share-alt"></i> Swipen</a>
                            </li> 
                        <?php endif; ?>
                        <li>
                            <a href="matchingController.php"><i class="ion ion-heart"></i> Mijn matches <div class="badge badge-primary"><?= $loggedInAccount->getAmountMyMatches(); ?></div></a>
                        </li>
                        
                        <?php if ($loggedInAccount->getAdministrator() === "1") : ?>
                            <li class="menu-header">Accounts</li>
                            <li>
                                <a href="userList.php"><i class="ion ion-android-people"></i> Alle accounts</a>
                            </li>
                            <li>
                                <a href="matchedCompanies.php"><i class="ion ion-android-happy"></i>  Met matches <div class="badge badge-primary">???</div></a>
                            </li>
                            <li>
                                <a href="unmatchedCompanies.php"><i class="ion ion-android-sad"></i> Zonder matches <div class="badge badge-primary">???</div></a>
                            </li>      
                        <?php endif; ?>
                        
                        <li class="menu-header">Beheer</li>
                        <li>
                            <a href="editProfile.php"><i class="ion-android-create"></i><span>Profiel</span></a>
                        </li>
                        <li>
                            <a href="contactUpdate.php"><i class="ion-android-mail"></i><span>Contactinfo</span></a>
                        </li>
                        <li>
                            <a href="updatePassword.php"><i class="ion ion-android-lock"></i><span>Wachtwoord</span></a>
                        </li>
                        <?php if ($loggedInAccount->getAdministrator() !== "1") : ?>
                            <li>
                                <a href="deleteAccount.php"><i class="ion ion-android-delete"></i><span>Account verwijderen</span></a>
                            </li>
                        <?php endif; ?>
                        <?php if ($loggedInAccount->getAdministrator() === "1") : ?>
                            <li>
                                <a href="expertises.php"><i class="ion ion-ribbon-b"></i><span>Expertises</span></a>
                            </li>
                            <li>
                                <a href="mailUpdate.php"><i class="ion ion-android-bulb"></i><span>Tips</span></a>
                            </li>
                            <li>
                                <a href="updateDateSettings.php"><i class="ion ion-android-calendar"></i><span>Datums</span></a>
                            </li>       
                            <li>
                                <a href="deleteMatching.php"><i class="ion ion-android-delete"></i> Matchings verwijderen</a>
                            </li>                             
                        <?php endif; ?>
                    </ul>
                    <div class="p-3 mt-4 mb-4">
                        <a href="logOut.php" class="btn btn-danger btn-shadow btn-round has-icon has-icon-nofloat btn-block">
                            <i class="ion ion-android-exit"></i> <div>Uitloggen</div>
                        </a>
                    </div>
                </aside>
            </div>
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
                        Copyright &copy; <a href="http://www.vdab.be">VDAB</a> 2018
                    </div>
                    <div class="footer-right"></div>
                </footer>
            </div>
        </div>

        <script src="modules/jquery.min.js"></script>
        <script src="modules/popper.js"></script>
        <script src="modules/tooltip.js"></script>
        <script src="modules/bootstrap/js/bootstrap.min.js"></script>
        <script src="modules/nicescroll/jquery.nicescroll.min.js"></script>
        <script src="modules/scroll-up-bar/dist/scroll-up-bar.min.js"></script>
        <script src="js/sa-functions.js"></script>

        <script src="js/scripts.js"></script>
        <script src="js/custom.js"></script>
  
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
  
</body>
</html>