<template>
<div class="main-container">
  <router-view @add="add" :prevUser="prevUser" :prevOrder="prevOrder" :key="$route.path"></router-view>
</div>
</template>

<script>
export default {
  name: 'Main',
  props:{
    prevOrder: Array,
    prevUser: Object,
  },
  methods:{
    add(tot,user,order){        
        this.$emit('add',tot , user, order);
    },
  },
}
</script>

<style lang="scss" scoped>
</style>