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
    <section class="lot-item container">
        <h2><?= $lots['name'] ?></h2>
        <div class="lot-item__content">
            <div class="lot-item__left">
                <div class="lot-item__image">
                    <img src="<?='./'.$lots['url'] ?>" width="730" height="548" alt="<?= $lots['name'] ?>">
                </div>
                <p class="lot-item__category">Category: <span><?= $lots['category'] ?></span></p>
                <p class="lot-item__description">A parka born in the frigid cold of the Great White North. From Canada
                    to Scandinavia, the Jacket has a winter-adventurer look, with its faux-fur trimmed removable
                    hood, ribbed cuffs, and pockets with snap flaps. Absolutely designed to ride powder, this jacket
                    features our DRYPLAY 10K/10K waterproof membrane that breathes well and keeps you dry in the
                    nastiest conditions, a Teflon EcoElite™ PFC-free water repellent treatment, critically-taped seams
                    to keep moisture out, a Tricot lining to eliminate cold spots, a removable powder skirt that
                    attaches to your pants, as well as Thermal STD 80-gram insulation that keeps you warm and toasty.
                    With the longer cut and look, slide from the slopes to the fireplace in style.</p>
            </div>
            <div class="lot-item__right">
                <div class="lot-item__state">
                    <div class="lot-item__timer timer">
                        10:54:12
                    </div>
                    <div class="lot-item__cost-state">
                        <div class="lot-item__rate">
                            <span class="lot-item__amount">Current price</span>
                            <span class="lot-item__cost"><?= $lots['price'] .' €'?></span>
                        </div>
                        <div class="lot-item__min-cost">
                            Min bid <span><?= $lots['price']+50 ?> €</span>
                        </div>
                    </div>
                    <form class="lot-item__form" action="https://echo.htmlacademy.ru" method="post">
                        <p class="lot-item__form-item">
                            <label for="cost">Your bid</label>
                            <input id="cost" type="number" name="cost" placeholder="><?= $lots['price']+50 ?>">
                        </p>
                        <button type="submit" class="button">Make bid</button>
                    </form>
                </div>
                <div class="history">
                    <h3>Bid history (<span>10</span>)</h3>
                    <table class="history__list">
                        <?php foreach($Bids as $value): ?>
                        <tr class="history__item">
                            <td class="history__name"><?=$value['name']?></td>
                            <td class="history__price"><?=$value['price']?> €</td>
                            <td class="history__time"><?=calculateTimeBids($value['ts'])?></td>
                        </tr>
                        <?php endforeach?>
                    </table>
                </div>
            </div>
        </div>
    </section>
</main>