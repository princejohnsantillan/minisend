<template>
  <Layout>
    <div class="max-w-4xl mx-auto">

      <div class="mt-0 mb-4">
        <span :class="['inline-flex rounded-full px-2 text-xs font-semibold leading-5 ',
          emailData.status == 'Sent' ? 'bg-green-100 text-green-800' : '',
          emailData.status == 'Posted' ? 'bg-yellow-100 text-yellow-800' : '',
          emailData.status == 'Failed' ? 'bg-red-100 text-red-800' : '',
        ]">
          {{ emailData.status }}
        </span>
        <h1 class="text-2xl font-bold">{{ emailData.subject }}</h1>
        <p class="text-xs text-gray-400">{{ emailData.posted_at }}</p>
      </div>

      <div class="my-4">
        <h2 class="text-md"><b>From: </b> {{ emailData.from.name }} &#60;{{ emailData.from.email }}&#62; </h2>
        <h2 class="text-md"><b>To: </b> {{ emailData.to.name }} &#60;{{ emailData.to.email }}&#62; </h2>
      </div>

      <div class="my-4">
        <div class="sm:hidden">
          <label for="tabs" class="sr-only">Select a tab</label>
          <select id="tabs" name="tabs" @change="activeTab = $event.target.value"
            class="block w-full pl-3 pr-10 py-2 text-base border-gray-300 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm rounded-md">
            <option v-if="emailData.html !== null" :selected="activeTab === 'html'" value="html">HTML</option>
            <option v-if="emailData.text !== null" :selected="activeTab === 'plain-text'" value="plain-text">Plain Text
            </option>
          </select>
        </div>
        <div class="hidden sm:block">
          <div class="border-b border-gray-200">
            <nav class="-mb-px flex space-x-8" aria-label="Tabs">
              <span v-if="emailData.html !== null" @click="activeTab = 'html'" :class="[
                activeTab === 'html' ? 'border-indigo-500 text-indigo-600' : 'border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300',
                'whitespace-nowrap py-4 px-1 border-b-2 font-medium text-sm cursor-pointer'
              ]">
                HTML
              </span>

              <span v-if="emailData.text !== null" @click="activeTab = 'plain-text'" :class="[
                activeTab === 'plain-text' ? 'border-indigo-500 text-indigo-600' : 'border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300',
                'whitespace-nowrap py-4 px-1 border-b-2 font-medium text-sm cursor-pointer'
              ]">
                Plain Text
              </span>
            </nav>
          </div>
        </div>

        <div class="my-4">
          <template v-if="activeTab == 'html'">
            <iframe :srcdoc="emailData.html" class="w-full min-h-[50vh] max-h-screen" height="100%"></iframe>
          </template>
          <div v-if="activeTab == 'plain-text'" v-text="emailData.text" class="w-full h-full" />
        </div>

        <hr />
      </div>

      <div v-if="attachments" class="mt-4">
        <h2 class=" text-md"><b>Attachments: </b> </h2>

        <a v-for="file in attachments.data" :key="file.id" :href="file.link"
          class="rounded-full text-xs m-1 bg-blue-100 text-blue-800 py-1 px-2 font-semibold leading-5 inline-block">
          {{ file.filename }}
        </a>

      </div>

    </div>
  </Layout>
</template>

<script setup>

import { ref } from 'vue';

const props = defineProps({
  email: Object,
  attachments: Object
});

const emailData = props.email.data


const activeTab = ref(emailData.html === null ? "plain-text" : "html");

</script>
