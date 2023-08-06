<script setup>
import { ChevronRightIcon } from '@heroicons/vue/24/solid';
import { Link } from '@inertiajs/vue3';
defineProps({
    // breadcrumbs: Object
})

</script>

<template>
    <div class="face">
        <!-- <p class="v-index">II </p> -->
        <!-- <p class="h-index">II </p> -->
        <div class="hand">
            <div class="hand">
                <div class="hour"></div>
                <div class="minute"></div>
                <!-- <div class="second"></div> -->
            </div>
        </div>
    </div>
</template>

<style>

:root{
    --facew: 45px;
    --hourw: 1.25px;
    --hourh: 15px;
    --hour: 22.5px;
    --hourleft:21.875px;
    --hourtop:10.75px;

    --minutew:1px;
    --minuteh:19.5px;

    --secondhw:2.5px;
    --secondtopleft:21.25px;
    /* --hourtop:calc(var(--hourleft)/2); */
}


.face {
    position: relative;
    width: var(--facew);
    height: var(--facew);
    border-radius: 50%;
    outline: 5px solid #333;
    background: repeating-radial-gradient(circle at 50% 50%,
            rgba(200, 200, 200, .2) 0%, rgba(200, 200, 200, .2) 2%,
            transparent 2%, transparent 3%, rgba(200, 200, 200, .2) 3%,
            transparent 3%), conic-gradient(white 0%, silver 10%,
            white 35%, silver 45%, white 60%, silver 70%,
            white 80%, silver 95%, white 100%);
    box-shadow: inset 0 0 20px #0007;
}

.hour {
    position: absolute;
    width: var(--hourw);
    height: var(--hourh);
    background: #aaa;
    left: var(--hourleft);
    top:  var(--hourtop);
    border-radius: 2px 2px 1px 1px;
    transform-origin: 1px 12px; /* temp */
    box-shadow: 0 0 5px #0005, inset 1.5px 3px 0px #333, inset -1.5px -3px 0px #333;
    z-index: 1;
    animation: watch 432s linear infinite;
}

.minute {
    position: absolute;
    width:  var(--minutew);
    height: var(--minuteh);
    background: #aaa;
    left: 22px;
    top: 6.25px;
    border-radius: 3px 3px 1px 1px;
    transform-origin: 1px 16.25px; /* temp */
    box-shadow: 0 0 5px rgb(38, 0, 255), inset 1.5px 3px 0px #120064, inset -1.5px -3px 0px #ff0000;
    z-index: 2;
    animation: watch 12s linear infinite;
}

.second {
    position: absolute;
    width:  var(--secondhw);
    height: var(--secondhw);
    background: red;
    left:var(--secondtopleft);
    top: var(--secondtopleft);
    border-radius: 50%;
    border: 0.5px solid #eee;
    z-index: 3;
    animation: watch .6s steps(60, end) 0s infinite;
}

.second::before {
    content: "";
    position: absolute;
    width: 0.5px;
    height: var(--secondtopleft);
    left: 1.5px;
    bottom: -5px;
    background: red;
    border-radius: 2px;
    box-shadow: 5px 0 2px rgba(128, 128, 128, 0.2);
}

.second::after {
    content: "";
    position: absolute;
    width:  1.5px;
    height: 1.5px;
    left:   0.5px;
    top:    0.5px;
    background: #555;
    border-radius: 50%;
}


@keyframes watch {
    0% {
        transform: rotate(0deg);
    }

    100% {
        transform: rotate(360deg);
    }
}
</style>
