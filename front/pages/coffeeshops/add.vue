<template>
  <div class="w-full min-h-screen">
    <h1 class="my-6 text-center text-accent text-5xl font-francoisOne font-bold">
      Ajouter un coffee shop
    </h1>
    <CoffeeshopForm ref="coffeeshopForm" :submit="submit" />
  </div>
</template>

<script>
export default {
  middleware: 'auth-admin',
  methods: {
    submit (coffeeshop) {
      this.$axios.$post('/api/coffeeshops',
        {
          name: coffeeshop.name,
          address: coffeeshop.address,
          city: coffeeshop.city,
          postcode: coffeeshop.postcode,
          coordinates: coffeeshop.coordinates,
          description: coffeeshop.description,
          brunch: coffeeshop.brunch,
          sunday: coffeeshop.sunday,
          timetable: coffeeshop.timetable,
          phone: coffeeshop.phone,
          website: coffeeshop.website
        })
        .then((response) => {
          this.$refs.coffeeshopForm.submitImage(response.id)
        })
        .then(() => {
          this.$router.push('/admin')
        })
        .catch(() => {
          this.$toast.error('Something went wrong...')
        })
    }
  }
}
</script>

<style scoped>

</style>
