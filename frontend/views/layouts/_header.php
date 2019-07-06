<v-navigation-drawer v-model="drawer"
                     clipped
                     fixed
                     left
                     app>
    <v-list>
        <v-list-tile>
        {{user.email}}
         </v-list-tile>
        <router-link v-for="(item, index) in menuList"
                     class="nav-list-link"
                     :key="index"
                     tag="v-list-tile"
                     :to="item.url"
                     @click="alert(1)"
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

