<?
use local\modules\Composite\Elementor\Client;
?>

<? if ($isAuthorized): ?>
    <div class="success-block">
        <div class="title"><?= $message ?></div>
        <a href="<?= g_ROOT ?>" class="underlined-button"><?= $text ?></a>
    </div>
<? else: ?>

<?
$client = new Client();
$form = $client->generateloginForm();
$client->renderLoginForm($form);
?>

<!--<form action ='/account/authorize/' method="post">-->
<!--    <input type="text" name="login" placeholder="Login">-->
<!--    <br>-->
<!--    <input type="password" name="password" placeholder="Password">-->
<!--    <br>-->
<!--    <label>-->
<!--        remember me-->
<!--        <input type="checkbox" name="remember">-->
<!--    </label>-->
<!--    <button type="submit">Отправить</button>-->
<!--</form>-->

<? endif; ?>