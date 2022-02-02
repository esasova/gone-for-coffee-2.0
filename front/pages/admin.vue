<template>
  <div class="w-full min-h-screen relative">
    <h1 class="my-6 text-center text-accent text-5xl font-francoisOne font-bold">
      Tous les coffee shops
    </h1>
    <div class="w-full px-12">
      <table class="w-full">
        <tr class="p-2 bg-primary px-12 text-2xl">
          <th class="p-2 text-center font-aleo text-accent font-bold">
            Nom
          </th>
          <th class="p-2 text-center font-aleo text-accent font-bold">
            Adresse
          </th>
          <th class="p-2 text-center font-aleo text-accent font-bold">
            Actions
          </th>
        </tr>
        <tr v-for="coffeeshop in coffeeshops" :key="coffeeshop.id" class="px-12 text-xl">
          <td class="py-4 text-center font-aleo font-bold text-primary border-b border-primary">
            <nuxt-link :to="`coffeeshops/${coffeeshop.id}`">
              {{ coffeeshop.name }}
            </nuxt-link>
          </td>
          <td class="py-4 text-center font-aleo text-primary border-b border-primary">
            {{ coffeeshop.address }} {{ coffeeshop.postcode }} {{ coffeeshop.city }}
          </td>
          <td class="py-4 text-center font-aleo text-primary border-b border-primary flex justify-center">
            <nuxt-link :to="`coffeeshops/${coffeeshop.id}/edit`">
              <PrimaryRoundButton icon-name="pencil-alt" />
            </nuxt-link>
            <PrimaryRoundButton icon-name="trash" />
          </td>
        </tr>
      </table>
    </div>
  </div>
</template>

<script>

export default {
  middleware: 'auth-admin',
  data () {
    return {
      coffeeshops: null
    }
  },
  mounted () {
    this.getCoffeeshops()
  },
  methods: {
    async getCoffeeshops () {
      await this.$axios.$get('/api/coffeeshops.json')
        .then((response) => {
          this.coffeeshops = response
        })
        .finally(() => {
          console.log(this.coffeeshops)
        })
    },
    deleteCoffeeshop (coffeeshopId) {
      this.$axios.$delete('/api/coffeeshops/' + coffeeshopId)
        .then(() => {
          this.validateDelete = false
        })
    }
  }
}
</script>

<style scoped>

</style>
