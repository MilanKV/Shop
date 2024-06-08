<template> 
    <div class="sidebar">
        <div class="tab">
            <Accordion title="Brand" :active="true">
                <div class="mini-search">
                    <Search />
                </div>
                <div class="list">
                    <div class="list-item" v-for="brand in brands" :key="brand.id">
                        <input type="checkbox" :id="brand.id" class="custom" :checked="selectedBrand === brand.id" @change="selectBrand(brand.id)">
                        <label :for="brand.id">{{ brand.brand_name }}</label>
                    </div>
                </div>
            </Accordion>
        </div>
        <div class="tab">
            <Accordion title="Color" :active="true">
                <div class="list">
                    <div class="list-item-color" v-for="color in colors" :key="color">
                        <input type="checkbox" :id="color" class="color-checkbox" :checked="selectedColor === color" @change="selectColor(color)">
                        <label :for="color" :style="getColorStyle(color)">{{ color }}</label>
                    </div>
                </div>
            </Accordion>
        </div>
        <div class="tab">
            <Accordion title="Price" :active="true">
                <div class="list">
                    <div class="list-item" v-for="price in prices" :key="price">
                        <input type="checkbox" :id="price" class="custom" :checked="selectedPrice === price" @change="selectPrice(price)">
                        <label :for="price">{{ price }}</label>
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
    }
}
</script>