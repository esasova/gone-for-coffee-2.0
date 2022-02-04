<template>
  <button class="w-1/2 mx-auto bg-accent text-primary font-francoisOne rounded lg:w-2/3">
    {{ name }}
  </button>
</template>

<script>
export default {
  props: {
    name: {
      type: String,
      required: true
    }
  }
}
</script>

<style scoped>

</style>
