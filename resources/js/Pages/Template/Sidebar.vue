<template>
  <span class="absolute text-white text-4xl top-5 left-4 cursor-pointer">
    <i class="bi bi-filter-left px-2 bg-gray-900 rounded-md"></i>
  </span>
  <div class="fixed top-0 bottom-0 lg:left-0 duration-200 p-2 overflow-y-auto text-center bg-[#522D64] shadow h-screen"
       :class="{
         'w-[100px] px-2' : sidebar,
         'w-[250px]' : !sidebar
       }"
   >
    <div class="text-gray-100 text-xl">
      <div class="p-2.5 mt-1 flex items-center rounded-md"
       :class="{
         'px-0 justify-center' : sidebar,
         'justify-between' : !sidebar
       }">
        <h1
            class="text-[15px]  ml-3 text-xl text-gray-200 font-bold"
            :class="{
               'px-0 hidden' : sidebar
            }"

        >Admin</h1>
        <i
            class="fa-solid fa-bars px-2 py-1 bg-blue-600 rounded-md cursor-pointer"
            :class="{
               'px-0 disabled' : sidebar
            }"
            @click="sidebarClose()"
        ></i>
      </div>
      <hr class="my-2 text-gray-600">
      <div>
        <Link
            :href="route('admin.dashboard')"
            class="p-2.5 mt-2 flex px-[20px] items-center rounded-md duration-300 cursor-pointer hover:bg-blue-600"
            :class="{
               'px-[0px] justify-center' : sidebar
            }">
          <i
              class="fa-solid fa-house-chimney"
              :class="{
               'block' : sidebar
               }"
          ></i>
          <span
              class="text-[15px] ml-4 text-gray-200"
              :class="{
               'px-0 hidden' : sidebar
              }"
          >Dashboard</span>
        </Link>

        <Link
            :href="route('product.index')"
            class="p-2.5 mt-2 flex px-[20px] items-center rounded-md px-4 duration-300 cursor-pointer hover:bg-blue-600"
            :class="{
               'px-[0px] justify-center' : sidebar
            }"
        >
          <i
              class="fa-solid fa-shop"
              :class="{
               'block' : sidebar
               }"
          ></i>
          <span
              class="text-[15px] ml-4 text-gray-200"
              :class="{
               'px-0 hidden' : sidebar
              }"
          >Products</span>
        </Link>
        <hr class="my-4 text-gray-600">

        <div
            @click="logout()"
            class="p-2.5 mt-3 flex px-[20px] items-center rounded-md px-4 duration-300 cursor-pointer hover:bg-blue-600"
            :class="{
               'px-0  justify-center' : sidebar
            }">
          <i class="fa-solid fa-right-from-bracket"></i>
          <span
              class="text-[15px] ml-4 text-gray-200"
              :class="{
               'px-0 hidden' : sidebar
              }"
          >Logout</span>
        </div>
      </div>
    </div>

  </div>
</template>
<style scoped>

</style>
<script setup>

  import { computed, onMounted, onUnmounted, ref, watch } from "vue"
  import {router} from "@inertiajs/vue3";

  let sidebar = ref(false);

  function logout()
  {
    router.post(route('logout'))
  }

  function useBreakpoints() {
    let windowWidth = ref(window.innerWidth)

    const onWidthChange = () => windowWidth.value = window.innerWidth
    onMounted(() => window.addEventListener('resize', onWidthChange))
    onUnmounted(() => window.removeEventListener('resize', onWidthChange))

    const type = computed(() => {
      if (windowWidth.value < 550) return 'xs'
      if (windowWidth.value >= 550 && windowWidth.value < 1200) return 'md'
      if (windowWidth.value >= 1200) return 'lg'
      return null; // This is an unreachable line, simply to keep eslint happy.
    })

    const width = computed(() => windowWidth.value)

    return { width, type }
  }
  const { width, type } = useBreakpoints()

  watch(width, (newWidth) => {
    if(width.value < 640)
    {
      sidebar.value = true;
      return;
    }
  })
  function sidebarClose() {
    console.log(sidebar.value)
    if(sidebar.value)
    {
      sidebar.value = false;
      return;
    }
    sidebar.value = true;
    return;
  }

</script>