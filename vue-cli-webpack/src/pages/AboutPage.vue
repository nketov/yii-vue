<template>
    <div class="container">
        <div id="appp" class="containerabout">
            <!-- Navigation section  -->


            <div class="itemapp">

                <div class="partapp image" @click="nextSlide">
                    <image-slide>
                        <div class="image-slideapp" :style="slideImageapp" :key="activeSlide"></div>
                    </image-slide>
                </div>
                <div class="partapp text">
                    <text-slide>
                        <div class="innerapp" :key="activeSlide">
                            <div class="brand">
                                Наши проекты
                            </div>
                            <div class="centered">
                                <h1>{{ activeItem.title }}</h1>
                                <h3 :style="descriptionColor">{{ activeItem.description }}</h3>
                                <h6>{{ activeItem.creditTitle }}</h6>
                                <h5><a :href="activeItem.credit">{{ activeItem.credit }}<a></h5>
                                <button :style="buttonColor" @click="nextSlide"><i class="fa fa-play"></i></button>
                            </div>
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
                            <div class="social">
                                <ul>
                                    <li><i class="fa fa-heart-o"></i><span :data-like="activeItem.social.like">{{ activeItem.social.like }}</span>
                                    </li>
                                    <li><i class="fa fa-eye"></i><span :data-visit="activeItem.social.visit">{{ activeItem.social.visit }}</span>
                                    </li>
                                    <li><i class="fa fa-comment-o"></i><span :data-comment="activeItem.social.comment">{{ activeItem.social.comment }}</span>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </text-slide>
                </div>
            </div>
        </div>
    </div>
</template>

<script>

    import ImageSlide from '../components/ImageSlide';
    import TextSlide from '../components/TextSlide';

    export default {
        data: function data() {
            return {
                activeSlide: 0,
                slides: [
                    {
                        title: 'Онлайн-биржа страховок',
                        description: 'Вы выбираете из нескольких предложений прямо на онлайн бирже где представлены многие страховые компании.',
                        creditTitle: 'Смотреть по прямой ссылке',
                        credit: 'http://epolis.shop',
                        image: '/images/projects/epolis.jpg',
                        color: '#009688',
                        social: {
                            like: 19,
                            visit: 324,
                            comment: 11
                        }
                    },
                    {
                        title: 'Биржа онлайн-игроков',
                        description: 'Покупайте и продавайте аккаунты, героев, игровую валюту, артефакты и прочее... Зачисление средств на аккаунт',
                        creditTitle: 'Смотреть по прямой ссылке',
                        credit: 'http://zergo.ru',
                        image: '/images/projects/zergo.jpg',
                        color: '#558B2F',
                        social: {
                            like: 88,
                            visit: 254,
                            comment: 7
                        }
                    }, {
                        title: 'Онлайн магазин светотехнического оборудования',
                        description: 'Покупайте именно ваш источник света для дома из 15000 предложенных',
                        creditTitle: 'Смотреть по прямой ссылке',
                        credit: 'http://svitlograd.in.ua',
                        image: 'http://ukrdeveloper.pro/wallpaper-286723-c.jpg',
                        color: '#FFC107',
                        social: {
                            like: 56,
                            visit: 119,
                            comment: 21
                        }
                    }, {
                        title: 'Онлайн магазин автозапчастей',
                        description: 'Найдите необходимую деталь и все ее аналоги, учавствуйте в акциях и специальных предложениях, отслеживайте заказы и предложения из личного кабинета',
                        creditTitle: 'Смотреть по прямой ссылке',
                        credit: 'http://lion-auto.com.ua',
                        image: 'http://ukrdeveloper.pro/wallpaper-23226-c.jpg',
                        color: '#FFC107',
                        social: {
                            like: 156,
                            visit: 419,
                            comment: 34
                        }
                    }]
            };
        },
        computed: {
            slideImageapp: function slideImageapp() {
                console.log(this.activeSlide);
                return {
                    backgroundImage: 'url("' + this.slides[this.activeSlide].image + '")'
                };
            },
            activeItem: function activeItem() {
                return this.slides[this.activeSlide];
            },
            buttonColor: function buttonColor() {
                return {
                    backgroundColor: this.slides[this.activeSlide].color
                };
            },
            descriptionColor: function descriptionColor() {
                return {
                    color: this.slides[this.activeSlide].color
                };
            }
        },
        methods: {
            nextSlide: function nextSlide() {
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
