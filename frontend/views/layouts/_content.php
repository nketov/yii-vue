<v-content>
    <v-container fluid>
        <v-layout justify-center align-center>
            <v-flex text-xs-center>
                <component :is="preferences.pageTransition" mode="out-in">
                    <router-view></router-view>
                </component>
            </v-flex>
        </v-layout>
    </v-container>
</v-content>


