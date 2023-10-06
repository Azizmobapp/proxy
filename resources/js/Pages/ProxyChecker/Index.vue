<template>
    <div class=" mx-auto p-6">
        <div v-if="proxyIps">
            <div class="relative overflow-x-auto">
                <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                    <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                    <tr>
                        <th scope="col" class="px-6 py-3">
                            Ip
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Внешний Ip
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Порт
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Тип
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Город
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Страна
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Скорость
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Активность
                        </th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr v-for="proxyIp in proxyIps" class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                        <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                            {{ proxyIp.ip }}
                        </th>
                        <td class="px-6 py-4">
                            {{ proxyIp.real_ip }}
                        </td>
                        <td class="px-6 py-4">
                            {{ proxyIp.port }}
                        </td>
                        <td class="px-6 py-4">
                            {{ proxyIp.type }}
                        </td>
                        <td class="px-6 py-4">
                            {{ proxyIp.city }}
                        </td>
                        <td class="px-6 py-4">
                            {{ proxyIp.country }}
                        </td>
                        <td class="px-6 py-4">
                            {{ proxyIp.speed }}
                        </td>
                        <td class="px-6 py-4">
                            {{ proxyIp.is_active ? 'Да' : 'Нет' }}
                        </td>
                    </tr>
                    </tbody>
                </table>
            </div>

        </div>
    </div>
</template>

<script>
import MainLayout from "@/Layouts/MainLayout.vue";

export default {
    name: "Index",

    props: [
        'proxyIps'
    ],
    layout: MainLayout
}
</script>

<style scoped>

</style>
