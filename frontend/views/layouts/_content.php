<v-content>
    <v-container fluid>
        <v-layout justify-center align-center>
            <v-flex text-xs-center>
                <component
                        :is="chooseTransitionComponentType(preferences.pageTransition)"
                        :name="chooseTransitionName(preferences.pageTransition)"
                        mode="out-in"
                        appear>
                    <router-view></router-view>
                </component>
            </v-flex>
        </v-layout>
    </v-container>
</v-content>


