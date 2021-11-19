<template>
    <Link :href="'/'">
         <img src="/images/tbom-logo.png" alt="tbom" class="">
        
    </Link>
</template>

<script>
    import { defineComponent } from 'vue'
    import { Link } from '@inertiajs/inertia-vue3';

    export default defineComponent({
        components: {
            Link,
        },
    })
</script>
