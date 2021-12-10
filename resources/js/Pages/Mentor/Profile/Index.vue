<template>
    <nav-bar />
    <Head :title="mentor.user.name - Profile"> </Head>

    <div class=" py-4 bg-gray-100 min-h-screen ">
        <!-- top Section  -->
        <div class="flex flex-col md:flex-row justify-between px-4 items-center my-8"> 
            <!-- DP and Basic Info -->
            <div class="flex items-center gap-2"> 
                <img :src="mentor.user.profile_photo_url" class="rounded-full h-36 w-36 object-cover mt-4 " />
                <div class="flex flex-col">
                    <h3 class="text-center  font-semibold text-xl  text-indigo-400">{{mentor.title}} {{mentor.user.name}} </h3>
                    <p v-if="mentee_count>0" class="text-center font-thin mt-2 text-gray-400"> {{mentee_count}} {{mentee_count==1 ? 'mentee' : 'mentees'}}</p>
                </div>
            </div>
            <!-- Connect Buttons -->
            <div class="mt-4 ">
                <span v-if="is_requested " class="bg-gradient-to-r from-indigo-700 via-indigo-600 to-indigo-500 hover:from-yellow-700 hover:via-yellow-600 hover:to-yellow-500 py-2 px-4 cursor-pointer text-gray-100 rounded-lg font-xs font-bold shadow-sm ">
                    <span :class="{'animate-pulse' : loader.state }" @click="cancel(mentor.id)">Cancel Request </span> 
                </span>
                <span v-if="!is_requested && !is_connected " class="bg-gradient-to-r from-indigo-700 via-indigo-600 to-indigo-500 hover:from-yellow-700 hover:via-yellow-600 hover:to-yellow-500 py-2 px-4 cursor-pointer text-gray-100 rounded-lg font-xs font-bold shadow-sm ">
                    <span :class="{'animate-pulse' : loader.state }" @click="connect(mentor.id)">Connect </span> 
                </span>
                <span v-if="is_connected " class="mx-4 bg-gradient-to-r from-green-500 to-green-400 hover:bg-green-300 hover:opacity-75 py-2 px-4 cursor-pointer text-gray-100 rounded-lg font-xs font-bold shadow-sm ">
                    <Link :href="route('mentor-assessment.edit',{mentor:mentor.id})" ><span  @click="assess(connected_mentor.mentor_id)">Assess</span> </Link>
                </span> 
                <span v-if="is_connected " class="bg-gradient-to-r from-indigo-700 via-indigo-600 to-indigo-500 hover:from-yellow-700 hover:via-yellow-600 hover:to-yellow-500 py-2 px-4 cursor-pointer text-gray-100 rounded-lg font-xs font-bold shadow-sm ">
                    <span :class="{'animate-pulse' : loader.state }" @click="disconnect(mentor.id)">Disconnect </span> 
                </span>
                
                
            </div>

        </div>


        <div class="grid grid-cols-1 md:grid-cols-3 gap-4 md:m-6">
             <div class="bg-white shadow-md flex flex-col p-2 md:p-6">
                <h2 class="text-gray-700 font-semibold text-xl">Basic Information </h2>
                <hr class="mb-4">
                <div class="flex flex-col"> <span class="text-gray-500 mt-4">Country</span> <span class=""> {{mentor.user.nationality.country}} </span> </div>
                <div class="flex flex-col"> <span class="text-gray-500 mt-4">Highest Qualification</span> <span class=""> {{mentor.qualification.name}} </span> </div>
                
                <assess-mentor v-if="is_connected"> </assess-mentor>
            </div>
            <div class="md:col-span-2 md:order-first grid grid-cols-1 md:grid-cols-2 gap-6  bg-white shadow-md p-2 md:p-6">
                <div class="md:col-span-2"> 
                    <h2 class="text-gray-700  text-xl"> General Information </h2>
                    <h4 class="text-gray-500 font-thin "> Personal information and expertise details </h4>
                    <hr class="mb-4">
                </div>
                <div v-for="expertise in mentor.expertises" :key="expertise.id" class="flex flex-col "> 
                    <h3 class="text-gray-400 mt-3 font-semibold"> {{expertise.name}}  </h3>
                    <h5 class="text-gray-700 mt-3 font-bold"> Years of Experience: {{expertise.pivot.years_of_experience}}  </h5>
                    <h5 class="text-gray-700 mt-3 font-bold"> Duration of mentorship: {{expertise.pivot.duration_of_mentorship}}  </h5>
                </div>
                <div class="md:col-span-2">
                    <h4 class="text-gray-500 font-thin "> About me. </h4>
                    <p class="font-light mt-4"> {{mentor.about_me}} </p>
                </div>
            </div>
        </div>
    </div>
    <Footer />
</template>

<script>
     import { Head, Link } from '@inertiajs/inertia-vue3';
     import AssessMentor from '@/Pages/Mentor/Profile/Partials/AssessMentor.vue';
     import axios from 'axios';
     import NavBar from '@/Pages/Partials/NavBar.vue';
    import Footer from '@/Pages/Partials/Footer.vue';
export default {
        components: {
        Head,
        Link,
        NavBar,
        Footer,
        AssessMentor
    },
    props:['mentor','is_connected', 'is_requested', 'mentee_count'],
    data(){
        return {
            
            loader:{state:false},
        }
    },
    methods:{
        cancel(mentorId){
            this.loading();
             axios.patch(route('mentor.connect.request'),{action:'cancel','mentor_id':mentorId})
                .then((response) => {
                        this.$inertia.reload();
                        this.loader.state = false;
                    })
                .catch((error) => {
                    this.stopLoading();
                    alert('Something went wrong. Try again.');
                })
        },
        connect(mentorId){
            this.loading();
             axios.patch(route('mentor.connect.request'),{action:'request','mentor_id':mentorId})
                .then((response) => {
                        this.$inertia.reload();
                        this.stopLoading();
                    })
                .catch((error) => {
                    this.stopLoading();
                    alert('Something went wrong. Try again.');
                })
        },
        disconnect(mentorId){
            if(!confirm('Are you sure you want to be disconnected from this mentor?')){
                return;
            }
            this.loading(mentorId);
             axios.patch(route('mentor.connect.request'),{action:'disconnect','mentor_id':mentorId})
                .then((response) => {
                        this.$inertia.reload();
                        this.stopLoading();
                    })
                .catch((error) => {
                    this.stopLoading();
                    alert('Something went wrong. Try again.');
                })
        },
        loading(){
            this.loader.state = true;
        },
        stopLoading(){
            this.loader.state = false;
        }
    }
}
</script>