<template>
    <div :class="['container-fluid', { 'scrolled': isScrolled }]">
        <div class="logo-menu">
            <Logo />
            <div class="menu">
                <Menu :menuItems="homeMenuItems"/>
            </div>
        </div>
        <div class="utilities">
            <div class="search">
                <Search />
            </div>
            <Action />
            <Hamburger :isActive="isOffCanvasActive" :toggleActive="toggleOffCanvas" />
        </div>
    </div>
    <div class="offcanvas" :class="{ 'show': isOffCanvasActive }">
        <Offcanvas />
    </div>
    <div class="body-overlay" v-if="isOffCanvasActive" @click="toggleOffCanvas"></div>
</template>

<script>
import Logo from './Logo.vue';
import Menu from './Menu.vue';
import Search from './Search.vue';
import Action from './Action.vue';
import Hamburger from './Hamburger.vue';
import Offcanvas from './Offcanvas.vue';

import { mapState, mapActions } from 'vuex';

export default {
    name: "Header",
    components: {
        Logo,
        Menu,
        Search,
        Action,
        Hamburger,
        Offcanvas,
    },
    data() {
        return {
            isOffCanvasActive: false,
            isScrolled: false,
            homeMenuItems: [
                { id: 1, title: 'Home', url: '/', class: 'link underline' },
                { id: 2, title: 'About Us', url: '/about', class: 'link underline' },
                { id: 3, title: 'Shop', url: '/shop', class: 'link underline' },
                { id: 4, title: 'Contact Us', url: '/contact', class: 'link underline' },
            ],
        };
    },
    computed: {
        ...mapState(['isLoggedIn']),
    },
    methods: {
        ...mapActions(['fetchAuthStatus', 'handleLogout']),
        toggleOffCanvas() {
            this.isOffCanvasActive = !this.isOffCanvasActive;
        },
        handleScreenSizeChange() {
            if (window.innerWidth >= 768 && this.isOffCanvasActive) {
                this.isOffCanvasActive = false;
            }
        },
        handleScroll() {
            this.isScrolled = window.scrollY > 0;
        },
    },
    mounted() {
        this.fetchAuthStatus();
        window.addEventListener('resize', this.handleScreenSizeChange);
        window.addEventListener('scroll', this.handleScroll);
    },
    beforeDestroy() {
        window.removeEventListener('resize', this.handleScreenSizeChange);
        window.removeEventListener('scroll', this.handleScroll);
    },
};
</script>