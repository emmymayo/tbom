<template >
    <Head title="Home" />
    
    <nav-bar />
    
    <home-header class="" />
    <count-widget />
     <!-- <features-section /> -->
    <rest-template :posts="posts" />
    <Faq />
    <Footer />
    
</template>


<script>
    import { defineComponent } from 'vue'
    import { Head, Link } from '@inertiajs/inertia-vue3';
    import HomeHeader from './Partials/HomeHeader.vue';
    import NavBar from './Partials/NavBar.vue';
    import Footer from './Partials/Footer.vue';
    import Faq from './Partials/Faq.vue';
    import CountWidget from './Partials/CountWidget.vue';
    import FeaturesSection from './Partials/FeaturesSection.vue';
    import RestTemplate from './Partials/RestTemplate.vue';

    export default defineComponent({
        components: {
            Head,
            Link,
            HomeHeader,
            NavBar,
            Footer,
            Faq,
            CountWidget,
            FeaturesSection,
            RestTemplate
        },

        props: {
            canLogin: Boolean,
            canRegister: Boolean,
            laravelVersion: String,
            phpVersion: String,
            posts: Array
        }
    })
</script>
