<template>
    <app-layout title="Dashboard">
        <template #header>
            <div class="flex items-center gap-x-6 my-2">
                <img :src="$page.props.user.profile_photo_url" class="rounded-full h-32 w-32 object-cover " />
                <div>
                    <h3 class="font-semi-bold text-xl text-gray-500 capitalize" > <span v-if="$page.props.mentor!=null" class="font-semi-bold text-gray-500"> {{$page.props.mentor.title}} </span> {{$page.props.user.name}} </h3>
                    <h3 class="font-bold text-xl text-gray-500" v-if="$page.props.mentor!=null" >   {{$page.props.mentor.about_me}} </h3>
                    <Link :href="route('profile.show')"><h3 class="font-thin text-gray-500 underline"  >   Edit Profile </h3></Link>
                    <h3 class="font-bold text-gray-500" v-if="$page.props.mentor!=null && $page.props.assessment_index>0" > 
                        <!-- Rating Icon -->
                        <svg xmlns="http://www.w3.org/2000/svg" class="fill-current text-indigo-400 h-4 w-4 inline" xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1" width="256" height="256" viewBox="0 0 256 256" xml:space="preserve">
                                <desc>Created with Fabric.js 1.7.22</desc>
                                <defs>
                                </defs>
                                <g transform="translate(128 128) scale(0.72 0.72)" style="">
                                    <g style="stroke: none; stroke-width: 0; stroke-dasharray: none; stroke-linecap: butt; stroke-linejoin: miter; stroke-miterlimit: 10; fill: none; fill-rule: nonzero; opacity: 1;" transform="translate(-175.05 -175.05000000000004) scale(3.89 3.89)" >
                                    <circle cx="45" cy="45" r="45" style="stroke: none; stroke-width: 1; stroke-dasharray: none; stroke-linecap: butt; stroke-linejoin: miter; stroke-miterlimit: 10; fill: rgb(32,196,203); fill-rule: nonzero; opacity: 1;" transform="  matrix(1 0 0 1 0 0) "/>
                                    <path d="M 43.589 21.276 l 7.389 14.973 c 0.264 0.536 0.775 0.907 1.366 0.993 l 16.523 2.401 c 1.488 0.216 2.082 2.045 1.006 3.095 L 57.917 54.392 c -0.428 0.417 -0.623 1.017 -0.522 1.606 l 2.823 16.457 c 0.254 1.482 -1.302 2.613 -2.633 1.913 l -14.779 -7.77 c -0.529 -0.278 -1.16 -0.278 -1.689 0 l -14.779 7.77 c -1.331 0.7 -2.887 -0.431 -2.633 -1.913 l 2.823 -16.457 c 0.101 -0.589 -0.094 -1.189 -0.522 -1.606 L 14.05 42.737 c -1.077 -1.05 -0.483 -2.879 1.006 -3.095 l 16.523 -2.401 c 0.591 -0.086 1.102 -0.457 1.366 -0.993 l 7.389 -14.973 C 41 19.927 42.923 19.927 43.589 21.276 z" style="stroke: none; stroke-width: 1; stroke-dasharray: none; stroke-linecap: butt; stroke-linejoin: miter; stroke-miterlimit: 10; fill: rgb(27,167,173); fill-rule: nonzero; opacity: 1;" transform=" matrix(1 0 0 1 0 0) " stroke-linecap="round" />
                                    <path d="M 46.665 18.199 l 7.389 14.973 c 0.264 0.536 0.775 0.907 1.366 0.993 l 16.523 2.401 c 1.488 0.216 2.082 2.045 1.006 3.095 L 60.994 51.315 c -0.428 0.417 -0.623 1.017 -0.522 1.606 l 2.823 16.457 c 0.254 1.482 -1.302 2.613 -2.633 1.913 l -14.779 -7.77 c -0.529 -0.278 -1.16 -0.278 -1.689 0 l -14.779 7.77 c -1.331 0.7 -2.887 -0.431 -2.633 -1.913 l 2.823 -16.457 c 0.101 -0.589 -0.094 -1.189 -0.522 -1.606 L 17.127 39.66 c -1.077 -1.05 -0.483 -2.879 1.006 -3.095 l 16.523 -2.401 c 0.591 -0.086 1.102 -0.457 1.366 -0.993 l 7.389 -14.973 C 44.077 16.851 46 16.851 46.665 18.199 z" style="stroke: none; stroke-width: 1; stroke-dasharray: none; stroke-linecap: butt; stroke-linejoin: miter; stroke-miterlimit: 10; fill: rgb(255,255,255); fill-rule: nonzero; opacity: 1;" transform=" matrix(1 0 0 1 0 0) " stroke-linecap="round" />
                                </g>
                                </g>
                            </svg>
                          {{$page.props.assessment_index}} 
                          </h3>


                </div>
            </div>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Dashboard
            </h2>
        </template>

        <div class="py-12">
            <!-- Status -->
            <dashboard-status />
            <!-- Quick Links -->
            <dashboard-quicklinks />
            
        </div>
    </app-layout>
</template>

<script>
    import { defineComponent } from 'vue'
    import AppLayout from '@/Layouts/AppLayout.vue'
    import Welcome from '@/Jetstream/Welcome.vue'
    import  {Link, Head}  from '@inertiajs/inertia-vue3';
    import DashboardStatus from '@/Pages/Partials/DashboardStatus.vue'
    import DashboardQuicklinks from '@/Pages/Partials/DashboardQuicklinks.vue'

    export default defineComponent({
        components: {
            AppLayout,
            Welcome,
            DashboardStatus,
            DashboardQuicklinks,
            Link,
        },
    })
</script>
