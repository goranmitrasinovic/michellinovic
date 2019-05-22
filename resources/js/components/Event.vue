<template>
    <div>
    <v-text-field v-model="event.sport" label="sport"></v-text-field>
</div>
</template>

<script>
export default {
    name: "Event",
    props: ["event"],


}
</script>

<style lang="css" scoped>
</style>
