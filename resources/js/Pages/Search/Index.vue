<template >
    <Head title="Find Mentors "> </Head>
    <nav-bar />
    <div class="mx-4 py-4 md:px-16" >
        <h1 class="my-4 text-2xl md:text-4xl font-bold">Find Mentors</h1>
        <!-- responsive filter -->
        <div v-if="show_responsive_filter" class="fixed inset-y-0 left-0 w-3/4 bg-white z-20 shadow-lg py-5 px-1">
            <div class="flex justify-between">
                <h4 class="text-lg font-bold">Filter By </h4> 
                <span @click="show_responsive_filter = false" class="font-bold text-lg"> &times;</span>
            </div>
            <hr>
            <div class="my-2">
                <div class="flex justify-between">
                    <h3 class="font-semibold" >Area of Expertise</h3>
                    <!-- Toggle Expertise -->
                    <span @click="show_expertise = ! show_expertise" class="cursor-pointer"> 
                        <!-- Chevron down -->
                        <svg v-show="show_expertise" xmlns="http://www.w3.org/2000/svg" class="h-6 w-6  text-indigo-900" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 15l7-7 7 7" />
                        </svg>
                        <!-- Chevron Up -->
                        <svg v-show="!show_expertise" xmlns="http://www.w3.org/2000/svg" class="h-6 w-6  text-indigo-900" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                        </svg>
                    </span>

                </div>
                <!-- Filter Expertise -->
                <div>
                    
                </div>
                <div class="flex flex-col my-2" v-show="show_expertise">
                    <template v-for="expertise in expertises" :key="expertise.id">
                    <div class="flex flex-row justify-between items-center"> 
                        <!-- :href="route('mentor.search.index')+'?q='+query+'&f='+expertise.id" -->
                        <Link  @click="filter(expertise.id)"
                            class="text-indigo-900 p-1 font-light active:font-bold mt-2 text-sm"
                            :class="{'animate-pulse bg-indigo-100 font-bold':expertise.id==form.f}"> {{expertise.name}}
                        </Link> 
                        <span v-if="expertise.id==form.f" class="cursor-pointer font-bold hover:text-red-500" @click="removeFilter"> &times;</span>
                    </div>
                    </template>
                </div>
            </div>
        </div>

        <!-- End of responsive filter -->

        <div class="grid grid-cols-1 md:grid-cols-4  gap-4 ">
            <!-- Filter Col -->
            <div class=" hidden md:block max-height-screen overflow-y-auto">
                <h4 class="text-lg font-bold">Filter By </h4>
                <hr>
                <div class="my-2">
                    <div class="flex justify-between">
                        <h3 class="font-semibold" >Area of Expertise</h3>
                        <!-- Toggle Expertise -->
                        <span @click="show_expertise = ! show_expertise" class="cursor-pointer"> 
                            <!-- Chevron down -->
                            <svg v-show="show_expertise" xmlns="http://www.w3.org/2000/svg" class="h-6 w-6  text-indigo-900" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 15l7-7 7 7" />
                            </svg>
                            <!-- Chevron Up -->
                            <svg v-show="!show_expertise" xmlns="http://www.w3.org/2000/svg" class="h-6 w-6  text-indigo-900" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                            </svg>
                        </span>

                    </div>
                    <!-- Filter Expertise -->
                    <div>
                        
                    </div>
                    <div class="flex flex-col my-2" v-show="show_expertise">
                        <template v-for="expertise in expertises" :key="expertise.id">
                        <div class="flex flex-row justify-between items-center"> 
                            <!-- :href="route('mentor.search.index')+'?q='+query+'&f='+expertise.id" -->
                            <Link  @click="filter(expertise.id)"
                                class="text-indigo-900 p-1 font-light active:font-bold mt-2"
                                :class="{'animate-pulse bg-indigo-100 font-bold':expertise.id==form.f}"> {{expertise.name}}
                            </Link> 
                            <span v-if="expertise.id==form.f" class="cursor-pointer font-bold hover:text-red-500" @click="removeFilter"> &times;</span>
                        </div>
                        </template>
                    </div>
                </div>
            </div>

            <!-- Search result col -->
            <div class="md:col-span-3 border rounded">
                <!-- Search form -->
                <div class="my-8 mx-4">
                    <div class="flex  items-stretch focus:outline-none focus:ring-2 focus:ring-indigo-600 focus:border-transparent">
                        <input @keyup.enter="search" type="search" v-model="form.q" placeholder="Find mentor by name or expertise" class="rounded-l-lg flex-1 appearance-none border border-gray-300 w-full py-2 px-4 bg-white text-gray-700 placeholder-gray-400 shadow-sm text-base ">
                        <Link  @click="search"  class="bg-indigo-600 hover:bg-indigo-900 rounded-r-lg align-middle px-2">
                            <!-- :href="route('mentor.search.index')+'?q='+query+'&f='+expertise" -->
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-6   fill-current text-gray-100 " viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z" clip-rule="evenodd" />
                            </svg>
                        </Link>
                        
                    </div>
                    <div class="flex justify-end mt-2">
                        <!-- responsive filter button -->
                        <span    @click="show_responsive_filter = ! show_responsive_filter"
                                class="inline md:hidden    hover:opacity-75"> 
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-6   fill-current text-indigo-600 " fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6V4m0 2a2 2 0 100 4m0-4a2 2 0 110 4m-6 8a2 2 0 100-4m0 4a2 2 0 110-4m0 4v2m0-6V4m6 6v10m6-2a2 2 0 100-4m0 4a2 2 0 110-4m0 4v2m0-6V4" />
                                </svg>
                             
                        </span>
                    </div>
                </div>
                <hr class="">
                
                <!-- The individual search results -->
                <div v-for="mentor in mentors.data" :key="mentor.id" class="divide-y">
                <Link :href="route('mentor.profile',{'mentor':mentor.id})">
                    <div class="p-4  cursor-pointer hover:bg-gray-100 my-2">
                        <!-- Row 1 Image and name -->
                        <div class="flex ">
                            <img :src="mentor.user.profile_photo_url" class="h-16 w-16 rounded-full mr-4">
                            <div class="flex flex-col lg:flex-row justify-between w-full ">
                                <div class="">
                                    <h3 class="text-yellow-500 font-sm capitalize  font-semibold">{{mentor.title}} {{mentor.user.name}} </h3>
                                    <h3 class="font-bold text-gray-500" v-if="mentor.assessment_index>0" > 
                                        <!-- Rating Icon -->
                                        <svg xmlns="http://www.w3.org/2000/svg" class="fill-current text-indigo-400 h-4 w-4 inline" xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1" width="256" height="256" viewBox="0 0 256 256" xml:space="preserve">
                                                <desc>Created with Fabric.js 1.7.22</desc>
                                                <defs>
                                                </defs>
                                                <g transform="translate(128 128) scale(0.72 0.72)" style="">
                                                    <g style="stroke: none; stroke-width: 0; stroke-dasharray: none; stroke-linecap: butt; stroke-linejoin: miter; stroke-miterlimit: 10; fill: none; fill-rule: nonzero; opacity: 1;" transform="translate(-175.05 -175.05000000000004) scale(3.89 3.89)" >
                                                    <circle cx="45" cy="45" r="45" style="stroke: none; stroke-width: 1; stroke-dasharray: none; stroke-linecap: butt; stroke-linejoin: miter; stroke-miterlimit: 10; fill: rgb(32,196,203); fill-rule: nonzero; opacity: 1;" transform="  matrix(1 0 0 1 0 0) "/>
                                                    <path d="M 43.589 21.276 l 7.389 14.973 c 0.264 0.536 0.775 0.907 1.366 0.993 l 16.523 2.401 c 1.488 0.216 2.082 2.045 1.006 3.095 L 57.917 54.392 c -0.428 0.417 -0.623 1.017 -0.522 1.606 l 2.823 16.457 c 0.254 1.482 -1.302 2.613 -2.633 1.913 l -14.779 -7.77 c -0.529 -0.278 -1.16 -0.278 -1.689 0 l -14.779 7.77 c -1.331 0.7 -2.887 -0.431 -2.633 -1.913 l 2.823 -16.457 c 0.101 -0.589 -0.094 -1.189 -0.522 -1.606 L 14.05 42.737 c -1.077 -1.05 -0.483 -2.879 1.006 -3.095 l 16.523 -2.401 c 0.591 -0.086 1.102 -0.457 1.366 -0.993 l 7.389 -14.973 C 41 19.927 42.923 19.927 43.589 21.276 z" style="stroke: none; stroke-width: 1; stroke-dasharray: none; stroke-linecap: butt; stroke-linejoin: miter; stroke-miterlimit: 10; fill: rgb(27,167,173); fill-rule: nonzero; opacity: 1;" transform=" matrix(1 0 0 1 0 0) " stroke-linecap="round" />
                                                    <path d="M 46.665 18.199 l 7.389 14.973 c 0.264 0.536 0.775 0.907 1.366 0.993 l 16.523 2.401 c 1.488 0.216 2.082 2.045 1.006 3.095 L 60.994 51.315 c -0.428 0.417 -0.623 1.017 -0.522 1.606 l 2.823 16.457 c 0.254 1.482 -1.302 2.613 -2.633 1.913 l -14.779 -7.77 c -0.529 -0.278 -1.16 -0.278 -1.689 0 l -14.779 7.77 c -1.331 0.7 -2.887 -0.431 -2.633 -1.913 l 2.823 -16.457 c 0.101 -0.589 -0.094 -1.189 -0.522 -1.606 L 17.127 39.66 c -1.077 -1.05 -0.483 -2.879 1.006 -3.095 l 16.523 -2.401 c 0.591 -0.086 1.102 -0.457 1.366 -0.993 l 7.389 -14.973 C 44.077 16.851 46 16.851 46.665 18.199 z" style="stroke: none; stroke-width: 1; stroke-dasharray: none; stroke-linecap: butt; stroke-linejoin: miter; stroke-miterlimit: 10; fill: rgb(255,255,255); fill-rule: nonzero; opacity: 1;" transform=" matrix(1 0 0 1 0 0) " stroke-linecap="round" />
                                                </g>
                                                </g>
                                            </svg>
                                        {{mentor.assessment_index}} 
                                    </h3>
                                    <h5 class="text-gray-700 font-sm font-light">
                                        <!-- <span class=" text-gray-400">Highest Qualification</span> -->
                                        <!-- <span class="px-4 text-yellow-500">| </span> -->
                                        <span class="">{{mentor.qualification.name}}</span> 
                                        
                                    </h5>
                                    <h5 class="text-gray-400"> {{mentor.user.nationality.country}} </h5>
                                </div>
                                <div class="mt-3"> 
                                    <!-- Connect Button -->
                                    <span v-if="!connected(mentor.id) && !requested(mentor.id)" class="bg-gradient-to-r from-indigo-700 via-indigo-600 to-indigo-500 hover:from-yellow-700 hover:via-yellow-600 hover:to-yellow-500 py-2 px-4 cursor-pointer text-gray-100 rounded-lg font-xs font-bold shadow-sm ">
                                        
                                        
                                         <!-- show when not connected -->
                                         <span :class="{'animate-pulse' : loader.state && loader.mentorId == mentor.id}" @click="connect(mentor.id)">Connect</span> 
                                    </span>
                                    <!-- Requested Button -->
                                    <span v-if="requested(mentor.id) " class="bg-gradient-to-r from-indigo-700 via-indigo-600 to-indigo-500 hover:from-yellow-700 hover:via-yellow-600 hover:to-yellow-500 py-2 px-4 cursor-pointer text-gray-100 rounded-lg font-xs font-bold shadow-sm ">
                                        
                                       
                                         <!-- show when not connected -->
                                         <span :class="{'animate-pulse' : loader.state && loader.mentorId == mentor.id}" @click="cancel(mentor.id)">Cancel Request </span> 
                                    </span>
                                </div>
                            </div>
                        </div>
                        <!-- Row 2 About Me -->
                        <div class="mt-4 font-thin text-gray-700">
                            {{mentor.about_me}} 
                        </div>
                        <!-- Expertise Loop -->
                        <div class="mt-4 flex md:flex-wrap gap-1 overflow-x-auto  ">
                            <span class="flex-none bg-yellow-100 px-4 py-2 rounded-full text-gray-600 text-xs font-light" v-for="expertise in mentor.expertises" :key="expertise.id"> {{expertise.name}}</span>
                        </div>
                        <hr class="mt-4">
                    </div>
                </Link>
                </div>
                <!-- Pagination -->
                <div class="flex justify-between my-16 px-4" >
                    <Link :href="mentors.prev_page_url" as="button" :disabled="mentors.prev_page_url==null" class=" px-4 py-2 rounded-full bg-indigo-600 text-gray-100 shadow-sm hover:opacity-75 shadow-sm disabled:opacity-50"  >&laquo; Previous  </Link>
                    <Link :href="mentors.next_page_url" as="button" :disabled="mentors.next_page_url==null" class=" px-4 py-2 rounded-full bg-indigo-600 text-gray-100 shadow-sm hover:opacity-75 shadow-sm disabled:opacity-50" > Next &raquo; </Link>
                </div>
            </div>
            <!-- End of Search result loop -->

            
        </div>

        
    </div>
    <Footer />
</template>

<script>
     import { Head, Link } from '@inertiajs/inertia-vue3';
     import axios from 'axios';
     import NavBar from '@/Pages/Partials/NavBar.vue';
     import Footer from '@/Pages/Partials/Footer.vue';
export default {
    components: {
        Head,
        Link,
        NavBar,
        Footer
    },
    props:['mentors','q','expertises','connected_mentors','requested_mentors','f'],
    data(){
        return {
            form: this.$inertia.form({
                    
                    q: this.q,
                    f: this.f,
                    
                }),
            
            show_expertise:true,
            show_responsive_filter:false,
            filtered_expertises:[],
            loader:{state:false,mentorId:null},
        }
    },
    methods: {
        filter(f=''){
            this.form.f = f;
            this.form.get(route('mentor.search.index'));
            //this.$inertia.visit(route('mentor.search.index')+'?q='+this.q);
        },
        removeFilter(){
            this.form.f = null;
            this.form.get(route('mentor.search.index'));
            //this.$inertia.visit(route('mentor.search.index')+'?q='+this.q);
        },
        search(){
            this.form.get(route('mentor.search.index'))
            // console.log(this.query);
            //     this.$inertia.visit(route('mentor.search.index')+'?q='+this.q+'&f='+this.f);
        },
        connected(mentorId){
            for (const mentor of this.$page.props.connected_mentors) {
                if(mentor.mentor_id ==mentorId){
                    return true
                }
            }
           return false
        },
        connect(mentorId){
            this.loading(mentorId);
             axios.patch(route('mentor.connect.request'),{action:'request','mentor_id':mentorId})
                .then((response) => {
                        this.$inertia.reload({ only: ['connected_mentors','requested_mentors'] });
                        this.stopLoading();
                    })
                .catch((error) => {
                    this.stopLoading();
                    
                })
        },
        requested(mentorId){
            for (const mentor of this.$page.props.requested_mentors) {
                if(mentor.mentor_id ==mentorId){
                    return true
                }
            }
           return false
        },
        cancel(mentorId){
            this.loading(mentorId);
             axios.patch(route('mentor.connect.request'),{action:'cancel','mentor_id':mentorId})
                .then((response) => {
                        this.$inertia.reload({ only: ['connected_mentors','requested_mentors'] });
                        this.stopLoading();
                    })
                .catch((error) => {
                    this.stopLoading();
                    
                })
        },
        loading(mentorId){
            this.loader.state = true;
            this.loader.mentorId = mentorId 
        },
        stopLoading(){
            this.loader.state = false;
            this.loader.mentorId = null 
        }
    },
    


}
</script>