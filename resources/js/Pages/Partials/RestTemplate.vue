<template>
    
<!-- Section 1 -->
<section class="relative w-full bg-white mt-12" v-if="posts.length>0">
    <div class="absolute w-full h-32 bg-gradient-to-b from-gray-100 to-white"></div>
    <div class="relative w-full px-5 py-10 mx-auto sm:py-12 md:py-16 md:px-10 max-w-7xl">

        <h1 class="mb-1 text-2xl font-extrabold leading-none text-gray-900 lg:text-3xl xl:text-4xl sm:mb-3"><a href="#_">Events And Publications</a></h1>
        <p class="text-lg font-medium text-gray-500 sm:text-2xl"></p>
        <div class="flex grid h-full grid-cols-12 gap-10 pb-10 mt-8 sm:mt-16">
            
           

            <div class="grid grid-cols-12 col-span-12 gap-7">
                
                <div v-for="post in posts" :key="post.id" class=" border-gray-200 flex flex-col items-start col-span-12 overflow-hidden shadow-sm rounded-xl md:col-span-6 lg:col-span-4">
                    <Link :href="route('publications.show',post.slug)" class="block transition duration-200 ease-out transform hover:scale-110">
                        <img v-if="post.featured_image!=null" class="object-cover w-full  h-56" :src="post.featured_image">
                        <img v-else class="object-cover w-full  h-56" src="/images/tbom-logo.png">
                        <!-- <img v-if="post.featured_image" class="object-cover w-full shadow-sm max-h-56" src="https://cdn.devdojo.com/images/may2021/workstation.jpg"> -->
                    </Link>
                    <div class="relative flex flex-col items-start px-6 bg-white  py-7 rounded-b-2xl">
                        <div v-if="post.tags[0]!=null" class="bg-indigo-400 absolute top-0 -mt-3 flex items-center px-3 py-1.5 leading-none w-auto inline-block rounded-full text-xs font-medium uppercase text-white inline-block">
                            <Link :href="route('publications.tags.index',post.tags[0].slug)">
                                <span >{{post.tags[0].name}}</span>
                            </Link>
                        </div>
                        <h2 class="text-base font-bold sm:text-lg "><Link :href="route('publications.show',post.slug)">{{post.title}}</Link></h2>
                        <p class="mt-2 text-base text-gray-700">{{post.excerpt}}</p>
                    </div>
                </div>
                <!-- <div class="flex flex-col items-start col-span-12 overflow-hidden shadow-sm rounded-xl md:col-span-6 lg:col-span-4">
                    <a href="#_" class="block transition duration-200 ease-out transform hover:scale-110">
                        <img class="object-cover w-full shadow-sm max-h-56" src="https://cdn.devdojo.com/images/may2021/snacks.jpg">
                    </a>
                    <div class="relative flex flex-col items-start px-6 bg-white border border-t-0 border-gray-200 py-7 rounded-b-2xl">
                        <div class="bg-red-400 absolute top-0 -mt-3 flex items-center px-3 py-1.5 leading-none w-auto inline-block rounded-full text-xs font-medium uppercase text-white inline-block">
                            <span>Food</span>
                        </div>
                        <h2 class="text-base font-bold sm:text-lg md:text-xl"><a href="#_">Keto-Diet</a></h2>
                        <p class="mt-2 text-sm text-gray-500">Learn how to be more disciplined in your diet and lose some of those extra weight.</p>
                    </div>
                </div>

                <div class="flex flex-col items-start col-span-12 overflow-hidden shadow-sm rounded-xl md:col-span-6 lg:col-span-4">
                    <a href="#_" class="block transition duration-200 ease-out transform hover:scale-110">
                        <img class="object-cover w-full shadow-sm max-h-56" src="https://cdn.devdojo.com/images/may2021/book-design.jpg">
                    </a>
                    <div class="relative flex flex-col items-start px-6 bg-white border border-t-0 border-gray-200 py-7 rounded-b-2xl">
                        <div class="bg-purple-500 absolute top-0 -mt-3 flex items-center px-3 py-1.5 leading-none w-auto inline-block rounded-full text-xs font-medium uppercase text-white inline-block">
                            <span>Science & Tech</span>
                        </div>
                        <h2 class="text-base font-bold sm:text-lg md:text-xl"><a href="#_">Artificial Intelligence</a></h2>
                        <p class="mt-2 text-sm text-gray-500">Imagine the influence of AI in the tech, and consider the limitless possibilities.</p>
                    </div>
                </div> -->
            </div>

        </div>
    </div>
</section>



</template>

<script>
import { Head, Link } from "@inertiajs/inertia-vue3";
export default {
    components:{
        Link
    },
    props:['posts'],
    setup(props){
        console.log(props);
    }
}
</script>