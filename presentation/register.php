<!DOCTYPE html>
<html lang="nl">
    <head>
        <meta charset="UTF-8">
        <title>Vinder | Register</title>
    </head>
    <body>
        <main>
            <section id="register">
                <h1>Registreer</h1>
                
                <small>Velden met een * zijn verplicht in te vullen</small>
                
                <label for="name">Naam</label>
                <input type="text" id="name" maxlength="255" required />
                
                <label for="contactPerson">Contactpersoon</label>
                <input type="text" id="contactPerson" maxlength="255" required />
                
                <label for="email">Email</label>
                <input type="email" id="email" maxlength="255" required />
                
                <label for="password">Wachtwoord</label>
                <input type="password" id="password" maxlength="255" required />
                
                <label for="repeat-password">Herhaal wachtwoord</label>
                <input type="password" id="repeat-password" maxlength="255" required />
                
                <input type="submit" value="Registreer">
                
            </section>
        </main>
    </body>
</html>
