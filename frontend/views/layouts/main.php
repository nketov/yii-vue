<?php

/* @var $this \yii\web\View */

/* @var $content string */

use frontend\assets\AppAsset;

AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <?php $siteContent=['CONTENT']; ?>
    <?= $this->render('_head.php', compact('siteContent')) ?>



    <!--    --><?//= $this->render('_head.php', compact('siteContent')) ?>
    <?php $this->registerCsrfMetaTags() ?>
    <?php $this->head() ?>
    <link href='https://fonts.googleapis.com/css?family=Roboto:100,300,400,500,700,900|Material+Icons' rel="stylesheet">

</head>
<body>
<?php $this->beginBody() ?>

<?php $siteContent=['CONTENT']; ?>
<?= $this->render('app.php', compact('siteContent')) ?>


<!--<footer class="footer">-->
<!--    <div class="container">-->
<!--        <p class="pull-left">&copy; My Company --><?//= date('Y') ?><!--</p>-->
<!---->
<!--        <p class="pull-right">Powered by <a href="http://www.yiiframework.com/" rel="external">Yii Framework</a></p>-->
<!--    </div>-->
<!--</footer>-->

<?php $this->endBody() ?>
</body>


</html>
<?php $this->endPage() ?>
