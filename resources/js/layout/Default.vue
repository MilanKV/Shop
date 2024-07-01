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
</template>

<script>
import Header from '../components/Header.vue'
import Footer from '../components/Footer.vue'

export default {
    name: "Default",
    components: {
        Header,
        Footer,
    }
}
</script>