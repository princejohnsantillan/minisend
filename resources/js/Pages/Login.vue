<template>
  <div class="min-h-full flex items-center justify-center py-12 px-4 sm:px-6 lg:px-8">
    <div class="max-w-md w-full space-y-8">

      <div>
        <h2 class="mt-6 text-center text-3xl font-extrabold text-gray-900">Sign in with your API Token</h2>
      </div>

      <form class="mt-8 space-y-6" @submit.prevent="loginForm.post('/login')">
        <div class="rounded-md shadow-sm -space-y-px">
          <div>
            <label for="email-address" class="sr-only">Email address</label>
            <input id="email-address" v-model="loginForm.email" name="email" type="email" autocomplete="email" required
              class="appearance-none rounded-none relative block w-full px-3 py-2 border border-gray-300 placeholder-gray-500 text-gray-900 rounded-t-md focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 focus:z-10 sm:text-sm"
              placeholder="Email address" />
          </div>
          <div>
            <label for="token" class="sr-only">token</label>
            <input id="token" name="token" v-model="loginForm.token" type="text" autocomplete="token" required
              class="appearance-none rounded-none relative block w-full px-3 py-2 border border-gray-300 placeholder-gray-500 text-gray-900 rounded-b-md focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 focus:z-10 sm:text-sm"
              placeholder="Token" />
          </div>
        </div>
        <div>
          <button type="submit" :disabled="loginForm.processing"
            class="group relative w-full flex justify-center py-2 px-4 border border-transparent text-sm font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
            <span class="absolute left-0 inset-y-0 flex items-center pl-3">
              <LockClosedIcon class="h-5 w-5 text-indigo-500 group-hover:text-indigo-400" aria-hidden="true" />
            </span>
            Sign in
          </button>
        </div>
        <p v-if="$page.props.errors.email" class="mt-2 text-sm text-red-600">{{ $page.props.errors.email }}</p>
      </form>

    </div>
  </div>
</template>

<script setup>

import { LockClosedIcon } from '@heroicons/vue/solid'
import { useForm } from '@inertiajs/inertia-vue3'

const loginForm = useForm({
  email: null,
  token: null,
});

</script>
