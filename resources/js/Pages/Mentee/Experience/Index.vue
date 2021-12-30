<template>
    <app-layout title="Educational History">
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Educational History
            </h2>
        </template>

        <!-- Educational History -->
        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                    
                    <Link :href="route('create.mentee.experience')">
                        <jet-button class="my-4 mx-2 bg-blue-400 hover:bg-blue-600"> + ADD </jet-button>
                    </Link>
                   <experience-table v-if="experiences.length>0" @trash="trash($event)" @edit="edit($event)" :experiences="experiences"> </experience-table>
                   <template v-else> 
                       <!-- Show this when no Experience -->
                       <div class="container mx-auto px-4 py-12"> 
                           <h3 class="text-gray-600 text-xl"> 
                               No Academic Experience Added Yet.    
                               <Link :href="route('create.mentee.experience')">
                                    <span class=" text-blue-700 hover:text-blue-400">  ADD </span>
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
    import ExperienceTable from './Partials/ExperienceTable.vue'
    import { Head, Link } from '@inertiajs/inertia-vue3';
export default defineComponent({
    props:['experiences'],
    components: {
        JetApplicationMark,
        JetButton,
        JetBanner,
        AppLayout,
        ExperienceTable,
        Head,
        Link
    },
    setup(){
        
    },
    methods:{
        /* 
        *Trash Mentee Experience
        *@param id - Mentee Experience id 
        **/
        trash(id){
            if(!confirm('Are you sure you want to delete this academic experience?')){return;}
            this.$inertia.delete(route('destroy.mentee.experience',{experience: id}));
        },
        /* 
        *Open Edit Mentee Experience Page
        *@param id - Mentee Experience id 
        */
        edit(id){
            this.$inertia.get(route('edit.mentee.experience',{experience: id}));
        }
    }
})
</script>