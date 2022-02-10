<template>
  <div v-if="mutatedCoffeeshop" class="w-1/2 mx-auto border-1 border-r border-l border-primary p-10">
    <div class="my-10 flex justify-between">
      <input v-model="mutatedCoffeeshop.name" type="text" class="rounded p-5 text-primary text-xl w-1/3 mx-2 font-aleo" placeholder="Nom">
      <input v-model="mutatedCoffeeshop.website" type="text" class="rounded p-5 text-primary text-xl w-1/3 mx-2 font-aleo" placeholder="Site">
      <input v-model="mutatedCoffeeshop.phone" type="text" class="rounded p-5 text-primary text-xl w-1/3 mx-2 font-aleo" placeholder="Téléphone">
    </div>
    <div class="my-10 flex justify-between">
      <input v-model="mutatedCoffeeshop.address" type="text" class="rounded p-5 text-primary text-xl w-1/3 mx-2 font-aleo" placeholder="Adresse">
      <input v-model="mutatedCoffeeshop.city" type="text" class="rounded p-5 text-primary text-xl w-1/3 mx-2 font-aleo" placeholder="Ville">
      <input v-model="mutatedCoffeeshop.postcode" type="text" class="rounded p-5 text-primary text-xl w-1/3 mx-2 font-aleo" placeholder="Code postal">
    </div>
    <div class="my-10 flex justify-center">
      <input
        v-model="mutatedCoffeeshop.coordinates"
        type="text"
        class="rounded p-5 text-primary text-xl font-aleo mr-6 w-2/3"
        placeholder="Cliquez le bouton pour obtenir les coordonnées"
      >
      <AccentButton name="Générer" @click.native="getCoordinates" />
    </div>
    <div class="my-10">
      <textarea v-model="mutatedCoffeeshop.description" rows="4" class="w-full text-primary p-5 text-xl font-aleo" placeholder="Description" />
    </div>
    <div class="my-10 flex justify-evenly">
      <div>
        <input id="brunch" v-model="mutatedCoffeeshop.brunch" type="checkbox">
        <label for="brunch" class="ml-2 text-primary font-aleo font-bold md:text-xl">Brunch</label>
      </div>
      <div>
        <input id="sunday" v-model="mutatedCoffeeshop.sunday" type="checkbox">
        <label for="brunch" class="ml-2 text-primary font-aleo font-bold md:text-xl">Ouvert le dimanche</label>
      </div>
    </div>
    <div class="my-10 w-2/3 mx-auto">
      <p class="font-francoisOne text-primary text-2xl text-center my-1">
        Horaires d'ouverture
      </p>
      <div>
        <AddTimelineForm v-for="day in daysOfWeek" ref="timetable" :key="day.id" :coffeeshop="mutatedCoffeeshop" :day-name="day.name" :day-id="day.id" />
      </div>
    </div>
    <div class="my-10">
      <p class="font-francoisOne text-primary text-2xl text-center my-1">
        Une image
      </p>
      <div class="grid grid-cols-2">
        <input type="file" class="rounded p-5 text-primary text-xl font-aleo my-auto" @change="processImage($event)">
        <img :src="imagePreviewURL">
      </div>
    </div>
    <div class="my-3 w-1/2 mx-auto flex justify-center">
      <AccentButton name="Sauvegarder" class="py-4" @click.native="handleFormSubmit" />
    </div>
  </div>
</template>

<script>
import { OpenStreetMapProvider } from 'leaflet-geosearch'
export default {
  props: {
    coffeeshop: {
      type: Object,
      default: () =>
        ({
          id: '',
          name: '',
          address: '',
          city: '',
          postcode: '',
          coordinates: [],
          website: '',
          phone: '',
          description: '',
          brunch: false,
          sunday: false,
          ratings: [],
          timetable: []
        })
    },
    submit: {
      type: Function,
      required: true
    }
  },
  data () {
    return {
      mutatedCoffeeshop: this.coffeeshop,
      image: null,
      imagePreviewURL: null,
      daysOfWeek: [
        { name: 'Lundi', id: 1 },
        { name: 'Mardi', id: 2 },
        { name: 'Mercredi', id: 3 },
        { name: 'Jeudi', id: 4 },
        { name: 'Vendredi', id: 5 },
        { name: 'Samedi', id: 6 },
        { name: 'Dimanche', id: 7 }
      ]
    }
  },
  mounted () {
    if (this.mutatedCoffeeshop.image) {
      this.imagePreviewURL = this.$axios.defaults.baseURL + this.mutatedCoffeeshop.image
    }
  },
  methods: {
    handleFormSubmit () {
      this.mutatedCoffeeshop.timetable = this.$refs.timetable.map(function (el) {
        return {
          start: el._data.start,
          end: el._data.end,
          day: '/api/days/' + el._props.dayId
        }
      }).filter(el => el.start != null)
      this.submit(this.mutatedCoffeeshop)
    },
    processImage (event) {
      if (event) {
        this.imagePreviewURL = URL.createObjectURL(event.target.files[0])
        URL.revokeObjectURL(event)
      } else {
        this.imagePreviewURL = null
      }
      this.image = event.target.files[0]
    },
    submitImage (coffeeshopId) {
      if (this.image) {
        const formData = new FormData()
        formData.append('image', this.image)
        this.$axios.$post('/api/coffeeshop/' + coffeeshopId + '/images',
          formData,
          {
            headers: {
              'Content-Type': 'multipart/form-data'
            }
          })
          .catch(() => {
            this.$toast.error('Impossible de télécharger l\'image')
          })
      }
    },
    getCoordinates () {
      const provider = new OpenStreetMapProvider()
      provider.search({ query: this.mutatedCoffeeshop.address + ' ' + this.mutatedCoffeeshop.city })
        .then((result) => {
          this.mutatedCoffeeshop.coordinates = [result[0].y, result[0].x]
        })
        .catch(() => {
          this.$toast.error('Impossible d\'obtenir les coordonnées, vérifiez l\'adresse')
        })
    }
  }
}
</script>

<style scoped>

</style>
