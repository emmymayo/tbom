<template>
    <main class="mt-4  mb-4 md:mb-16 mx-auto  max-w-full px-4 py-8 sm:mt-12 sm:px-6 md:mt-4 lg:mt-4 lg:px-8 xl:mt-12 ">
            <div class="sm:text-center ">
                <h1 class=" tracking-tighter  text-indigo-900 sm:text-3xl md:text-6xl">
                    <span class=" text-3xl md:text-7xl font-black block xl:inline tracking-tighter bg-clip-text text-transparent bg-gradient-to-r from-indigo-800 via-indigo-700 to-indigo-600">
                        Eliminating barriers
                        </span>
                </h1>
                <h3 class="text-4xl md:text-6xl font-bold tracking-tight bg-clip-text text-transparent bg-gradient-to-r from-yellow-600 via-yellow-500 to-yellow-300 block  xl:inline"> 
                        of access to research mentorship
                </h3>
               
                <div class="mt-5 sm:mt-8 flex justify-center ">
                    <div class=" w-full">
                        <div v-if="$page.props.user==null || $page.props.user.role.name=='mentee'" class="lg:w-1/2 flex mx-2 md:mx-auto items-stretch items-center focus:outline-none focus:ring-2 focus:ring-indigo-600 focus:border-transparent">
                            <input type="search" placeholder="Search..."
                             @keyup.enter="search" v-model="q" 
                             class="rounded-full md:rounded-none md:rounded-l-full  flex-1 appearance-none border border-gray-300 w-full py-4 px-6 bg-white text-gray-700 placeholder-gray-400 shadow-sm text-base ">
                            <Link :href="route('mentor.search.index')+'?q='+q" replace class="hidden md:inline-block bg-indigo-600 text-gray-100   hover:bg-indigo-900 rounded-r-full   px-6">
                               <span class="inline-block mt-4 font-extrabold"> Find Mentor </span>
                            </Link>
                        </div>
                        

                    <!-- <a href="#" v-if="$page.props.user!=null && $page.props.user.role.name=='mentor'" class="animate-pulse rounded-full  flex items-center justify-center inline px-8 py-3 border border-transparent text-base font-medium rounded-md text-white hover:bg-indigo-500 md:py-4 md:text-lg md:px-10">
                        Explore
                    </a> -->
                    </div>
                    <!-- <div class="mt-3 sm:mt-0 sm:ml-3">
                    <a href="#" class="w-full flex items-center justify-center px-8 py-3 border border-transparent text-base font-medium rounded-md text-indigo-700 bg-indigo-100 hover:bg-indigo-200 md:py-4 md:text-lg md:px-10">
                        Live demo
                    </a>
                    </div> -->
                </div>
            </div>
        </main>
            
</template>

<script>
    import { defineComponent } from 'vue'
    import { Head, Link } from '@inertiajs/inertia-vue3';
    import JetApplicationMark from '@/Jetstream/ApplicationMark.vue'
    import JetDropdown from '@/Jetstream/Dropdown.vue'
    import JetDropdownLink from '@/Jetstream/DropdownLink.vue'

    export default defineComponent({
        components: {
            Head,
            Link,
            JetApplicationMark,
            JetDropdown,
            JetDropdownLink,
        },
        data(){
            return {
                // Search query
                q:''
            }
        },

        methods:{
            search(){
                this.$inertia.visit(route('mentor.search.index')+'?q='+this.q);
            },
            logout(){
                this.$inertia.post(route('logout'));
            }
        }
        
    })
</script>
