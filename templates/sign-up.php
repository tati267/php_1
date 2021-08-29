<?php
$email = $form['email'] ?? '';
$password = $form['password'] ?? '';
$name = $form['name'] ?? '';
$message  = $form['message']  ?? '';
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
    <form class="form container <?= isset($errors) ? 'form--invalid' : '' ?>" enctype="multipart/form-data"
        action="sign-up.php" method="post">
        <!-- form--invalid -->
        <h2>Register new accaunt</h2>
        <div class="form__item <?= isset($errors['email']) ? 'form__item--invalid' : '' ?>">
            <!-- form__item--invalid -->
            <label for="email">E-mail*</label>
            <input id="email" type="text" name="email" value="<?= $email;?>" placeholder="Insert e-mail">
            <span class="form__error"><?= $errors['email'] ?? '' ?></span>
        </div>
        <div class="form__item <?= isset($errors['password']) ? 'form__item--invalid' : '' ?> ">
            <label for="password">Password*</label>
            <input id="password" type="text" name="password" value="<?= $password;?>" placeholder="Insert password">
            <span class="form__error"><?= $errors['password'] ?? '' ?></span>
        </div>
        <div class="form__item <?= isset($errors['name']) ? 'form__item--invalid' : '' ?>">
            <label for="name">Name*</label>
            <input id="name" type="text" name="name" value="<?= $name;?>" placeholder="Insert your name">
            <span class="form__error"><?= $errors['name'] ?? '' ?></span>
        </div>
        <div class="form__item <?= isset($errors['message']) ? 'form__item--invalid' : '' ?>">
            <label for="message">Contact details*</label>
            <textarea id="message" name="message" placeholder="Your contact details"><?= $message;?></textarea>
            <span class="form__error"><?= $errors['message'] ?? '' ?></span>
        </div>
        <div
            class="form__item form__item--file form__item--last <?= isset($errors['file']) ? 'form__item--invalid' : '' ?>">
            <label>Your photo</label>
            <div class="preview">
                <button class="preview__remove" type="button">x</button>
                <div class="preview__img">
                    <img src="img/avatar.jpg" width="113" height="113" alt="Your photo">
                </div>
            </div>
            <div class="form__input-file">
                <input class="visually-hidden" type="file" id="photo" name="user-photo">
                <label for="photo">
                    <span>+ Add</span>
                </label>
                <span class="form__error"><?= $errors['file'] ?? '' ?></span>
            </div>
        </div>
        <span class="form__error form__error--bottom">Please, correct mistakes in your form</span>
        <button type="submit" class="button">Register</button>

        <a class="text-link" href="#">Already have this accaunt</a>
    </form>
</main>