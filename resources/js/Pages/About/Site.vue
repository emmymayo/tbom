<template>
    <Head title="About Site" />
    <nav-bar />
    

    <div class="mx-4 md:mx-12 my-6 flex flex-col space-y-6 text-lg">
        <h1 class="font-bold text-4xl"> About TBOM  </h1>

        <div class=" my-6 md:mr-20 ">
            <h4 class="font-semibold text-lg md:text-2xl mt-8 mb-4 uppercase shadow-md p-2 cursor-pointer hover:opacity-75" @click="show_problem = ! show_problem"> The perceived problem 
                <!-- <svg xmlns="http://www.w3.org/2000/svg" v-if="!show_problem" class="hidden inline h-6 w-6 float-right" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                </svg>

                <svg xmlns="http://www.w3.org/2000/svg" v-if="show_problem" class="hidden inline h-6 w-6 float-right" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 15l7-7 7 7" />
                </svg> -->
            </h4>
            <p class="my-4" v-if="show_problem"> Research mentorship routinely take place at tertiary education level. However, 
                there are several bottlenecks mitigating effective mentorship at this level. 
            </p>
            <ol class="list-decimal list-inside" v-if="show_problem">
                <li>	Foremost, there is paucity of mentors (less than 5million) available to the teeming population of mentees. </li>
                <li> Secondly, enrolment ratio for mentees is less than 25% in southern Asia and Sub-Saharan Africa, with tuition fee, 
                    entry examinations and long distances posing as major bottlenecks, limiting access of mentees to suitable mentors.
                </li>
                <li>
                    	Thirdly, the current approach of seeking a mentor is tedious, involving a bottom to top style of engagement, 
                    which requires the mentee to expend both financial and emotional resources to seek an appropriate mentor. 
                </li>
                <li>
                	Lastly, the culture to research mentorship has degenerated to “academic supervisor to student” relationship, 
                    and there are no measures to assess the outputs of a mentor, or to ascertain if mentoring has taken place.
                </li>
            
            </ol>

            <h4 class="font-semibold text-lg md:text-2xl mt-8 mb-4 uppercase shadow-md p-2 cursor-pointer hover:opacity-75" @click="show_solution = ! show_solution"> The solution  </h4>
            <p class=" " v-if="show_solution">
                The <span class="font-bold">Top-Bottom Open Mentorship (T-BOM) Model</span> therefore seeks to eliminate barriers of access to research mentorship, 
                promote behavioral change between mentors and mentees and establish innovative strategies of assessing and rewarding mentors.
            </p>

            <h4 class="font-semibold text-lg md:text-2xl mt-8 mb-4 uppercase shadow-md p-2 cursor-pointer hover:opacity-75" @click="show_core = ! show_core"> Core Objectives of the T-BOM Model are </h4>
            <ol class="list-decimal list-inside" v-if="show_core">
                <li>	Eliminate barriers of access to mentorship (e.g., schools, tuition/exams, distance). </li>
                <li> Enhance capacity of potential mentors. 
                </li>
                <li>
                	Promote visibility for mentors. 
                </li>
                <li>
                	Improve how mentees seek mentors.
                </li>
                <li>
                    Establish a collaborative system of assessing mentors as a means of measuring impact.
                </li>
            
            </ol>
            <h4 class="font-semibold text-lg md:text-2xl mt-8 mb-4 uppercase shadow-md p-2 cursor-pointer hover:opacity-75" @click="show_implementation = ! show_implementation"> Implementation flow chart </h4>
          

            <ol class="list-decimal list-inside" v-if="show_implementation">
                <li>	Open recruitment of potential mentors and mentees. </li>
                <li> Hosting and visibility promotion for mentees.</li>
                <li>
                		Training and enhancement of mentors’ skills. 
                </li>
                <li>
                	Pairing of mentees to mentor within a cycle of 12 months. 
                </li>
                <li>
                   Assessment of mentors by mentees.
                </li>
                <li>
                   Reward mentors based on mentorship index.
                </li>
            
            </ol>
            <h4 class="font-semibold text-lg md:text-2xl mt-8 mb-4 uppercase shadow-md p-2 cursor-pointer hover:opacity-75" @click="show_highlight = ! show_highlight"> Highlights </h4>
          

            <ol class="list-decimal list-inside" v-if="show_highlight">
                <li>	Mentors with high mentorship index could apply for mentorship grants or qualify for regional awards where the records of such 
                    mentors and mentees would be showcase annually. </li>
                <li> Mentors can use the index scores to improve on their weaknesses.</li>
                <li>
                		Training and enhancement of mentors’ skills. 
                </li>
                <li>
                	The model is open to both early, mid or senior career researchers who are interested in obtaining mentorship on a range of skill or experiences. 
                </li>
                <li>
                  Mentees can also get mentors from other regions of the world.
                </li>
                <li>
                   There are no barriers to mentorship (no entry fee or examination).
                </li>
            
            </ol>
        </div>
    </div>

    <Footer />
</template>



<script>
    import { defineComponent } from 'vue'
    import { Head, Link } from '@inertiajs/inertia-vue3';
    
    import NavBar from '@/Pages/Partials/NavBar.vue';
     import Footer from '@/Pages/Partials/Footer.vue';

    export default defineComponent({
        components: {
            Head,
            Link,
           
            NavBar,
            Footer,
            
        },
        data(){
            return {
                show_problem:false,
                show_solution:false,
                show_core:false,
                show_implementation:false,
                show_highlight:false,
            }
        }

    
    })
</script>
