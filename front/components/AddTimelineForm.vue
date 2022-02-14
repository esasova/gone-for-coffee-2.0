<template>
  <div v-if="coffeeshop" class="w-full grid grid-cols-3 my-2">
    <p class="text-xl text-primary font-aleo my-auto">
      {{ dayName }}
    </p>
    <input v-model="start" class="rounded p-2 mx-3" type="time" step="1800">
    <input v-model="end" class="rounded p-2 mx-3" type="time" step="1800">
  </div>
</template>

<script>
export default {
  props: {
    dayName: {
      type: String,
      required: true
    },
    dayId: {
      type: Number,
      required: true
    },
    coffeeshop: {
      type: Object,
      required: true
    }
  },
  data () {
    return {
      start: this.coffeeshop.timetable.some(tl => tl.day.id === this.dayId) ? this.$dayjs(this.coffeeshop.timetable.find(tl => tl.day.id === this.dayId).start).tz('Europe/London', true).format('HH:mm:ss') : null,
      end: this.coffeeshop.timetable.some(tl => tl.day.id === this.dayId) ? this.$dayjs(this.coffeeshop.timetable.find(tl => tl.day.id === this.dayId).end).tz('Europe/London', true).format('HH:mm:ss') : null
    }
  },
  methods: {
    changeValue (value) {
      this.$emit('change', value)
    }
  }
}
</script>

<style scoped>

</style>
