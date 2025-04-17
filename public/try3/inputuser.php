<?php
function isValidLength(string $input, int $maxLength): bool {
  return mb_strlen($input) <= $maxLength;
}

function isJapaneseName(string $input): bool {
  // ひらがな・カタカナ・漢字のみ
  return mb_ereg('^[ぁ-んァ-ヶ一-龠々ー]+$', $input);
}

function isValidAddress(string $input): bool {
  // ひらがな・カタカナ・漢字・数字（全角/半角）・ハイフンのみ許可
  return mb_ereg('^[ぁ-んァ-ヶ一-龠々ー0-9０-９\-ー]+$', $input);
}

function isValidEmail(string $input): bool {
  // @, . _ - のみ許可 + filter_var で形式チェック
  return filter_var($input, FILTER_VALIDATE_EMAIL) !== false &&
    preg_match('/^[a-zA-Z0-9._\-@]+$/', $input);
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
  !isJapaneseName($input_name)
) {
  echo "20文字以内で名前を入力してください。記号等は利用できません。";
  exit;
}

if (
  !$input_address ||
  !isValidLength($input_address, 50) ||
  !isValidAddress($input_address)
) {
  echo "50文字以内で住所を入力してください。記号等は利用できません。";
  exit;
}

if (
  !$input_email ||
  !isValidLength($input_email, 100) ||
  !isValidEmail($input_email)
) {
  echo "正しいメールアドレス形式で入力してください。記号は.-_@のみ利用可能。";
  exit;
}

echo "あなたが入力した値<br>";
echo "名前：" . htmlspecialchars($input_name, ENT_QUOTES, 'UTF-8') . "<br>";
echo "住所：" . htmlspecialchars($input_address, ENT_QUOTES, 'UTF-8') . "<br>";
echo "メールアドレス：" . htmlspecialchars($input_email, ENT_QUOTES, 'UTF-8');
?>
      </h2>
    </div>
  </body>
</html>
