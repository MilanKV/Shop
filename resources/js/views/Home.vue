<template>
    <section class="hero-section">
        <div class="row">
            <div class="left col-xl-6 col-lg-6">
                <span class="small-title">Elevate Your <br> <span class="bold-text">Audio</span> Experience</span>
                <h3 class="title">Unmatched <br> Sound Quality.</h3>
                <a href="/shop" class="btn btn-outline">
                    Shop Now
                    <img src="../../img/icons/arrow-right.svg" alt="arrow-right">
                </a>
            </div>
            <div class="right col-xl-6 col-lg-6">
                <span class="circle"></span>
                <span class="circle"></span>
                <img src="../../img/Images/Headphones.png" alt="Headphone" class="img-responsive">
            </div>
        </div>
    </section>
    <section class="category-section">
        <div class="container">
            <div class="row">
                <div class="category-slider col-xxl-12">
                    <swiper class="slider-horizontal swiper-container" :modules="modules" :breakpoints="breakpoints"
                        :slides-per-view="slidesPerView" :space-between="20" :scrollbar="{ draggable: true }"
                        @swiper="onSwiper" @slideChange="onSlideChange">
                        <swiper-slide class="category-item " v-for="(category, index) in categories" :key="index">
                            <div class="category-image">
                                <a href="#" class="image" @click.prevent="goToShopWithCategory(category.id)">
                                    <img :src="getImageUrl(category)" alt="">
                                </a>
                            </div>
                            <div class="category-content">
                                <h3 class="category-title">
                                    <a href="#" class="title" @click.prevent="goToShopWithCategory(category.id)">{{
                        category.category_name }}</a>
                                </h3>
                            </div>
                        </swiper-slide>
                    </swiper>
                </div>
            </div>
        </div>
    </section>
</template>

<script>
import { mapState, mapActions } from 'vuex';
import { Swiper, SwiperSlide } from 'swiper/vue';
import { Scrollbar } from 'swiper/modules';

import "swiper/css";
import 'swiper/css/scrollbar';

export default {
    name: 'Home',
    components: {
        Swiper,
        SwiperSlide,
    },
    data() {
        return {
            modules: [Scrollbar],
            slidesPerView: 4,
            breakpoints: {
                // when window width is >= 320px
                320: {
                    slidesPerView: 1,
                },
                // when window width is >= 480px
                480: {
                    slidesPerView: 2,
                },
                // when window width is >= 640px
                640: {
                    slidesPerView: 2,
                },
                // when window width is >= 1024px
                1024: {
                    slidesPerView: 3,
                },
                // when window width is >= 1440px
                1440: {
                    slidesPerView: 4,
                }
            }
        };
    },
    computed: {
        ...mapState({
            categories: state => state.categories,
        }),

    },
    methods: {
        ...mapActions(['fetchCategories']),

        getImageUrl(category) {
            return `/storage/${category.category_image}`;
        },
        onSwiper(swiper) {
            // console.log(swiper);
        },
        onSlideChange() {
            // console.log('slide change');
        },
        goToShopWithCategory(categoryId) {
            this.$router.push({ name: 'Shop', query: { category: categoryId } });
        },
    },
    created() {
        this.fetchCategories();
    }
}
</script>