<template>
    <div class="container-fluid">
        <div class="logo-menu">
            <Logo />
            <Menu></Menu>
        </div>
        <div class="utilities">
            <Search />
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
import Logo from './Header/Logo.vue';
import Menu from './Header/Menu.vue';
import Search from './Header/Search.vue';
import Action from './Header/Action.vue';
import Hamburger from './Header/Hamburger.vue';
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
    },
    mounted() {
        this.fetchAuthStatus();
        window.addEventListener('resize', this.handleScreenSizeChange);
    },
    beforeDestroy() {
        window.removeEventListener('resize', this.handleScreenSizeChange);
    },
};
</script>