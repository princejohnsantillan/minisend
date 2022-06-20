<template>
  <Layout header="Email List">
    <div class="px-4 sm:px-6 lg:px-8">
      <div class="sm:flex sm:items-center">
        <div class="w-full">

          <div class="mt-1 relative rounded-md shadow-sm">
            <form action="">
              <input type="text" name="search-field" id="search-field"
                class="focus:ring-indigo-500 focus:border-indigo-500 block w-full pr-10 sm:text-sm border-gray-300 rounded-md"
                placeholder="Search by Sender, Recipient, or Subject" />
              <div class="absolute inset-y-0 right-0 pr-3 flex items-center pointer-events-none">
                <SearchIcon class="h-5 w-5 text-gray-400" aria-hidden="true" />
              </div>
            </form>
          </div>
        </div>
      </div>
      <div class="mt-8 flex flex-col">
        <div class="-my-2 -mx-4 overflow-x-auto sm:-mx-6 lg:-mx-8">
          <div class="inline-block min-w-full py-2 align-middle md:px-6 lg:px-8">
            <div class="overflow-hidden shadow ring-1 ring-black ring-opacity-5 md:rounded-lg">
              <table class="min-w-full divide-y divide-gray-300">
                <thead class="bg-gray-50">
                  <tr>
                    <th scope="col" class="py-3.5 pl-4 pr-3 text-left text-sm font-semibold text-gray-900 sm:pl-6">
                      Subject</th>
                    <th scope="col" class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900">From</th>
                    <th scope="col" class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900">To
                    </th>
                    <th scope="col" class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900">Status
                    </th>
                    <th scope="col" class="relative py-3.5 pl-3 pr-4 sm:pr-6">
                      <span class="sr-only">view</span>
                    </th>
                  </tr>
                </thead>
                <tbody class="divide-y divide-gray-200 bg-white">
                  <tr v-for="email in emails.data" :key="email.id">
                    <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500">
                      {{ email.subject }}
                    </td>
                    <td class="whitespace-nowrap py-4 pl-4 pr-3 text-sm sm:pl-6">
                      <div class="flex items-center">
                        <div class="ml-4">
                          <div class="font-medium text-gray-900">{{ email.from.name }}</div>
                          <div class="text-gray-500">{{ email.from.email }}</div>
                        </div>
                      </div>
                    </td>
                    <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500">
                      <div class="text-gray-900">{{ email.to.name }}</div>
                      <div class="text-gray-500">{{ email.to.email }}</div>
                    </td>

                    <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500">
                      <span :class="['inline-flex rounded-full px-2 text-xs font-semibold leading-5 ',
                        email.status == 'Sent' ? 'bg-green-100 text-green-800' : '',
                        email.status == 'Posted' ? 'bg-yellow-100 text-yellow-800' : '',
                        email.status == 'Failed' ? 'bg-red-100 text-red-800' : '',
                      ]">{{ email.status }}</span>
                    </td>
                    <td class="relative whitespace-nowrap py-4 pl-3 pr-4 text-right text-sm font-medium sm:pr-6">
                      <Link :href="'/email/' + email.id" class="text-indigo-600 hover:text-indigo-900">
                      View
                      <span class="sr-only">, {{ email.id }}</span>
                      </Link>
                    </td>
                  </tr>
                </tbody>
              </table>
            </div>

          </div>
        </div>
      </div>
      <Pagination></Pagination>
    </div>
  </Layout>
</template>

<script setup>

import Pagination from '../../Shared/Pagination.vue';
import { SearchIcon } from '@heroicons/vue/solid'

const props = defineProps({
  emails: Object
});

</script>
