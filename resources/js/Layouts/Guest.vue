<template lang="">
  <div class="flex items-center min-h-screen p-4 bg-purple-50 lg:justify-center">
    <div
      class="flex flex-col overflow-hidden bg-white rounded-md shadow-lg max md:flex-row md:flex-1 lg:max-w-screen-md"
    >
      <div
        class="p-4 py-6 bg-white md:w-80 md:flex-shrink-0 md:flex md:flex-col md:items-center md:justify-evenly"
      >
        <div class="my-3 text-4xl font-bold tracking-wider text-center">
          <inertia-link href="/">
            <img src="../../../resources/images/logo.png" alt="logo" class="object-contain h-48 w-full" />
          </inertia-link>
        </div>


      </div>
      <div class="p-5 bg-white md:flex-1">
        <slot />
      </div>
    </div>
  </div>
</template>
<script>
export default {}
</script>
<style lang=""></style>
