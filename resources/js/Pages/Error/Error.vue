<template>
<Head title="Error" />
<nav-bar />
  <div class="flex flex-col justify-center items-center my-12">
    <h1 class="text-5xl font-extrabold my-8 text-indigo-700 ">Oops</h1>
    <div class="text-2xl text-gray-800 font-bold">Something went wrong.</div>
  </div>
  <Footer />
</template>

<script>

import { Head, Link } from '@inertiajs/inertia-vue3';
    
    import NavBar from '@/Pages/Partials/NavBar.vue';
     import Footer from '@/Pages/Partials/Footer.vue';
export default {
    components: {
        Head,
        Link,
        
        NavBar,
        Footer,
        
    },
  
  
    
  }
</script>