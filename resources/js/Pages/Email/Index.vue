<template>
    <Layout header="Email List">
        <div class="px-4 sm:px-6 lg:px-8">
            <div class="sm:flex sm:items-center">

            </div>
            <div class="mt-8 flex flex-col">
                <div class="-my-2 -mx-4 overflow-x-auto sm:-mx-6 lg:-mx-8">
                    <div class="inline-block min-w-full py-2 align-middle md:px-6 lg:px-8">
                        <div class="overflow-hidden shadow ring-1 ring-black ring-opacity-5 md:rounded-lg">
                            <table class="min-w-full divide-y divide-gray-300">
                                <thead class="bg-gray-50">
                                    <tr>
                                        <th scope="col"
                                            class="py-3.5 pl-4 pr-3 text-left text-sm font-semibold text-gray-900 sm:pl-6">
                                            Subject</th>
                                        <th scope="col"
                                            class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900">From</th>
                                        <th scope="col"
                                            class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900">To
                                        </th>
                                        <th scope="col"
                                            class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900">Status
                                        </th>
                                        <th scope="col" class="relative py-3.5 pl-3 pr-4 sm:pr-6">
                                            <span class="sr-only">view</span>
                                        </th>
                                    </tr>
                                </thead>
                                <tbody class="divide-y divide-gray-200 bg-white">
                                    <tr v-for="email in props.emails" :key="email.id">
                                        <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500">
                                            {{ email.subject }}
                                        </td>
                                        <td class="whitespace-nowrap py-4 pl-4 pr-3 text-sm sm:pl-6">
                                            <div class="flex items-center">
                                                <div class="ml-4">
                                                    <div class="font-medium text-gray-900">{{ email.from_name }}</div>
                                                    <div class="text-gray-500">{{ email.from_email }}</div>
                                                </div>
                                            </div>
                                        </td>
                                        <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500">
                                            <div class="text-gray-900">{{ email.to_name }}</div>
                                            <div class="text-gray-500">{{ email.to_email }}</div>
                                        </td>

                                        <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500">
                                            <span :class="['inline-flex rounded-full px-2 text-xs font-semibold leading-5 ',
                                                email.status == 'Sent' ? 'bg-green-100 text-green-800' : '',
                                                email.status == 'Posted' ? 'bg-blue-100 text-blue-800' : '',
                                                email.status == 'Failed' ? 'bg-red-100 text-red-800' : '',
                                            ]">{{ email.status }}</span>
                                        </td>
                                        <td
                                            class="relative whitespace-nowrap py-4 pl-3 pr-4 text-right text-sm font-medium sm:pr-6">
                                            <a href="#" class="text-indigo-600 hover:text-indigo-900">View<span
                                                    class="sr-only">, {{ email.id }}</span></a>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </Layout>
</template>

<script setup>
import Layout from '../Layout.vue';

const props = defineProps({
    emails: Object
});



</script>
