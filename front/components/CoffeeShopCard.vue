<template>
  <div class="bg-accent p-1 rounded-xl flex flex-col">
    <img :src="coffeeshop.image ? $axios.defaults.baseURL + coffeeshop.image : require('~/assets/images/coffeeshop_placeholder.jpg')" class="rounded-xl h-52 md:h-60 lg:h-80">
    <nuxt-link :to="`/coffeeshops/${coffeeshop.id}`" class="font-francoisOne text-primary text-2xl">
      <h2 class="my-4 text-primary font-francoisOne text-center text-3xl" data-test="coffeeshop_name">
        {{ coffeeshop.name }}
      </h2>
    </nuxt-link>
    <div class="flex justify-center mt-2 text-xl">
      <i v-for="i in 5" :key="i" class="fa fas fa-coffee" :class="i <= coffeeshopRating ? 'text-primary' : 'text-gray-400'" />
    </div>
    <p class="my-4 text-primary font-aleo text-center text-xl flex-grow">
      {{ coffeeshop.description }}
    </p>
    <div class="flex justify-center my-4 text-primary text-4xl">
      <i v-show="coffeeshop.sunday" class="fa fas fa-sun mx-2" />
      <i v-show="coffeeshop.brunch" class="fa fas fa-utensils mx-2" />
    </div>
    <div class="text-center my-4">
      <nuxt-link :to="`/coffeeshops/${coffeeshop.id}`" class="text-primary text-2xl font-francoisOne">
        En savoir plus
      </nuxt-link>
    </div>
  </div>
</template>

<script>
export default {
  props: {
    coffeeshop: {
      type: Object,
      required: true
    }
  },
  computed: {
    coffeeshopRating () {
      return Math.ceil(this.coffeeshop.ratings.map(el => el.rating).reduce((p, c) => p + c, 0) / this.coffeeshop.ratings.length)
    }
  }
}
</script>

<style scoped>

</style>
