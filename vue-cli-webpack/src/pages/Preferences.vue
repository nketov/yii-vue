<template>
    <v-container fluid fill-height>
        <v-layout align-start justify-center wrap>
            <v-flex sm12 md6 xl4 :class="{'px-3': $vuetify.breakpoint.smAndUp}" py-2 v-if="user.id">
                <v-card class="elevation-12">
                    <v-toolbar :color="preferences.cardHeaderColor">
                        <v-toolbar-title><h4 :style="{color: preferences.cardHeaderTextColor}">Мой аватар</h4>
                        </v-toolbar-title>
                    </v-toolbar>
                    <v-card-text>
                        <img :src="imageUrl" height="150" v-if="imageUrl"/>
                        <v-text-field label="Выберите изображение" @click='pickFile' v-model='imageName' prepend-icon='attach_file'></v-text-field>
                        <input
                                type="file"
                                style="display: none"
                                ref="image"
                                accept="image/*"
                                @change="onFilePicked"
                        >
                    </v-card-text>
                </v-card>
            </v-flex>
            <v-flex sm12 md6 xl4 :class="{'px-3': $vuetify.breakpoint.smAndUp}" py-2 m-1>
                <v-card class="elevation-12">
                    <v-toolbar :color="preferences.cardHeaderColor">
                        <v-toolbar-title><h5 :style="{color: preferences.cardHeaderTextColor}">Эффект смены
                            страницы</h5>
                        </v-toolbar-title>
                    </v-toolbar>
                    <v-card-text>
                        <v-radio-group :value="preferences.pageTransition"  wrap>
                                <v-radio
                                        @change="savePageTransition($event)"
                                        v-for="(item, index) in  pageTransitionList"
                                        :label="item"
                                        :value="index"
                                        :key="index"
                                ></v-radio>
                        </v-radio-group>
                    </v-card-text>
                </v-card>
            </v-flex>
            <v-flex sm12 md6 xl4 :class="{'px-3': $vuetify.breakpoint.smAndUp}" py-2>
                <v-card class="elevation-12">
                    <v-toolbar :color="preferences.cardHeaderColor">
                        <v-toolbar-title><h5 :style="{color: preferences.cardHeaderTextColor}">Цвета заголовков
                            панелей</h5>
                        </v-toolbar-title>
                    </v-toolbar>
                    <v-card-text :class="{'no-padding': $vuetify.breakpoint.smAndDown}">
                        <v-container fluid fill-height>
                            <v-layout align-start justify-center wrap>
                                <v-flex style="width: 250px" :class="{'px-2': $vuetify.breakpoint.smAndUp}" py-2>
                                    <v-label>Цвет фона:</v-label>
                                    <v-layout justify-space-around>
                                        <chrome-picker :value="{hex:preferences.cardHeaderColor}" @input="saveCardHeaderColor($event)"></chrome-picker>
                                    </v-layout>
                                </v-flex>

                                <v-flex style="width: 250px" :class="{'px-2': $vuetify.breakpoint.smAndUp}" py-2>
                                    <v-label>Цвет текста:</v-label>
                                    <v-layout justify-space-around>
                                        <chrome-picker :value="{hex:preferences.cardHeaderTextColor}" @input="saveCardHeaderTextColor($event)"></chrome-picker>
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
                    'a-slide': 'Поворот',
                    'a-slide-x': 'Переворот',
                    'v-scale-transition': 'Размер',
                    'v-fade-transition': 'Прозрачность',
                    // 'v-expand-transition': 'Разворот',  //CRASH
                    'v-scroll-x-transition': 'Скролл слева',
                    'v-scroll-x-reverse-transition': 'Скролл справа',
                    'v-scroll-y-transition': 'Скролл сверху',
                    'v-scroll-y-reverse-transition': 'Скролл снизу',
                    'v-slide-x-transition': 'Слайд слева',
                    'v-slide-x-reverse-transition': 'Слайд справа',
                    'v-slide-y-transition': 'Слайд сверху',
                    'v-slide-y-reverse-transition': 'Слайд снизу',

                },
                imageName: '',
                imageUrl: '',
                imageFile: ''
            }
        },
        mounted (){
            this.imageUrl= '/images/avatars/' + this.user.avatar;
        },
        components: {
            'chrome-picker': Chrome
        },
        computed: {
            ...mapGetters('menu', {
                preferences : 'preferences'
            }),
            ...mapGetters('user', {
                user: 'user'
            })
        },
        methods: {
            ...mapActions('menu', {
                setPageTransition: 'setPageTransition',
                setCardHeaderColor:'setCardHeaderColor',
                setCardHeaderTextColor : 'setCardHeaderTextColor'
            }),
            ...mapActions('user', {
                saveAvatar : 'saveAvatar'
            }),
            savePageTransition(val){
                this.setPageTransition(val);
            },
            saveCardHeaderColor(val){
                this.setCardHeaderColor(val.hex);
            },
            saveCardHeaderTextColor(val){
                this.setCardHeaderTextColor(val.hex);
            },
            pickFile () {
                this.$refs.image.click ()
            },

            onFilePicked (e) {
                const files = e.target.files;
                if(files[0] !== undefined) {
                    this.imageName = files[0].name;
                    if(this.imageName.lastIndexOf('.') <= 0) {
                        return
                    }
                    const fr = new FileReader ();
                    fr.readAsDataURL(files[0]);
                    fr.addEventListener('load', () => {
                        this.imageUrl = fr.result;
                        this.imageFile = files[0];
                        this.saveAvatar(files[0]);
                    })
                } else {
                    this.imageName = '';
                    this.imageFile = '';
                    this.imageUrl = '';
                }
            }
        },


    }
</script>

