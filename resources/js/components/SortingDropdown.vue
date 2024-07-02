<template>
    <div class="sorting" @click="toggleDropdown">
        <div class="title">
            <span class="current">{{ currentSorting }}</span>
            <img :class="{ 'rotated': dropdownActive }" src="../../img/icons/arrow-down.svg">
        </div>
        <ul class="submenu" :class="{ active: dropdownActive }">
            <li v-for="option in sortingOptions" :key="option"
                :class="{ selected: option === currentSorting, focus: option === currentSorting }" class="option"
                @click.stop="selectOption(option)">
                {{ option }}
            </li>
        </ul>
    </div>
</template>

<script>
export default {
    name: "SortingDrop",
    props: ['currentSorting', 'sortingOptions', 'dropdownActive'],
    methods: {
        toggleDropdown() {
            this.$emit('toggle:dropdown');
        },
        selectOption(option) {
            this.$emit('select:option', option);
        }
    }
}
</script>