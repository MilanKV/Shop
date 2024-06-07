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
                            <SortTabs :activeView="activeView" @update:view="setActiveView" />
                            <SortingDropdown 
                                :currentSorting="currentSorting" 
                                :sortingOptions="sortingOptions" 
                                :dropdownActive="dropdownActive" 
                                @toggle:dropdown="toggleDropdown" 
                                @select:option="selectOption" 
                            />
                        </div>
                    </div>
                </div>
            </div>
            <div class="shop-body">
                <div class="row">
                    <div class="left col-lg-3">
                       <Sidebar 
                            :brands="brands"
                            :selectedBrand="selectedBrand"
                            @update:selectedBrand="selectBrand"
                            :colors="colors"
                            :selectedColor="selectedColor"
                            @update:selectedColor="selectColor"
                            :prices="prices"
                            :selectedPrice="selectedPrice"
                            @update:selectedPrice="selectPrice"
                       /> 
                    </div>
                    <div class="right col-lg-9">
                        <div class="content mb-40">
                            <div class="tab-panel">
                                <div v-if="activeView === 'grid'" class="tab-grid-view" :class="{ 'fade-out': switchingView }">
                                    <div class="row">
                                        <GridCard 
                                            v-for="product in products" 
                                            :key="product.id"
                                            :productName="product.product_name"
                                            :imageUrl="product.image"
                                            :productPrice="product.purchase_price"
                                            :discount="product.discount_price"
                                            :description="product.short_description"
                                        />
                                    </div>
                                </div>
                                <div v-else-if="activeView === 'list'" class="tab-list-view" :class="{ 'fade-out': switchingView }">
                                    <div class="row">
                                        <ListCard 
                                            v-for="product in products" 
                                            :key="product.id"
                                            :productName="product.product_name"
                                            :imageUrl="product.image"
                                            :productPrice="product.purchase_price"
                                            :discount="product.discount_price"
                                            :description="product.short_description"
                                        />
                                    </div>
                                </div>
                            </div>
                            <div class="row pagination"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</template>

<script>
import { mapState, mapActions } from 'vuex';

import Search from '../components/Search.vue';
import Accordion from '../components/Accordion.vue';
import GridCard from '../components/Grid-Card.vue';
import ListCard from '../components/List-Card.vue';
import SortTabs from '../components/SortTabs.vue';
import SortingDropdown from '../components/SortingDropdown.vue';
import Sidebar from '../components/Sidebar.vue';

export default {
    name: "Shop",
    components: {
        Search,
        Accordion,
        GridCard,
        ListCard,
        SortTabs,
        SortingDropdown,
        Sidebar,
    },
    data() {
        return {
            dropdownActive: false,
            activeView: 'grid',
            switchingView: false,
            sortingOptions: ['Low to High', 'High to Low', 'Latest', 'On Sale'],
            rotated: false,
            brands: ['Sony', 'Samsung', 'LG', 'Lenovo', 'Sam'],
            selectedBrand: null,
            colors: ['Green', 'Yellow', 'Black', 'Blue', 'Red'],
            selectedColor: null,
            prices: ['Under $50', '$50 - $100', '$100 - $200', 'Above $200'],
            selectedPrice: null,
        };
    },
    computed: {
        ...mapState({
            products: state => state.products,
            currentSorting: state => state.sortingOption,
        }),
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
        ...mapActions(['fetchProducts', 'updateSorting']),

        toggleDropdown() {
            this.dropdownActive = !this.dropdownActive;
            this.rotated = !this.rotated;
        },
        selectOption(option) {
            this.updateSorting(option);
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
        },
        setActiveView(view) {
            this.switchingView = true;
            setTimeout(() => {
                this.activeView = view;
                this.switchingView = false;
            }, 300);
        },
    },
    created() {
        this.fetchProducts();
    }
};
</script>