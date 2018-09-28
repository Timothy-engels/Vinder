<ul>
    <li><a href="showProfile.php">Profiel bekijken</a></li>
    <li><a href="editProfile.php">Profiel wijzigen</a></li>
    <li><a href="contactUpdate.php">Contactinfo wijzigen</a></li>
    <li><a href="updatePassword.php">Wachtwoord wijzigen</a></li>
    <li><a href="matchingController.php">matches</a></li>
    <li><a href="deleteAccount.php">Account verwijderen</a></li>
    <?php if (isset($loggedInAsAdmin) && $loggedInAsAdmin === true) : ?>
        <li><a href="userList.php">Gebruikers bekijken (admin)</a></li>
        <li><a href="expertises.php">Expertises (admin)</a></li>
        <li><a href="mailUpdate.php">Tekst voor mail wijzigen (admin)</a></li>
        <li><a href="updateDateSettings.php">Datums wijzigen (admin)</a></li>
        <li><a href="matchedCompanies.php">Bedrijven met matches</a></li>
        <li><a href="unmatchedCompanies.php">Bedrijven zonder matches</a></li>
        <li><a href="deleteMatching.php">Matchings verwijderen</a></li>
    <?php endif; ?>
    <li><a href="logOut.php">Uitloggen</a></li>
</ul>

