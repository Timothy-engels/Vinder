<a href="showProfile.php" class="dropdown-item has-icon">
    <i class="ion ion-android-person"></i> Profiel bekijken
</a>

<a href="editProfile.php" class="dropdown-item has-icon">
    <i class="ion ion-android-create"></i> Profiel wijzigen
</a>

<a href="contactUpdate.php" class="dropdown-item has-icon">
    <i class="ion ion-android-mail"></i> Contactinfo wijzigen
</a>

<a href="updatePassword.php" class="dropdown-item has-icon">
    <i class="ion ion-android-lock"></i> Wachtwoord wijzigen
</a>

 <?php if (isset($loggedInAsAdmin) && !$loggedInAsAdmin) : ?>
            
    <a href="swipe.php" class="dropdown-item has-icon">
        <i class="ion ion-android-share-alt"></i> Swipen
    </a>

    <a href="deleteAccount.php" class="dropdown-item has-icon">
        <i class="ion ion-android-delete"></i> Mijn account verwijderen
    </a>

<?php endif; ?>

 <?php if (isset($loggedInAsAdmin) && $loggedInAsAdmin) : ?>
            
    <a href="userList.php" class="dropdown-item has-icon">
        <i class="ion ion-android-menu"></i> Overzicht accounts
    </a>

    <a href="accounts-met-matches.php" class="dropdown-item has-icon">
        <i class="ion ion-android-happy"></i> Accounts met matches
    </a>

    <a href="accounts-zonder-matches.php" class="dropdown-item has-icon">
        <i class="ion ion-android-happy"></i> Accounts zonder matches
    </a>

    <a href="matchings-verwijderen.php" class="dropdown-item has-icon">
        <i class="ion ion-android-delete"></i> Matchings verwijderen
    </a>

    <a href="expertises.php" class="dropdown-item has-icon">
        <i class="ion ion-ribbon-b"></i> Expertises beheren
    </a>

    <a href="mailUpdate.php" class="dropdown-item has-icon">
        <i class="ion ion-android-bulb"></i> Tips beheren
    </a>

    <a href="updateDateSettings.php" class="dropdown-item has-icon">
        <i class="ion ion-android-calendar"></i> Datums wijzigen
    </a>

<?php endif; ?>

<a href="logOut.php" class="dropdown-item has-icon">
    <i class="ion ion-android-exit"></i> Uitloggen
</a>
