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
        <li <?php if (isset($menuItem) && $menuItem === "profiel-bekijken") echo 'class="active"'; ?>>
            <a href="profiel-bekijken.php"><i class="ion ion-android-person"></i><span>Mijn profiel</span></a>
        </li>
        <?php if ($loggedInAccount->getAdministrator() !== "1") : ?>
            <li <?php if (isset($menuItem) && $menuItem === "swipe") echo 'class="active"'; ?>>
                <a href="swipe.php"><i class="ion ion-android-share-alt"></i> Swipen</a>
            </li> 
        <?php endif; ?>
        <li <?php if (isset($menuItem) && $menuItem === "mijn-matches") echo 'class="active"'; ?>>
            <a href="mijn-matches.php"><i class="ion ion-heart"></i> Mijn matches <div class="badge badge-primary"><?= $loggedInAccount->getAmountMyMatches(); ?></div></a>
        </li>

        <?php if ($loggedInAccount->getAdministrator() === "1") : ?>
            <li class="menu-header">Accounts</li>
            <li <?php if (isset($menuItem) && $menuItem === "accounts") echo 'class="active"'; ?>>
                <a href="accounts.php"><i class="ion ion-android-people"></i> Alle accounts</a>
            </li>
            <li <?php if (isset($menuItem) && $menuItem === "accounts-met-matches") echo 'class="active"'; ?>>
                <a href="accounts-met-matches.php"><i class="ion ion-android-happy"></i>  Met matches <div class="badge badge-primary"><?= $amountMatchedCompanies; ?></div></a>
            </li>
            <li <?php if (isset($menuItem) && $menuItem === "accounts-zonder-matches") echo 'class="active"'; ?>>
                <a href="accounts-zonder-matches.php"><i class="ion ion-android-sad"></i> Zonder matches <div class="badge badge-primary"><?= $amountUnmatchedCompanies; ?></div></a>
            </li>      
        <?php endif; ?>
        <li class="menu-header">Beheer</li>
        <li <?php if (isset($menuItem) && $menuItem === "profiel-wijzigen") echo 'class="active"'; ?>>
            <a href="profiel-wijzigen.php"><i class="ion-android-create"></i><span>Profiel wijzigen</span></a>
        </li>
        <li <?php if (isset($menuItem) && $menuItem === "contactgegevens-wijzigen") echo 'class="active"'; ?>>
            <a href="contactgegevens-wijzigen.php"><i class="ion-android-mail"></i><span>Contactgegevens</span></a>
        </li>
        <li <?php if (isset($menuItem) && $menuItem === "wachtwoord-wijzigen") echo 'class="active"'; ?>>
            <a href="wachtwoord-wijzigen.php"><i class="ion ion-android-lock"></i><span>Wachtwoord</span></a>
        </li>
        <?php if ($loggedInAccount->getAdministrator() !== "1") : ?>
            <li <?php if (isset($menuItem) && $menuItem === "account-verwijderen") echo 'class="active"'; ?>>
                <a href="account-verwijderen.php"><i class="ion ion-android-delete"></i><span>Account verwijderen</span></a>
            </li>
        <?php endif; ?>
        <?php if ($loggedInAccount->getAdministrator() === "1") : ?>
            <li <?php if (isset($menuItem) && $menuItem === "expertises") echo 'class="active"'; ?>>
                <a href="expertises.php"><i class="ion ion-ribbon-b"></i><span>Expertises</span></a>
            </li>
            <li <?php if (isset($menuItem) && $menuItem === "tips-wijzigen") echo 'class="active"'; ?>>
                <a href="tips-wijzigen.php"><i class="ion ion-android-bulb"></i><span>Tips</span></a>
            </li>
            <li <?php if (isset($menuItem) && $menuItem === "datums-wijzigen") echo 'class="active"'; ?>>
                <a href="datums-wijzigen.php"><i class="ion ion-android-calendar"></i><span>Datums</span></a>
            </li>       
            <li <?php if (isset($menuItem) && $menuItem === "matchings-verwijderen") echo 'class="active"'; ?>>
                <a href="matchings-verwijderen.php"><i class="ion ion-android-delete"></i> Matchings verwijderen</a>
            </li>                             
        <?php endif; ?>
    </ul>
        <div class="p-3 mt-4 mb-4">
        <a href="logOut.php" class="btn btn-danger btn-shadow btn-round has-icon has-icon-nofloat btn-block">
            <i class="ion ion-android-exit"></i> <div>Uitloggen</div>
        </a>
    </div>
</aside>