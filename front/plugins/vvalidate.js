import Vue from 'vue'
import VeeValidate, { Validator } from 'vee-validate'
import fr from 'vee-validate/dist/locale/fr'

Vue.use(VeeValidate, {
  events: 'change'
})
Validator.localize('fr', fr)
