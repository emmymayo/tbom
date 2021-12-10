<template>
        <!-- component -->
    <div class="h-16 flex flex-col md:flex-row  bg-indigo-700 gap-2 relative mt-16 md:mt-8">
    <div class="z-10  transform -translate-y-10 flex flex-row m-auto  bg-gradient-to-r from-indigo-700 via-indigo-800 to-indigo-900 p-6 gap-8 rounded-lg border-2 border-indigo-500">
        <div class="text-indigo-300 my-auto bg-gradient-to-l from-indigo-700 via-indigo-800 to-indigo-900 rounded-full p-4">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12 animate-pulse" viewBox="0 0 20 20" fill="currentColor">
                <path d="M2 10a8 8 0 018-8v8h8a8 8 0 11-16 0z" />
                <path d="M12 2.252A8.014 8.014 0 0117.748 8H12V2.252z" />
            </svg>
        </div>
        <div class="my-auto ">
            <div class="text-lg text-indigo-300">Mentors</div>
            <div class="text-4xl text-indigo-100">{{$page.props.mentor_count}}</div>
        </div>
        <div class="my-auto ">
            <div class="text-lg text-indigo-300">Mentees</div>
            <div class="text-4xl text-indigo-100">{{$page.props.mentee_count}}</div>
        </div>
        
    </div>
    </div>
</template>