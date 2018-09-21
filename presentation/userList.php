<!DOCTYPE HTML>
<html>
<head>
    <meta charset="utf-8">
    <title>Vinder | Lijst gebruikers</title>
</head>

<body>
    <?php include('menu.php'); ?>
    
    <side>
        <p>Hier komt de banner</p>
    </side>

    <main>
        <h1>Lijst Gebruikers</h1>
        <ul>
            <?php foreach($list as $row) : ?>
                <li>
                    <?= $row->getName(); ?>
                    <?php if ($row->getLogo() !== null && $row->getLogo() !== '') : ?>
                        <img src="images/<?= $row->getLogo(); ?>" style="height: 8rem;"><br/>
                    <?php endif; ?>
                </li>
            <?php endforeach; ?>
        </ul>
    </main>
</body>
</html>