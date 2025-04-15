<!DOCTYPE html>
<html>
  <head>
    <meta charset="UTF-8">
    <title>Login Page</title>
    <link rel="stylesheet" type="text/css" href="style.css">
  </head>
  <body class="cyberpunk-bg">
    <div class="login-box">
      <h2>
<?php
$input = filter_input(INPUT_GET, 'indata');

if (!mb_ereg('^[0-9]+$', $input)) {
  header('Location: /try2/testnum.html');
  exit;
}

echo "入力された数字は： " . $_GET['indata'];
?>
    </h2>
    </div>
  </body>
</html>
