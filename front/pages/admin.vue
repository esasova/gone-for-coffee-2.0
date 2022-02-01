<template>
  <div>Admin</div>
</template>

<script>
export default {
  mounted () {
    console.log(this.$auth.user)
    this.$axios.$get('/users.json')
      .then((response) => {
        console.log(response)
      })
  }
}
</script>

<style scoped>

</style>
