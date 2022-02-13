<template>
  <button class="rounded-full w-14 h-14 bg-primary text-accent mx-2">
    <i :class="`fa fas fa-${iconName}`" />
  </button>
</template>

<script>
export default {
  props: {
    iconName: {
      type: String,
      required: true
    }
  }
}
</script>

<style scoped>

</style>
