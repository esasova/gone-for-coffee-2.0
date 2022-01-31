<template>
  <button class="w-1/2 mx-auto bg-accent text-primary font-francoisOne rounded lg:w-2/3" @click="action">
    {{ name }}
  </button>
</template>

<script>
export default {
  props: {
    name: {
      type: String,
      required: true
    },
    action: {
      type: Function,
      required: true
    }
  }
}
</script>

<style scoped>

</style>
