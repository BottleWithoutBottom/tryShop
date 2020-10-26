<?
/** $categories @array */
if (count($categories)): ?>
    <div class="row categories-list">
        <? foreach($categories as $category): ?>
            <div class="col col-4 category-card">
                <div class="header">
                    <div class="img-block">
                        <img class="picture" src="<?= g_ROOT ?>local/img/cake.png" alt="">
                    </div>
                    <span><?=$category->TITLE?></span>
                </div>

                <div class="content">
                    <p><?= $category->DESCRIPTION ?></p>
                    <a href="<?= $category->link ?>" class="bordered-button">Перейти</a>
                </div>
            </div>
        <? endforeach; ?>
    </div>
<? endif; ?>