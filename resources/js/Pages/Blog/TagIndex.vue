<template>
    <Head title="Publications" />
    <nav-bar />
    

    <div class="mx-4 md:mx-12  my-6 flex flex-col space-y-6">
        <div class="">
            <h1 class="text-4xl font-bold mb-4"> Publications <span class="capitalize italic text-base text-gray-600">({{tag.name}}) </span>
                
            </h1>
            <div class="  w-full md:w-1/2  flex items-center  items-stretch focus:outline-none focus:ring-2 focus:ring-indigo-600 focus:border-transparent">
                    <input @keyup.enter="search" type="search" v-model="form.q" placeholder="Find publications by title" class="rounded-l-lg flex-1 appearance-none border border-gray-300 w-full py-1 px-2 bg-white text-gray-700 placeholder-gray-400 shadow-sm text-base ">
                    <Link  @click="search"  class="bg-gray-600 text-gray-100 hover:bg-gray-900 rounded-r-lg align-middle px-2">
                        <span class="inline-block pt-1 align-middle">Search</span>
                    </Link>
                    
            </div> 
        </div>
        

        <div class="my-6">
            <div v-for="post in posts.data" :key="post.id">
                <Link :href="route('publications.show',post.slug)">
                <div class="p-2 flex flex-col md:flex-row-reverse justify-between gap-2  my-4 hover:opacity-75 hover:bg-gray-100">
                    <div>
                        <img v-if="post.featured_image!=null" :src="post.featured_image" class="h-32 rounded-lg" >
                        
                    </div>
                    <div>
                        <h3 class="text-xl capitalize font-bold text-gray-700">{{post.title}} </h3>
                        <h3 class="text-md capitalize font-light text-gray-500">{{post.excerpt}} </h3>
                        <h3 class="font-light text-gray-600 italic">published on {{getDate(post.publish_date)}}  </h3>
                        <div class="mt-2 flex flex-row flex-nowrap overflow-x-auto">
                        <span v-for="tag in post.tags" :key="tag.id" class="text-xs uppercase text-indigo-800 rounded-xl px-3 py-1.5 bg-indigo-100">
                            <Link :href="route('publications.tags.index',tag.slug)">{{tag.name}}</Link>
                        </span>
                    </div>
                    </div>
                    
                </div>
                </Link>
                <hr>
            </div>

            <!-- Pagination -->
                <div class="flex justify-between my-16 px-4" >
                    <Link :href="posts.prev_page_url" as="button" :disabled="posts.prev_page_url==null" class=" px-4 py-2 rounded-full bg-indigo-600 text-gray-100 shadow-sm hover:opacity-75 shadow-sm disabled:opacity-50"  >&laquo; Previous  </Link>
                    <Link :href="posts.next_page_url" as="button" :disabled="posts.next_page_url==null" class=" px-4 py-2 rounded-full bg-indigo-600 text-gray-100 shadow-sm hover:opacity-75 shadow-sm disabled:opacity-50" > Next &raquo; </Link>
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
        props:['posts','q','tag'],
        data(){
            return {
                form: this.$inertia.form({
                    
                    q: this.q
                    
                })
            }
        },
        methods:{
            getDate(date){
                let d = new Date(date);
                return d.toDateString() +' '+d.toLocaleTimeString();
            },
            
            search(){
            this.form.get(route('publications.index'))
            
        }
        }

    
    })
</script>
