<template>
    <jet-form-section @submitted="updateMenteeInformation">
        <template #title>
            Additional Information
        </template>

        <template #description>
            Update additional profile information.
        </template>

        <template #form>
            

            <!-- Date of Birth -->
            <div class="col-span-6 sm:col-span-4">
                <jet-label for="dob" value="Date of birth" />
                <jet-input id="dob" type="date" class="mt-1 block w-full" v-model="form.dob"  />
                <jet-input-error :message="form.errors.dob" class="mt-2" />
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

        props: ['dob'],

        data() {
            return {
                form: this.$inertia.form({
                    _method: 'PUT',
                    dob: this.dob,
                    
                }),

            }
        },

        methods: {
            updateMenteeInformation() {
                

                this.form.put(route('mentee-profile-information.update'), {
                    errorBag: 'updateAdditionalMenteeInformation',
                    preserveScroll: true,
                    
                });
            },

        },
    })
</script>
