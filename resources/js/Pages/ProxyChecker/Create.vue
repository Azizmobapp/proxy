<template>
    <div class="w-1/2 mx-auto p-6">

        <div class="mb-4">
            <textarea v-model="ips"></textarea>
        </div>
        <div  class="mb-4">
            <a @click="check" href="#" class="inline-block px-3 py-2 bg-sky-700 text-white">Проверить</a>
        </div>
        <div v-if="message">
            {{ message }}
        </div>
    </div>
</template>

<script>
import MainLayout from "@/Layouts/MainLayout.vue";

export default {
    name: "Index",

    data() {
        return {
            ips: '',
            message: ''

        }
    },

    methods: {
        check() {
            axios.post('/proxy_checkers', {ips: this.ips})
                .then(res => {
                    console.log(res);
                    this.message = res.data.message
                })
        }
    },

    layout: MainLayout
}
</script>

<style scoped>

</style>
