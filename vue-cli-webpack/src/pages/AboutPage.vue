<template>
    <v-container fluid fill-height>
        <v-layout align-start justify-center wrap>
            <v-flex xs12>
                <div class="itemapp" v-if="slides[0]">
                    <div class="partapp text">
                        <h2 style="text-align: left; padding: 10px">
                            Наши проекты
                        </h2>
                        <text-slide>
                            <div class="innerapp" :key="activeSlide">
                                <div class="centered">
                                    <h1>{{ activeItem.title }}</h1>
                                    <h3 :style="descriptionColor">{{ activeItem.description }}</h3>
                                    <h6>Смотреть по прямой ссылке</h6>
                                    <h5><a :href="activeItem.link">{{ activeItem.link }}</a></h5>
                                    <button :style="buttonColor" @click="nextSlide"><i class="fa fa-play"></i></button>
                                </div>
                            </div>
                        </text-slide>
                    </div>
                    <div class="partapp image" @click="nextSlide">
                        <image-slide>
                            <div class="image-slideapp" :style="slideImageapp" :key="activeSlide"></div>
                        </image-slide>
                    </div>
                    <div class="about-footer">
                        <div class="paginator1" @click="nextSlide">
                            {{ activeSlide+1 }} из {{ slides.length }}
                            <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
                                 version="1.1" viewBox="0 0 28 10">
                                <g>
                                    <g transform="translate(1147 -1004)">
                                        <use fill="#303030" transform="translate(-1147 1004)"
                                             xlink:href="#path0_fill"/>
                                    </g>
                                </g>
                                <defs>
                                    <path id="path0_fill"
                                          d="M27.9 4.309l-2.5-4.1c-.1-.2-.4-.3-.6-.1-.2.1-.3.4-.2.6l2 3.4H.5c-.3-.1-.5.1-.5.4 0 .2.2.5.5.5h26.1l-2.1 3.4c-.1.2-.1.5.2.6h.3c.2 0 .3-.1.4-.2l2.5-4.1c.1-.1.1-.3 0-.4z"/>
                                </defs>
                            </svg>
                        </div>
                        <!--<div class="social">-->
                        <!--<ul>-->
                        <!--<li><i class="fa fa-heart-o"></i><span :data-like="activeItem.social.like">{{ activeItem.social.like }}</span>-->
                        <!--</li>-->
                        <!--<li><i class="fa fa-eye"></i><span :data-visit="activeItem.social.visit">{{ activeItem.social.visit }}</span>-->
                        <!--</li>-->
                        <!--<li><i class="fa fa-comment-o"></i><span-->
                        <!--:data-comment="activeItem.social.comment">{{ activeItem.social.comment }}</span>-->
                        <!--</li>-->
                        <!--</ul>-->
                        <!--</div>-->
                    </div>
                </div>
            </v-flex>
        </v-layout>
    </v-container>
</template>

<script>

    import ImageSlide from '../components/ImageSlide';
    import TextSlide from '../components/TextSlide';
    import {mapGetters} from 'vuex';

    export default {
        data: function data() {
            return {
                activeSlide: 0,
            };
        },

        computed: {
            ...mapGetters('projects', {
                projects: 'projects'
            }),
            ...mapGetters('user', {
                user: 'user'
            }),

            slides: function slides() {
                return this.projects;
            },

            slideImageapp() {
                return {
                    backgroundImage: 'url("/images/projects/' + this.slides[this.activeSlide].image + '")'
                };
            },
            activeItem() {
                return this.slides[this.activeSlide];

            },
            buttonColor() {
                return {
                    backgroundColor: this.slides[this.activeSlide].color
                };
            },
            descriptionColor() {
                return {
                    color: this.slides[this.activeSlide].color
                };
            }
        },
        methods: {
            nextSlide() {
                if (this.activeSlide >= this.slides.length - 1) {
                    this.activeSlide = 0;
                } else {
                    this.activeSlide++;
                }
            }
        },
        components: {
            TextSlide,
            ImageSlide
        }
    }
</script>
