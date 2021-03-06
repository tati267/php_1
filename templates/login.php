<?php
$email = $form['email'] ?? '';
$password = $form['password'] ?? '';
?>

<main>
    <nav class="nav">
        <ul class="nav__list container">
            <?php foreach($categories as $key => $value): ?>
            <li class="nav__item">
                <a href="all-lots.html"><?=$value['CategoryName']?></a>
            </li>
            <?php endforeach?>
        </ul>
    </nav>
    <form class="form container <?= isset($errors) ? 'form--invalid' : '' ?>" action="login.php" method="post">
        <h2>Login</h2>
        <div class="form__item <?= isset($errors['email']) ? 'form__item--invalid' : '' ?>">
            <label for="email">E-mail*</label>
            <input id="email" type="text" name="email" placeholder="Your e-mail" value="<?= $email;?>">
            <span class="form__error"><?= $errors['email'] ?? '' ?></span>
        </div>
        <div class="form__item form__item--last <?= isset($errors['password']) ? 'form__item--invalid' : '' ?>">
            <label for="password">Password*</label>
            <input id="password" type="text" name="password" placeholder="Your password" value="<?= $password ?>">
            <span class="form__error"><?= $errors['password'] ?? '' ?></span>
        </div>
        <button type="submit" class="button">Login</button>
    </form>
</main>
