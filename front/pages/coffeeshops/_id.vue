<template>
  <div v-if="coffeeshop" data-test="coffeeshop_detail_name">
    {{ coffeeshop.name }}
  </div>
</template>

<script>
export default {
  data () {
    return {
      coffeeshop: null
    }
  },
  mounted () {
    this.$axios.$get('http://127.0.0.1:8000/api/coffeeshops/' + this.$route.params.id)
      .then((response) => {
        this.coffeeshop = response
      })
  }
}
</script>

<style scoped>

</style>
