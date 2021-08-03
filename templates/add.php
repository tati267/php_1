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
    <form class="form form--add-lot container form--invalid" action="./add.php" method="post">
        <!-- form--invalid -->
        <h2>Adding lot</h2>
        <div class="form__container-two">
            <div class="form__item form__item--invalid">
                <!-- form__item--invalid -->
                <label for="lot-name">Name</label>
                <input id="lot-name" type="text" name="lot-name" placeholder="Name your lot" required>
                <span class="form__error">Name your lot</span>
            </div>
            <div class="form__item">
                <label for="category">Category</label>
                <select id="category" name="category" required>
                    <option>Choose category</option>
                    <?php foreach($categories as $key => $value): ?>
                    <option><?=$value['category']?></option>
                    <?php endforeach?>
                </select>
                <span class="form__error">Choose category</span>
            </div>
        </div>
        <div class="form__item form__item--wide">
            <label for="message">Description</label>
            <textarea id="message" name="message" placeholder="Describe your lot" required></textarea>
            <span class="form__error">Describe your lot</span>
        </div>
        <div class="form__item form__item--file">
            <!-- form__item--uploaded -->
            <label>Photo</label>
            <div class="preview">
                <button class="preview__remove" type="button">x</button>
                <div class="preview__img">
                    <img src="img/avatar.jpg" width="113" height="113" alt="Lot photo">
                </div>
            </div>
            <div class="form__input-file">
                <input class="visually-hidden" type="file" id="photo2" value="">
                <label for="photo2">
                    <span>+ Add</span>
                </label>
            </div>
        </div>
        <div class="form__container-three">
            <div class="form__item form__item--small">
                <label for="lot-rate">Start price</label>
                <input id="lot-rate" type="number" name="lot-rate" placeholder="0" required>
                <span class="form__error">Insert start price</span>
            </div>
            <div class="form__item form__item--small">
                <label for="lot-step">Bid step</label>
                <input id="lot-step" type="number" name="lot-step" placeholder="0" required>
                <span class="form__error">Bid step</span>
            </div>
            <div class="form__item">
                <label for="lot-date">Finish date for bids</label>
                <input class="form__input-date" id="lot-date" type="date" name="lot-date" required>
                <span class="form__error">Insert finish date for making bids</span>
            </div>
        </div>
        <span class="form__error form__error--bottom">Please, correct mistakes in form</span>
        <button type="submit" class="button">Submit lot</button>
    </form>
</main>