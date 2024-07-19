<template>
    <section class="shop">
        <div class="container">
            <div class="shop-header">
                <div class="row">
                    <div class="shop-result col-lg-6 col-md-5">
                        <p class="result">Showing {{ pagination.from }}-{{ pagination.to }} of {{ pagination.total }}
                            results</p>
                    </div>
                    <div class="shop-sort col-lg-6 col-md-7">
                        <div class="sort">
                            <SortTabs :activeView="activeView" @update:view="setActiveView" />
                            <SortingDropdown :currentSorting="currentSorting" :sortingOptions="sortingOptions"
                                :dropdownActive="dropdownActive" @toggle:dropdown="toggleDropdown"
                                @select:option="selectOption" />
                        </div>
                    </div>
                </div>
            </div>
            <div class="shop-body">
                <div class="row">
                    <div class="left col-lg-3">
                        <Sidebar v-bind="sidebarProps" v-on="sidebarEvents" />
                    </div>
                    <div class="right col-lg-9">
                        <div class="content mb-40">
                            <div class="tab-panel">
                                <div v-if="activeView === 'grid'" class="tab-grid-view"
                                    :class="{ 'fade-out': switchingView }">
                                    <div class="row">
                                        <GridCard v-for="product in products" :key="product.id"
                                            v-bind="getDetails(product)"
                                            :cardClass="'grid-card col-xl-4 col-lg-4 col-md-4 col-sm-6'" />
                                    </div>
                                </div>
                                <div v-else-if="activeView === 'list'" class="tab-list-view"
                                    :class="{ 'fade-out': switchingView }">
                                    <div class="row">
                                        <ListCard v-for="product in products" :key="product.id"
                                            v-bind="getDetails(product)" />
                                    </div>
                                </div>
                            </div>
                        </div>
                        <NotFound v-if="products.length === 0" />
                        <Pagination v-if="products.length > 0" :pagination="pagination" @page-changed="changePage" />
                    </div>
                </div>
            </div>
        </div>
    </section>
</template>

<script>
import { mapState, mapActions, mapGetters } from 'vuex';

import Search from '../components/Search.vue';
import Accordion from '../components/Accordion.vue';
import GridCard from '../components/Grid-Card.vue';
import ListCard from '../components/List-Card.vue';
import SortTabs from '../components/SortTabs.vue';
import SortingDropdown from '../components/SortingDropdown.vue';
import Sidebar from '../components/Sidebar.vue';
import Pagination from '../components/Pagination.vue';
import NotFound from '../components/NotFound.vue';

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
        Pagination,
        NotFound,
    },
    data() {
        return {
            dropdownActive: false,
            activeView: 'grid',
            switchingView: false,
            sortingOptions: ['Low to High', 'High to Low', 'Latest', 'On Sale'],
            rotated: false,
            selectedBrand: null,
            colors: ['Green', 'Yellow', 'Black', 'Blue', 'Red'],
            selectedColor: null,
            prices: ['Under $50', '$50 - $100', '$100 - $200', 'Above $200'],
            selectedPrice: null,
            selectedCategory: null,
            selectedSubcategory: null,
        };
    },
    computed: {
        ...mapState({
            products: state => state.products,
            brands: state => state.brands,
            categories: state => state.categories,
            currentSorting: state => state.sortingOption,
            pagination: state => state.pagination,
            brandCounts: state => state.brandCounts,
            colorCounts: state => state.colorCounts,
            priceCounts: state => state.priceCounts,
            subCategoryCounts: state => state.subCategoryCounts,
        }),
        colorMap() {
            return {
                Red: '#ff5656',
                Blue: 'blue',
                Black: '#000',
                Yellow: '#e2e20d',
                Green: '#95c995',
            };
        },
        sidebarProps() {
            return {
                brands: this.brands,
                selectedBrand: this.selectedBrand,
                colors: this.colors,
                selectedColor: this.selectedColor,
                prices: this.prices,
                selectedPrice: this.selectedPrice,
                brandCounts: this.brandCounts,
                colorCounts: this.colorCounts,
                priceCounts: this.priceCounts,
                subCategoryCounts: this.subCategoryCounts,
                categories: this.categories,
                selectedCategory: this.selectedCategory,
                selectedSubcategory: this.selectedSubcategory
            };
        },
        sidebarEvents() {
            return {
                'update:selectedBrand': this.selectBrand,
                'update:selectedColor': this.selectColor,
                'update:selectedPrice': this.selectPrice,
                'update:selectedCategory': this.selectCategory,
                'update:selectedSubcategory': this.selectSubcategory
            };
        },
    },
    methods: {
        ...mapActions(['fetchProducts', 'updateSorting', 'fetchBrands', 'fetchCategories']),

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
        selectBrand(brandId) {
            this.selectedBrand = this.selectedBrand === brandId ? null : brandId;
            this.fetchProducts(this.getFilterParams());
        },
        selectColor(color) {
            this.selectedColor = this.selectedColor === color ? null : color;
            this.fetchProducts(this.getFilterParams())
        },
        selectPrice(price) {
            this.selectedPrice = this.selectedPrice === price ? null : price;
            this.fetchProducts(this.getFilterParams())
        },
        selectCategory(categoryId) {
            this.selectedCategory = this.selectedCategory === categoryId ? null : categoryId;
            this.fetchProducts(this.getFilterParams())
        },
        selectSubcategory({ categoryId, subcategoryId }) {
            this.selectedCategory = categoryId;
            this.selectedSubcategory = subcategoryId;
            this.fetchProducts(this.getFilterParams())
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
        changePage(page) {
            if (page > 0 && page <= this.pagination.last_page) {
                const filterParams = this.getFilterParams();
                this.fetchProducts({
                    ...filterParams,
                    page,
                });
                this.$nextTick(() => {
                    window.scrollTo({
                        top: 0,
                        behavior: 'smooth'
                    });
                });
            }
        },
        getFilterParams() {
            const { selectedBrand, selectedColor, selectedPrice, selectedCategory, selectedSubcategory } = this;
            return { selectedBrand, selectedColor, selectedPrice, selectedCategory, selectedSubcategory };
        },
        getDetails(product) {
            return {
                productName: product.product_name,
                imageUrl: product.images[0],
                productPrice: product.purchase_price,
                discount: product.discount_price,
                description: product.short_description,
            };
        }
    },
    created() {
        const category = this.$route.query.category;
        if (category) {
            this.selectedCategory = parseInt(category);
        }
        this.fetchProducts(this.getFilterParams());
        this.fetchBrands();
        this.fetchCategories();
    }
};
</script>