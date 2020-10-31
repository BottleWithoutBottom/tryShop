<?

$colors = [
        'red',
        'green',
        'purple'
];
/** @var array $categories*/
if (count($categories)): ?>
    <div class="row categories-list">
        <?$i = 0;
        foreach($categories as $category): ?>
            <div class="col col-4 category-card js-category-card <?= $colors[$i] ?>">
                <div class="wrapper js-wrapper">
                    <div class="header">
                        <div class="img-block">
                            <img class="picture" src="<?= g_ROOT ?>local/img/cake.png" alt="">
                        </div>
                        <span><?=$category->TITLE?></span>
                    </div>

                    <div class="content">
                        <p><?= $category->DESCRIPTION ?></p>
                        <a href="<?= $category->link ?>" class="bordered-button">Перейти</a>

                        <div class="links">
                            <? foreach ($category->children as $subCategory): ?>
                                <a href="javascript:void(0)"><?= $subCategory->NAME ?></a>
                            <? endforeach; ?>
                        </div>
                    </div>
                </div>
            </div>
        <?$i ++;
        endforeach; ?>
    </div>
<? endif; ?>