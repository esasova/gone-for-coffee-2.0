<template>
  <div class="bg-primary bg-opacity-50 py-10 flex flex-col justify-center items-center lg:w-1/2 lg:h-2/3">
    <h1 class="font-francoisOne text-accent text-5xl text-center">
      Gône for coffee
    </h1>
    <h2 class="font-aleo text-accent text-2xl text-center my-3">
      Connectez-vous
    </h2>
    <input v-model="username" v-validate.continues="'required|email'" name="email" placeholder="Email" class="py-3 pl-2 rounded font-aleo w-2/3">
    <span class="text-center my-3 text-red-800 font-bold font-aleo mb-3">{{ errors.first('email') }}</span>
    <input v-model="password" v-validate.continues="'required'" type="password" name="password" placeholder="Mot de passe" class="py-3 pl-2 rounded font-aleo mb-3 w-2/3">
    <span class="text-center my-3 text-red-800 font-bold font-aleo mb-3">{{ errors.first('password') }}</span>
    <AccentButton name="Se connecter" :action="login" class="py-2" />
    <p v-if="generalError.length > 0" class="text-center my-3 text-red-800 text-xl font-bold font-aleo">
      {{ generalError }}
    </p>
    <p class="mt-4 font-francoisOne text-xl text-accent">
      Première fois sur le site ? <nuxt-link to="/inscription" class="font-francoisOne text-xl text-accent font-bold">
        Inscrivez-vous !
      </nuxt-link>
    </p>
  </div>
</template>

<script>
export default {
  auth: false,
  layout: 'login',
  data () {
    return {
      username: null,
      password: null,
      generalError: ''
    }
  },
  methods: {
    login () {
      this.$validator.validate().then((valid) => {
        if (valid) {
          this.handleLoginSubmit()
        } else {
          this.generalError = 'Vos données ne sont pas valides'
        }
      })
    },
    async handleLoginSubmit () {
      try {
        await this.$auth.loginWith('local', {
          data: {
            username: this.username,
            password: this.password
          }
        }).then((resp) => {
          if (this.$auth.user.roles.includes('ROLE_ADMIN')) {
            this.$router.push('/admin')
          } else {
            this.$router.push('/')
          }
        })
      } catch (error) {
        if (error.response.status === 401) {
          this.generalError = 'Mauvais identifiants'
          console.log(error)
        } else {
          this.generalError = 'Quelque chose s\'est mal passé...'
        }
      }
    }
  }
}
</script>

<style scoped>

</style>
