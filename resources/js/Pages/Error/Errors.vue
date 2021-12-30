<template>
<Head title="Error" />
<nav-bar />
  <div class="flex flex-col justify-center items-center my-12">
    <h1 class="text-5xl font-extrabold my-8 text-indigo-700 ">{{title}}</h1>
    <div class="text-2xl text-gray-800 font-bold">{{description}}</div>
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
  props: {
    status: Number,
  },
  computed: {
    title() {
      return {
        503: '503: Service Unavailable',
        500: '500: Server Error',
        404: '404: Page Not Found',
        403: '403: Forbidden',
      }[this.status]
    },
    description() {
      return {
        503: 'Sorry, we are doing some maintenance. Please check back soon.',
        500: 'Whoops, something went wrong on our servers.',
        404: 'Sorry, the page you are looking for could not be found.',
        403: 'Sorry, you are forbidden from accessing this page.',
      }[this.status]
    },
  },
}
</script>