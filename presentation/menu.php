<ul>
    <li><a href="showProfile.php">Profiel bekijken</a></li>
    <li><a href="editProfile.php">Profiel wijzigen</a></li>
    <li><a href="updatePassword.php">Wachtwoord wijzigen</a></li>
    <?php if (isset($loggedInAsAdmin) && $loggedInAsAdmin === true) : ?>
        <li><a href="userList.php">Gebruikers bekijken (admin)</a></li>
        <li><a href="expertises.php">Expertises (admin)</a></li>
        <li><a href="mailUpdate.php">Tekst voor mail wijzigen (admin)</a></li>
        <li><a href="updateDateSettings.php">Datums wijzigen (admin)</a></li>
    <?php endif; ?>
    <li><a href="logOut.php">Uitloggen</a></li>
</ul>
