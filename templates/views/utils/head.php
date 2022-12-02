<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Take it - <?php echo $title; ?></title>
    <link rel="icon" href="<?php echo IMG; ?>/logo.jpg" type="image/svg" sizes="16x16">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=" crossorigin="anonymous"></script>

    <link rel="stylesheet" href="<?php echo CSS; ?>/style.css">
    <?php
    if (array_key_exists($_SERVER['PHP_SELF'], $stylesheets)) {
        for ($i = 0; $i < count($stylesheets[$_SERVER['PHP_SELF']]); $i++) {
            echo "<link rel='stylesheet' type='text/css' href='" . $stylesheets[$_SERVER['PHP_SELF']][$i] . "'>";
        }
    }
    if (isset($seller)) { ?>
        <link rel="stylesheet" href="<?php echo CSS; ?>/sidebarAdmin.css">
    <?php } ?>

    <script src="<?php echo JS; ?>/base.js" defer></script>
</head>