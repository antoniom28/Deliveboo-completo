<template>
      <div :class="noBorder ? 'no-border' : null" class="card d-flex flex-column">
          <div class="bg_image">
              <img v-if="user.img" :src="`../storage/${user.img}`">
              <img v-else :src="require(`../../../public/img/${user.id}.jpg`)">
          </div>
          <div class="card_name d-flex">
              <span>{{user.activity}}</span>
          </div>
          <div class="card_mail">
              <span>{{user.email}}</span>
          </div>
          <ul class="p-0 types d-flex flex-wrap w-100">
              <li v-for="(type,index) in user.types" :key="'type'+index" class="type">
                  {{type.name}}
                  <span v-if="index != user.types.length - 1" span> · </span>
             </li> 
          </ul>
      </div>
</template>

<script>
export default {
    name:"Card",
    props:{
        user: Object,
        types : Array,
        noBorder: Boolean,
    }
}
</script>

<style lang="scss" scoped>
@import "../../sass/variables.scss";

    .card{
        text-decoration: none;
        color: $dark-color;
        width: 100%;
        height: 100%;
        border-radius: 15px;

        &.no-border{
            border: unset!important;
        }

        &:hover{
            text-decoration: none;
        }
        .bg_image{
            width: 100%;
            overflow: hidden;
            max-height: 160px;
            display: flex;
            justify-content: center;
            
            img{
                width: 100%;
                //border-radius: 15px 15px 0px 0px;
            }
        }

        .card_name{
            span{
                color: $third-color;
                padding: 0 5px;
                margin: 5px;
                text-transform: uppercase;
                font-weight:bold ;
            }


        }
        .card_mail{
            width: auto;
            word-wrap: none;
            span{
                font-style: italic;
                margin: 10px;
                border-radius: 25px;
                color: #00B8A9;
            };

    }
    .types{
        margin: 5px;
        list-style: none;
        .type{
                color: $dark-color;
                margin: 0 5px;
                border-radius: 25px;

                span{
                    font-weight: bold;
                }
            }
    }
    

}
</style>