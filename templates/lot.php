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
    <section class="lot-item container">
        <h2><?= $lots['LotName'] ?></h2>
        <div class="lot-item__content">
            <div class="lot-item__left">
                <div class="lot-item__image">
                    <img src="<?='./'.$lots['LotImgUrl'] ?>" width="730" height="548" alt="<?= $lots['LotName'] ?>">
                </div>
                <p class="lot-item__category">Category: <span><?= $lots['CategoryName'] ?></span></p>
                <p class="lot-item__description"><?= $lots['LotDescription'] ?></p>
            </div>
            <div class="lot-item__right">
                <div class="lot-item__state">
                    <div class="lot-item__timer timer">
                        10:54:12
                    </div>
                    <div class="lot-item__cost-state">
                        <div class="lot-item__rate">
                            <span class="lot-item__amount">Current price</span>
                            <span class="lot-item__cost"><?= $lots['LotPrice'] .' €'?></span>
                        </div>
                        <div class="lot-item__min-cost">
                            Min bid <span><?= $lots['LotStartPrice'] ?> €</span>
                        </div>
                    </div>
                    <?php if ($is_auth): ?>
                    <form class="lot-item__form" action="https://echo.htmlacademy.ru" method="post">
                        <p class="lot-item__form-item">
                            <label for="cost">Your bid</label>
                            <input id="cost" type="number" name="cost" placeholder="><?= $lots['LotStartPrice'] ?>">
                        </p>
                        <button type="submit" class="button">Make bid</button>
                    </form>
                    <?php endif; ?>
                </div>
                <div class="history">
                    <h3>Bid history <?= $bidsQuantity ?></h3>
                    <table class="history__list">
                        <?php foreach($bids as $key => $value): ?>
                        <tr class="history__item">
                            <td class="history__name"><?=$value['UserName']?></td>
                            <td class="history__price"><?=$value['BidPrice']?> €</td>
                            <td class="history__time"><?=$value['BidDate']?></td>
                        </tr>
                        <?php endforeach?>
                    </table>
                </div>
            </div>
        </div>
    </section>
</main>