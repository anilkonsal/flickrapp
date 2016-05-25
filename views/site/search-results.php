<?php

use yii\helpers\Url;

$back_page = $page - 1;
$next_page = $page + 1;
?>
<div class="row">
    <?php
    if ($photos) {
        foreach ($photos as $photo) {
            ?>
            <div class="col-md-3">
                <?php
                $farm_id = $photo->farm;
                $server_id = $photo->server;
                $photo_id = $photo->id;
                $secret_id = $photo->secret;
                $size = 'm';
                $title = $photo->title;

                $photo_url = 'http://farm' . $farm_id . '.staticflickr.com/' . $server_id . '/' . $photo_id . '_' . $secret_id . '_' . $size . '.' . 'jpg';
                ?>
                <a href='<?= Url::to(['site/full-photo', 'photo_id' => $photo_id]) ?>' target="_blank">
                    <img title='<?= $title ?>' src='<?= $photo_url ?>'  class='thumbnail'/>
                </a>
                
            </div>
            <?php
        }
    }
    ?>
</div>

<nav>
    <ul class="pagination">
        <li><a href='<?= Url::to(['site/search', 'q' => $keyword, 'page' => 1]) ?>'> First Page</a></li>
        <?php if ($page > 1) { ?>
            <li><a href='<?= Url::to(['site/search', 'q' => $keyword, 'page' => $back_page]) ?>'>&laquo; Prev</a></li>
            <?php
        }
        if ($page != $page_count) {
            ?>    
            <li><a href='<?= Url::to(['site/search', 'q' => $keyword, 'page' => $next_page]) ?>'>Next &raquo;</a></li>
        <?php } ?>
        <li><a href='<?= Url::to(['site/search', 'q' => $keyword, 'page' => $page_count]) ?>'>Last Page</a></li>

    </ul>
</nav> 




