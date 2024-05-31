<template>
  <div class="dropdown" @mouseover="showDropdown" @mouseleave="hideDropdown">
    <slot name="trigger"></slot>
    <ul class="submenu" v-if="isDropdownVisible">
      <slot></slot>
    </ul>
  </div>
</template>
  
<script>
export default {
  name: "Dropdown",
  data() {
    return {
      isDropdownVisible: false,
    };
  },
  methods: {
    showDropdown() {
      this.isDropdownVisible = true;
    },
    hideDropdown() {
      this.isDropdownVisible = false;
    },
  },
};
</script>