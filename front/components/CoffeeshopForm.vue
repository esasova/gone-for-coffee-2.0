<template>
  <div v-if="mutatedCoffeeshop" class="w-1/2 mx-auto border-1 border-r border-l border-primary p-10">
    <div class="flex justify-center my-3">
      <input v-model="mutatedCoffeeshop.name" type="text" class="my-3 rounded p-5 text-primary text-xl font-aleo">
    </div>
    <div class="my-3 flex justify-between">
      <input v-model="mutatedCoffeeshop.address" type="text" class="rounded p-5 text-primary text-xl w-1/3 font-aleo">
      <input v-model="mutatedCoffeeshop.city" type="text" class="rounded p-5 text-primary text-xl w-1/4 font-aleo">
      <input v-model="mutatedCoffeeshop.postcode" type="text" class="rounded p-5 text-primary text-xl w-1/4 font-aleo">
    </div>
    <div class="my-10 flex justify-center">
      <input
        v-model="mutatedCoffeeshop.coordinates"
        type="text"
        class="rounded p-5 text-primary text-xl font-aleo mr-6 w-2/3"
        placeholder="Cliquez le bouton pour obtenir les coordonnées"
      >
      <AccentButton name="Générer" :action="handleFormSubmit" />
    </div>
    <div class="my-10">
      <textarea v-model="mutatedCoffeeshop.description" rows="4" class="w-full text-primary p-5 text-xl font-aleo" />
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
      <AccentButton name="Sauvegarder" :action="handleFormSubmit" class="py-4" />
    </div>
  </div>
</template>

<script>
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
      const tempTable = []
      for (const el of this.$refs.timetable) {
        const timeline = {}
        timeline.start = el._data.start
        timeline.end = el._data.end
        timeline.day = '/api/days/' + el._props.dayId
        tempTable.push(timeline)
      }
      this.mutatedCoffeeshop.timetable = tempTable.filter(el => el.start != null)
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
      console.log(this.image)
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
          .catch((error) => {
            console.log(error)
          })
      }
    }
  }
}
</script>

<style scoped>

</style>
