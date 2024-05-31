<template>
    <div class="action">
            <ul>
                <!-- If user is not logged in  -->
                <li v-if="!isLoggedIn">
                    <a href="/login">
                        <img src="../../img/icons/user.svg" alt="user">
                    </a>
                </li>

                <!-- If user is logged in -->
                <li v-else>
                    <Dropdown>
                        <template v-slot:trigger>
                            <a href="#">
                                <img src="../../img/icons/user.svg" alt="user">
                            </a>
                        </template>
                        <template v-slot:default>
                            <li class="submenu-item">
                                <a class="left-line text" href="#">Account</a>
                            </li>
                            <!-- Only if auth and role = Admin -->
                            <li v-if="isAdmin" class="submenu-item">
                                <a class="left-line text" href="/admin/dashboard">Dashboard</a>
                            </li>
                            <li class="submenu-item">
                                <a class="left-line text" @click="handleLogout">Logout</a>
                            </li>
                        </template>
                    </Dropdown>
                </li>
                <li>
                    <a href="/wishlist">
                        <img src="../../img/icons/wishlist.svg" alt="wishlist">
                    </a>
                </li>
                <li>
                    <a href="/cart">
                        <img src="../../img/icons/cart.svg" alt="cart">
                    </a>
                </li>
            </ul>
        </div>
</template>

<script>
import { mapState, mapActions, mapGetters } from 'vuex';
import Dropdown from './Dropdown.vue';

export default {
    name: "Action",
    data() {
        return {
            isDropdownVisible: false,
        };
    },
    components: {
        Dropdown,
    },
    computed: {
        ...mapState(['isLoggedIn']),
        ...mapGetters(['isAdmin']),
    },
    methods: {
        ...mapActions(['fetchAuthStatus', 'handleLogout']),
        showDropdown() {
            this.isDropdownVisible = true;
        },
        hideDropdown() {
            this.isDropdownVisible = false;
        },
    },
    mounted() {
        this.fetchAuthStatus();
    },
};
</script>