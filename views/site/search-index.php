<?php
/* @var $this yii\web\View */

$this->title = 'Search Flickr';
?>
<div class="site-index">

    <div class="jumbotron">
        <h2>Search Flickr!</h2>
        <p class="lead">Enter keywords here to search images</p>
        <form class="form" method="get" action="<?= yii\helpers\Url::to(['site/search']) ?>">
            <div class="row">
                <div class="col-md-1"></div>
                <div class="col-md-7">
                    <input type="text" class="form-control input-lg" name='q' id='q'>
                </div>
                <div class="col-md-4 text-left">
                    <input type="submit" class="btn btn-lg btn-success" href="#" value='Search'>
                </div>
            </div>
        </form>

        <p>
        <h4>Recent Searches:</h4>
        <div id="recent-searches">
            <?php
            if ($recentSearches) {
                foreach ($recentSearches as $term) {
                    ?>
                    <a href='<?= \yii\helpers\Url::to(['site/search', 'q' => $term]) ?>'><?= $term ?></a>
                    <?php
                }
            }
            ?>
        </div>
        </p>
    </div>

    <div class="body-content">

        <div class="row">
            <div class="col-lg-4">
                <h2>Heading</h2>

                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et
                    dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip
                    ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu
                    fugiat nulla pariatur.</p>

                <p><a class="btn btn-default" href="http://www.yiiframework.com/doc/">Yii Documentation &raquo;</a></p>
            </div>
            <div class="col-lg-4">
                <h2>Heading</h2>

                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et
                    dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip
                    ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu
                    fugiat nulla pariatur.</p>

                <p><a class="btn btn-default" href="http://www.yiiframework.com/forum/">Yii Forum &raquo;</a></p>
            </div>
            <div class="col-lg-4">
                <h2>Heading</h2>

                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et
                    dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip
                    ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu
                    fugiat nulla pariatur.</p>

                <p><a class="btn btn-default" href="http://www.yiiframework.com/extensions/">Yii Extensions &raquo;</a></p>
            </div>
        </div>

    </div>
</div>
