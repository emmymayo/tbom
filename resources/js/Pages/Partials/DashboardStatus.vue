<template>
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg  ">
                    <div class="flex flex-col gap-4 overflow-x-auto md:flex-row md:items-center md:justify-between px-4 py-6  bg-gray-100">
                        <!-- card 1 -->
                        <div class="bg-white shadow-lg py-8 px-12 rounded-lg bg-opacity-70 backdrop-filter backdrop-blur-xl ">
                            <!-- Mentee Card -->
                            <template v-if="$page.props.mentee!=null">
                            <div class="flex gap-x-6 items-center">
                                <div>  
                                    <h3 class="font-semibold text-indigo-400 text-5xl"> {{$page.props.connected_mentor_count}} </h3>
                                    <h3 class="font-thin text-gray-500 text-xl"> No. of Mentors </h3>
                                </div>
                                <div>
                                    <svg xmlns="http://www.w3.org/2000/svg" class="fill-current h-16 w-16  text-indigo-400" viewBox="0 0 20 20" fill="currentColor">
                                        <path d="M13 6a3 3 0 11-6 0 3 3 0 016 0zM18 8a2 2 0 11-4 0 2 2 0 014 0zM14 15a4 4 0 00-8 0v3h8v-3zM6 8a2 2 0 11-4 0 2 2 0 014 0zM16 18v-3a5.972 5.972 0 00-.75-2.906A3.005 3.005 0 0119 15v3h-3zM4.75 12.094A5.973 5.973 0 004 15v3H1v-3a3 3 0 013.75-2.906z" />
                                    </svg> 
                                </div>
                            </div>
                            </template>
                            <!-- Mentor Card -->
                            <template v-if="$page.props.mentor!=null"> 
                            <div class="flex gap-x-6 items-center">
                                <div>  
                                    <h3 class="font-semibold text-indigo-400 text-5xl"> {{$page.props.connected_mentee_count}} </h3>
                                    <h3 class="font-thin text-gray-500 text-xl"> No. of Mentees </h3>
                                </div>
                                <div>
                                    <svg xmlns="http://www.w3.org/2000/svg" class="fill-current h-16 w-16  text-indigo-400" viewBox="0 0 20 20" fill="currentColor">
                                        <path d="M13 6a3 3 0 11-6 0 3 3 0 016 0zM18 8a2 2 0 11-4 0 2 2 0 014 0zM14 15a4 4 0 00-8 0v3h8v-3zM6 8a2 2 0 11-4 0 2 2 0 014 0zM16 18v-3a5.972 5.972 0 00-.75-2.906A3.005 3.005 0 0119 15v3h-3zM4.75 12.094A5.973 5.973 0 004 15v3H1v-3a3 3 0 013.75-2.906z" />
                                    </svg> 
                                </div>
                            </div>
                            </template>

                        </div> 
                        <!-- Card 2 -->
                        <div class="bg-white shadow-lg py-8 px-12 rounded-lg bg-opacity-70 backdrop-filter backdrop-blur-xl ">
                            <!-- Mentee Card -->
                            <template v-if="$page.props.mentee!=null">
                            <div class="flex gap-x-6 items-center">
                                <div>  
                                    <h3 class="font-semibold text-indigo-400 text-5xl"> {{$page.props.requested_mentor_count}} </h3>
                                    <h3 class="font-thin text-gray-500 text-xl"> Pending Requests </h3>
                                </div>
                                <div>
                                    <svg xmlns="http://www.w3.org/2000/svg" class="fill-current h-16 w-16  text-indigo-400" viewBox="0 0 20 20" fill="currentColor">
                                        <path d="M13 6a3 3 0 11-6 0 3 3 0 016 0zM18 8a2 2 0 11-4 0 2 2 0 014 0zM14 15a4 4 0 00-8 0v3h8v-3zM6 8a2 2 0 11-4 0 2 2 0 014 0zM16 18v-3a5.972 5.972 0 00-.75-2.906A3.005 3.005 0 0119 15v3h-3zM4.75 12.094A5.973 5.973 0 004 15v3H1v-3a3 3 0 013.75-2.906z" />
                                    </svg> 
                                </div>
                            </div>
                            </template>
                            <!-- Mentor Card -->
                            <template v-if="$page.props.mentor!=null"> 
                            <div class="flex gap-x-6 items-center">
                                <div>  
                                    <h3 class="font-semibold text-indigo-400 text-5xl"> {{$page.props.requested_mentee_count}} </h3>
                                    <h3 class="font-thin text-gray-500 text-xl"> Pending Requests </h3>
                                </div>
                                <div>
                                    <svg xmlns="http://www.w3.org/2000/svg" class="fill-current h-16 w-16  text-indigo-400" viewBox="0 0 20 20" fill="currentColor">
                                        <path d="M13 6a3 3 0 11-6 0 3 3 0 016 0zM18 8a2 2 0 11-4 0 2 2 0 014 0zM14 15a4 4 0 00-8 0v3h8v-3zM6 8a2 2 0 11-4 0 2 2 0 014 0zM16 18v-3a5.972 5.972 0 00-.75-2.906A3.005 3.005 0 0119 15v3h-3zM4.75 12.094A5.973 5.973 0 004 15v3H1v-3a3 3 0 013.75-2.906z" />
                                    </svg> 
                                </div>
                            </div>
                            </template>

                        </div> 
                        <!-- Card 3 -->
                        <div class="bg-white shadow-lg py-8 px-12 rounded-lg bg-opacity-70 backdrop-filter backdrop-blur-xl ">
                            <!-- Mentee Card -->
                            <template v-if="$page.props.mentee!=null">
                            <div class="flex gap-x-6 items-center">
                                <div>  
                                    <h3 class="font-semibold text-indigo-400 text-5xl"> {{$page.props.academic_entries}} </h3>
                                    <h3 class="font-thin text-gray-500 text-xl"> Academic Entries </h3>
                                </div>
                                <div>
                                    <svg xmlns="http://www.w3.org/2000/svg" class="fill-current h-16 w-16  text-indigo-400" viewBox="0 0 20 20" fill="currentColor">
                                        <path d="M10.394 2.08a1 1 0 00-.788 0l-7 3a1 1 0 000 1.84L5.25 8.051a.999.999 0 01.356-.257l4-1.714a1 1 0 11.788 1.838L7.667 9.088l1.94.831a1 1 0 00.787 0l7-3a1 1 0 000-1.838l-7-3zM3.31 9.397L5 10.12v4.102a8.969 8.969 0 00-1.05-.174 1 1 0 01-.89-.89 11.115 11.115 0 01.25-3.762zM9.3 16.573A9.026 9.026 0 007 14.935v-3.957l1.818.78a3 3 0 002.364 0l5.508-2.361a11.026 11.026 0 01.25 3.762 1 1 0 01-.89.89 8.968 8.968 0 00-5.35 2.524 1 1 0 01-1.4 0zM6 18a1 1 0 001-1v-2.065a8.935 8.935 0 00-2-.712V17a1 1 0 001 1z" />
                                    </svg>
                                </div>
                            </div>
                            </template>
                            <!-- Mentor Card -->
                            <template v-if="$page.props.mentor!=null"> 
                            <div class="flex gap-x-6 items-center">
                                <div>  
                                    <h3 class="font-semibold text-indigo-400 text-5xl"> {{$page.props.expertise_entries}} </h3>
                                    <h3 class="font-thin text-gray-500 text-xl"> Expertise Count </h3>
                                </div>
                                <div>
                                    <svg xmlns="http://www.w3.org/2000/svg" class="fill-current h-16 w-16  text-indigo-400" viewBox="0 0 20 20" fill="currentColor">
                                        <path d="M10.394 2.08a1 1 0 00-.788 0l-7 3a1 1 0 000 1.84L5.25 8.051a.999.999 0 01.356-.257l4-1.714a1 1 0 11.788 1.838L7.667 9.088l1.94.831a1 1 0 00.787 0l7-3a1 1 0 000-1.838l-7-3zM3.31 9.397L5 10.12v4.102a8.969 8.969 0 00-1.05-.174 1 1 0 01-.89-.89 11.115 11.115 0 01.25-3.762zM9.3 16.573A9.026 9.026 0 007 14.935v-3.957l1.818.78a3 3 0 002.364 0l5.508-2.361a11.026 11.026 0 01.25 3.762 1 1 0 01-.89.89 8.968 8.968 0 00-5.35 2.524 1 1 0 01-1.4 0zM6 18a1 1 0 001-1v-2.065a8.935 8.935 0 00-2-.712V17a1 1 0 001 1z" />
                                    </svg>
                                    
                                </div>
                            </div>
                            </template>

                        </div> 
     
                    </div>
                </div>
            </div>
</template>