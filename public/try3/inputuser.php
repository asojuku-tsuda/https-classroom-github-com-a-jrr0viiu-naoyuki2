<?php
function isValidLength(string $input, int $maxLength = 20): bool {
  return mb_strlen($input) <= $maxLength;
}

function isJapaneseOnly(string $input): bool {
  return mb_ereg('^[ぁ-んァ-ヶ一-龠々]+$', $input);
}

function isValidEmail(string $input): bool {
  return filter_var($input, FILTER_VALIDATE_EMAIL) !== false;
}
?>

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
$input_name = filter_input(INPUT_GET, 'username');
$input_address = filter_input(INPUT_GET, 'useraddress');
$input_email = filter_input(INPUT_GET, 'usermail');

if (
  !$input_name ||
  !isValidLength($input_name, 20) ||
  !isJapaneseOnly($input_name)
) {
  header('Location: /try3/inputuser.html');
  exit;
}

if (
  !$input_address ||
  !isValidLength($input_address, 50) ||
  !isJapaneseOnly($input_address)
) {
  header('Location: /try3/inputuser.html');
  exit;
}

if (
  !$input_email ||
  !isValidLength($input_email, 100) ||
  !isValidEmail($input_email)
) {
  header('Location: /try3/inputuser.html');
  exit;
}

echo "あなたが入力した値<br>";
echo "名前：" . $_GET['username'] . "<br>";
echo "住所：" . $_GET['useraddress']. "<br>";
echo "メールアドレス：" . $_GET['usermail'];
?>
    </h2>
    </div>
  </body>
</html>
