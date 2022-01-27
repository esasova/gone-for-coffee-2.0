<template>
  <div>
    <div v-if="coffeeShops" class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3">
      <nuxt-link v-for="coffeeShop in coffeeShops" :key="coffeeShop.id" :to="`/coffeeshops/${coffeeShop.id}`" data-test="coffeeshop_title">
        {{ coffeeShop. name }}
      </nuxt-link>
    </div>
  </div>
</template>

<script>
export default {
  data () {
    return {
      coffeeShops: null
    }
  },
  mounted () {
    this.$axios.$get('http://127.0.0.1:8000/api/coffeeshops.json')
      .then((response) => {
        this.coffeeShops = response
      })
  }
}
</script>
