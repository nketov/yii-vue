<v-navigation-drawer v-model="drawer"
                     clipped
                     fixed
                     left
                     app>
    <v-list>
        <v-toolbar flat class="transparent" v-if="user.id">
            <v-list class="pa-0">
                <v-list-tile avatar>
                    <v-list-tile-avatar>
                        <img :src="'/images/avatars/'+ user.avatar" v-if="user.avatar">
                        <img src="/images/avatars/def_user.png" v-else>
                    </v-list-tile-avatar>

                    <v-list-tile-content>
                        <v-list-tile-title>{{user.email}}</v-list-tile-title>
                    </v-list-tile-content>
                </v-list-tile>
            </v-list>
        </v-toolbar>

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
    <v-toolbar-title>
        <v-btn flat>
            <router-link to="/" class="headline font-weight-bold">yii-vue</router-link>
        </v-btn>
    </v-toolbar-title>
    <v-spacer></v-spacer>
    <v-btn icon>
        <v-icon :color="dark ? 'white': 'black'" @click="dark = !dark">wb_sunny</v-icon>
    </v-btn>

</v-toolbar>

