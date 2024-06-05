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
                                <button class="link" @click="setActiveView('grid')" :class="{ active: activeView === 'grid' }">
                                    <img src="../../img/icons/grid.svg">
                                </button>
                                <button class="link" @click="setActiveView('list')" :class="{ active: activeView === 'list' }">
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
                    </div>
                    <div class="right col-lg-9">
                        <div class="content mb-40">
                            <div class="tab-panel">
                                <div v-if="activeView === 'grid'" class="tab-grid-view" :class="{ 'fade-out': switchingView }">
                                    <div class="row">
                                        <GridCard 
                                            v-for="product in products" 
                                            :key="product.id"
                                            :productName="product.name"
                                            :imageUrl="product.imageUrl"
                                            :productPrice="product.price"
                                            :discount="product.discount"
                                            :description="product.description"
                                        />
                                    </div>
                                </div>
                                <div v-else-if="activeView === 'list'" class="tab-list-view" :class="{ 'fade-out': switchingView }">
                                    <div class="row">
                                        <ListCard 
                                            v-for="product in products" 
                                            :key="product.id"
                                            :productName="product.name"
                                            :imageUrl="product.imageUrl"
                                            :productPrice="product.price"
                                            :discount="product.discount"
                                            :description="product.description"
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
import Search from '../components/Search.vue';
import Accordion from '../components/Accordion.vue';
import GridCard from '../components/Grid-Card.vue';
import ListCard from '../components/List-Card.vue';

export default {
    name: "Shop",
    components: {
        Search,
        Accordion,
        GridCard,
        ListCard,
    },
    data() {
        return {
            dropdownActive: false,
            currentSorting: 'Popular',
            activeView: 'grid',
            switchingView: false,
            sortingOptions: ['Popular', 'Low to High', 'High to Low', 'Latest', 'On Sale'],
            rotated: false,
            brands: ['Sony', 'Samsung', 'LG', 'Lenovo', 'Sam'],
            selectedBrand: null,
            colors: ['Green', 'Yellow', 'Black', 'Blue', 'Red'],
            selectedColor: null,
            prices: ['Under $50', '$50 - $100', '$100 - $200', 'Above $200'],
            selectedPrice: null,
            products: [
                {
                    id: 1,
                    imageUrl: "https://i.ibb.co/2ZZ6hxW/product-27.jpg",
                    name: "HP Reverb G2 VR Headset",
                    price: "$999.99",
                    discount: "10%",
                    description: "Experience cutting-edge virtual reality with the HP Reverb G2 VR Headset. Enjoy stunning visuals with high-resolution lenses and a comfortable, adjustable fit. Perfect for immersive gaming, virtual tours, and professional applications. Elevate your VR experience with this top-tier headset.",
                },
                {
                    id: 2,
                    imageUrl: "https://i.ibb.co/qxYc8ts/product-25.jpg",
                    name: "Wireless Rechargeable Battery Powered Camera",
                    price: "$51.00",
                    description: "Capture every moment effortlessly with the Wireless Rechargeable Battery Powered Camera. Enjoy the convenience of wire-free operation and long-lasting battery life. Perfect for security, adventure, and everyday use. This versatile camera ensures you never miss a shot, anytime, anywhere.",
                },
                {
                    id: 3,
                    imageUrl: "https://i.ibb.co/VWr49c2/product-24.jpg",
                    name: "Polaroid Go and Camera Case Bundle",
                    price: "$49.99",
                    discount: "5%",
                    description: "Capture instant memories with the compact Polaroid Go and Camera Case Bundle. Featuring the smallest analog instant camera, this bundle is perfect for on-the-go photography. Includes a stylish and protective case, ensuring your camera stays safe while you're out creating memories.",
                },
                {
                    id: 4,
                    imageUrl: "https://i.ibb.co/x81YysG/product-5.jpg",
                    name: "E68 Wireless Headphone Bluetooth",
                    price: "$111.99",
                    description: "Experience superior sound quality with the E68 Wireless Bluetooth Headphones. Enjoy the freedom of wireless connectivity, long battery life, and comfortable design. Perfect for music lovers, gamers, and professionals who demand high-fidelity audio and seamless performance.",
                },
                {
                    id: 5,
                    imageUrl: "https://i.ibb.co/CB7zKR9/product-26.jpg",
                    name: "New Beats Studio Buds",
                    price: "$200.00",
                    discount: "60%",
                    description: "Discover a new level of audio excellence with the New Beats Studio Buds. These true wireless earbuds deliver powerful sound, active noise cancellation, and all-day comfort. Ideal for music enthusiasts, athletes, and anyone on the go, offering premium sound quality and a sleek, compact design.",
                },
                {
                    id: 6,
                    imageUrl: "https://i.ibb.co/zJnrwrK/product-21.jpg",
                    name: "Bluetooth speaker with light",
                    price: "$99.99",
                    description: "Illuminate your music experience with the Bluetooth Speaker with Light. This portable speaker combines high-quality sound with dynamic LED lighting effects. Perfect for parties, outdoor adventures, or relaxing at home, providing an immersive audio-visual experience anywhere you go.",
                },
                {
                    id: 7,
                    imageUrl: "https://i.ibb.co/mCKTs61/product-23.jpg",
                    name: "Cougar Gaming Case (Conquer)",
                    price: "$2023.00",
                    description: "Elevate your gaming setup with the Cougar Gaming Case (Conquer). This robust and stylish case features a unique open-frame design, superior cooling capabilities, and customizable lighting. Ideal for gamers and PC enthusiasts who want a high-performance, visually striking case for their build.",
                },
                {
                    id: 8,
                    imageUrl: "https://i.ibb.co/ncm9NFx/product-6.jpg",
                    name: "ViewSonic Professional Monitor",
                    price: "$1999.99",
                    discount: "65%",
                    description: "Enhance your productivity with the ViewSonic Professional Monitor. Featuring stunning 4K resolution, accurate color reproduction, and versatile connectivity options. Perfect for designers, photographers, and professionals who require precise and vibrant visuals for their work.",
                },
                {
                    id: 9,
                    imageUrl: "https://i.ibb.co/5FGVYm3/product-20.jpg",
                    name: "Dualshock 4 Wireless Controller",
                    price: "$99.99",
                    description: "Elevate your gaming experience with the Dualshock 4 Wireless Controller. Featuring responsive buttons, precise analog sticks, and an integrated touchpad, this controller is perfect for PlayStation gamers. Enjoy seamless wireless connectivity and ergonomic design for hours of comfortable gameplay.",
                },
            ],
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
        },
        setActiveView(view) {
            this.switchingView = true;
            setTimeout(() => {
                this.activeView = view;
                this.switchingView = false;
            }, 300);
        },
    },
};
</script>