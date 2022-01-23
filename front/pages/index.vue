<template>
  <div class="font-aleo text-4xl bg-secondary text-primary">
    My future homepage
    <p class="font-francoisOne text-2xl text-accent">
      Fonts and colors test
    </p>
  </div>
</template>

<script>
export default {
  mounted () {
    this.$axios.$get('http://127.0.0.1:8000/api/coffeeshops.json')
      .then((response) => {
        console.log(response)
      })
  }
}
</script>
