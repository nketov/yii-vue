<v-content>
    <v-container fluid>
        <v-layout justify-center align-center>
            <v-flex text-xs-center>
            <transition name="slide" mode="out-in">
                <router-view></router-view>
            </transition>
            </v-flex>
        </v-layout>

    </v-container>
</v-content>


