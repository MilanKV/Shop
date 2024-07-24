<template>
    <div :class="cardClass">
        <div class="product-grid-item">
            <div class="product-grid-image">
                <a @click.prevent="goToProductDetails">
                    <img :src="imageUrl" :alt="productName">
                </a>
                <div v-if="discount" class="product-grid-discount">
                    <span class="product-grid-discount-item">-{{ discount }}%</span>
                </div>
                <div class="product-grid-action">
                    <button type="button" class="product-grid-button">
                        <img src="../../img/icons/wishlist.svg">
                        <span class="product-grid-button-tooltip">Add To Wishlist</span>
                    </button>
                    <button type="button" class="product-grid-button" @click.prevent="goToProductDetails">
                        <img src="../../img/icons/eye.svg">
                        <span class="product-grid-button-tooltip">Quick View</span>
                    </button>
                </div>
                <div class="product-grid-add">
                    <button type="button" class="product-grid-add-cart">
                        <img src="../../img/icons/cart.svg">
                        Add To Cart
                    </button>
                </div>
            </div>
            <div class="product-grid-content">
                <h3 class="product-grid-title">
                    <a @click.prevent="goToProductDetails">{{ productName }}</a>
                </h3>
                <div class="product-grid-price">
                    <span class="product-grid-amount">${{ productPrice }}</span>
                </div>
            </div>
        </div>
    </div>
</template>

<script>

export default {
    name: "GridCard",
    props: {
        imageUrl: String,
        productName: String,
        productPrice: Number,
        discount: Number,
        short_desc: String,
        cardClass: {
            type: String,
            required: true
        },
        productId: {
            type: Number,
            required: true
        }
    },
    methods: {
        goToProductDetails() {
            this.$router.push({ name: 'ProductDetails', params: { id: this.productId } });
        }
    },
}
</script>