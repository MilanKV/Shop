<template>
    <header>
        <Header />
    </header>
     <main>
         <router-view/>
     </main>
     <footer>
        <!-- <Footer /> -->
     </footer>
</template>

<script>
import Header from '../components/Header.vue'

export default {
    name: "Default",
    components: {
        Header,
    }
}
</script>