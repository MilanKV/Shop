<template>
    <section class="product-details">
        <div class="container">
            <div class="row">
                <div class="product-images col-xl-7 col-lg-6">
                    <div class="product-thumb-tab" v-if="product && product.images.length">
                        <div class="product-main-image">
                            <img class="product-img" :src="activeImage.url" :alt="product.product_name">
                        </div>
                        <div class="product-all-images">
                            <nav>
                                <div class="image-gallery d-flex flex-wrap justify-content-center">
                                    <a v-for="(image, index) in product.images" :key="index" class="nav-link"
                                        :class="{ active: activeImageIndex === index }"
                                        @click.prevent="setActiveImage(index)">
                                        <img :src="image.url" :alt="product.product_name">
                                    </a>
                                </div>
                            </nav>
                        </div>
                    </div>
                </div>
                <div class="product-information col-xl-5 col-lg-6" v-if="product">
                    <div class="product-details-wrapper">
                        <div class="product-stock">
                            <span class="stock">{{ product.quantity }} In Stock</span>
                        </div>
                        <h3 class="product-title">{{ product.product_name }}</h3>
                        <p class="short_description">{{ product.short_description }}</p>
                        <div class="product-price-discount">
                            <span class="product-price">${{ product.purchase_price }}</span>
                            <span class="product-discount" v-if="product.discount_price">
                                -{{ product.discount_price }}%
                            </span>
                        </div>
                        <div class="product-quantity">
                            <div class="product">
                                <span class="cart-minus">
                                    <img src="../../img/icons/minus.svg" alt="minus">
                                </span>
                                <input type="text" class="total-quantity" value="1" disabled>
                                <span class="cart-plus">
                                    <img src="../../img/icons/plus.svg" alt="plus">
                                </span>
                            </div>
                        </div>
                        <div class="product-action d-flex flex-wrap align-items-center">
                            <button type="button" class="add-cart">
                                <img src="../../img/icons/cart.svg">
                                Add To Cart
                            </button>
                            <button type="button" class="add-wishlist">
                                <img src="../../img/icons/wishlist.svg">
                                <span class="add-wishlist-tooltip">Add To Wishlist</span>
                            </button>
                        </div>
                        <div class="product-sku">
                            <p class="title">SKU:</p>
                            <span class="sku">{{ product.product_SKU }}</span>
                        </div>
                        <div class="product-category-subcategory">
                            <p class="title">Category:</p>
                            <span class="category-subcategory">
                                <a class="category-link" href="#"
                                    @click.prevent="goToShopWithCategory(product.category.id)">
                                    {{ product.category.category_name }} / {{ product.subcategory.category_name }}
                                </a>
                            </span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="product-tab-description" v-if="product">
        <div class="container">
            <div class="row">
                <Accordion class="col-xl-12" title="Description" :active="true">
                    <div class="tab-content col-lg-12">
                        <h3 class="title">{{ product.product_name }}</h3>
                        <p class="long_description">{{ product.long_descriptions }}</p>
                    </div>
                </Accordion>
            </div>
        </div>
    </section>
</template>

<script>
import { mapGetters, mapActions } from 'vuex';

import Accordion from '../components/Accordion.vue';

export default {
    name: 'ProductDetails',
    components: {
        Accordion,
    },

    computed: {
        ...mapGetters(['product', 'activeImageIndex']),
        activeImage() {
            return this.product && this.product.images[this.activeImageIndex];
        },
    },
    methods: {
        ...mapActions(['fetchProduct']),
        setActiveImage(index) {
            this.$store.commit('SET_ACTIVE_IMAGE_INDEX', index);
        },
        goToShopWithCategory(categoryId) {
            this.$router.push({ name: 'Shop', query: { category: categoryId } });
        },
    },
    created() {
        const productId = this.$route.params.id;
        this.fetchProduct(productId);
    },
}
</script>