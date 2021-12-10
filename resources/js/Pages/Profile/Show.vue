<template>
    <app-layout title="Profile">
        <template #header> 
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Profile
            </h2>
        </template>

        <div>
            <div class="max-w-7xl mx-auto py-10 sm:px-6 lg:px-8">
                <div v-if="$page.props.jetstream.canUpdateProfileInformation">
                    <update-profile-information-form :user="$page.props.user" :nationalities="$page.props.nationalities" />

                    <jet-section-border />
                </div>

                <div v-if="$page.props.mentor!=null">
                    <upload-documents class="mt-10 sm:mt-0" />

                    <jet-section-border />
                </div>
                <div v-if="$page.props.mentee!=null">
                    <update-additional-mentee-information-form :dob="$page.props.mentee.dob" class="mt-10 sm:mt-0" />

                    <jet-section-border />
                </div>
    
                <div v-if="$page.props.mentor!=null">
                    <update-additional-mentor-information-form :mentor="$page.props.mentor" :qualifications="$page.props.qualifications" class="mt-10 sm:mt-0" />

                    <jet-section-border />
                </div>

                <div v-if="$page.props.jetstream.canUpdatePassword">
                    <update-password-form class="mt-10 sm:mt-0" />

                    <jet-section-border />
                </div>

               

                <div v-if="$page.props.jetstream.canManageTwoFactorAuthentication">
                    <two-factor-authentication-form class="mt-10 sm:mt-0" />

                    <jet-section-border />
                </div>

                <logout-other-browser-sessions-form :sessions="sessions" class="mt-10 sm:mt-0" />

                <template v-if="$page.props.jetstream.hasAccountDeletionFeatures">
                    <jet-section-border />

                    <delete-user-form class="mt-10 sm:mt-0" />
                </template>
            </div>
        </div>
    </app-layout>
</template>

<script>
    import { defineComponent } from 'vue'
    import AppLayout from '@/Layouts/AppLayout.vue'
    import DeleteUserForm from '@/Pages/Profile/Partials/DeleteUserForm.vue'
    import JetSectionBorder from '@/Jetstream/SectionBorder.vue'
    import LogoutOtherBrowserSessionsForm from '@/Pages/Profile/Partials/LogoutOtherBrowserSessionsForm.vue'
    import TwoFactorAuthenticationForm from '@/Pages/Profile/Partials/TwoFactorAuthenticationForm.vue'
    import UpdatePasswordForm from '@/Pages/Profile/Partials/UpdatePasswordForm.vue'
    import UpdateProfileInformationForm from '@/Pages/Profile/Partials/UpdateProfileInformationForm.vue'
    import UpdateAdditionalMenteeInformationForm from '@/Pages/Profile/Partials/UpdateAdditionalMenteeInformationForm.vue'
    import UpdateAdditionalMentorInformationForm from '@/Pages/Profile/Partials/UpdateAdditionalMentorInformationForm.vue'
    import UploadDocuments from '@/Pages/Profile/Partials/UploadDocuments.vue'

    export default defineComponent({
        props: ['sessions'],

        components: {
            AppLayout,
            DeleteUserForm,
            JetSectionBorder,
            LogoutOtherBrowserSessionsForm,
            TwoFactorAuthenticationForm,
            UpdatePasswordForm,
            UpdateProfileInformationForm,
            UpdateAdditionalMenteeInformationForm,
            UpdateAdditionalMentorInformationForm,
            UploadDocuments
        },
    })
</script>
