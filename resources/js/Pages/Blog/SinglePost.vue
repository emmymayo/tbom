<template>
    <Head title="" />
    <nav-bar />
    
    <div class="grid grid-cols-1 lg:grid-cols-3">
    <div class="col-span-2 mx-4 md:mx-12  my-6 flex flex-col space-y-6">
        <h1 class="text-2xl lg:text-3xl text-gray-900 font-bold capitalize"> {{post.title}}  </h1>

        <div class="my-6">
            <img v-if="post.featured_image!=null" :src="post.featured_image" class="h-1/2  rounded-lg " />
            <h3 class="font-light text-gray-600 italic">Published on {{getDate(post.publish_date)}}  </h3>
            <div class="mt-2">
                <span v-for="tag in post.tags" :key="tag.id" class="text-xs uppercase text-indigo-800 rounded-xl px-3 py-1.5 bg-indigo-100">
                    <Link :href="route('publications.tags.index',tag.slug)">{{tag.name}}</Link>
                </span>
            </div>
            
            <div class="font-normal my-4" v-html="post.body">   </div>
            

        </div>
    </div>
    <div class="mx-4 md:mx-12"> 
        <div >
            <h3 class="mt-4 mb-2 text-2xl text-indigo-800 font-bold"> Recent Publications </h3>
            <hr>
            <div v-for='latest_post in latest_posts' :key="latest_post.id">
                <Link v-if="latest_post.id != post.id" :href="route('publications.show',latest_post.slug)">
                    <h5 class="text-gray-700 capitalize text-lg my-2 hover:opacity-75"> {{latest_post.title}} </h5>
                </Link>
            </div>
        </div>
    </div>
    </div>

    <Footer />
</template>



<script>
    import { defineComponent } from 'vue'
    import { Head, Link } from '@inertiajs/inertia-vue3';
    import NavBar from '@/Pages/Partials/NavBar.vue';
     import Footer from '@/Pages/Partials/Footer.vue';
   

    export default defineComponent({
        components: {
            Head,
            Link,
           
            NavBar,
            Footer,
            
        },
        props:['post','latest_posts'],
        methods:{
             getDate(date){
                let d = new Date(date);
                return d.toDateString() +' '+d.toLocaleTimeString();
            }
        }

    
    })
</script>
