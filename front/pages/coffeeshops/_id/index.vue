<template>
  <div>
    <div v-if="coffeeshop" class="w-full min-h-screen grid grid-cols-1 lg:grid-rows-none lg:grid-cols-2 lg:gap-2.5 px-10">
      <div :style="coffeeshop.image ? `backgroundImage: url(${$axios.defaults.baseURL}${coffeeshop.image})` : `backgroundImage: url(${require(`~/assets/images/coffeeshop_placeholder.jpg`)}`" class="order-first h-64 md:h-80 lg:h-88 xl:h-160 bg-cover bg-center bg-no-repeat" />
      <div class="flex flex-col justify-center items-center font-francoisOne text-primary text-3xl text-center my-5 md:text-5xl lg:order-3" data-test="coffeeshop_detail_name">
        {{ coffeeshop.name }}
        <div class="flex justify-center mt-3">
          <i v-for="i in 5" :key="i" class="fa fas fa-coffee" :class="i <= coffeeshopRating ? 'text-accent' : 'text-gray-500'" />
        </div>
        <div v-if="$auth.user && alreadyRated" class="text-center font-francoisOne text-primary mb-2 text-base cursor-pointer" @click="changeRating">
          Changer ma note
        </div>
        <div v-if="$auth.user && !alreadyRated" class="mt-3">
          <p class="text-center font-francoisOne text-primary mb-2 text-base">
            Noter le coffee shop
          </p>
          <i v-for="i in 5" :key="i" class="fa fas fa-coffee text-gray-500 cursor-pointer hover:text-accent" @click="rateCoffeeshop(i)" />
        </div>
        <div v-if="ratingThanks" class="text-center font-francoisOne text-primary mb-2 text-base">
          Merci !
        </div>
      </div>
      <div class="flex flex-col justify-center items-center bg-accent p-5 font-aleo text-primary text-justify leading-relaxed my-3 md:text-2xl lg:order-5">
        {{ coffeeshop.description }}
        <div class="flex justify-center my-4 text-primary text-4xl">
          <i v-show="coffeeshop.brunch" class="fa fas fa-utensils mx-2" />
          <i v-show="coffeeshop.sunday" class="mx-2 fa fas fa-sun" />
        </div>
      </div>
      <div class="bg-primary font-aleo p-5 my-3 text-accent font-bold text-center md:text-2xl lg:order-4">
        <p>{{ coffeeshop.address }} {{ coffeeshop.postcode }} {{ coffeeshop.city }}</p>
        <p>{{ coffeeshop.phone }}</p>
        <a :href="coffeeshop.website">{{ coffeeshop.website }}</a>
      </div>
      <div class="bg-accent font-aleo p-5 my-3 text-primary md:text-2xl order-last lg:order-5">
        <p class="font-francoisOne text-xl md:text-3xl text-center">
          Horaires d'ouverture
        </p>
        <table class="mx-auto">
          <tr v-for="timeline in coffeeshop.timetable" :key="timeline.id" class="border-b border-primary">
            <td class="p-2">
              {{ timeline.day.name }}
            </td>
            <td class="p-2">
              {{ $dayjs.tz(timeline.start).format('HH:mm') }}
            </td>
            <td class="p-2">
              {{ $dayjs.tz(timeline.end).format('HH:mm') }}
            </td>
          </tr>
        </table>
      </div>
      <div class="lg:order-2 h-64 lg:h-88 xl:h-160">
        <l-map :zoom="17" :center="coffeeshop.coordinates" style="height: 100%">
          <l-tile-layer :z-index="0" url="https://{s}.tile.osm.org/{z}/{x}/{y}.png" :attribution="attribution" />
          <l-marker :lat-lng="coffeeshop.coordinates" />
        </l-map>
      </div>
    </div>
    <Loader v-else />
  </div>
</template>

<script>
export default {
  auth: false,
  data () {
    return {
      coffeeshop: null,
      attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors',
      ratingThanks: false
    }
  },
  computed: {
    coffeeshopRating () {
      return Math.ceil(this.coffeeshop.ratings.map(el => el.rating).reduce((p, c) => p + c, 0) / this.coffeeshop.ratings.length)
    },
    alreadyRated () {
      return this.coffeeshop ? this.coffeeshop.ratings.some(el => el.user.id === this.$auth.user.id) : false
    }
  },
  mounted () {
    this.getCoffeeshop()
    setTimeout(function () {
      window.dispatchEvent(new Event('resize'))
    }, 1000)
  },
  methods: {
    getCoffeeshop () {
      this.$axios.$get('/api/coffeeshops/' + this.$route.params.id)
        .then((response) => {
          this.coffeeshop = response
        })
    },
    rateCoffeeshop (rating) {
      this.$axios.$post('/api/ratings',
        {
          rating,
          user: '/api/users/' + this.$auth.user.id,
          coffeeshop: '/api/coffeeshops/' + this.coffeeshop.id
        })
        .then(() => {
          this.getCoffeeshop()
          this.ratingThanks = true
        })
        .catch(() => {
          this.$toast.error('Désolée, impossible d\'ajouter votre note')
        })
    },
    changeRating () {
      this.$axios.$delete('/api/ratings/' + this.coffeeshop.ratings.find(el => el.user.id === this.$auth.user.id).id)
        .then(() => {
          this.getCoffeeshop()
        })
    }
  }
}
</script>
