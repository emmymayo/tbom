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
                    <jet-banner> </jet-banner>
                    <Link :href="route('create.mentee.experience')">
                        <jet-button class="my-4 mx-2 bg-blue-400 hover:bg-blue-600"> + ADD </jet-button>
                    </Link>
                   <experience-table :experiences="experiences"> </experience-table>
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

    }
})
</script>