<template>
    <div>
        <div class="w-1/2 mx-auto mb-6 p-6">
            <Link class="mr-6" :href="route('proxy_checker.create')">Проверка</Link>
            <Link :href="route('proxy_checker.index')">Список</Link>
        </div>
        <div>
            <slot />
        </div>
    </div>
</template>

<script>
import {Link} from '@inertiajs/vue3'
export default {
    name: "MainLayout",

    components: {
        Link
    }
}
</script>

<style scoped>

</style>
