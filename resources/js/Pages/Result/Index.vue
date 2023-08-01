<template>
    <div id="container" class="bg-[#3AAFA9] pt-[30px] h-fit min-h-screen">
      <div class="my-[20px]">
          <h1 class="text-black text-4xl text-center main-font">Query</h1>
      </div>
      <form
          @submit.prevent="submit"
      >
      <div id="input" class="w-[60%] mx-auto p-2 rounded-[10px] flex justify-center flex-col align-center">
          <label for="message" class="block mb-2 text-sm font-medium text-gray-900 text-black">Input API</label>
          <textarea
              id="message"
              rows="4"
              v-model="query"
              @input="write('query', query)"
              class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500"
              placeholder="Write the URL"></textarea>

        <button type="submit" class="w-[100px] mx-auto my-2 bg-blue-500 hover:bg-blue-700 text-black main-font font-bold py-2 px-4 rounded">
          Query
        </button>
      </div>
      </form>
      <div id="result" class="h-fit min-h-[500px] mx-auto rounded-[10px] mt-[50px] bg-gray-500 w-[80%] h-[500px] flex justify-center items-center p-2 break-all">

          <div id="original-api"
               class="bg-green-500 p-2 w-[50%] mx-1 h-full rounded-[5px] h-fit min-h-[500px]">
            <p class="text-center text-black my-2 text-2xl main-font font-bold">Original API Response</p>
            <pre
                v-if="result_original"
                class="whitespace-pre-wrap"
                v-html="JSON.stringify(result_original, null, '\t')"></pre>

            <p v-else></p>
          </div>
          <div id="processed-api" class="bg-green-500 p-2 w-[50%] mx-1 h-full rounded-[5px] h-[100%] min-h-[500px]">
            <p class="text-center text-black my-2 text-2xl main-font font-bold">Transformed API Response</p>

            <pre
                v-if="result_original"
                class="whitespace-pre-wrap"
                v-html="JSON.stringify(result_transformed, null, '\t')"></pre>
            <p v-else></p>
          </div>
      </div>
    </div>
</template>

<script setup>
  import { useForm } from '@inertiajs/vue3'
  import { defineProps, ref, computed } from 'vue'
  import { usePage } from '@inertiajs/vue3'

  let props = defineProps({
    result_original: Object,
    result_transformed: Object,
  })

  const page = usePage()
  let result_original = computed(() => page.props.flash.result_original)
  let result_transformed = computed(() => page.props.flash.result_transformed)


  let query = ref(localStorage.getItem('query'))

  const form = useForm({
    query: query,
  })

  const submit = () => {
    form.post('attempt-url')
    form.reset()
    form.clearErrors()
  }

  function write(key, value)
  {
    localStorage.setItem(key, value)
  }
</script>