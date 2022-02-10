<template>
  <div>
    <div v-if="coffeeshop" class="w-full min-h-screen">
      <h1 class="my-6 text-center text-accent text-5xl font-francoisOne font-bold">
        Modifier le coffee shop {{ coffeeshop.name }}
      </h1>
      <CoffeeshopForm ref="coffeeshopForm" :coffeeshop="coffeeshop" :submit="submit" />
    </div>
    <Loader v-else />
  </div>
</template>

<script>
export default {
  middleware: 'auth-admin',
  data () {
    return {
      coffeeshop: null
    }
  },
  mounted () {
    this.getCoffeeshop()
  },
  methods: {
    async getCoffeeshop () {
      await this.$axios.$get('/api/coffeeshops/' + this.$route.params.id)
        .then((response) => {
          this.coffeeshop = response
        })
    },
    submit (coffeeshop) {
      this.$axios.$put('/api/coffeeshops/' + this.$route.params.id,
        {
          name: coffeeshop.name,
          address: coffeeshop.address,
          city: coffeeshop.city,
          postcode: coffeeshop.postcode,
          coordinates: coffeeshop.coordinates,
          description: coffeeshop.description,
          brunch: coffeeshop.brunch,
          sunday: coffeeshop.sunday,
          timetable: coffeeshop.timetable
        })
        .then((response) => {
          this.$refs.coffeeshopForm.submitImage(response.id)
        })
        .catch((error) => {
          console.log(error)
        })
        .finally(() => {
          this.$router.push('/coffeeshops/' + this.$route.params.id)
        })
    }
  }
}
</script>

<style scoped>

</style>
