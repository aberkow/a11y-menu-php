<?php

require_once('src/A11y/Menu_Generator.php');

$data = file_get_contents(__DIR__ . '/src/data/mock-data.json');
$decoded = json_decode($data);

?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css" integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous">
  <link rel="stylesheet" href="vendor/ucomm/a11y-menu/dist/main.css">
  <link rel="stylesheet" href="public/css/style.css">
  <title>A11Y Menu PHP Version</title>
</head>
<body>
  <div class="content-wrapper">
    <h1>A11Y Menu PHP Version</h1>
  </div>
  <nav id="am-navigation">
    <ul id="am-php-menu" class="am-click-menu">
      <?php echo A11y\Menu_Generator::display_menu($decoded->menu); ?>
    </ul>
  </nav>
  <div class="content-wrapper">
    <p>This is a demo of the pure PHP menu generator.</p>
  </div>
  <script src="vendor/ucomm/a11y-menu/dist/Navigation.js"></script>
  <script src="public/js/index.js"></script>
</body>
</html>