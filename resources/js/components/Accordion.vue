<template>
    <div class="accordion">
        <div class="accordion-header d-flex align-items-center justify-content-between" @click="toggleAccordion">
            <h2 class="title">{{ title }}</h2>
            <img :class="{ 'rotated': isActive }" src="../../img/icons/arrow-down.svg">
        </div>
        <div :class="{ 'accordion-content': true, 'active': isActive }">
            <slot></slot>
        </div>
    </div>
</template>

<script>
export default {
    name: "Accordion",
    props: {
        title: {
            type: String,
            required: true
        },
        active: {
            type: Boolean,
            default: false
        }
    },
    data() {
        return {
            isActive: this.active
        };
    },
    methods: {
        toggleAccordion() {
            this.isActive = !this.isActive;
        }
    }
};
</script>