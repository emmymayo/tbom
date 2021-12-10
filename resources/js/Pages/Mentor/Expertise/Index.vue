<template>
    <app-layout title="Educational History">
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Expertises
            </h2>
        </template>

        <!-- Mentor Expertise -->
        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                    
                    <Link :href="route('create.mentor.expertise')">
                        <jet-button class="my-4 mx-2 bg-blue-400 hover:bg-blue-600">+ Add  </jet-button>
                    </Link>
                   <mentor-expertise-table v-if="mentor_expertises.length>0" @trash="trash($event)" @edit="edit($event)" :mentor_expertises="mentor_expertises"> </mentor-expertise-table>
                   <template v-else> 
                       <!-- Show this when no Expertise -->
                       <div class="container mx-auto px-4 py-12"> 
                           <h3 class="text-gray-600"> 
                               No Expertise Added Yet.    
                               <Link :href="route('create.mentor.expertise')">
                                    <span class=" text-blue-700 hover:text-blue-400">  Add </span>
                                </Link>
                            </h3>
                       </div>
                   </template>
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
    import JetBanner from '@/Jetstream/Banner.vue'
    import MentorExpertiseTable from './Partials/MentorExpertiseTable.vue'
    import { Head, Link } from '@inertiajs/inertia-vue3';
export default defineComponent({
    props:['mentor_expertises'],
    components: {
        JetApplicationMark,
        JetButton,
        JetBanner,
        AppLayout,
        MentorExpertiseTable,
        Head,
        Link
    },
    setup(){
        
    },
    methods:{
        /* 
        *Trash Mentor Expertise
        *@param id - Mentor Expertise id 
        **/
        trash(id){
            if(!confirm('Are you sure you want to delete this expertise?')){return;}
            this.$inertia.delete(route('destroy.mentor.expertise',{mentor_expertise: id}));
        },
        /* 
        *Open Edit Mentor expertise Page
        *@param id - Mentor expertise id 
        */
        edit(id){
            this.$inertia.get(route('edit.mentor.expertise',{mentor_expertise: id}));
        }
    }
})
</script>