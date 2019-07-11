<template>
    <transition
            :css="false"
            name="text-slide"
            mode="out-in"
            @enter="enter"
            @leave="leave"
    >
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
                console.log('ENTER');
                var timeline = anime.timeline({complete: onComplete});
                timeline.add({
                    targets: ['.centered h1', '.centered h3', '.centered h6', '.centered h5', '.centered button'],
                    translateY: [250, 0],
                    easing: 'easeOutSine',
                    duration: 500,
                    opacity: [0, 1],
                    delay: function delay(el, i, l) {
                        return i * 100;
                    }
                });
                timeline.add({
                    targets: '.paginator1',
                    translateX: [-50, 0],
                    easing: 'easeOutSine',
                    duration: 300,
                    opacity: [0, 1],
                    offset: 0
                });
                timeline.add({
                    targets: '.social',
                    translateY: [30, 0],
                    easing: 'easeOutSine',
                    duration: 300,
                    opacity: [0, 1],
                    offset: 0
                });

                var socialObj = {like: 0, visit: 0, comment: 0};
                var elLike = document.querySelector('[data-like]');
                var elVisit = document.querySelector('[data-visit]');
                var elComment = document.querySelector('[data-comment]');
                timeline.add({
                    targets: socialObj,
                    like: elLike.dataset.like,
                    visit: elVisit.dataset.visit,
                    comment: elComment.dataset.comment,
                    round: 1,
                    duration: 900,
                    easing: 'easeInQuad',
                    offset: -50,
                    update: function update() {
                        elLike.innerHTML = socialObj.like;
                        elVisit.innerHTML = socialObj.visit;
                        elComment.innerHTML = socialObj.comment;
                    }
                });
            },
            leave: function leave(el, onComplete) {
                console.log('LEAVE');

                var timeline = anime.timeline({
                    complete: onComplete
                });

                timeline.add({
                    targets: ['.partapp.text h1', '.partapp.text h3', '.centered h6', '.centered h5', '.centered button'],
                    translateY: [0, -250],
                    easing: 'easeInExpo',
                    duration: 500,
                    opacity: [1, 0],
                    delay: function delay(el, i, l) {
                        return i * 100;
                    }
                });
                timeline.add({
                    targets: '.paginator1',
                    translateX: [0, 120],
                    easing: 'easeInExpo',
                    duration: 300,
                    opacity: [1, 0],
                    offset: 0
                });
                timeline.add({
                    targets: '.social',
                    translateY: [0, -80],
                    easing: 'easeInExpo',
                    duration: 300,
                    opacity: [1, 0],
                    offset: 0
                });
            }
        }
    }
</script>
