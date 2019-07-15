<v-navigation-drawer v-model="drawer"
                     clipped
                     fixed
                     left
                     app>
    <v-list>

        <v-toolbar flat class="transparent" v-if="user.id">
            <v-list class="pa-0">
                <v-scale-transition appear mode="out-in">
                    <v-list-tile avatar>
                        <v-list-tile-avatar v-if="user.id">
                            <img :src="'/images/avatars/'+ user.avatar" v-if="user.avatar">
                            <img src="/images/avatars/def_user.png" v-else>
                        </v-list-tile-avatar>

                        <v-list-tile-content>
                            <v-list-tile-title>{{user.email}}</v-list-tile-title>
                        </v-list-tile-content>
                    </v-list-tile>
                </v-scale-transition>
            </v-list>
        </v-toolbar>

        <v-slide-x-transition appear mode="out-in">
            <router-link class="nav-list-link"
                         :key="101"
                         tag="v-list-tile"
                         to="/login"
                         v-if="!user.id"
            >
                <v-list-tile-action>
                    <v-icon>input</v-icon>
                </v-list-tile-action>
                <v-list-tile-content>
                    <v-list-tile-title class="subheading">Вход</v-list-tile-title>
                </v-list-tile-content>
            </router-link>


            <router-link class="nav-list-link"
                         :key="102"
                         tag="v-list-tile"
                         to="/logout"
                         v-else
            >
                <v-list-tile-action>
                    <v-icon>keyboard_backspace</v-icon>
                </v-list-tile-action>
                <v-list-tile-content>
                    <v-list-tile-title class="subheading">Выход</v-list-tile-title>
                </v-list-tile-content>
            </router-link>
        </v-slide-x-transition>
        <v-divider></v-divider>


        <router-link v-for="(item, index) in menuList"
                     class="nav-list-link"
                     :key="index"
                     tag="v-list-tile"
                     :to="item.url"
        >
            <v-list-tile-action>
                <v-icon>{{item.icon}}</v-icon>
            </v-list-tile-action>
            <v-list-tile-content>
                <v-list-tile-title class="subheading">{{ item.text }}</v-list-tile-title>
            </v-list-tile-content>
        </router-link>
    </v-list>

</v-navigation-drawer>

<v-toolbar app fixed clipped-left>
    <v-toolbar-side-icon @click.stop="drawer = !drawer"></v-toolbar-side-icon>
    <v-toolbar-title class="hidden-xs-only">
        <v-menu :nudge-width="100">
            <template v-slot:activator="{ on }">
                <v-toolbar-title v-on="on">
                    <span>Ukrdeveloper.pro</span>
                    <v-icon dark>arrow_drop_down</v-icon>
                </v-toolbar-title>
            </template>
            <v-list>

                <router-link v-for="(item, index) in menuList"
                             :key="index"
                             tag="v-list-tile"
                             :to="item.url"
                >
                    <v-list-tile-title v-text="item.text"></v-list-tile-title>
                </router-link>

            </v-list>
        </v-menu>

    </v-toolbar-title>
    <v-spacer></v-spacer>
    <v-btn icon>
        <v-icon>search</v-icon>
    </v-btn>
    <v-btn icon @click="$router.go()">
        <v-icon>refresh</v-icon>
    </v-btn>
    <v-btn icon @click="changeDark">
        <v-icon :color="preferences.dark ? 'white': 'black'">wb_sunny
        </v-icon>
    </v-btn>
    <v-divider vertical v-if="user.avatar" class="hidden-xs-only"></v-divider>
    <v-slide-x-reverse-transition appear>
        <v-avatar v-if="user.avatar" class="hidden-xs-only" style="margin-left: 10px">
            <img :src="'/images/avatars/'+ user.avatar">
        </v-avatar>
    </v-slide-x-reverse-transition>

</v-toolbar>

