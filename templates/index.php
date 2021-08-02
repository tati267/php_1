<section class="promo">
    <h2 class="promo__title">Looking for a snowsport equipment?</h2>
    <p class="promo__text">On our auction you will find exclusive equipment for snowboarding and skiing!</p>
    <ul class="promo__list">
        <?php foreach($categories as $value): ?>
        <li class="promo__item promo__item--'<?=$value['class']?>'">
            <a class="promo__link" href="all-lots.html"><?=$value['category']?></a>
        </li>
        <?php endforeach; ?>
    </ul>
</section>
<section class="lots">
    <div class="lots__header">
        <h2>Open lots</h2>
    </div>
    <ul class="lots__list">
        <?php foreach($lots as $item => $value): ?>
        <li class="lots__item lot">
            <div class="lot__image">
                <img src="<?=$value['url']?>" width="350" height="260" alt="<?=$value['category']?>">
            </div>
            <div class="lot__info">
                <span class="lot__category"><?=$value['category']?></span>
                <h3 class="lot__title"><a class="text-link" href="<?= "lot.php?lot_id=$item" ?>"><?=$value['name']?></a>
                </h3>
                <div class="lot__state">
                    <div class="lot__rate">
                        <span class="lot__amount">Start price</span>
                        <span class="lot__cost"><?=calculatePrice($value['price']).' €'?></span>
                    </div>
                    <div class="lot__timer timer"><?=calculateTimer();?></div>
                </div>
            </div>
        </li>
        <?php endforeach; ?>
    </ul>
</section>