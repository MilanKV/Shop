<template>
    <div class="sort-tab">
        <button class="link" @click="setActiveView('grid')" :class="{ active: activeView === 'grid' }">
            <img src="../../img/icons/grid.svg">
        </button>
        <button class="link" @click="setActiveView('list')" :class="{ active: activeView === 'list' }">
            <img src="../../img/icons/list.svg">
        </button>
    </div>
</template>

<script>
export default {
    name: "SortTabs",
    props: ['activeView'],
    methods: {
        setActiveView(view) {
            this.$emit('update:view', view);
        }
    }
}
</script>