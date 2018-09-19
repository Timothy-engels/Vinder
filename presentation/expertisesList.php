<!DOCTYPE HTML> <!-- presentation/commentlist.php -->
<html>
<head>
    <meta charset=utf-8>
    <title>users</title>
    <style>
        body{
            font-family: 'Lato', sans-serif;
            font-size: 21px;
            margin: 0px auto;
            text-align: center;
        }
        ul {
            list-style-type: none;
        }
        a {
            padding: 0 25px;
        }
        
        .error{
            display: block;
            color: red;
            font-weight: bold;
        }

        .message{
            display: block;
            color: green;
            font-weight: bold;
        }
    </style>
    <link href="https://fonts.googleapis.com/css?family=Lato" rel="stylesheet">
</head>
<body>
    <?php include('menu.php'); ?>
    
    <h1>Expertises</h1>

    <?php if ($message !== '') : ?>
        <div class="message"><?= $message; ?></div>
    <?php endif; ?>
    
    <table>
        <thead>
            <tr>
                <th>Expertise</th>
                <th>Status</th>
                <th>Opties</th>
            </tr>
        </thead>
        <?php foreach($expertises as $expertise) : ?>
            <tr>
                <td><?= $expertise->getExpertise(); ?></td>
                <td><?= ($expertise->getActive() === 1 ? "Actief" : "Inactief"); ?></td>
                <td>
                    <a href='expertiseAdjust.php?eaid=<?= $expertise->getId(); ?>'>Wijzigen</a>
                    <a href='expertiseDelete.php?edid=<?= $expertise->getId(); ?>'>Verwijderen</a>
                </td>
            </tr>
        <?php endforeach; ?>
    </table>

    <br/>
    
    <form action="expertises.php" method="POST">
        <input type="text" name="newExpertise" value="<?= $newExpertise; ?>">
        <input type="submit" value="Toevoegen"><br/>
        <?php if ($validation !== '') : ?>
            <p class="error"><?= $validation; ?></div>
        <?php endif; ?>
    </form>
    
</body>
</html>