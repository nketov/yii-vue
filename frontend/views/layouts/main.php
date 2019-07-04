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
    <meta charset="<?= Yii::$app->charset ?>">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?php $this->registerCsrfMetaTags() ?>
<!--    <title>--><?//= Html::encode($this->title) ?><!--</title>-->
    <?php $this->head() ?>
</head>
<body>
<?php $this->beginBody() ?>

<div class="wrap" id="app">
    <nav id="w0" class="navbar-inverse navbar-fixed-top navbar">
        <div class="container">
            <div class="navbar-header">
                <router-link to="/" class="navbar-brand">yii-vue</router-link>


            </div>

            <div id="w0-collapse" class="collapse navbar-collapse">


                <ul class="navbar-nav navbar-right nav">
                    <router-link v-for="(item, index) in menuList"
                                 :key="index"
                                 :to="item.url"
                                 tag="li"
                                 active-class="active"
                    >
                        <a>{{ item.text }}</a>
                    </router-link>
                </ul>

            </div>
        </div>
    </nav>
    <div class="container">
        <transition name="slide" mode="out-in">
            <router-view></router-view>
        </transition>
    </div>
</div>


<footer class="footer">
    <div class="container">
        <p class="pull-left">&copy; My Company <?= date('Y') ?></p>

        <p class="pull-right">Powered by <a href="http://www.yiiframework.com/" rel="external">Yii Framework</a></p>
    </div>
</footer>

<?php $this->endBody() ?>
</body>



</html>
<?php $this->endPage() ?>
