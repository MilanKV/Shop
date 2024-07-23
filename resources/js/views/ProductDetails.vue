<template>
    <section class="product-details">
        <div class="container">
            <div class="row">
                <div class="product-images col-xl-7 col-lg-6">
                    <div class="product-thumb-tab">
                        <div class="product-main-image">
                            <img class="product-img" src="https://i.ibb.co/5FGVYm3/product-20.jpg" alt="#">
                        </div>
                        <div class="product-all-images">
                            <nav>
                                <div class="image-gallery d-flex flex-wrap justify-content-center">
                                    <a href="#" class="nav-link active">
                                        <img src="https://i.ibb.co/5FGVYm3/product-20.jpg">
                                    </a>
                                </div>
                            </nav>
                        </div>
                    </div>
                </div>
                <div class="product-information col-xl-5 col-lg-6">
                    <div class="product-details-wrapper">
                        <div class="product-stock">
                            <span class="stock">44 In Stock</span>
                        </div>
                        <h3 class="product-title">Dualshock 4 Wireless Controller</h3>
                        <p class="short_description">
                            The Bluetooth Speaker with Light is the ultimate fusion of sound and visual appeal, designed
                            to enhance any environment with its dynamic audio performance and captivating LED lighting.
                        </p>
                        <div class="product-price-discount">
                            <span class="product-price">$2993.99</span>
                            <span class="product-discount">-15%</span>
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
                            <span class="sku">213141212</span>
                        </div>
                        <div class="product-category-subcategory">
                            <p class="title">Category:</p>
                            <span class="category-subcategory">
                                <a class="category-link" href="#">Peripherals</a>
                                /
                                <a class="subcategory-link" href="#">Controller</a>
                            </span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="product-tab-description">
        <div class="container">
            <div class="row">
                <Accordion class="col-xl-12" title="Description" :active="true">
                    <div class="tab-content col-lg-12">
                        <h3 class="title">Dualshock 4 Wireless Controller</h3>
                        <p class="long_description">The Bluetooth Speaker with Light is the ultimate fusion of sound and
                            visual appeal, designed to enhance any environment with its dynamic audio performance and
                            captivating LED lighting. This portable speaker delivers rich, clear sound with deep bass,
                            making it ideal for music lovers who demand quality on the go.

                            Featuring Bluetooth connectivity, this speaker pairs effortlessly with your devices,
                            allowing you to stream your favorite music wirelessly. The built-in rechargeable battery
                            provides hours of continuous playtime, so you can enjoy your tunes without interruption.</p>
                    </div>
                </Accordion>
            </div>
        </div>
    </section>
</template>

<script>
import Accordion from '../components/Accordion.vue';

export default {
    name: 'ProductDetails',
    components: {
        Accordion,
    },
}
</script>