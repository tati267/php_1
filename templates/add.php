<?php
$lot_name = $lot['lot-name'] ?? '';
$category = $lot['category'] ?? 'Select category';
$message  = $lot['message']  ?? '';
$lot_rate = $lot['lot-rate'] ?? '';
$lot_step = $lot['lot-step'] ?? '';
$lot_date = $lot['lot-date'] ?? '';
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

    <form class="form form--add-lot container <?= isset($errors) ? 'form--invalid' : '' ?>"
        enctype="multipart/form-data" action="add.php" method="post">
        <h2>Adding lot</h2>
        <div class="form__container-two">
            <div class="form__item <?= isset($errors['lot-name']) ? 'form__item--invalid' : '' ?>">
                <label for="lot-name">Name</label>
                <input id="lot-name" type="text" name="lot-name" placeholder="Enter lot name"
                    value="<?= $lot_name ?>" />
                <span class="form__error"><?= $errors['lot-name'] ?? '' ?></span>
            </div>
            <div class="form__item <?= isset($errors['category']) ? 'form__item--invalid' : '' ?>">
                <label for="category">Category</label>
                <select id="category" name="category" required>
                    <option selected>Select category</option>
                    <?php foreach($categories as $key => $value): ?>
                    <option><?=$value['category']?></option>
                    <?php endforeach?>
                </select>
                <span class="form__error"><?= $errors['category'] ?? '' ?></span>
            </div>
        </div>
        <div class="form__item form__item--wide <?= isset($errors['message']) ? 'form__item--invalid' : '' ?>">
            <label for="message">Description</label>
            <textarea id="message" name="message" placeholder="Enter lot description"><?= $message ?></textarea>
            <!-- required -->
            <span class="form__error"><?= $errors['message'] ?? '' ?></span>
        </div>
        <div class="form__item form__item--file <?= isset($errors['file']) ? 'form__item--invalid' : '' ?>">
            <!-- form__item--uploaded -->
            <label>Photo</label>
            <div class="preview">
                <button class="preview__remove" type="button">x</button>
                <div class="preview__img">
                    <img src="img/avatar.jpg" width="113" height="113" alt="Photo of lot" />
                </div>
            </div>
            <div class="form__input-file">
                <input class="visually-hidden" type="file" id="photo2" name="lot-photo" />
                <label for="photo2">
                    <span>+ Add</span>
                </label>
                <span class="form__error"><?= $errors['file'] ?? '' ?></span>
            </div>
        </div>
        <div class="form__container-three">
            <div class="form__item form__item--small <?= isset($errors['lot-rate']) ? 'form__item--invalid' : '' ?>">
                <label for="lot-rate">Start bid</label>
                <input id="lot-rate" type="number" name="lot-rate" placeholder="0" value="<?= $lot_rate ?>" />
                <span class="form__error"><?= $errors['lot-rate'] ?? '' ?></span>
            </div>
            <div class="form__item form__item--small <?= isset($errors['lot-step']) ? 'form__item--invalid' : '' ?>">
                <label for="lot-step">Bid step</label>
                <input id="lot-step" type="number" name="lot-step" placeholder="0" value="<?= $lot_step ?>" />
                <span class="form__error"><?= $errors['lot-step'] ?? '' ?></span>
            </div>
            <div class="form__item <?= isset($errors['lot-date']) ? 'form__item--invalid' : '' ?>">
                <label for="lot-date">Auction final date</label>
                <input class="form__input-date" id="lot-date" type="date" name="lot-date" value="<?= $lot_date ?>" />
                <span class="form__error"><?= $errors['lot-date'] ?? '' ?></span>
            </div>
        </div>
        <span class="form__error form__error--bottom">Please, correct mistakes in your form</span>
        <button type="submit" class="button">Upload lot</button>
    </form>
</main>
