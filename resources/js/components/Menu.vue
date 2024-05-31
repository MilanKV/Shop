<template>
    <ul>
        <li v-for="item in menuItems" :key="item.id">
            <a :href="item.url" :class="item.class">{{ item.title }}</a>
        </li>
    </ul>
</template>

<script>
    export default {
        name: "Menu",
        props: {
            menuItems: {
                type: Array,
                default: () => [],
                required: true,
            }
        }
    };
</script>