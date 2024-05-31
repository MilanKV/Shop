<template>
    <div class="menu-links">
        <Menu :menuItems="offcanvasMenuItems" />
    </div>
    <div class="login-profile">
        <!-- If user is not logged in  -->
        <a v-if="!isLoggedIn" href="/login" class="btn btn-add me-3">Login</a>
        <a v-if="!isLoggedIn" href="/register" class="btn btn-outline">Register</a>

        <!-- If user is logged in -->
        <a v-if="isLoggedIn" href="#" class="btn btn-add me-3">Account</a>
        <a v-if="isLoggedIn" @click="handleLogout" class="btn btn-outline">Logout</a>
    </div>
    <SocialLinks />
</template>

<script>
import { mapState, mapActions } from 'vuex';
import Menu from './Menu.vue';
import SocialLinks from './SocialLinks.vue';

export default {
    name: "Offcanvas",
    components: {
        Menu,
        SocialLinks,
    },
    data() {
        return {
            offcanvasMenuItems: [
                { id: 1, title: 'Home', url: '/', class: 'off-links' },
                { id: 2, title: 'About Us', url: '/about', class: 'off-links' },
                { id: 3, title: 'Shop', url: '/shop', class: 'off-links' },
                { id: 4, title: 'Contact Us', url: '/contact', class: 'off-links' },
                { id: 5, title: 'Wishlist', url: '/wishlist', class: 'off-links' },
                { id: 6, title: 'Cart', url: '/cart', class: 'off-links' },
            ],
        };
    },
    computed: {
        ...mapState(['isLoggedIn']),
    },
    methods: {
        ...mapActions(['fetchAuthStatus', 'handleLogout']),
    },
    mounted() {
        this.fetchAuthStatus();
    },
};
</script>