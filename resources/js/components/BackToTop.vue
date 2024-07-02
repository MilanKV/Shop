<template>
    <div class="back-to-top" :class="{ show: shouldShowBackToTop }">
        <button id="back-to-top" class="back-to-top-button" type="button" @click="scrollToTop">
            <img src="../../img/icons/arrow-up.svg">
        </button>
    </div>
</template>

<script>
export default {
    name: 'BackToTop',
    data() {
        return {
            shouldShowBackToTop: false
        };
    },
    methods: {
        scrollToTop() {
            window.scrollTo({
                top: 0,
                behavior: "smooth"
            });
        },
        handleScroll() {
            this.shouldShowBackToTop = window.scrollY > 200;
        }
    },
    mounted() {
        window.addEventListener("scroll", this.handleScroll);
    },
    beforeDestroy() {
        window.removeEventListener("scroll", this.handleScroll);
    }
};
</script>