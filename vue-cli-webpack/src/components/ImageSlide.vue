<template>
    <transition :css="false" name="image-slideappapp" mode="in-out" @enter="enter" @leave="leave">
        <slot></slot>
    </transition>
</template>

<script>

    export default {
        data: function data() {
            return {
                anim: null
            };
        },
        methods: {
            enter: function enter(el, onComplete) {
                // console.log('Enter')
                onComplete();
                this.anim = anime({
                    targets: el,
                    translateY: ['100%', 0],
                    easing: 'easeOutCubic',
                    duration: 600,
                    delay: 600
                });
                // this.anim.play
                // this.isImageLoaded (el.getAttribute('src'))
            },
            leave: function leave(el, onComplete) {
                anime({
                    targets: el,
                    translateY: [0, '-100%'],
                    easing: 'easeOutSine',
                    duration: 600,
                    delay: 700,
                    complete: onComplete
                });
            },
            isImageLoaded: function isImageLoaded(src) {
                var _this = this;

                this.isLoaded = false;
                var img = new Image();
                img.onload = function () {
                    // the image is ready
                    _this.isLoaded = true;
                    // console.log('loaded')
                    // this.anim.play
                };
                img.onerror = function () {
                    // the image has failed
                };
                img.src = src;
            }
        }
    }
</script>
