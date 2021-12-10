<template>
    <nav-bar />
    <Head :title="mentee.user.name - Profile"> </Head>

    <div class=" py-4 bg-gray-100 min-h-screen ">
        <!-- top Section  -->
        <div class="flex flex-col md:flex-row justify-between px-4 items-center my-8"> 
            <!-- DP and Basic Info -->
            <div class="flex items-center gap-2"> 
                <img :src="mentee.user.profile_photo_url" class="rounded-full h-36 w-36 object-cover mt-4 " />
                <div class="flex flex-col">
                    <h3 class="text-center  font-semibold text-xl  text-indigo-400"> {{mentee.user.name}} </h3>
                    <p v-if="mentor_count>0" class="text-center font-thin mt-2 text-gray-400"> {{mentor_count}} {{mentor_count==1 ? 'mentor' : 'mentors'}}</p>
                </div>
            </div>
            <!-- Connect Buttons -->
            <div class="mt-4 ">
                
                <span v-if="is_requested  " class="mx-4 bg-gradient-to-r from-green-500 via-green-400 to-green-300 hover:opacity-75 py-2 px-4 cursor-pointer text-gray-100 rounded-lg font-xs font-bold shadow-sm ">
                    <span :class="{'animate-pulse' : loader.state && loader.action == 'accept' }" @click="accept(mentee.id)">Accept </span> 
                </span>
                
                <span v-if="is_requested " class="mx-4 bg-gradient-to-r from-red-600 via-red-500 to-red-400 hover:opacity-75 py-2 px-4 cursor-pointer text-gray-100 rounded-lg font-xs font-bold shadow-sm ">
                    <span :class="{'animate-pulse' : loader.state && loader.action == 'decline' }" @click="decline(mentee.id)">Decline </span> 
                </span>
                
                <span v-if="is_connected " class="mx-4 bg-gradient-to-r from-indigo-700 via-indigo-600 to-indigo-500 hover:from-yellow-700 hover:via-yellow-600 hover:to-yellow-500 py-2 px-4 cursor-pointer text-gray-100 rounded-lg font-xs font-bold shadow-sm ">
                    <span :class="{'animate-pulse' : loader.state && loader.action == 'disconnect' }" @click="disconnect(mentee.id)">Disconnect </span> 
                </span>
            </div>

        </div>


        <div class="grid grid-cols-1 md:grid-cols-3 gap-4 md:m-6">
             <div class="bg-white shadow-md flex flex-col p-2 md:p-6">
                <h2 class="text-gray-700 font-semibold text-xl">Basic Information </h2>
                <hr class="mb-4">
                <div class="flex flex-col"> <span class="text-gray-500 mt-4">Country</span> <span class=""> {{mentee.user.nationality.country}} </span> </div>
                <div class="flex flex-col"> <span class="text-gray-500 mt-4">Date of Birth</span> <span class=""> {{mentee.dob}} </span> </div>
                
                
            </div>
            <div class="md:col-span-2 md:order-first grid grid-cols-1 md:grid-cols-2 gap-6  bg-white shadow-md p-2 md:p-6">
                <div class="md:col-span-2"> 
                    <h2 class="text-gray-700  text-xl"> Academic Information </h2>
                    <h4 class="text-gray-500 font-thin "> Information on academic experience  </h4>
                    <hr class="mb-4">
                </div>
                <div v-for="experience in mentee.experiences" :key="experience.id" class="flex flex-col "> 
                    <h3 class="text-gray-400 mt-3 font-semibold"> {{experience.school}}  </h3>
                    <h5 class="text-gray-700 mt-3 font-light" v-if="experience.from"> <span class="text-indigo-400">From</span> {{experience.from}}  </h5>
                    <h5 class="text-gray-700 mt-3 font-light" v-if="experience.to"> <span class="text-indigo-400">To</span> {{experience.to}}  </h5>
                    <h5 class="text-gray-700 mt-3 font-light" v-if="experience.degree"> <span class="text-indigo-400">Certification/Degree</span> {{experience.degree}}  </h5>
                    <h5 class="text-gray-700 mt-3 font-light" v-if="experience.area_of_study"> <span class="text-indigo-400">Area of Study</span> {{experience.area_of_study}}  </h5>
                    <h5 class="text-gray-700 mt-3 font-light" v-if="experience.description"> <span class="text-indigo-400">Additional Information</span> {{experience.description}}  </h5>
                </div>
                
            </div>
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
    props:['mentee','is_connected', 'is_requested', 'mentor_count'],
    data(){
        return {
            
            loader:{state:false, action:''},
        }
    },
    methods:{
        decline(menteeId){
            this.loading('decline');
             axios.patch(route('mentee.connect.request'),{action:'decline','mentee_id':menteeId})
                .then((response) => {
                        this.$inertia.reload();
                        this.stopLoading();
                    })
                .catch((error) => {
                    this.stopLoading();
                    alert('Something went wrong. Try again.');
                })
        },
        accept(menteeId){
            this.loading('accept');
             axios.patch(route('mentee.connect.request'),{action:'accept','mentee_id':menteeId})
                .then((response) => {
                        this.$inertia.reload();
                        this.stopLoading();
                    })
                .catch((error) => {
                    this.stopLoading();
                    alert('Something went wrong. Try again.');
                })
        },
        disconnect(menteeId){
            if(!confirm('Are you sure you want to be disconnected from this mentee?')){
                return;
            }
            this.loading('disconnect');
             axios.patch(route('mentee.connect.request'),{action:'disconnect','mentee_id':menteeId})
                .then((response) => {
                        this.$inertia.reload();
                        this.stopLoading();
                    })
                .catch((error) => {
                    this.stopLoading();
                    alert('Something went wrong. Try again.');
                })
        },
        loading(action=''){
            this.loader.action = action;
            this.loader.state = true;
        },
        stopLoading(){
            this.loader.action = '';
            this.loader.state = false;
        }
    }
}
</script>