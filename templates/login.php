<?php

$email = $form_enter['email'] ?? '';
$password = $form_enter['password'] ?? '';

$email_error = $errors['email'] ?? '';
$password_error = $errors['password'] ?? '';

?>

<main>
    <nav class="nav">
        <ul class="nav__list container">
            <?php foreach($categories as $key => $value): ?>
            <li class="nav__item">
                <a href="all-lots.html"><?=$value['category']?></a>
            </li>
            <?php endforeach?>
        </ul>
    </nav>
    <form class="form container <?= isset($errors) ? 'form--invalid' : '' ?>" action="enter.php" method="post">
        <h2>Вход</h2>
        <div class="form__item <?= isset($errors['email']) ? 'form__item--invalid' : '' ?>">
            <label for="email">E-mail*</label>
            <input id="email" type="text" name="email" placeholder="Введите e-mail" value="<?= $email ?>">
            <span class="form__error"><?= $email_error ?></span>
        </div>
        <div class="form__item form__item--last <?= isset($errors['password']) ? 'form__item--invalid' : '' ?>">
            <label for="password">Пароль*</label>
            <input id="password" type="text" name="password" placeholder="Введите пароль" value="<?= $password ?>">
            <span class="form__error"><?= $password_error ?></span>
        </div>
        <button type="submit" class="button">Войти</button>
    </form>
</main>