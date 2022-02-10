<template>
  <div class="bg-primary bg-opacity-50 py-10 flex flex-col justify-center items-center lg:w-1/2">
    <h1 class="font-francoisOne text-accent text-5xl text-center">
      Gône for coffee
    </h1>
    <h2 class="font-aleo text-accent text-2xl text-center my-3">
      Inscrivez-vous
    </h2>
    <input
      v-model="name"
      v-validate.continues="'required'"
      type="text"
      name="name"
      placeholder="Votre nom"
      class="py-3 pl-2 rounded font-aleo mb-3 w-2/3"
    >
    <span class="text-center my-3 text-red-800 font-bold font-aleo mb-3">{{ errors.first('name') }}</span>
    <input
      v-model="email"
      v-validate.continues="'required|email'"
      type="email"
      name="email"
      placeholder="Email"
      class="py-3 pl-2 rounded font-aleo mb-3 w-2/3"
    >
    <span class="text-center my-3 text-red-800 font-bold font-aleo mb-3">{{ errors.first('email') }}</span>
    <input
      ref="password"
      v-model="password"
      v-validate.continues="'required|min:6'"
      type="password"
      name="password"
      placeholder="Mot de passe"
      class="py-3 pl-2 rounded font-aleo mb-3 w-2/3"
    >
    <span class="text-center my-3 text-red-800 font-bold font-aleo mb-3">{{ errors.first('password') }}</span>
    <input
      v-model="repeat_password"
      v-validate="'required|confirmed:password'"
      type="password"
      name="repeat_password"
      placeholder="Répétez le mot de passe"
      class="py-3 pl-2 rounded font-aleo mb-3 w-2/3"
    >
    <span class="text-center my-3 text-red-800 font-bold font-aleo mb-3">{{ errors.first('repeat_password') }}</span>
    <AccentButton name="S'inscrire" class="py-2" @click.native="signIn" />
    <p v-if="generalError.length > 0" class="text-center my-3 text-red-800 text-xl font-bold font-aleo">
      {{ generalError }}
    </p>
  </div>
</template>

<script>
export default {
  auth: false,
  layout: 'login',
  data () {
    return {
      name: null,
      email: null,
      password: null,
      repeat_password: null,
      generalError: ''
    }
  },
  methods: {
    signIn () {
      this.$validator.validate().then((valid) => {
        if (valid) {
          this.handleSignInSubmit()
        } else {
          this.generalError = 'Vos données ne sont pas valides'
        }
      })
    },
    async handleSignInSubmit () {
      await this.$axios.$post('/api/users',
        {
          name: this.name,
          email: this.email,
          password: this.password
        })
        .then(() => {
          this.$auth.loginWith('local', {
            data: {
              username: this.email,
              password: this.password
            }
          })
            .finally(() => {
              this.$router.push('/')
            })
        })
        .catch((error) => {
          if (error.response.data['hydra:description'].includes('Duplicate entry')) {
            this.generalError = 'Cet utilisateur existe déjà !'
          } else {
            this.generalError = 'Vos données ne sont pas valides'
          }
        })
    }
  }
}
</script>

<style scoped>

</style>
