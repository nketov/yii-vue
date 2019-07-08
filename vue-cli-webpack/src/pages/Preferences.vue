<template>
    <v-container fluid fill-height>
        <v-layout align-start justify-center wrap>
            <v-flex sm12 md6 xl4 :class="{'px-3': $vuetify.breakpoint.smAndUp}" py-2 m-1>
                <v-card class="elevation-12">
                    <v-toolbar :color="preferences.cardHeaderColor">
                        <v-toolbar-title><h5 :style="{color: preferences.cardHeaderTextColor}">Эффект смены страницы</h5>
                        </v-toolbar-title>
                    </v-toolbar>
                    <v-card-text>
                        <v-radio-group v-model="currentPageTransition">
                            <v-radio
                                    v-for="(item, index) in  pageTransitionList"
                                    :label="item"
                                    :value="index"
                            ></v-radio>
                        </v-radio-group>
                    </v-card-text>
                </v-card>
            </v-flex>
            <v-flex sm12 md6 xl4 :class="{'px-3': $vuetify.breakpoint.smAndUp}" py-2>
                <v-card class="elevation-12">
                    <v-toolbar :color="preferences.cardHeaderColor">
                        <v-toolbar-title><h4 :style="{color: preferences.cardHeaderTextColor}">Мой аватар</h4></v-toolbar-title>
                    </v-toolbar>
                    <v-card-text>
                        <v-radio-group v-model="currentPageTransition">
                            <v-radio
                                    v-for="(item, index) in  pageTransitionList"
                                    :label="item"
                                    :value="index"
                            ></v-radio>
                        </v-radio-group>
                    </v-card-text>
                </v-card>
            </v-flex>
            <v-flex sm12 md6 xl4 :class="{'px-3': $vuetify.breakpoint.smAndUp}" py-2>
                <v-card class="elevation-12">
                    <v-toolbar :color="preferences.cardHeaderColor">
                        <v-toolbar-title><h5 :style="{color: preferences.cardHeaderTextColor}">Цвета заголовков панелей</h5>
                        </v-toolbar-title>
                    </v-toolbar>
                    <v-card-text :class="{'no-padding': $vuetify.breakpoint.smAndDown}">
                        <v-container fluid fill-height>
                            <v-layout align-start justify-center wrap>
                                <v-flex style="width: 250px" :class="{'px-2': $vuetify.breakpoint.smAndUp}" py-2>
                                    <v-label>Цвет фона:</v-label>
                                    <v-layout justify-space-around>
                                        <chrome-picker v-model="currentCardHeaderColor"></chrome-picker>
                                    </v-layout>
                                </v-flex>

                                <v-flex style="width: 250px" :class="{'px-2': $vuetify.breakpoint.smAndUp}" py-2>
                                    <v-label>Цвет текста:</v-label>
                                    <v-layout justify-space-around>
                                        <chrome-picker v-model="currentCardHeaderTextColor"></chrome-picker>
                                    </v-layout>
                                </v-flex>
                            </v-layout>
                        </v-container>
                    </v-card-text>
                </v-card>
            </v-flex>
        </v-layout>
    </v-container>
</template>

<script>
    import {mapActions} from 'vuex';
    import {mapGetters} from 'vuex';
    import {Chrome} from 'vue-color';

    export default {
        data() {
            return {
                pageTransitionList: {
                    'v-scale-transition': 'Scale',
                    'v-fade-transition': 'Fade',
                },
                currentCardHeaderColor: {},
                currentPageTransition: "",
                currentCardHeaderTextColor: {}
            }
        },
        components: {
            'chrome-picker': Chrome
        },
        beforeMount() {

            this.currentPageTransition = this.preferences.pageTransition;
            this.currentCardHeaderColor.hex = this.preferences.cardHeaderColor;
            this.currentCardHeaderTextColor.hex = this.preferences.cardHeaderTextColor;
        },
        watch: {
            currentPageTransition: function (val) {
                this.preferences.pageTransition = val;
            },
            currentCardHeaderColor: function (val) {
                this.preferences.cardHeaderColor = val.hex;
            },
            currentCardHeaderTextColor: function (val) {
                this.preferences.cardHeaderTextColor = val.hex;
            }

        },
        computed: {
            ...mapGetters('menu', {
                preferences: 'preferences'
            })
        },
        methods:{
            test(val){
                console.log(val);
            }
        }

    }
</script>
