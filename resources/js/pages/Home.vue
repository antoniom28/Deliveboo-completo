<template>
<div class="home">
    <HomeTop />
    <HomeDown />
</div>
</template>

<script>
import HomeDown from '../common/HomeDown.vue'
import HomeTop from '../common/HomeTop.vue'
export default {
    name:"Home",
    components: { HomeTop, HomeDown },
}
</script>

<style lang="scss" scoped>

</style>