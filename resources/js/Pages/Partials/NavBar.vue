<template>
  <div class="relative bg-white max-w-full ">
    <div class="max-w-7xl mx-auto max-w-full">
      <div
        class="
          relative
          z-10
          pb-4
          bg-white
          sm:pb-4
          md:pb-4
          lg:max-w-7xl lg:w-full lg:pb-4
          xl:pb-8
        "
      >
        <svg
          class="
            hidden
            
            absolute
            right-0
            inset-y-0
            h-full
            w-48
            text-white
            transform
            translate-x-1/2
          "
          fill="currentColor"
          viewBox="0 0 100 100"
          preserveAspectRatio="none"
          aria-hidden="true"
        >
          <polygon points="50,0 100,0 50,100 0,100" />
        </svg>

        <div>
          <div class="relative pt-6 px-4 sm:px-6 lg:px-8">
            <nav
              class="
                relative
                flex
                items-center
                justify-between
                sm:h-10
                lg:justify-start
              "
              aria-label="Global"
            >
              <div
                class="flex items-center flex-grow flex-shrink-0 lg:flex-grow-0"
              >
                <div class="flex items-center justify-between w-full md:w-auto">
                  <a href="#">
                    <span class="sr-only">Tbom</span>
                    <Link href="/"
                      ><img
                        class="h-12 w-auto"
                        src="/images/tbom-logo.png"
                        alt="tbom-logo"
                      />
                    </Link>
                  </a>
                  <div class="mr-1 flex items-center md:hidden">
                    <button
                      @click="showMobileMenu = ! showMobileMenu"
                      type="button"
                      class="
                        bg-white
                        rounded-md
                        p-2
                        inline-flex
                        items-center
                        justify-center
                        text-gray-400
                        hover:text-gray-500 hover:bg-gray-100
                        focus:outline-none
                        focus:ring-2
                        focus:ring-inset
                        focus:ring-indigo-500
                      "
                      aria-expanded="false"
                    >
                      <span class="sr-only">Open main menu</span>
                      <!-- Heroicon name: outline/menu -->
                      <svg
                        class="h-6 w-6"
                        xmlns="http://www.w3.org/2000/svg"
                        fill="none"
                        viewBox="0 0 24 24"
                        stroke="currentColor"
                        aria-hidden="true"
                      >
                        <path
                          stroke-linecap="round"
                          stroke-linejoin="round"
                          stroke-width="2"
                          d="M4 6h16M4 12h16M4 18h16"
                        />
                      </svg>
                    </button>
                    
                  </div>
                  
                  
                </div>
              </div>
              <div class="hidden md:block md:ml-10 md:pr-4 md:space-x-8">
                <Link
                  :href="route('about-author')"
                  class="font-medium text-gray-500 hover:text-gray-900"
                  >About Author</Link
                >

                <Link
                  :href="route('about-site')"
                  class="font-medium text-gray-500 hover:text-gray-900"
                  >About TBOM</Link
                >
                <Link
                  :href="route('publications.index')"
                  class="font-medium text-gray-500 hover:text-gray-900"
                  >Publications</Link
                >
                <Link
                  :href="route('login')"
                  class="font-medium text-gray-500 hover:text-gray-900"
                  v-if="$page.props.user == null"
                  >Log in</Link
                >
                <!-- Settings Dropdown -->
              </div>
              <div class="hidden md:block ml-3 relative">
                <jet-dropdown align="right" width="48">
                  <template #trigger>
                    <span
                      v-if="$page.props.user == null"
                      class="inline-flex rounded-md"
                    >
                      <button
                        type="button"
                        class="
                          inline-flex
                          items-center
                          px-3
                          py-1
                          border border-transparent
                          text-sm
                          leading-4
                          font-medium
                          rounded-md
                          text-gray-500
                          bg-white
                          hover:text-gray-700
                          focus:outline-none
                          transition
                        "
                      >
                        Sign Up

                        <svg
                          class="ml-2 -mr-0.5 h-4 w-4"
                          xmlns="http://www.w3.org/2000/svg"
                          viewBox="0 0 20 20"
                          fill="currentColor"
                        >
                          <path
                            fill-rule="evenodd"
                            d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                            clip-rule="evenodd"
                          />
                        </svg>
                      </button>
                    </span>

                    <span v-else class="inline-flex rounded-md">
                      <button
                        type="button"
                        class="
                          inline-flex
                          items-center
                          px-3
                          py-2
                          border border-transparent
                          text-sm
                          leading-4
                          font-medium
                          rounded-md
                          text-gray-500
                          bg-white
                          hover:text-gray-700
                          focus:outline-none
                          transition
                        "
                      >
                        Account
                      </button>
                    </span>
                  </template>

                  <template #content>
                    <!-- Account Management
                                                <div class="block px-4 py-2 text-xs text-gray-400">
                                                    Manage Account
                                                </div> -->

                    <jet-dropdown-link
                      :href="route('profile.show')"
                      v-if="$page.props.user != null"
                    >
                      Profile
                    </jet-dropdown-link>
                    <jet-dropdown-link
                      :href="route('dashboard')"
                      v-if="$page.props.user != null"
                    >
                      Dashboard
                    </jet-dropdown-link>

                    <jet-dropdown-link
                      href="/register?role=mentee"
                      v-if="$page.props.user == null"
                    >
                      Join As Mentee
                    </jet-dropdown-link>
                    <jet-dropdown-link
                      href="/register?role=mentor"
                      v-if="$page.props.user == null"
                    >
                      Join As Mentor
                    </jet-dropdown-link>

                    <div class="border-t border-gray-100"></div>

                    <!-- Authentication -->
                    <form @submit.prevent="logout">
                      <jet-dropdown-link
                        v-if="$page.props.user != null"
                        as="button"
                      >
                        Log Out
                      </jet-dropdown-link>
                    </form>
                  </template>
                </jet-dropdown>
                
              </div>
              <div v-if="$page.props.user==null || $page.props.user.role.name=='mentee'"
                 class="ml-6  w-1/3 hidden xl:flex   items-stretch focus:outline-none focus:ring-2 focus:ring-indigo-600 focus:border-transparent">
                        <input @keyup.enter="search" type="search" v-model="q" placeholder="Find mentor by name or expertise" class="rounded-l-lg flex-1 appearance-none border border-gray-300 w-full py-1 px-2 bg-white text-gray-700 placeholder-gray-400 shadow-sm text-base ">
                        <Link  @click="search"  class="bg-indigo-600 hover:bg-indigo-900 rounded-r-lg align-middle px-2">
                            <!-- :href="route('mentor.search.index')+'?q='+query+'&f='+expertise" -->
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-6   fill-current text-gray-100 " viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z" clip-rule="evenodd" />
                            </svg>
                        </Link>
                        
                </div>
            </nav>
          </div>
        </div>
      </div>
     
    </div>
     <!-- Mobile Menu -->
    <div class="md:hidden shadow-md z-30 absolute inset-0  mt-20 transition duration-500 ease-in-out" v-show="showMobileMenu">
        <div class="bg-white flex flex-col px-6 gap-y-4 pb-4 ">
            <Link :href="route('login')" v-if="$page.props.user==null">Log In </Link>
            <Link :href="route('register')+'?role=mentor'" v-if="$page.props.user==null">Join As Mentor </Link>
            <Link :href="route('register')+'?role=mentee'" v-if="$page.props.user==null">Join As Mentee </Link>
            <Link :href="route('profile.show')" v-if="$page.props.user!=null">Profile </Link>
            <Link :href="route('dashboard')" v-if="$page.props.user!=null">Dashboard </Link>
            <Link :href="route('about-author')" >About Author </Link>
            <Link :href="route('about-site')" >About TBOM </Link>
            <Link :href="route('publications.index')" >Publications </Link>
            <Link :href="route('logout')" class="text-left" v-if="$page.props.user!=null" method="post" as="button" type="button">Log Out</Link>
            
        </div>
    </div>
  </div>
</template>

<script>
import { defineComponent } from "vue";
import { Head, Link } from "@inertiajs/inertia-vue3";
import JetApplicationMark from "@/Jetstream/ApplicationMark.vue";
import JetDropdown from "@/Jetstream/Dropdown.vue";
import JetDropdownLink from "@/Jetstream/DropdownLink.vue";

export default defineComponent({
  components: {
    Head,
    Link,
    JetApplicationMark,
    JetDropdown,
    JetDropdownLink,
  },
  data() {
    return {
      showMobileMenu: false,
      // Search query
      q: "",
    };
  },

  methods: {
    search() {
      this.$inertia.visit(route("mentor.search.index") + "?q=" + this.q);
    },
    logout() {
      this.$inertia.post(route("logout"));
    },
  },
});
</script>
