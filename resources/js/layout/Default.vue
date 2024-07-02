<template>
    <header>
        <Header />
    </header>
    <main>
        <router-view />
    </main>
    <footer>
        <Footer />
    </footer>
    <BackToTop />
</template>

<script>
import Header from '../components/Header.vue'
import Footer from '../components/Footer.vue'
import BackToTop from '../components/BackToTop.vue'

export default {
    name: "Default",
    components: {
        Header,
        Footer,
        BackToTop,
    }
}
</script>