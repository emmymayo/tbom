<template >
    <Head title="Find Mentors"> </Head>
    <div class="mx-4 py-4 md:px-16" >
        <h1 class="my-4 text-4xl font-bold">Top Mentors</h1>
        <div class="grid grid-cols-1 md:grid-cols-4  gap-4 ">
            <!-- Filter Col -->
            <div class=" hidden md:block">
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
                        <Link  
                            class="text-indigo-900 font-light active:font-bold mt-2"> {{expertise.name}}
                        </Link>
                        </template>
                    </div>
                </div>
            </div>

            <!-- Search result col -->
            <div class="md:col-span-3 border rounded">
                <!-- Search form -->
                <div class="my-8 ">
                    <div class="flex mx-4 items-stretch focus:outline-none focus:ring-2 focus:ring-indigo-600 focus:border-transparent">
                        <input type="search" v-model="q" class="rounded-l-lg flex-1 appearance-none border border-gray-300 w-full py-2 px-4 bg-white text-gray-700 placeholder-gray-400 shadow-sm text-base ">
                        <Link :href="route('mentor.search.index')+'?q='+q" replace class="bg-indigo-600 hover:bg-indigo-900 rounded-r-lg align-middle px-2">
                            
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-6   fill-current text-gray-100 " viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z" clip-rule="evenodd" />
                            </svg>
                        </Link>
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
                                    <h3 class="text-yellow-500 font-sm  font-semibold">{{mentor.title}} {{mentor.user.name}} </h3>
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
</template>

<script>
     import { Head, Link } from '@inertiajs/inertia-vue3';
     import axios from 'axios';
export default {
    components: {
        Head,
        Link
    },
    props:['mentors','q','expertises','connected_mentors','requested_mentors'],
    data(){
        return {
            show_expertise:true,
            filtered_expertises:[],
            loader:{state:false,mentorId:null},
        }
    },
    methods: {
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
                    alert('Something went wrong. Try again.');
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
                    alert('Something went wrong. Try again.');
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