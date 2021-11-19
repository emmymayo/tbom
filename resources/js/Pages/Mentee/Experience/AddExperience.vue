<template>
    

    <app-layout title="Add Experience">
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Add Educational Experience
            </h2>
        </template>

        <jet-validation-errors class="mb-4" />

        <form @submit.prevent="submit">

          
            <div>
                <jet-label for="school" value="School" />
                <jet-input id="school" type="text" class="mt-1 block w-full" v-model="form.school" required autofocus autocomplete="school" />
            </div>


            <div class="mt-4">
                <jet-label for="from" value="From (Year)" />
                <jet-input id="from" type="number" class="mt-1 block w-full" v-model="form.from" required />
            </div>

            <div class="mt-4">
                <jet-label for="to" value="To (Year)" />
                <jet-input id="to" type="text" class="mt-1 block w-full" v-model="form.to"  autofocus autocomplete="to" />
            </div>

            <div class="mt-4">
                <jet-label for="degree" value="Degree" />
                <jet-input id="degree" type="text" class="mt-1 block w-full" v-model="form.degree"  autocomplete="degree" />
            </div>

            <div class="mt-4">
                <jet-label for="area_of_study" value="Area Of Study" />
                <jet-input id="area_of_study" type="text" class="mt-1 block w-full" v-model="form.area_of_study"  autocomplete="area_of_study" />
            </div>


            <div class="mt-4">
                <jet-label for="description" value="Additional Information" />
                <textarea row="5" id="description" v-model="form.description" class="border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm mt-1 block w-full"></textarea>
            </div>

            

            
            <div class="flex items-center justify-end mt-4">

                <jet-button class="ml-4" :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
                    Submit
                </jet-button>
            </div>
        </form>
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

        data() {
            return {
                form: this.$inertia.form({
                    school: '',
                    from: '',
                    to: '',
                    degree:'',
                    area_of_study: '',
                    description: '',
                    mentee_id:$page.props.user.mentee.id
                    
                })
            }
        },
        
        methods: {
            submit() {
                this.form.post(this.route('store.mentee.experience'))
            }
        }
    })
</script>
