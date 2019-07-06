<?php

/* @var $this \yii\web\View */

/* @var $content string */

use common\models\Content;
use frontend\assets\AppAsset;

AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <?php $siteContent = Content::findOne(1); ?>
    <?= $this->render('_head.php', compact('siteContent')) ?>
    <?php $this->registerCsrfMetaTags() ?>
    <link href='https://fonts.googleapis.com/css?family=Roboto:100,300,400,500,700,900|Material+Icons' rel="stylesheet">
    <?php $this->head() ?>
</head>
<body>
<?php
$_yii_user = (object)[];
if (!Yii::$app->user->isGuest) {
    $_yii_user = (object)array('id' => Yii::$app->user->identity->id, 'email' => Yii::$app->user->identity->email);
} ?>
<script>
    window._PHP_user = <?= json_encode($_yii_user) ?>  ;
</script>
<?php $this->beginBody() ?>
<?= $this->render('app.php', compact('siteContent')) ?>
<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
