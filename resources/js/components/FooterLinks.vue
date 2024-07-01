<template>
    <div class="footer-section">
        <h3 class="title">{{ title }}</h3>
        <div class="content">
            <ul>
                <li v-for="link in links" :key="link.text">
                    <a :href="link.href">{{ link.text }}</a>
                </li>
            </ul>
        </div>
    </div>
</template>

<script>
export default {
    name: 'FooterLinks',
    props: {
        title: {
            type: String,
            required: true
        },
        links: {
            type: Array,
            required: true
        }
    }
};
</script>