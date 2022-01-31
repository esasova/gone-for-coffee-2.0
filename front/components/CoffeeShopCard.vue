<template>
  <div class="bg-accent p-1 rounded-xl flex flex-col">
    <img src="~/assets/images/coffeeshop_placeholder.jpg" class="rounded-xl">
    <nuxt-link :to="`/coffeeshops/${coffeeshop.id}`" class="font-francoisOne text-primary text-2xl">
      <h2 class="my-4 text-primary font-francoisOne text-center text-3xl" data-test="coffeeshop_name">
        {{ coffeeshop.name }}
      </h2>
    </nuxt-link>
    <p class="my-4 text-primary font-aleo text-center text-xl flex-grow">
      {{ coffeeshop.description }}
    </p>
    <div class="flex justify-center my-4 text-primary text-4xl">
      <FontAwesomeIcon v-show="coffeeshop.brunch" :icon="['fas', 'utensils']" class="mx-2" />
      <FontAwesomeIcon v-show="coffeeshop.sunday" :icon="['fas', 'sun']" class="mx-2" />
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
  }
}
</script>

<style scoped>

</style>
