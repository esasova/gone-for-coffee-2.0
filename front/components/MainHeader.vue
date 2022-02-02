<template>
  <header class="w-full h-16 bg-primary flex justify-between items-center px-3">
    <nuxt-link to="/" class="text-accent text-4xl">
      <FontAwesomeIcon :icon="['fas', 'coffee']" />
    </nuxt-link>
    <p v-if="$auth.user" class="text-accent font-francoisOne mx-4 md:text-xl">
      Bienvenue, {{ $auth.user.name }}
    </p>
    <nuxt-link v-if="$auth.user && $auth.user.roles.includes('ROLE_ADMIN')" to="/admin" class="text-accent font-francoisOne mx-4 md:text-xl">
      Espace admin
    </nuxt-link>
    <button v-if="$auth.user" class="text-accent font-francoisOne mx-4 md:text-xl" @click="logout">
      Log out
    </button>
    <div v-else class="flex">
      <nuxt-link class="text-accent font-francoisOne mx-4 md:text-xl" to="/login">
        Log in
      </nuxt-link>
      <nuxt-link class="text-accent font-francoisOne mx-4 md:text-xl" to="/inscription">
        Sign up
      </nuxt-link>
    </div>
  </header>
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
