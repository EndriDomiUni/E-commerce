<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Take it - <?php echo $title; ?></title>
    <link rel="icon" href="<?php echo IMG; ?>/logo.svg" type="image/svg" sizes="16x16">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta2/css/all.min.css" integrity="sha512-YWzhKL2whUzgiheMoBFwW8CKV4qpHQAEuvilg9FAn5VJUDwKZZxkJNuGM4XkWuk94WCrrwslk8yWNGmY1EduTA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
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

    <script src="./assets/js/base.js"></script>
</head>