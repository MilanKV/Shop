<template>
    <form @submit.prevent>
        <div class="search-input">
            <input type="text" :placeholder="placeholder" v-model="searchQuery" @input="handleSearch">
        </div>
    </form>
</template>

<script>
    export default {
        name: "Search",
        props: {
            placeholder: {
                type: String,
                default: "Search ...",
            },
        },
        data() {
            return {
                searchQuery: "",
            };
        },
        methods: {
            handleSearch() {
                this.$emit("search", this.searchQuery.trim());
            },
        },
    };
</script>