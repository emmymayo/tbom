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
                    <h3 class="text-center  font-semibold text-xl capitalize  text-indigo-400">{{mentor.title}} {{mentor.user.name}} </h3>
                    <p v-if="mentee_count>0" class="text-center font-thin mt-2 text-gray-400"> {{mentee_count}} {{mentee_count==1 ? 'mentee' : 'mentees'}}</p>
                    <h3 class="font-bold text-gray-500" v-if="$page.props.mentor!=null && $page.props.mentor.assessment_index>0" > 
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
                <div class="flex flex-col"> <span class="text-gray-500 mt-4" v-if="mentor.annual_mentees!=null">Annual Mentees</span> <span class=""> {{mentor.annual_mentees}} </span> </div>
                <div class="flex flex-col"> <span class="text-gray-500 mt-4" v-if="mentor.mentorship_schedule!=null">Mentorship Schedule</span> <span class=""> {{mentor.mentorship_schedule}} </span> </div>
                <div class="flex flex-col"> <span class="text-gray-500 mt-4" v-if="mentor.preffered_platform!=null">Preffered Platform</span> <span class=""> {{mentor.preffered_platform}} </span> </div>
                
                
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