<template>
    <div class="flex flex-col">
        <div class="flex justify-between" v-for="requested_mentor in mentors" :key="requested_mentor.id">
            <Link :href="route('mentor.profile',{'mentor':requested_mentor.mentor_id})">
            <div class="flex">
                <img :src="requested_mentor.mentor.user.profile_photo_url" class="h-16 w-16 rounded-full object-cover" />
                <div>
                    <h3 class="text-indigo-600">{{requested_mentor.mentor.title}} {{requested_mentor.mentor.user.name}} </h3>     
                </div>
            </div>
            <div> Cancel Request </div>
            </Link>
        </div>
    </div>
</template>


<script>
    import { defineComponent } from 'vue'
    import Link  from '@inertiajs/inertia-vue3';
export default defineComponent({
    components:{
        Link
    },
    props:['mentors']
})
</script>