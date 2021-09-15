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
        <h2><?= $lot['LotName'] ?></h2>
        <div class="lot-item__content">
            <div class="lot-item__left">
                <div class="lot-item__image">
                    <img src="<?='./'.$lot['LotImgUrl'] ?>" width="730" height="548" alt="<?= $lot['LotName'] ?>">
                </div>
                <p class="lot-item__category">Category: <span><?= $lot['CategoryName'] ?></span></p>
                <p class="lot-item__description"><?= $lot['LotDescription'] ?></p>
            </div>
            <div class="lot-item__right">
                <div class="lot-item__state">
                    <div class="lot-item__timer timer">
                        10:54:12
                    </div>
                    <div class="lot-item__cost-state">
                        <div class="lot-item__rate">
                            <span class="lot-item__amount">Current price</span>
                            <span class="lot-item__cost"><?= $lot['LotPrice'] .' €'?></span>
                        </div>
                        <div class="lot-item__min-cost">
                            Min bid <span><?= $lot['LotPrice'] + $lot['LotStepBid']?> €</span>
                        </div>
                    </div>
                    <?php if ($is_auth): ?>
                    <form class="lot-item__form" action="lot.php" method="post">
                        <p class="lot-item__form-item">
                            <label for="cost">Your bid</label>
                            <input id="cost" type="number" name="cost"
                                min="<?= $lot['LotPrice'] + $lots['LotStepBid']?>"
                                placeholder="<?= $lot['LotPrice'] + $lot['LotStepBid']?>">
                        </p>
                        <button type="submit" class="button">Make bid</button>
                    </form>
                    <?php endif; ?>
                </div>
                <div class="history">
                    <h3>Bid history <?= $bidsQuantity ?></h3>
                    <?php if ($bidsQuantity>0): ?>
                    <table class="history__list">
                        <?php foreach($bids as $key => $value): ?>
                        <tr class="history__item">
                            <td class="history__name"><?=$value['UserName']?></td>
                            <td class="history__price"><?=$value['BidPrice']?> €</td>
                            <td class="history__time"><?=calculate_TimeBids($value['BidDateTime'])?></td>
                        </tr>
                        <?php endforeach?>
                    </table>
                    <?php endif?>
                </div>
            </div>
        </div>
    </section ection>
</main>
