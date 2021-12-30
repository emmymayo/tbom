<template>
    <jet-form-section @submitted="updateMentorInformation">
        <template #title>
            Additional Information
        </template>

        <template #description>
            Update additional profile information.
        </template>

        <template #form>
            

            <!-- Title -->
            <div class="col-span-6 sm:col-span-4">
                <jet-label for="title" value="Title " />
                <jet-input id="title" type="text" class="mt-1 block w-full" placeholder="Mr., Prof, Barrister, ..." v-model="form.title"  />
                <jet-input-error :message="form.errors.title" class="mt-2" />
            </div>

             <!-- Highest Qualification -->
            <div class="col-span-6 sm:col-span-4">
                <jet-label for="qualification" value="Highest Qualification" />
                <select id="qualification" v-model="form.qualification_id" class="border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm mt-1 block w-full">
                    <option value="">  </option>
                    <option v-for="qualification in qualifications" :value="qualification.id" :key="qualification.id"> {{qualification.name}} </option>
                </select>
                <jet-input-error :message="form.errors.qualification_id" class="mt-2" />
            </div>

            <!-- Annual mentees -->
            <div class="col-span-6 sm:col-span-4">
                <jet-label for="annual_mentees" value="Annual Mentees" /> <small class="text-gray-600">Maximum number of mentees you can handle per year </small>
                <jet-input id="annual_mentees" type="number" class="mt-1 block w-full" v-model="form.annual_mentees"  />
                <jet-input-error :message="form.errors.annual_mentees" class="mt-2" />
            </div>

            <!-- Mentorship Schedule -->
            <div class="col-span-6 sm:col-span-4">
                <jet-label for="mentorship_schedule" value="Mentorship schedule" /> 
                <jet-input id="mentorship_schedule" type="text" placeholder="Weekly, monthly, ..."  class="mt-1 block w-full" v-model="form.mentorship_schedule"  />
                <jet-input-error :message="form.errors.mentorship_schedule" class="mt-2" />
            </div>

            <!-- Preffered Platform -->
            <div class="col-span-6 sm:col-span-4">
                <jet-label for="preffered_platform" value="Preferred Mentorship Platform" /> 
                <jet-input id="preffered_platform" type="text" placeholder="Zoom, Google Meet, Microsoft Teams, ... "  class="mt-1 block w-full" v-model="form.preffered_platform"  />
                <jet-input-error :message="form.errors.preffered_platform" class="mt-2" />
            </div>

            <!-- About me -->
            <div class="col-span-6 sm:col-span-4">
                <jet-label for="about_me" value="About me" /> 
                <textarea id="about_me" type="text" placeholder="Brief introduction about yourself" row="7"   v-model="form.about_me"
                 class="mt-1 block w-full border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-s" ></textarea>
                <jet-input-error :message="form.errors.about_me" class="mt-2" />
            </div>


            

        </template>   
        <template #actions>
            <jet-action-message :on="form.recentlySuccessful" class="mr-3">
                Saved.
            </jet-action-message>

            <jet-button :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
                Save
            </jet-button>
        </template>
    </jet-form-section>
</template>

<script>
    import { defineComponent } from 'vue'
    import JetButton from '@/Jetstream/Button.vue'
    import JetFormSection from '@/Jetstream/FormSection.vue'
    import JetInput from '@/Jetstream/Input.vue'
    import JetInputError from '@/Jetstream/InputError.vue'
    import JetLabel from '@/Jetstream/Label.vue'
    import JetActionMessage from '@/Jetstream/ActionMessage.vue'
    import JetSecondaryButton from '@/Jetstream/SecondaryButton.vue'

    export default defineComponent({
        components: {
            JetActionMessage,
            JetButton,
            JetFormSection,
            JetInput,
            JetInputError,
            JetLabel,
            JetSecondaryButton,
        },

        props: [ 'mentor','qualifications'],

        data() {
            return {
                form: this.$inertia.form({
                    _method: 'PUT',
                    title: this.mentor.title,
                    qualification_id: this.mentor.qualification_id,
                    annual_mentees: this.mentor.annual_mentees,
                    mentorship_schedule: this.mentor.mentorship_schedule,
                    preffered_platform: this.mentor.preffered_platform,
                    about_me: this.mentor.about_me
                    
                }),

            }
        },
        methods: {
            updateMentorInformation() {
                

                this.form.put(route('mentor-profile-information.update'), {
                    errorBag: 'updateAdditionalMentorInformation',
                    preserveScroll: true,
                    
                });
            },

        },
    })
</script>
