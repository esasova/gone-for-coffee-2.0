<template>
  <div>
    <input v-model="username" name="username" placeholder="Email">
    <input v-model="psw" name="username" placeholder="Email">
    <button type="submit" @click="login">
      Log in
    </button>
  </div>
</template>

<script>
export default {
  data () {
    return {
      username: null,
      psw: null
    }
  },
  methods: {
    async login () {
      try {
        await this.$auth.loginWith('local', {
          data: {
            username: this.username,
            password: this.psw
          }
        })
          .then((resp) => {
            if (this.$auth.user.roles.includes('ROLE_ADMIN')) {
              this.$router.push('/coffeeshops/1')
            } else {
              this.$router.push('/')
            }
          })
      } catch (error) {
        if (error.response.status === 401) {
          this.invalidCred = true
        } else {
          this.unexpectedError = true
        }
      }
    }
  }
}
</script>

<style scoped>

</style>
