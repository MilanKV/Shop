<template>
    <div class="list-card col-lg-12 col-md-6">
        <div class="product-list-item">
            <div class="row">
                <div class="image col-xl-5 col-lg-5">
                    <div class="product-list-image">
                        <a @click.prevent="goToProductDetails">
                            <img :src="imageUrl" :alt="productName">
                        </a>
                        <div v-if="discount" class="product-list-discount">
                            <span class="product-list-discount-item">-{{ discount }}%</span>
                        </div>
                    </div>
                </div>
                <div class="content col-xl-7 col-lg-7">
                    <div class="product-list-content">
                        <h3 class="product-list-title">
                            <a @click.prevent="goToProductDetails">{{ productName }}</a>
                        </h3>
                        <div class="product-list-price">
                            <span class="product-list-amount">${{ productPrice }}</span>
                        </div>
                        <p class="product-list-description">{{ truncatedDescription }}</p>
                        <div class="product-list-action">
                            <button type="button" class="product-list-add-cart">
                                <img src="../../img/icons/cart.svg">
                                Add To Cart
                            </button>
                            <button type="button" class="product-list-button">
                                <img src="../../img/icons/wishlist.svg">
                                <span class="product-list-button-tooltip">Add To Wishlist</span>
                            </button>
                            <button type="button" class="product-list-button" @click.prevent="goToProductDetails">
                                <img src="../../img/icons/eye.svg">
                                <span class="product-list-button-tooltip">Quick View</span>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>

export default {
    name: "ListCard",
    props: {
        imageUrl: String,
        productName: String,
        productPrice: Number,
        discount: Number,
        short_desc: String,
        productId: {
            type: Number,
            required: true
        },
    },
    computed: {
        truncatedDescription() {
            return this.short_desc.length > 250
                ? this.short_desc.substring(0, 250) + '...'
                : this.short_desc;
        },
    },
    methods: {
        goToProductDetails() {
            this.$router.push({ name: 'ProductDetails', params: { id: this.productId } });
        }
    },
}
</script>