<template>
  <div class="w-full h-screen">
    <div class="w-full py-36 bg-no-repeat bg-cover homepage_image text-accent font-francoisOne text-6xl text-center">
      Gône for coffee
    </div>
    <div class="w-full p-8 bg-primary text-justify font-aleo text-xl text-accent mb-4">
      Combien de fois en cherchant « café lyon », on était déçu parce qu’on tombait
      sur les Starbucks ou endroits « cosy » où on vous propose de déguster un bon cappuccino en poudre
      dans un cadre de jolis coussins et meubles en palettes… Pour être sûrs de votre prochain café,
      confiez-vous à <span class="font-bold">Gône for Coffee</span>, guide des coffee shops de Lyon.
    </div>
    <div class="grid grid-rows-2">
      <div class="m-3 flex justify-between">
        <input type="text" class="rounded-l p-2" v-model="coffeshop_search" placeholder="Votre recherche">
        <button class="rounded bg-accent font-francoisOne text-primary p-2">Chercher</button>
      </div>
      <div class="flex">
        <div>
          <label>Brunch</label>
          <input v-model="brunch" type="checkbox" id="brunch">
          <label>Torréfacteur</label>
          <input v-model="torrefacteur" type="checkbox" id="torrefacteur">
        </div>
        <div>
          <label>Ouvert le dimanche</label>
          <input v-model="sunday" type="checkbox" id="sunday">
        </div>
      </div>
    </div>
    <div v-if="coffeeShops" class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3">
        <CoffeeShopCard v-for="coffeeShop in coffeeShops" :key="coffeeShop.id" :coffeeshop="coffeeShop" />
    </div>
  </div>
</template>

<script>
export default {
  data () {
    return {
      coffeeShops: null,
      coffeeshop_search: ''
    }
  },
  mounted () {
    this.$axios.$get('/coffeeshops.json')
      .then((response) => {
        this.coffeeShops = response
      })
  }
}
</script>
