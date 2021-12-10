<template>
    <jet-form-section @submitted="uploadDocument">
        <template #title>
            Document Upload
        </template>

        <template #description>
            Document should be properly formatted.
        </template>

        <template #form>
            
            <!-- Document Type -->
            <div class="col-span-6 sm:col-span-4">
                <jet-label for="type" value="Document Type" />
                <select id="type" v-model="form.type" required class="border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm mt-1 block w-full">
                    <option value="">  </option>
                    <option value="1"> Curriculum vitae/ Resume (5 pages)  </option>
                    <option value="2"> Biography (1 page)  </option>
                </select>
                <!-- <jet-input-error :message="form.errors.type" class="mt-2" /> -->
            </div>

            <!--Document  -->
            <div class="col-span-6 sm:col-span-4">
                <!-- <input type="text" v-model="form.name" />
                <input type="file" @input="form.avatar = $event.target.files[0]" /> -->
                <progress v-if="form.progress" :value="form.progress.percentage" max="100">
                {{ form.progress.percentage }}%
                </progress>
                <!-- <button type="submit">Submit</button> -->
                <jet-label for="document" value="Upload Document" /> <span class="text-gray-400"></span>
                <jet-input id="document" type="file" class="mt-1 block w-full" @input="form.document = $event.target.files[0]"  />
                <jet-input-error :message="form.errors.document" class="mt-2" />
            </div>

            <!-- Documents Uploaded -->
            <div class="mt-4 col-span-6 sm:col-span-4">
            
                <div class="bg-white shadow overflow-hidden sm:rounded-lg">
                <div class="px-4 py-5 sm:px-6">
                    <!--  <h3 class="text-lg leading-6 font-medium text-gray-900">
                                Document Information 
                    </h3> -->
                </div>
                <div class="border-t border-gray-200">
                    <dl>

                    <div class="bg-white px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                        <dt class="text-sm font-medium text-gray-500">
                        Documents
                        </dt>
                        <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
                        <ul v-if="$page.props.user.documents.length>0" role="list" class="border border-gray-200 rounded-md divide-y divide-gray-200">
                            <li v-for="document in $page.props.user.documents" :key="document.id" class="pl-3 pr-4 py-3 flex items-center justify-between text-sm">
                            <div class="w-0 flex-1 flex items-center">
                                <!-- Heroicon name: solid/paper-clip -->
                                <svg class="flex-shrink-0 h-5 w-5 text-gray-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                <path fill-rule="evenodd" d="M8 4a3 3 0 00-3 3v4a5 5 0 0010 0V7a1 1 0 112 0v4a7 7 0 11-14 0V7a5 5 0 0110 0v4a3 3 0 11-6 0V7a1 1 0 012 0v4a1 1 0 102 0V7a3 3 0 00-3-3z" clip-rule="evenodd" />
                                </svg>
                                <span v-if="document.type==1" class="ml-2 flex-1 w-0 truncate">
                                Curriculum Vitae/Resume
                                </span>
                                <span v-if="document.type==2" class="ml-2 flex-1 w-0 truncate">
                                Biography
                                </span>
                            </div>
                            <div class="ml-4 flex-shrink-0">
                                <a :href="route('user-document-download',{user_document:document.id})" class="font-medium text-indigo-600 hover:text-indigo-500">
                                Download
                                </a>
                            </div>
                            </li>
                            
                        </ul>
                        <p v-else class=""> No Documents Uploaded.</p>
                        </dd>
                    </div>
                    </dl>
                </div>
                </div>
                
            </div>

            

            

        </template>   
        <template #actions>
            <jet-action-message :on="form.recentlySuccessful" class="mr-3">
                Uploaded.
            </jet-action-message>

            <jet-button :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
                Upload
            </jet-button>
        </template>

        
    
    </jet-form-section>
    
</template>

<script>
    import { defineComponent } from 'vue'
     import  Link  from '@inertiajs/inertia-vue3';
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
            Link
        },

        props: [],

        data() {
            return {
                form: this.$inertia.form({
                    _method: 'POST',
                    type: '',
                    document: null
                    
                }),

            }
        },

        methods: {
            uploadDocument() {
                this.form.post(route('current-user-document-upload'));
            },

        },
    })
</script>
