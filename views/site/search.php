<?php
/* @var $this yii\web\View */

$this->title = 'Search Results';
?>

<h1>Search Results</h1>
<div id="results-container">

</div>


<?php $this->beginBlock('scripts') ?>
<script type="text/javascript">
    $(function () {
        $.ajax({
            url: '<?= yii\helpers\Url::to(['site/search-results', 'keyword' => $keyword, 'page' => $page]) ?>',
            beforeSend: function () {
                $('#results-container').block({'message': '<img src="<?= yii\helpers\Url::to('@web/img/ajax-loader.gif') ?>" >'});
            },
            type: 'json',
            success: function (data) {
                $('#results-container').html(data);
            }
        })

    })
</script>
<?php $this->endBlock() ?>
