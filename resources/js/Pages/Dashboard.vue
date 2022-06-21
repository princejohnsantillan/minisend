<template>
  <Layout header="Dashboard">

    <div>
      <h3 class="text-lg leading-6 font-medium text-gray-900"></h3>

      <dl class="mt-5 grid grid-cols-1 gap-5 sm:grid-cols-3">
        <div v-for="item in stats" :key="item.name" class="px-4 py-5 bg-white shadow rounded-lg overflow-hidden sm:p-6">
          <dt class="text-sm font-medium text-gray-500 truncate">
            {{ item.name }}
          </dt>
          <dd class="mt-1 text-3xl font-semibold text-gray-900">
            {{ item.stat }}
          </dd>
        </div>
      </dl>
    </div>

  </Layout>
</template>

<script setup>

const props = defineProps({
  stats: Object
})

</script>
