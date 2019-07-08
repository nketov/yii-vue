
<div class="wrap" id="app">
    <v-app :dark="preferences.dark">
        <?= $this->render('_header.php') ?>
        <?= $this->render('_content.php') ?>
        <?= $this->render('_footer.php') ?>
    </v-app>
</div>