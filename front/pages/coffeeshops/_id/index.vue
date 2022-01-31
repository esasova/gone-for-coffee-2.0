<template>
  <div v-if="coffeeshop" class="w-full min-h-screen grid grid-cols-1 lg:grid-rows-none lg:grid-cols-2 lg:gap-2.5">
    <img src="~/assets/images/coffeeshop_placeholder.jpg" class="order-first">
    <div class="flex justify-center items-center font-francoisOne text-primary text-3xl text-center my-5 md:text-5xl lg:order-3" data-test="coffeeshop_detail_name">
      {{ coffeeshop.name }}
    </div>
    <div class="flex flex-col justify-center items-center bg-accent p-5 font-aleo text-primary text-justify leading-relaxed my-3 md:text-2xl lg:order-5">
      {{ coffeeshop.description }}
      <div class="flex justify-center my-4 text-primary text-4xl">
        <FontAwesomeIcon v-show="coffeeshop.brunch" :icon="['fas', 'utensils']" class="mx-2" />
        <FontAwesomeIcon v-show="coffeeshop.sunday" :icon="['fas', 'sun']" class="mx-2" />
      </div>
    </div>
    <div class="bg-primary font-aleo p-5 my-3 text-accent font-bold text-center md:text-2xl lg:order-4">
      <p>{{ coffeeshop.address }} {{ coffeeshop.postcode }} {{ coffeeshop.city }}</p>
      <p>{{ coffeeshop.phone }}</p>
      <p>{{ coffeeshop.website }}</p>
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
            {{ $dayjs(timeline.start).format('HH:hh') }}
          </td>
          <td class="p-2">
            {{ $dayjs(timeline.end).format('HH:hh') }}
          </td>
        </tr>
      </table>
    </div>
    <div class="lg:order-2">
      <l-map :zoom="17" :center="coffeeshop.coordinates" style="height:100%">
        <l-tile-layer :z-index="0" url="https://{s}.tile.osm.org/{z}/{x}/{y}.png" :attribution="attribution" />
        <l-marker :lat-lng="coffeeshop.coordinates" />
      </l-map>
    </div>
  </div>
</template>

<script>
export default {
  data () {
    return {
      coffeeshop: null,
      attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
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
      this.$axios.$get('http://127.0.0.1:8000/api/coffeeshops/' + this.$route.params.id)
        .then((response) => {
          this.coffeeshop = response
        })
    }
  }
}
</script>

<style scoped>

</style>
