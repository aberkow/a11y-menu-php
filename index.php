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
  <link rel="stylesheet" href="vendor/ucomm/a11y-menu/dist/main.css">
  <title>A11Y Menu PHP Version</title>
</head>
<body>
  <h1>A11Y Menu PHP Version</h1>
  <nav id="am-navigation">
    <ul id="am-php-menu">
      <?php echo A11y\Menu_Generator::display_menu($decoded->menu); ?>
    </ul>
  </nav>
  <script src="vendor/ucomm/a11y-menu/dist/Navigation.js"></script>
</body>
</html>