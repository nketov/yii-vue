<v-footer app
        height="auto"
        padless
>
    <v-layout
            justify-center
            row
            wrap
            :grey="!preferences.dark"
    >

        <v-btn
                v-for="link in footerMenu.items"
                :key="link"
                color="white"
                flat
                round
        >
            {{ link }}
        </v-btn>
        <v-flex
                grey
                darken-3
                py-3
                text-xs-center
                white--text
                xs12
        >
            &copy;<?= date('Y') ?> &nbsp;&nbsp; <strong>yii-vue</strong>
        </v-flex>
        <v-layout justify-center>
            <v-btn
                    v-for="icon in footerMenu.icons"
                    :key="icon"
                    class="mx-3 white--text"
                    icon
            >
                <v-icon size="24px">{{ icon }}</v-icon>
            </v-btn>
        </v-layout>
    </v-layout>
</v-footer>
