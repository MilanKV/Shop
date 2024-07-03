<template>
    <div class="sidebar">
        <div class="tab">
            <Accordion title="Categories" :active="true">
                <div v-for="(category, index) in categories" :key="index" class="category-container">
                    <div class="category-header" @click="toggleCategory(index)">
                        <h5 :class="['category-title', { active: category.isActive }]">{{ category.title }}</h5>
                        <img :class="{ 'rotated': category.isActive }" src="../../img/icons/arrow-down.svg">
                    </div>
                    <div class="category-content" :class="{ 'active': category.isActive }">
                        <ul class="category-list">
                            <li v-for="item in category.items" :key="item.id" class="category-item">
                                <a href="#" class="category-link">{{ item.name }}</a>
                                <span class="product-count">{{ item.count }}</span>
                            </li>
                        </ul>
                    </div>
                </div>
            </Accordion>
        </div>
        <div class="tab">
            <Accordion title="Brand" :active="true">
                <div class="mini-search">
                    <Search :placeholder="'Search Brands...'" @search="filterBrands" />
                </div>
                <div class="list">
                    <div class="list-item" v-for="brand in filteredBrands" :key="brand.id">
                        <input type="checkbox" :id="brand.id" class="custom" :checked="selectedBrand === brand.id"
                            @change="selectBrand(brand.id)">
                        <label :for="brand.id">{{ brand.brand_name }}</label>
                        <div class="total-products">
                            <span class="product-count">{{ brandCounts[brand.id] || 0 }}</span>
                        </div>
                    </div>
                </div>
            </Accordion>
        </div>
        <div class="tab">
            <Accordion title="Color" :active="true">
                <div class="list">
                    <div class="list-item-color" v-for="color in colors" :key="color">
                        <input type="checkbox" :id="color" class="color-checkbox" :checked="selectedColor === color"
                            @change="selectColor(color)">
                        <label :for="color" :style="getColorStyle(color)">{{ color }}</label>
                        <div class="total-products">
                            <span class="product-count">{{ colorCounts[color.toLowerCase()] || 0 }}</span>
                        </div>
                    </div>
                </div>
            </Accordion>
        </div>
        <div class="tab">
            <Accordion title="Price" :active="true">
                <div class="list">
                    <div class="list-item" v-for="price in prices" :key="price">
                        <input type="checkbox" :id="price" class="custom" :checked="selectedPrice === price"
                            @change="selectPrice(price)">
                        <label :for="price">{{ price }}</label>
                        <div class="total-products">
                            <span class="product-count">{{ priceCounts[price] || 0 }}</span>
                        </div>
                    </div>
                </div>
            </Accordion>
        </div>
    </div>
</template>

<script>
import Search from './Search.vue';
import Accordion from './Accordion.vue';

export default {
    name: "Sidebar",
    components: {
        Search,
        Accordion,
    },
    props: {
        brands: Array,
        selectedBrand: Number,
        colors: Array,
        selectedColor: String,
        prices: Array,
        selectedPrice: String,
        brandCounts: Object,
        colorCounts: Object,
        priceCounts: Object,
    },
    data() {
        return {
            searchQuery: "",
            categories: [
                {
                    title: 'Ipad Phone & Tablets',
                    isActive: false,
                    items: [
                        { id: 1, name: 'Joystick', count: 12 },
                        { id: 2, name: 'Laptops', count: 5 },
                        { id: 3, name: 'Monitor', count: 29 },
                        { id: 4, name: 'Desktop', count: 45 }
                    ]
                },
                {
                    title: 'Ipad',
                    isActive: false,
                    items: [
                        { id: 5, name: 'Joystick', count: 67 },
                        { id: 6, name: 'Laptops', count: 21 },
                        { id: 7, name: 'Monitor', count: 2 },
                        { id: 8, name: 'Desktop', count: 33 }
                    ]
                },
                {
                    title: 'Tablets',
                    isActive: false,
                    items: [
                        { id: 9, name: 'Joystick', count: 21 },
                        { id: 10, name: 'Laptops', count: 67 },
                        { id: 11, name: 'Monitor', count: 99 },
                        { id: 12, name: 'Desktop', count: 150 }
                    ]
                }
            ]
        };
    },
    computed: {
        filteredBrands() {
            return this.brands.filter(brand =>
                brand.brand_name.toLowerCase().includes(this.searchQuery.toLowerCase())
            );
        },
    },
    methods: {
        selectBrand(brand) {
            this.$emit('update:selectedBrand', brand);
        },
        selectColor(color) {
            this.$emit('update:selectedColor', color);
        },
        selectPrice(price) {
            this.$emit('update:selectedPrice', price);
        },
        getColorStyle(color) {
            return {
                '--checkbox-color': color.toLowerCase()
            };
        },
        filterBrands(query) {
            this.searchQuery = query;
        },
        toggleCategory(index) {
            this.categories.forEach((category, idx) => {
                if (idx !== index) {
                    category.isActive = false;
                }
            });
            this.categories[index].isActive = !this.categories[index].isActive;
        },
    },
}
</script>