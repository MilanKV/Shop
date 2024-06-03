<template>
    <section class="shop">
        <div class="container">
            <div class="shop-header">
                <div class="row">
                    <div class="shop-result col-lg-6 col-md-5">
                        <p class="result">Showing 1-1 of 1 results</p>
                    </div>
                    <div class="shop-sort col-lg-6 col-md-7">
                        <div class="sort">
                            <div class="sort-tab">
                                <button class="link">
                                    <img src="../../img/icons/grid.svg">
                                </button>
                                <button class="link">
                                    <img src="../../img/icons/list.svg">
                                </button>
                            </div>
                            <div class="sorting" @click="toggleDropdown">
                                <div class="title">
                                    <span class="current">{{ currentSorting }}</span>
                                    <img :class="{ 'rotated': dropdownActive }" src="../../img/icons/chevron-down.svg">
                                </div>
                                <ul class="submenu" :class="{ active: dropdownActive }">
                                    <li v-for="option in sortingOptions" :key="option" :class="{ selected: option === currentSorting, focus: option === currentSorting }" class="option" @click.stop="selectOption(option)">
                                        {{ option }}
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="shop-body">
                <div class="row">
                    <div class="left col-lg-3">
                        <div class="sidebar">
                            <div class="tab">
                                <Accordion title="Brand" :active="true">
                                    <div class="mini-search">
                                        <Search />
                                    </div>
                                    <div class="list">
                                        <div class="list-item" v-for="brand in brands" :key="brand">
                                            <input type="checkbox" :id="brand" class="custom" :checked="selectedBrand === brand" @change="selectBrand(brand)">
                                            <label :for="brand">{{ brand }}</label>
                                        </div>
                                    </div>
                                </Accordion>
                            </div>
                            <div class="tab">
                                <Accordion title="Color">
                                    <div class="list">
                                        <div class="list-item-color" v-for="color in colors" :key="color">
                                            <input type="checkbox" :id="color" class="color-checkbox" :checked="selectedColor === color" @change="selectColor(color)">
                                            <label :for="color" :style="getColorStyle(color)">{{ color }}</label>
                                        </div>
                                    </div>
                                </Accordion>
                            </div>
                            <div class="tab">
                                <Accordion title="Price">
                                    <div class="list">
                                        <div class="list-item" v-for="price in prices" :key="price">
                                            <input type="checkbox" :id="price" class="custom" :checked="selectedPrice === price" @change="selectPrice(price)">
                                            <label :for="price">{{ price }}</label>
                                        </div>
                                    </div>
                                </Accordion>
                            </div>
                        </div>
                    </div>
                    <div class="right col-lg-9">

                    </div>
                </div>
            </div>
        </div>
    </section>
</template>

<script>
import Search from '../components/Search.vue';
import Accordion from '../components/Accordion.vue';

export default {
    name: "Shop",
    components: {
        Search,
        Accordion,
    },
    data() {
        return {
            dropdownActive: false,
            currentSorting: 'Popular',
            sortingOptions: ['Popular', 'Low to High', 'High to Low', 'Latest', 'On Sale'],
            rotated: false,
            brands: ['Sony', 'Samsung', 'LG', 'Lenovo', 'Sam'],
            selectedBrand: null,
            colors: ['Green', 'Yellow', 'Black', 'Blue', 'Red'],
            selectedColor: null,
            prices: ['Under $50', '$50 - $100', '$100 - $200', 'Above $200'],
            selectedPrice: null
        };
    },
    computed: {
        colorMap() {
            return {
                Red: '#ff5656',
                Blue: 'blue',
                Black: '#000',
                Yellow: '#e2e20d',
                Green: '#95c995',
            };
        }
    },
    methods: {
        toggleDropdown() {
            this.dropdownActive = !this.dropdownActive;
            this.rotated = !this.rotated;
        },
        selectOption(option) {
            this.currentSorting = option;
            this.dropdownActive = false;
        },
        toggleAccordion(index) {
            this.accordions[index].active = !this.accordions[index].active;
        },
        selectBrand(brand) {
            this.selectedBrand = this.selectedBrand === brand ? null : brand;
        },
        selectColor(color) {
            this.selectedColor = this.selectedColor === color ? null : color;
        },
        selectPrice(price) {
            this.selectedPrice = this.selectedPrice === price ? null : price;
        },
        getColorStyle(color) {
            return {
                '--checkbox-color': color.toLowerCase()
            };
        }
    },
};
</script>