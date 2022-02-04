<template>
  <div class="w-full min-h-screen">
    <div class="w-full py-36 bg-no-repeat bg-cover homepage_image text-accent font-francoisOne text-6xl text-center md:text-8xl">
      Gône for coffee
    </div>
    <div class="w-full p-8 bg-primary text-justify font-aleo text-xl text-accent mb-4 md:p-12 md:leading-relaxed lg:text-2xl lg:px-36">
      Combien de fois en cherchant «&nbsp;café lyon&nbsp;», on était déçu parce qu’on tombait
      sur les Starbucks ou endroits « cosy » où on vous propose de déguster un bon cappuccino en poudre
      dans un cadre de jolis coussins et meubles en palettes… Pour être sûrs de votre prochain café,
      confiez-vous à <span class="font-bold">Gône for Coffee</span>, guide des coffee shops de Lyon.
    </div>
    <div class="grid m-3 mt-6 gap-y-6 lg:grid-rows-none lg:gap-2 lg:mb-6 lg:mx-16" :class="searchInProgress ? 'grid-rows-4 lg:grid-cols-5' : 'grid-rows-3 lg:grid-cols-4'">
      <div class="flex justify-center">
        <input v-model="coffeeshop_search" type="text" placeholder="Cherchez un café" class="py-3 pl-2 rounded-lg font-aleo flex-grow">
      </div>
      <div class="flex justify-evenly items-center lg:col-span-2">
        <div>
          <input id="brunch" v-model="brunch" type="checkbox" class="border-primary">
          <label for="brunch" class="ml-2 text-primary font-aleo font-bold md:text-xl">Brunch</label>
        </div>
        <div>
          <input id="sunday" v-model="sunday" type="checkbox" class="border-primary">
          <label for="sunday" class="ml-2 text-primary font-aleo font-bold md:text-xl">Ouvert le dimanche</label>
        </div>
      </div>
      <AccentButton name="Chercher" @click.native="searchCoffeeshops" />
      <AccentButton v-if="searchInProgress" name="Tous les coffeeshops" @click.native="getCoffeeshops" />
    </div>
    <section v-if="coffeeshops" class="m-3 grid grid-cols-1 gap-6 md:grid-cols-2 lg:grid-cols-3 lg:mx-16">
      <CoffeeShopCard v-for="coffeeShop in coffeeshops" :key="coffeeShop.id" :coffeeshop="coffeeShop" />
    </section>
    <section v-if="coffeeshops && coffeeshops.length < 1" class="h-full text-center font-bold font-aleo text-primary text-xl m-3 lg:text-3xl">
      <div>Malheureusement, il n'y a pas de coffeshops qui correspondent à vos filtres</div>
    </section>
  </div>
</template>

<script>
export default {
  auth: false,
  data () {
    return {
      coffeeshops: null,
      coffeeshop_search: '',
      brunch: null,
      sunday: null,
      searchInProgress: false
    }
  },
  mounted () {
    this.getCoffeeshops()
    console.log(this.$auth.user)
  },
  methods: {
    async getCoffeeshops () {
      await this.$axios.$get('/api/coffeeshops.json')
        .then((response) => {
          this.coffeeshops = response
        })
        .finally(() => {
          this.searchInProgress = false
          this.coffeeshop_search = ''
        })
    },
    searchCoffeeshops () {
      this.$axios.$get('/api/coffeeshops.json?name=',
        {
          params: {
            name: this.coffeeshop_search,
            sunday: this.sunday ? this.sunday : null,
            brunch: this.brunch ? this.brunch : null
          }
        })
        .then((response) => {
          this.coffeeshops = response
        })
        .finally(() => {
          this.searchInProgress = true
        })
    }
  }
}
</script>
