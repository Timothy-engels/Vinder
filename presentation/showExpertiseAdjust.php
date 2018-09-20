<!DOCTYPE HTML>
<html>
<head>
    <meta charset=utf-8>
    <title>users</title>
    <style>
        body{
            font-family: 'Lato', sans-serif;
            font-size: 21px;
            margin: 0px auto;
        }
        
        ul {
            list-style-type: none;
        }
        
        label, input {
            display: block;
        }
        .error {
            color: red;
            font-weight: bold;
        }
    </style>
    <link href="https://fonts.googleapis.com/css?family=Lato" rel="stylesheet">
</head>
<body>
    <?php include('menu.php'); ?>
    
    <h1>Expertises</h1>
    <form action="expertiseAdjust.php?eaid=<?=$eaid;?>" method="POST">
        <label for="expertise">Expertise:</label>
        <input type="text" name="expertise" value="<?= $expertiseName; ?>">
        <?php if ($expertiseNameErrors !== '') : ?>
            <div class="error"><?= $expertiseNameErrors; ?></div>
        <?php endif; ?>
        <label for="active">Actief:<label>
        <?php
        $checked = '';
        if ($expertiseActive === "1") {
            $checked = "checked";
        }
        ?>
        <input type="checkbox" name="active" value="1" <?= $checked; ?> />
        <input type="submit" value="Wijzigen">
    </form>
</body>
</html>