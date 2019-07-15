<v-footer app
          height="auto"
          padless
>
    <v-hover>
        <v-layout @
                  justify-center
                  row
                  wrap
                  :grey="!preferences.dark"
                  slot-scope="{ hover }"
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
            <v-slide-y-reverse-transition>
                <v-flex justify-center v-show="hover"
                        grey
                        darken-3
                        py-3
                        text-xs-center
                        white--text
                        xs12
                >
                     &nbsp;&nbsp; <strong>Ukrdeveloper.pro</strong>&nbsp;&copy;&nbsp;<?= date('Y') ?>
                </v-flex>
            </v-slide-y-reverse-transition>
            <v-slide-y-reverse-transition>
                <v-layout justify-center v-show="hover">
                    <v-btn
                            v-for="icon in footerMenu.icons"
                            :key="icon"
                            class="mx-3 white--text"
                            icon
                    >
                        <v-icon size="24px">{{ icon }}</v-icon>
                    </v-btn>
                </v-layout>
            </v-slide-y-reverse-transition>
        </v-layout>
        <v-hover>
</v-footer>
