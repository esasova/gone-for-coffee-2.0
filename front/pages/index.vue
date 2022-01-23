<template>
  <div class="font-bold">
    My future homepage
  </div>
</template>

<script>
export default {
  mounted () {
    this.$axios.$get('http://127.0.0.1:8000/api/coffeeshops.json')
      .then((response) => {
        console.log(response)
      })
  }
}
</script>
