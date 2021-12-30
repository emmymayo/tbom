<template>
    <app-layout title="Mentors">
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                 Mentors
            </h2>
        </template>

        <!--  Mentors -->
        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-4">
                    
                    <div class="tabs flex  flex-nowrap overflow-x-auto gap-x-6 py-4 shadow-sm"> 
                        <span class="flex-shrink-0 cursor-pointer inline-block px-2 py-4 text-gray-400 font-bold hover:bg-gray-100" :class="{'text-indigo-500 border-b-2 border-indigo-500': currentTab=='connected'}" @click="setCurrentTab('connected')">
                            My Mentors 
                            <span class="rounded-full px-2 bg-gray-100 text-gray-400" v-show="connected_mentors.length>0"> {{connected_mentors.length}} </span>
                        </span>
                        <span class="flex-shrink-0 cursor-pointer inline-block px-2 py-4 text-gray-400 font-bold hover:bg-gray-100" :class="{'text-indigo-500 border-b-2 border-indigo-500': currentTab=='requested'}" @click="setCurrentTab('requested')">
                            Requested Mentors 
                            <span class="rounded-full px-2 bg-gray-100 text-gray-400" v-show="requested_mentors.length>0"> {{requested_mentors.length}} </span>
                        </span>
                    </div>

                    <div class="">
                        <!-- Conected Mentors -->
                            <div class="flex flex-col " v-if="currentTab=='connected'">
                                <div v-for="connected_mentor in connected_mentors" :key="connected_mentor.id">
                                    <div class="flex flex-col  md:flex-row md:justify-between  md:items-center mt-2 py-2 space-y-4 hover:bg-gray-100" >
                                        <Link :href="route('mentor.profile',{'mentor':connected_mentor.mentor_id})" >
                                            <div class="flex items-center gap-x-6">
                                                <img :src="connected_mentor.mentor.user.profile_photo_url" class="h-16 w-16 rounded-full object-cover" />
                                                <div class="">
                                                   
                                                    <h3 class="capitalize text-indigo-600 hover:underline">{{connected_mentor.mentor.title}} {{connected_mentor.mentor.user.name}} </h3>     
                                                    
                                                </div>
                                            </div>
                                        </Link>
                                        <div>   
                                            <span  class="mx-4 bg-gradient-to-r from-green-500 to-green-400 hover:bg-green-300 hover:opacity-75 py-2 px-4 cursor-pointer text-gray-100 rounded-lg font-xs font-bold shadow-sm ">
                                                <span  @click="assess(connected_mentor.mentor_id)">Assess</span> 
                                            </span> 
                                            <span  class="mx-4 bg-gradient-to-r from-red-500 to-red-400 hover:bg-red-300 hover:opacity-75 py-2 px-4 cursor-pointer text-gray-100 rounded-lg font-xs font-bold shadow-sm ">
                                                <span :class="{'animate-pulse' : loader.state && loader.mentorId == connected_mentor.mentor_id}" @click="disconnect(connected_mentor.mentor_id)">Disconnect</span> 
                                            </span> 
                                        </div>
                                        
                                    </div>
                                    <hr class="mt-2">
                                </div>
                            </div>
                        
                        <!-- Requested Mentor  -->
                        <div class="flex flex-col " v-if="currentTab=='requested'">
                            <div v-for="requested_mentor in requested_mentors" :key="requested_mentor.id">
                                <div class="flex flex-col  md:flex-row md:justify-between  md:items-center mt-2 py-2 space-y-4 hover:bg-gray-100">
                                    <Link :href="route('mentor.profile',{'mentor':requested_mentor.mentor_id})"  >
                                        <div class="flex items-center gap-x-6">
                                            <img :src="requested_mentor.mentor.user.profile_photo_url" class="h-16 w-16 rounded-full object-cover" />
                                            <div>
                                                <h3 class="text-indigo-600 hover:underline">{{requested_mentor.mentor.title}} {{requested_mentor.mentor.user.name}} </h3>     
                                            </div>
                                        </div>
                                    </Link> 
                                    <div> 
                                        <span  class="bg-gradient-to-r from-indigo-700 via-indigo-600 to-indigo-500 hover:from-yellow-700 hover:via-yellow-600 hover:to-yellow-500 py-2 px-4 cursor-pointer text-gray-100 rounded-lg font-xs font-bold shadow-sm ">
                                        
                                            <span :class="{'animate-pulse' : loader.state && loader.mentorId == requested_mentor.mentor_id}" @click="cancel(requested_mentor.mentor_id)">Cancel Request </span> 
                                        </span> 
                                    </div>
                                </div>
                                <hr class="mt-2">
                            </div>
                        </div>

                        
                    </div>
                    
                   
                </div>
            </div>
        </div>
    </app-layout>
</template>

<script>
    import { defineComponent } from 'vue'
    import AppLayout from '@/Layouts/AppLayout.vue'
    import JetApplicationMark from '@/Jetstream/ApplicationMark.vue'
    import JetButton from '@/Jetstream/Button.vue'
    
    import { Head, Link } from '@inertiajs/inertia-vue3';
export default defineComponent({
    
    components: {
        JetApplicationMark,
        JetButton,
        AppLayout,
       
        Head,
        Link,
        
    },
    props:['connected_mentors','requested_mentors'],
    data(){
        return {
            currentTab:'connected',
            tabs:['connected','requested'],
            loader:{state:false,mentorId:null},
        }
    },
    methods:{
        setCurrentTab(tab){
            // set connected as the default tab if tab provided is not registered
            if(this.tabs.indexOf(tab)==-1){
                tab = 'connected';
            }
            this.currentTab = tab;
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
        disconnect(mentorId){
            if(!confirm('Are you sure you want to be disconnected from this mentor?')){
                return;
            }
            this.loading(mentorId);
             axios.patch(route('mentor.connect.request'),{action:'disconnect','mentor_id':mentorId})
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
        },
        assess(mentorId){
            this.$inertia.visit(route('mentor-assessment.edit',{mentor:mentorId}));
        }
    },
    computed:{
        
    }
})
</script>