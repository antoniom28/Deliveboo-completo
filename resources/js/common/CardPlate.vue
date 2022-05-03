<template>
  <div class="card-container">
      <div class="col">
        <div class="m-2 ms_margin d-flex justify-content-between">
          <div class="text" :class="!plate.img ? 'w-100' : null">
            <p class="ms_name_plate">{{plate.name}}</p>
            <!-- <p class="ms_ingredients">{{plate.ingredients}}</p> -->
            <p class="ms_price">{{(plate.price).toFixed(2)}}€</p>
          </div>

          <div v-if="plate.img" class="image">
            <img class="img-class" v-if="plate.img" :src="`../storage/${plate.img}`">
          </div>
        </div>
      </div>
      
  </div>
</template>

<script>
export default {
    name:"CardPlate",
    props:{
        plate: Object
    }
}
</script>

<style lang="scss" scoped>
.card-container{

  .text{
    width: 65%;
    line-height: 2;
  }
}

.ms_name_plate{
  font-weight: bold;
  margin-bottom: 0;
  line-height: 1;
  font-size: 1.1em;
}

.ms_ingredients{
  margin-bottom: 0;
}

.ms_price{
  margin-bottom: 0;
}

.ms_margin{
  padding: 10px;
  background: rgba( 255, 255, 255, 0.9 );
  box-shadow: 0 8px 32px 0 rgba( 31, 38, 135, 0.2 );
  border-radius: 5px;
  height: 100px;
  transition: all 0.7s ease;
  cursor: pointer;
}

.ms_margin:hover{
    transform: scale(.95);
}

.col{
  padding: 0;
}

.image{
  overflow: hidden;
  justify-content: center;
  display: flex;
  width: 35%;

  .img-class{
    width: unset;
    flex-shrink: 0;
    min-height: 100%;
    min-width: 100%;
  }
}




</style>