<v-footer app
        height="auto"
        color="grey darken-3"
        padless
>
    <v-layout
            justify-center
            row
            wrap
    >
        <v-btn
                v-for="link in footerMenu"
                :key="link"
                color="white"
                flat
                round
        >
            {{ link }}
        </v-btn>
        <v-flex
                grey
                darken-4
                py-3
                text-xs-center
                white--text
                xs12
        >
            &copy;<?= date('Y') ?> &nbsp;&nbsp; <strong>yii-vue</strong>
        </v-flex>
    </v-layout>
</v-footer>
