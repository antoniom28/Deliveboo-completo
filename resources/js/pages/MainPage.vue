<template>
  <div v-if="loadAxios == 2" class="main-container">

      <div class="d-lg-none">
        <div v-if="!showTypes" @click="showTypes = true" class="button-open-types">
          <i class="fa-solid fa-utensils"></i>
        </div>
        <div @click="showTypes = false" v-show="showTypes" class="hidden-close-sub create"></div>   
        <TypeBox v-if="showTypes" @searchType="searchType" :address="address" :typesArr="typesArr" />
      </div>

      <div class="d-none d-lg-block">
        <TypeBox @searchType="searchType" :address="address" :typesArr="typesArr" />
      </div>

      <div class="users-box">
        <div class="header-users-box">
          <div class="checked-types">
            <div class="type" v-for="(type,index) in checkedType" :key="'checked'+index">
              {{type.name}} 
              <i @click="removeType(type.id)" class="fa-solid fa-xmark"></i>
            </div>
          </div>
      </div>
      
        <div class="fluid-container main-users-box w-100 flex-wrap d-flex" v-if="usersArr.length > 0" >
          <h3 v-if="ratedUsers && ratedUsers.length > 0" class="w-100">
            <strong>In primo piano</strong>
          </h3>
          <span class="w-100" v-if="ratedUsers && ratedUsers.length > 0">Spazi pagati dai nostri partner</span>
          
          <div class="rated-users row w-80-xs row-cols-1 row-cols-sm-2 row-cols-lg-3 row-cols-xxl-4">
            <div v-for="(user,index) in ratedUsers" :key="'users'+index" class="col user not-main mt-3">
              <router-link class="link-card" :to="{name : 'CardUser' , params:{activity:user.activity,user:user} }">
                <Card :user="user"/>
              </router-link>
            </div>
          </div>


          <h3 v-if="newUsers && newUsers.length > 0" class="w-100 mt-5">
            <strong>Nuovi su Deliveboo</strong>
          </h3>
          <div class="new-users row w-80-xs row-cols-1 row-cols-sm-2 row-cols-lg-3 row-cols-xxl-4">
            <div v-for="(user,index) in newUsers" :key="'newUsers'+index" class="col user not-main mt-3">
              <router-link class="link-card" :to="{name : 'CardUser' , params:{activity:user.activity,user:user} }">
                <Card :user="user"/>
              </router-link>
            </div>
          </div>

          <h3 v-if="checkedType && checkedType.length > 0" class="w-100 mt-5">
            <strong>Ristoranti</strong>
          </h3>
          <div v-if="checkedType && checkedType.length > 0" class="w-100 all-users row w-80-xs row-cols-1 row-cols-sm-2 row-cols-lg-3 row-cols-xxl-4">
            <div v-for="(user,index) in usersArr" :key="'usersArr'+index" class="col user mt-3">
              <router-link class="link-card" :to="{name : 'CardUser' , params:{activity:user.activity,user:user} }">
                <Card :noBorder="true" :user="user"/>
              </router-link>
            </div>
          </div>
        </div>

        <div v-else-if="empty" class="users-box">
          Non ci sono ristoranti con queste categorie!
        </div>
      </div>
  </div>

  <div v-else class="main-container">
    <Preloader/>
  </div>
</template>

<script>
import Card from "../common/Card.vue";
import TypeBox from '../common/TypeBox.vue';
import Preloader from '../components/Preloader.vue';

export default {
    name:"MainPage",
    data(){
      return{
        address: null,
        showTypes: false,
        urlAllUsers : '../api/users',
        usersArr: [],
        ratedUsers: [],
        newUsers: [],
      
        urlAllTypes : '../api/allTypes',
        typesArr : [],

        checkedType: [],
        empty: false,
        loadAxios: 0,
      }
    },
    created(){
      console.log(this.$route.params.address);
      if(!this.$route.params.address)
        this.$router.push({
          name:"home",
        });
      
      this.address = this.$route.params.address;
      this.loadAxios = 0;
      this.getAllUsers();
      this.getAllTypes();
    },
    methods:{
      getAllUsers(){
        if(this.typesArr && this.typesArr.length > 0)
          this.loadAxios = 1;
        else  
          this.loadAxios = 0;
          
        axios.get(this.urlAllUsers)
          .then((response) => {
        // handle success
          this.usersArr.push(...response.data.users);
          this.newUsers.push(...response.data.newUsers);
          this.ratedUsers.push(...response.data.ratedUsers);
          console.log(this.usersArr);
          setTimeout(() => {
            this.loadAxios++;
          }, 500);
        })
        .catch(function (error) {
          // handle error
          console.log(error);
        });
      },
      getAllTypes(){
        axios.get(this.urlAllTypes)
          .then((response) => {
        // handle success
          this.typesArr.push (...response.data);
          console.log(this.typesArr);
           setTimeout(() => {
            this.loadAxios++;
          }, 500);
        })
        .catch(function (error) {
          // handle error
          console.log(error);
        });
      },
      searchType(check){
        if(check)
          this.checkedType = check;
        console.log(this.checkedType,'new2',check);
        this.empty = false;
        this.usersArr = [];
        this.ratedUsers = [];
        this.newUsers = [];
        if(this.checkedType.length <= 0){
          this.getAllUsers();
          return;
        }
        let onlyTypeId = [];
        for(let i=0; i<this.checkedType.length; i++)
          onlyTypeId.push(this.checkedType[i].id);

console.log(onlyTypeId,'test da rimuovere');
        axios.get(`../api/types/${onlyTypeId}`)
          .then((response) => {
        // handle success
          this.usersArr.push(...response.data);
          console.log(response.data,'qua PAPEE');
          this.empty = true;
        })
        .catch(function (error) {
          // handle error
          console.log(error);
        });
      },
      removeType(id){
        console.log(this.checkedType,id);
        for(let i=0; i<this.checkedType.length; i++){
          if(this.checkedType[i].id == id)
            this.checkedType.splice(i,1);
        }
        this.searchType();
      }
    },
    components:{
      Card,
      Preloader,
        TypeBox
    }

}
</script>

<style lang="scss" scoped>
@import '../../sass/front.scss';
.main-users-box{
  flex-direction: column;
  justify-content: center;
  align-items: center;

  .user{
    width: 80%;
    height: 300px;
    display: flex;
    justify-content: center;

    a{
      width: 100%;
    }
  }
}

@media screen and (max-width: 576px){
  .main-users-box{
      text-align: center;
  }
}

@media screen and (min-width: 576px) {
  .main-users-box{
    flex-direction: row;
    padding: 0 2rem;
    //justify-content: flex-start;
    align-items: unset;

    /*.user{
      //width: 45%;

      &.not-main{
       // max-width: 265px!important;
      }
    }*/
  } 
}

.button-open-types{
  position: fixed;
  bottom: 15px;
  right: 10px;
  height: 50px;
  z-index: 9999;
  opacity: 0.85;
  display: flex;
  width: 50px;
  font-size: 1.9em;
  background-color: $primary_color;
  justify-content: center;
  border-radius: 50%;
  align-items: center;

  &:hover{
    opacity: 1;
  }
}

.hidden-close-sub{
  position: fixed;
  top: 0;
  left: 0;
  height: 100%;
  width: 100%;
}

.hidden-close-sub.create{
  z-index: 9998;
  background-color: rgba(0, 0, 0, 0.5);
}

.w-80{
  width: 80%!important;
}

.link-card{
  text-decoration: none!important;
}

.main-container{
  padding: 45px 0;
  width: 100%;
  height: 100vh;
  display: flex;
}

.users-box{
  width: 100%;
  overflow-y: auto;
}

  .checked-types{
    width: 100%;
    display: flex;
    justify-content: flex-start;
    flex-wrap: wrap;
    margin-bottom: 15px;

    .type{
      padding: 4px 8px 4px 12px;
      background-color: $primary-color;
      color: white;
      font-weight: bold;
      display: flex;
      align-items: center;

      .fa-xmark{
        font-size: 1.2em;

        &:hover{
          cursor: pointer;
          transform: scale(1.1);
        }
      }
    }

    & *{
      margin: 5px 10px;
    }
  }
  /*.button-open-types{
  position: fixed;
  bottom: 0;
  right: 0;
  height: 35px;
  z-index: 9999;
  display: flex;
  width: 35px;
  font-size: 1.9em;
  background-color: $primary_color;
  justify-content: center;
  border-radius: 50%;
  align-items: center;
}

.hidden-close-sub{
  position: fixed;
  top: 0;
  left: 0;
  height: 100%;
  width: 100%;
}

.hidden-close-sub.create{
  z-index: 9998;
  background-color: rgba(0, 0, 0, 0.5);
}

.w-80{
  width: 80%!important;
}

.link-card{
  text-decoration: none!important;
}

.main-container{
  padding: 45px 0;
  width: 100%;
  display: flex;
}

.users-box{
  width: 100%;
}

  .checked-types{
    width: 100%;
    display: flex;
    justify-content: flex-start;
    flex-wrap: wrap;
    margin-bottom: 15px;

    .type{
      padding: 4px 8px 4px 12px;
      background-color: $primary-color;
      color: white;
      font-weight: bold;
      display: flex;
      align-items: center;

      .fa-xmark{
        font-size: 1.2em;

        &:hover{
          cursor: pointer;
          transform: scale(1.1);
        }
      }
    }

    & *{
      margin: 5px 10px;
    }
  }*/
</style>