<v-navigation-drawer v-model="drawer"
                     clipped
                     fixed
                     left
                     app>
    <v-list>
        <router-link v-for="(item, index) in menuList"
                     :key="index"
                     tag="v-list-tile"
                     :to="item.url"
                     active-class="active"
        >
            <v-list-tile-action>
                <v-icon>settings</v-icon>
            </v-list-tile-action>
            <v-list-tile-content>
                <v-list-tile-title><a>{{ item.text }}</a></v-list-tile-title>
            </v-list-tile-content>

        </router-link>
    </v-list>

</v-navigation-drawer>

<v-toolbar app fixed clipped-left>
    <v-toolbar-side-icon @click.stop="drawer = !drawer"></v-toolbar-side-icon>
    <v-toolbar-title>
        <router-link to="/" class="navbar-brand">yii-vue</router-link>
    </v-toolbar-title>
</v-toolbar>

