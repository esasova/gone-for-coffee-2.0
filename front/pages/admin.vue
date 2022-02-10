<template>
  <div class="w-full min-h-screen relative">
    <div class="flex justify-end">
      <nuxt-link to="/coffeeshops/add" class="rounded bg-primary text-accent font-francoisOne font-bold text-xl text-center p-3 m-3">
        Ajouter
      </nuxt-link>
    </div>
    <div class="my-6 text-center text-accent text-5xl font-francoisOne font-bold">
      <h1>Tous les coffee shops</h1>
    </div>
    <div class="w-full px-12">
      <table v-if="coffeeshops" class="w-full">
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
            <ConfirmationPopup :confirm="() => deleteCoffeeshop(coffeeshop.id)" />
          </td>
        </tr>
      </table>
      <Loader v-else />
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
    },
    deleteCoffeeshop (coffeeshopId) {
      this.$axios.$delete('/api/coffeeshops/' + coffeeshopId)
        .then(() => {
          this.getCoffeeshops()
        })
    }
  }
}
</script>

<style scoped>

</style>
