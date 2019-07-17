<?php
$_user = [];
if (!Yii::$app->user->isGuest) {
    $_user = Yii::$app->user->identity->getUserInfo();
}

$_preferences = ['empty' => 1];
if (isset($_COOKIE['preferences'])) {
    $_preferences = unserialize($_COOKIE['preferences'], ["allowed_classes" => false]);
}
?>

<script>
    window._user = <?= json_encode($_user) ?>;

    let _preferences = {
        pageTransition: 'v-fade-transition',
        dark: true,
        cardHeaderColor: '#333',
        cardHeaderTextColor: '#FFC',
    };
    let _php_pref = <?= json_encode($_preferences) ?>;
    if (!_php_pref.empty) {
        _preferences = _php_pref;
    }
    window._preferences = _preferences;
</script>
<style>
    body{
        opacity: 0;
    }
</style>

