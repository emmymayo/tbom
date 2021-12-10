<template class="">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 mt-6 mt-12">
        <h3 class="text-3xl font-bold  text-gray-500">
            <svg xmlns="http://www.w3.org/2000/svg" class="inline fill-current text-indigo-400 h-10 w-10" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 5a2 2 0 012-2h10a2 2 0 012 2v16l-7-3.5L5 21V5z" />
            </svg>
            <span class="border-b-4 border-indigo-400">Quick</span> Links </h3>
        <div class="mt-16 flex flex-col md:flex-row md:overflow-x-auto gap-x-16 ">
            <!-- Profile Link -->
            <div> 
                <Link :href="route('profile.show')" >
                    <div class="flex-shrink-0 shadow-md flex flex-col gap-4 py-4 px-6 items-center hover:opacity-75">
                        <svg xmlns="http://www.w3.org/2000/svg" class="fill-current text-indigo-400 h-12 w-12" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-6-3a2 2 0 11-4 0 2 2 0 014 0zm-2 4a5 5 0 00-4.546 2.916A5.986 5.986 0 0010 16a5.986 5.986 0 004.546-2.084A5 5 0 0010 11z" clip-rule="evenodd" />
                        </svg>
                        
                        <h3 class="text-xl text-gray-400 text-center"> My Profile </h3>
                        
                    </div> 
                </Link>
            </div>
            <div v-if="$page.props.mentor!=null"> 
                <Link :href="route('create.mentor.expertise')" >
                    <div class="flex-shrink-0 shadow-md flex flex-col gap-4 py-4 px-6 items-center hover:opacity-75">
                        <svg xmlns="http://www.w3.org/2000/svg" class="fill-current h-12 w-12  text-indigo-400" viewBox="0 0 20 20" fill="currentColor">
                            <path d="M10.394 2.08a1 1 0 00-.788 0l-7 3a1 1 0 000 1.84L5.25 8.051a.999.999 0 01.356-.257l4-1.714a1 1 0 11.788 1.838L7.667 9.088l1.94.831a1 1 0 00.787 0l7-3a1 1 0 000-1.838l-7-3zM3.31 9.397L5 10.12v4.102a8.969 8.969 0 00-1.05-.174 1 1 0 01-.89-.89 11.115 11.115 0 01.25-3.762zM9.3 16.573A9.026 9.026 0 007 14.935v-3.957l1.818.78a3 3 0 002.364 0l5.508-2.361a11.026 11.026 0 01.25 3.762 1 1 0 01-.89.89 8.968 8.968 0 00-5.35 2.524 1 1 0 01-1.4 0zM6 18a1 1 0 001-1v-2.065a8.935 8.935 0 00-2-.712V17a1 1 0 001 1z" />
                        </svg>
                        <h3 class="text-xl text-gray-400 text-center"> Add Professional Expertise </h3>
                       
                    </div> 
                </Link>
            </div>
            <div v-if="$page.props.mentee!=null"> 
                <Link :href="route('create.mentee.experience')" >
                    <div class="flex-shrink-0 shadow-md flex flex-col gap-4 py-4 px-6 items-center  hover:opacity-75">
                        <svg xmlns="http://www.w3.org/2000/svg" class="fill-current h-12 w-12  text-indigo-400" viewBox="0 0 20 20" fill="currentColor">
                            <path d="M10.394 2.08a1 1 0 00-.788 0l-7 3a1 1 0 000 1.84L5.25 8.051a.999.999 0 01.356-.257l4-1.714a1 1 0 11.788 1.838L7.667 9.088l1.94.831a1 1 0 00.787 0l7-3a1 1 0 000-1.838l-7-3zM3.31 9.397L5 10.12v4.102a8.969 8.969 0 00-1.05-.174 1 1 0 01-.89-.89 11.115 11.115 0 01.25-3.762zM9.3 16.573A9.026 9.026 0 007 14.935v-3.957l1.818.78a3 3 0 002.364 0l5.508-2.361a11.026 11.026 0 01.25 3.762 1 1 0 01-.89.89 8.968 8.968 0 00-5.35 2.524 1 1 0 01-1.4 0zM6 18a1 1 0 001-1v-2.065a8.935 8.935 0 00-2-.712V17a1 1 0 001 1z" />
                        </svg>
                        <h3 class="text-xl text-gray-400 text-center"> Add Academic Experience </h3>
                        
                    </div> 
                </Link>
            </div>
            <div v-if="$page.props.mentor!=null"> 
                <Link :href="route('my-mentee.index')" >
                    <div class="flex-shrink-0 shadow-md flex flex-col gap-4 py-4 px-6 items-center hover:opacity-75">
                        <svg xmlns="http://www.w3.org/2000/svg" class="fill-current h-12 w-12  text-indigo-400" viewBox="0 0 20 20" fill="currentColor">
                            <path d="M13 6a3 3 0 11-6 0 3 3 0 016 0zM18 8a2 2 0 11-4 0 2 2 0 014 0zM14 15a4 4 0 00-8 0v3h8v-3zM6 8a2 2 0 11-4 0 2 2 0 014 0zM16 18v-3a5.972 5.972 0 00-.75-2.906A3.005 3.005 0 0119 15v3h-3zM4.75 12.094A5.973 5.973 0 004 15v3H1v-3a3 3 0 013.75-2.906z" />
                        </svg> 
                        <h3 class="text-xl text-gray-400 text-center"> My Mentees </h3>
                        
                    </div> 
                </Link>
            </div>
            <div v-if="$page.props.mentee!=null"> 
                <Link :href="route('my-mentor.index')" >
                    <div class="flex-shrink-0 shadow-md flex flex-col gap-4 py-4 px-6 items-center hover:opacity-75">
                        <svg xmlns="http://www.w3.org/2000/svg" class="fill-current h-12 w-12  text-indigo-400" viewBox="0 0 20 20" fill="currentColor">
                            <path d="M13 6a3 3 0 11-6 0 3 3 0 016 0zM18 8a2 2 0 11-4 0 2 2 0 014 0zM14 15a4 4 0 00-8 0v3h8v-3zM6 8a2 2 0 11-4 0 2 2 0 014 0zM16 18v-3a5.972 5.972 0 00-.75-2.906A3.005 3.005 0 0119 15v3h-3zM4.75 12.094A5.973 5.973 0 004 15v3H1v-3a3 3 0 013.75-2.906z" />
                        </svg> 
                        <h3 class="text-xl text-gray-400 text-center"> My Mentors </h3>
                        
                        
                    </div> 
                </Link>
            </div>
            <div > 
                <Link :href="route('logout')" >
                    <div class="flex-shrink-0  shadow-md flex flex-col gap-4 py-4 px-6 items-center hover:opacity-75">
                        <svg xmlns="http://www.w3.org/2000/svg" class="fill-current h-12 w-12  text-indigo-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" />
                        </svg>
                        <h3 class="text-xl text-gray-400 text-center"> Log Out </h3>
                        
                        
                    </div> 
                </Link>
            </div>
        </div>
    </div>
</template>

<script>
import { defineComponent } from 'vue'
import  {Link, Head}  from '@inertiajs/inertia-vue3';
export default defineComponent({
    components:{
        Link,
    }
})
</script>