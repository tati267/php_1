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
    <form class="form container" action="https://echo.htmlacademy.ru" method="post">
        <!-- form--invalid -->
        <h2>Register new accaunt</h2>
        <div class="form__item">
            <!-- form__item--invalid -->
            <label for="email">E-mail*</label>
            <input id="email" type="text" name="email" placeholder="Insert e-mail" required>
            <span class="form__error">Insert e-mail</span>
        </div>
        <div class="form__item">
            <label for="password">Password*</label>
            <input id="password" type="text" name="password" placeholder="Insert e-mail" required>
            <span class="form__error">Insert password</span>
        </div>
        <div class="form__item">
            <label for="name">Name*</label>
            <input id="name" type="text" name="name" placeholder="Insert your name" required>
            <span class="form__error">Your name</span>
        </div>
        <div class="form__item">
            <label for="message">Contact details*</label>
            <textarea id="message" name="message" placeholder="Your contact details" required></textarea>
            <span class="form__error">Your contact details</span>
        </div>
        <div class="form__item form__item--file form__item--last">
            <label>Your photo</label>
            <div class="preview">
                <button class="preview__remove" type="button">x</button>
                <div class="preview__img">
                    <img src="img/avatar.jpg" width="113" height="113" alt="Your photo">
                </div>
            </div>
            <div class="form__input-file">
                <input class="visually-hidden" type="file" id="photo2" value="">
                <label for="photo2">
                    <span>+ Add</span>
                </label>
            </div>
        </div>
        <span class="form__error form__error--bottom">Please correct mistakes in the form.</span>
        <button type="submit" class="button">Register</button>

        <a class="text-link" href="#">Already have this accaunt</a>
    </form>
</main>