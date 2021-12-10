<template>
    <app-layout title="Mentor Assessment">
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                 Mentor Assessment
            </h2>
        </template>
        <div class="max-w-7xl mx-auto py-10 sm:px-6 lg:px-8">
        
            <!-- top Section  -->
            <div class="flex flex-col md:flex-row justify-between px-4 items-center my-6"> 
                <!-- DP and Basic Info -->
                <div class="flex items-center gap-2"> 
                    <img :src="mentor.user.profile_photo_url" class="rounded-full h-36 w-36 object-cover mt-4 " />
                    <div class="flex flex-col">
                        <h3 class="text-center  font-semibold text-xl  text-indigo-400">{{mentor.title}} {{mentor.user.name}} </h3>
                        
                    </div>
                </div>
            </div>

            <div class ="bg-white py-6 px-4 flex flex-col md:flex-row">
                <jet-form-section @submitted="updateAssessment">
                    <template #title>
                        Update Assessment
                    </template>

                    <template #description>
                        Assessment should be fair and without any form of prejudice.
                    </template>

                    <template #form >
                        

                        <!-- Expertise -->
                        <div class="col-span-6 md:col-span-3">
                            <jet-label for="expertise" class="font-bold" :class="{'text-red-400':form.expertise<40,'text-yellow-400':form.expertise<70,'text-green-400':form.expertise>=70}" value="Expertise in subject area" /> 
                            <span class="font-bold" :class="{'text-red-400':form.expertise<40,'text-yellow-400':form.expertise<70,'text-green-400':form.expertise>=70}">
                                {{form.expertise}} %
                            </span>
                            <br>
                            <svg v-for="n in stars(form.expertise)" :key="n" xmlns="http://www.w3.org/2000/svg" class="fill-current h-5 w-5 text-yellow-500 inline" viewBox="0 0 20 20" fill="currentColor">
                                <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                            </svg>
                                
                            
                            <jet-input id="expertise" type="range" :max="max" :min="min" 
                                class=" mt-1 block w-full  " v-model="form.expertise"  />
                            <jet-input-error :message="form.errors.expertise" class="mt-2" />
                        </div>
                        <!-- Availability -->
                        <div class="col-span-6 md:col-span-3">
                            <jet-label for="availability" class="font-bold" :class="{'text-red-400':form.availability<40,'text-yellow-400':form.availability<70,'text-green-400':form.availability>=70}" value="Availability" /> 
                            <span class="font-bold" :class="{'text-red-400':form.availability<40,'text-yellow-400':form.availability<70,'text-green-400':form.availability>=70}">
                                {{form.availability}} %
                            </span>
                            <br>
                            <svg v-for="n in stars(form.availability)" :key="n" xmlns="http://www.w3.org/2000/svg" class="fill-current h-5 w-5 text-yellow-500 inline" viewBox="0 0 20 20" fill="currentColor">
                                <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                            </svg>
                            <jet-input id="availability" type="range" :max="max" :min="min" 
                                class=" mt-1 block w-full  " v-model="form.availability"  />
                            <jet-input-error :message="form.errors.availability" class="mt-2" />
                        </div>
                        <!-- Motivation -->
                        <div class="col-span-6 md:col-span-3">
                            <jet-label for="motivation" class="font-bold" :class="{'text-red-400':form.motivation<40,'text-yellow-400':form.motivation<70,'text-green-400':form.motivation>=70}" value="Motivation & Enthusiasm" /> 
                            <span class="font-bold" :class="{'text-red-400':form.motivation<40,'text-yellow-400':form.motivation<70,'text-green-400':form.motivation>=70}">
                                {{form.motivation}} %
                            </span>
                            <br>
                            <svg v-for="n in stars(form.motivation)" :key="n" xmlns="http://www.w3.org/2000/svg" class="fill-current h-5 w-5 text-yellow-500 inline" viewBox="0 0 20 20" fill="currentColor">
                                <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                            </svg>
                            <jet-input id="motivation" type="range" :max="max" :min="min" 
                                class=" mt-1 block w-full   " v-model="form.motivation"  />
                            <jet-input-error :message="form.errors.motivation" class="mt-2" />
                        </div>

                        <!-- listening -->
                        <div class="col-span-6 md:col-span-3">
                            <jet-label for="listening" value="Listening" class="font-bold" :class="{'text-red-400':form.listening<40,'text-yellow-400':form.listening<70,'text-green-400':form.listening>=70}" />
                            <span class="font-bold" :class="{'text-red-400':form.listening<40,'text-yellow-400':form.listening<70,'text-green-400':form.listening>=70}">
                                {{form.listening}} %
                            </span>
                            <br>
                            <svg v-for="n in stars(form.listening)" :key="n" xmlns="http://www.w3.org/2000/svg" class="fill-current h-5 w-5 text-yellow-500 inline" viewBox="0 0 20 20" fill="currentColor">
                                <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                            </svg>
                            <jet-input id="listening" type="range" :max="max" :min="min" 
                                class=" mt-1 block w-full  " v-model="form.listening"  />
                            <jet-input-error :message="form.errors.listening" class="mt-2" />
                        </div>
                        <!-- adaptability -->
                        <div class="col-span-6 md:col-span-3">
                            <jet-label for="adaptability" value="Adaptability" class="font-bold" :class="{'text-red-400':form.adaptability<40,'text-yellow-400':form.adaptability<70,'text-green-400':form.adaptability>=70}" />
                            <span class="font-bold" :class="{'text-red-400':form.adaptability<40,'text-yellow-400':form.adaptability<70,'text-green-400':form.adaptability>=70}">
                                {{form.adaptability}} %
                            </span>
                            <br>
                            <svg v-for="n in stars(form.adaptability)" :key="n" xmlns="http://www.w3.org/2000/svg" class="fill-current h-5 w-5 text-yellow-500 inline" viewBox="0 0 20 20" fill="currentColor">
                                <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                            </svg>
                            <jet-input id="adaptability" type="range" :max="max" :min="min" 
                                class=" mt-1 block w-full  " v-model="form.adaptability"  />
                            <jet-input-error :message="form.errors.adaptability" class="mt-2" />
                        </div>
                        <!-- positivity -->
                        <div class="col-span-6 md:col-span-3">
                            <jet-label for="positivity" value="Positivity" class="font-bold" :class="{'text-red-400':form.positivity<40,'text-yellow-400':form.positivity<70,'text-green-400':form.positivity>=70}" />
                            <span class="font-bold" :class="{'text-red-400':form.positivity<40,'text-yellow-400':form.positivity<70,'text-green-400':form.positivity>=70}">
                                {{form.positivity}} %
                            </span>
                            <br>
                            <svg v-for="n in stars(form.positivity)" :key="n" xmlns="http://www.w3.org/2000/svg" class="fill-current h-5 w-5 text-yellow-500 inline" viewBox="0 0 20 20" fill="currentColor">
                                <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                            </svg>
                            <jet-input id="positivity" type="range" :max="max" :min="min" 
                                class=" mt-1 block w-full " v-model="form.positivity"  />
                            <jet-input-error :message="form.errors.positivity" class="mt-2" />
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
            </div>
        

        </div>
    </app-layout>
</template>

<script>
    import { defineComponent } from 'vue'
    import AppLayout from '@/Layouts/AppLayout.vue'
    import JetApplicationMark from '@/Jetstream/ApplicationMark.vue'
    import JetButton from '@/Jetstream/Button.vue'
    import JetInput from '@/Jetstream/Input.vue'
    import JetLabel from '@/Jetstream/Label.vue'
    import JetFormSection from '@/Jetstream/FormSection.vue'
    import JetInputError from '@/Jetstream/InputError.vue'
    import JetActionMessage from '@/Jetstream/ActionMessage.vue'
    
    import { Head, Link } from '@inertiajs/inertia-vue3';
export default defineComponent({
    
    components: {
        JetApplicationMark,
        JetButton,
        AppLayout,
        JetInput,
        JetInputError,
        JetLabel,
        JetFormSection,
        JetActionMessage,
        Head,
        Link,
        
    },
    props:['mentor','assessment'],
    data(){
        return {
            max:100,
            min:1,
            form : this.$inertia.form({
                    _method: 'PUT',
                    'expertise' : this.assessment.expertise,
                    'availability' : this.assessment.availability,
                    'motivation' : this.assessment.motivation,
                    'listening' : this.assessment.listening,
                    'adaptability' : this.assessment.adaptability,
                    'positivity' : this.assessment.positivity
                    
                }),
        }
    },
    methods:{
        updateAssessment(){
            this.form.put(route('mentor-assessment.update',{mentor:this.mentor.id}));
        },
        stars(value){
            return Math.round(value/(this.max/5)); 
        }
    },
    computed:{
        
    }
})
</script>

<style scoped>
    input[type=range] {
  height: 28px;
  -webkit-appearance: none;
  margin: 10px 0;
  width: 100%;
}
input[type=range]:focus {
  outline: none;
}
input[type=range]::-webkit-slider-runnable-track {
  width: 100%;
  height: 5px;
  cursor: pointer;
  animate: 0.2s;
  box-shadow: 0px 0px 0px #000000;
  background: #2497E3;
  border-radius: 15px;
  border: 0px solid #000000;
}
input[type=range]::-webkit-slider-thumb {
  box-shadow: 0px 0px 0px #000000;
  border: 1px solid #2497E3;
  height: 21px;
  width: 21px;
  border-radius: 24px;
  background: #A1D0FF;
  cursor: pointer;
  -webkit-appearance: none;
  margin-top: -8.5px;
}
input[type=range]:focus::-webkit-slider-runnable-track {
  background: #2497E3;
}
input[type=range]::-moz-range-track {
  width: 100%;
  height: 5px;
  cursor: pointer;
  animate: 0.2s;
  box-shadow: 0px 0px 0px #000000;
  background: #2497E3;
  border-radius: 15px;
  border: 0px solid #000000;
}
input[type=range]::-moz-range-thumb {
  box-shadow: 0px 0px 0px #000000;
  border: 1px solid #2497E3;
  height: 21px;
  width: 21px;
  border-radius: 24px;
  background: #A1D0FF;
  cursor: pointer;
}
input[type=range]::-ms-track {
  width: 100%;
  height: 5px;
  cursor: pointer;
  animate: 0.2s;
  background: transparent;
  border-color: transparent;
  color: transparent;
}
input[type=range]::-ms-fill-lower {
  background: #2497E3;
  border: 0px solid #000000;
  border-radius: 30px;
  box-shadow: 0px 0px 0px #000000;
}
input[type=range]::-ms-fill-upper {
  background: #2497E3;
  border: 0px solid #000000;
  border-radius: 30px;
  box-shadow: 0px 0px 0px #000000;
}
input[type=range]::-ms-thumb {
  margin-top: 1px;
  box-shadow: 0px 0px 0px #000000;
  border: 1px solid #2497E3;
  height: 21px;
  width: 21px;
  border-radius: 24px;
  background: #A1D0FF;
  cursor: pointer;
}
input[type=range]:focus::-ms-fill-lower {
  background: #2497E3;
}
input[type=range]:focus::-ms-fill-upper {
  background: #2497E3;
}
</style>