<template>
    <app-layout title="Mentees" :pendingMenteeRequests="requested_mentees.length">
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                 Mentees 
            </h2>
        </template>

        <!--  Mentees -->
        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-4">
                    
                    <div class="tabs flex  flex-nowrap overflow-x-auto gap-x-6 py-4 shadow-sm"> 
                        <span class="flex-shrink-0 cursor-pointer inline-block px-2 py-4 text-gray-400 font-bold hover:bg-gray-100" :class="{'text-indigo-500 border-b-2 border-indigo-500': currentTab=='connected'}" @click="setCurrentTab('connected')">
                            My Mentees 
                            <span class="rounded-full px-2 bg-gray-100 text-gray-400" v-show="connected_mentees.length>0"> {{connected_mentees.length}} </span>
                        </span>
                        <span class="flex-shrink-0 cursor-pointer inline-block px-2 py-4 text-gray-400 font-bold hover:bg-gray-100" :class="{'text-indigo-500 border-b-2 border-indigo-500': currentTab=='requested'}" @click="setCurrentTab('requested')">
                            Pending Requests 
                            <span class="rounded-full px-2 bg-gray-100 text-gray-400" v-show="requested_mentees.length>0"> {{requested_mentees.length}} </span>
                        </span>
                    </div>

                    <div class="">
                        <!-- Conected Mentees -->
                            <div class="flex flex-col " v-if="currentTab=='connected'">
                                <div v-for="connected_mentee in connected_mentees" :key="connected_mentee.id">
                                    <div class="flex flex-col  md:flex-row md:justify-between  md:items-center mt-2 py-2 space-y-4 hover:bg-gray-100" >
                                        <Link :href="route('mentee.profile',{'mentee':connected_mentee.mentee_id})" >
                                            <div class="flex items-center gap-x-6">
                                                <img :src="connected_mentee.mentee.user.profile_photo_url" class="h-16 w-16 rounded-full object-cover" />
                                                <div class="">
                                                   
                                                    <h3 class="capitalize text-indigo-600 hover:underline"> {{connected_mentee.mentee.user.name}} </h3>     
                                                    
                                                </div>
                                            </div>
                                        </Link>
                                        <div>   
                                            <span  class="bg-gradient-to-r from-red-500 to-red-400 hover:bg-red-300 py-2 px-4 cursor-pointer text-gray-100 rounded-lg font-xs font-bold shadow-sm ">
                                                <span :class="{'animate-pulse' : loader.state && loader.menteeId == connected_mentee.mentee_id}" @click="disconnect(connected_mentee.mentee_id)">Disconnect</span> 
                                            </span> 
                                        </div>
                                        
                                    </div>
                                    <hr class="mt-2">
                                </div>
                            </div>
                        
                        <!-- Pending Requests  -->
                        <div class="flex flex-col " v-if="currentTab=='requested'">
                            <div v-for="requested_mentee in requested_mentees" :key="requested_mentee.id">
                                <div class="flex flex-col  md:flex-row md:justify-between  md:items-center mt-2 py-2 space-y-4 hover:bg-gray-100">
                                    <Link :href="route('mentee.profile',{'mentee':requested_mentee.mentee_id})"  >
                                        <div class="flex items-center gap-x-6">
                                            <img :src="requested_mentee.mentee.user.profile_photo_url" class="h-16 w-16 rounded-full object-cover" />
                                            <div>
                                                <h3 class="text-indigo-600 hover:underline"> {{requested_mentee.mentee.user.name}} </h3>     
                                            </div>
                                        </div>
                                    </Link> 
                                    <div> 
                                        <span  class="mx-4 bg-gradient-to-r from-green-500 via-green-400 to-green-300 hover:opacity-75 py-2 px-4 cursor-pointer text-gray-100 rounded-lg font-xs font-bold shadow-sm ">
                                            <span :class="{'animate-pulse' : loader.state && loader.menteeId == requested_mentee.mentee_id && loader.action == 'accept'}" @click="accept(requested_mentee.mentee_id)">Accept </span> 
                                        </span> 
                                        <span  class="mx-4 bg-gradient-to-r from-red-600 via-red-500 to-red-400 hover:opacity-75 py-2 px-4 cursor-pointer text-gray-100 rounded-lg font-xs font-bold shadow-sm ">
                                            <span :class="{'animate-pulse' : loader.state && loader.menteeId == requested_mentee.mentee_id && loader.action == 'decline'}" @click="decline(requested_mentee.mentee_id)">Decline </span> 
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
    props:['connected_mentees','requested_mentees'],
    data(){
        return {
            currentTab:'connected',
            tabs:['connected','requested'],
            loader:{state:false,menteeId:null, action:''},
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
        decline(menteeId){
            this.loading(menteeId,'decline');
             axios.patch(route('mentee.connect.request'),{action:'decline','mentee_id':menteeId})
                .then((response) => {
                        this.$inertia.reload();
                        this.stopLoading();
                    })
                .catch((error) => {
                    this.stopLoading();
                    
                })
        },
        accept(menteeId){
            this.loading(menteeId, 'accept');
             axios.patch(route('mentee.connect.request'),{action:'accept','mentee_id':menteeId})
                .then((response) => {
                        this.$inertia.reload();
                        this.stopLoading();
                    })
                .catch((error) => {
                    this.stopLoading();
                    
                })
        },
        disconnect(menteeId){
            if(!confirm('Are you sure you want to be disconnected from this mentee?')){
                return;
            }
            this.loading(menteeId, 'disconnect');
             axios.patch(route('mentee.connect.request'),{action:'disconnect','mentee_id':menteeId})
                .then((response) => {
                        this.$inertia.reload();
                        this.stopLoading();
                    })
                .catch((error) => {
                    this.stopLoading();
                   
                })
        },
        loading(menteeId, action=''){
            this.loader.state = true;
            this.loader.menteeId = menteeId;
            this.loader.action = action;
        },
        stopLoading(){
            this.loader.state = false;
            this.loader.menteeId = null ;
            this.loader,action = '' ;
        }
    },
    computed:{
        
    }
})
</script>