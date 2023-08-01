<template>
  <nav class="isolate inline-flex -space-x-px rounded-md shadow-sm" aria-label="Pagination">
    <template v-for="link in links">
      <Link
          v-if="link.url"
          :href="link.url"
          v-html="link.label"
          class="relative inline-flex items-center px-4 py-2 text-base font-semibold text-gray-900 ring-1 ring-inset ring-gray-300 hover:bg-gray-50 focus:z-20 focus:outline-offset-0"
          :class="{
                  'bg-[#887e94] focus:z-20 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600' : link.active
                }"
      />
      <Link v-else
            v-html="link.label"
            class="relative inline-flex items-center px-2 py-2 text-gray-400 ring-1 ring-inset ring-gray-300 hover:bg-gray-50 focus:z-20 focus:outline-offset-0"
            :class="{
                    'rounded-r-md' : checkifRightorLeft(link.label),
                    'rounded-l-md' : !checkifRightorLeft(link.label)
                  }"
      />
    </template>
  </nav>
</template>

<script setup>
  import { defineProps } from "vue";
  import { Link, router } from '@inertiajs/vue3'
  import { ref, watch } from 'vue'

  const props = defineProps({
    links: {
      type: Object,
    }
  })
  let search = ref(props.search);
  let sort = ref('');
  watch (search, value => {
    router.visit('/product', {
      method: 'get',
      data: {
        search: value,
      },
      preserveState: true,
      preserveScroll: true,
    })
  })

  function checkifRightorLeft(side)
  {
    if(side == 'Next &raquo;')
    {
      return true;
    }
    return false;
  }
</script>
