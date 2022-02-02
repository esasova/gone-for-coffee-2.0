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
  methods: {
    submit (coffeeshop) {
      this.$axios.$post('/api/coffeeshops',
        {
          name: coffeeshop.name,
          address: coffeeshop.address,
          city: coffeeshop.city,
          postcode: coffeeshop.postcode,
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
          this.$router.push('/admin')
        })
    }
  }
}
</script>

<style scoped>

</style>
