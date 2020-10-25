<? if (!$isAuthorized): ?>
    <form action ='/account/register/' method="post">
        <input type="text" name="login" placeholder="Login">
        <br>
        <input type="password" name="password" placeholder="Password">
        <br>
        <input type="text" name="email" placeholder="Email">
        <br>
        <input type="text" name="phone" placeholder="Phone">
        <br>
        <button type="submit">Отправить</button>
    </form>
<? else: ?>
    <div class="success-block">
        <div class="title"><?= $message ?></div>
        <a href="<?= g_ROOT ?>" class="underlined-button"><?= $text ?></a>
    </div>
<? endif; ?>

