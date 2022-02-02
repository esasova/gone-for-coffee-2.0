<template>
  <footer class="w-full h-16 bg-primary flex justify-center items-center mt-6">
    <nuxt-link to="/" class="text-accent font-francoisOne mx-4 md:text-xl">
      Home
    </nuxt-link>
    <button v-if="$auth.user" class="text-accent font-francoisOne mx-4 md:text-xl" @click="logout">
      Log out
    </button>
    <nuxt-link v-if="!$auth.user" class="text-accent font-francoisOne mx-4 md:text-xl" to="/login">
      Log in
    </nuxt-link>
    <nuxt-link v-if="!$auth.user" class="text-accent font-francoisOne mx-4 md:text-xl" to="/inscription">
      Sign up
    </nuxt-link>
  </footer>
</template>

<script>
export default {
  methods: {
    async logout () {
      await this.$auth.logout()
        .then(() => {
          this.$router.push('/')
        })
    }
  }
}
</script>

<style scoped>

</style>
