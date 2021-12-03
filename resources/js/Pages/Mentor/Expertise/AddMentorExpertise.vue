<template>
    

    <app-layout title="Add Expertise">
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Add Professional Expertise
            </h2>
        </template>

        <jet-validation-errors class="mb-4" />
        <div class="grid grid-cols-1 md:grid-cols-2">
            <div class="px-4 py-4">
               <h3 class="text-lg font-medium leading-6 text-gray-900">Add Expertise</h3>
                <p class="mt-1 text-sm text-gray-600">
                    This information helps us prospective mentees to decide you have the required expertise to mentor them.
                </p>
            </div>
            <div class="col-span-1 px-4 py-4">
                
                <form @submit.prevent="submit">

                
                    <div>
                        <jet-label for="expertise" value="Expertise" />
                        <jet-input id="expertise" type="text" class="mt-1 block w-full" v-model="form.expertise" required autofocus  />
                    </div>


                    <div class="mt-4">
                        <jet-label for="years_of_experience" value="Years of Experience" />
                        <jet-input id="years_of_experience" type="number" class="mt-1 block w-full" v-model="form.years_of_experience" required />
                    </div>

                    <div class="mt-4">
                        <jet-label for="duration_of_mentorship" value="Duration of mentorship " />
                        <jet-input id="duration_of_mentorship" type="text" class="mt-1 block w-full" v-model="form.duration_of_mentorship" placeholder="How long are you willing to mentor? A year" required autofocus  />
                    </div>

                     

                    
                    <div class="flex items-center justify-end mt-4">

                        <jet-button class="ml-4" :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
                            Submit
                        </jet-button>
                    </div>
                </form>
            </div>
        </div>
    </app-layout>
</template>

<script>
    import { defineComponent } from 'vue'
    import AppLayout from '@/Layouts/AppLayout.vue'
    import JetButton from '@/Jetstream/Button.vue'
    import JetInput from '@/Jetstream/Input.vue'
    
    import JetLabel from '@/Jetstream/Label.vue'
    import JetValidationErrors from '@/Jetstream/ValidationErrors.vue'

    export default defineComponent({
        components: {
            AppLayout,
            JetButton,
            JetInput,
            
            JetLabel,
            JetValidationErrors,
            
        },
        props:['mentor'],
        data() {
            return {
                form: this.$inertia.form({
                    expertise: '',
                    years_of_experience: '',
                    duration_of_mentorship: '',
                    
                    mentor_id:this.mentor.id
                    
                })
            }
        },
        
        methods: {
            submit() {
                this.form.post(this.route('store.mentor.expertise'))
            }
        }
    })
</script>
