<template>
  <div v-if="!payloading" class="pay-container">
      <div v-if="tot" class="pay-box">
        <div class="container mt-3">
          <div class="row">
            <div class="col-12 col-lg-8">
              <h1 class="text-light">Stai ordinando da : {{user.activity}}</h1>
              <p class="text-light">Inserisci i dati per la consegna</p>
              <!-- Box form -->
              <div class="form-edit-box" :class="(!waitToken && formComplete) ? 'form-complete' : null">    
                <div class="main-box">
                  <div v-if="!formComplete" class="main-form-box">
                      <div class="form-group">
                          <label for="name">Nome</label>
                          <input :disabled="formComplete" v-model="name" type="text" class="form-control" id="name" name="name" placeholder="Nome">
                          <div v-if="!validation.name.success" class="alert alert-danger">
                            {{validation.name.message}}
                          </div>
                      </div>

                      <div class="form-group">
                          <label for="surname">Cognome</label>
                          <input :disabled="formComplete" v-model="surname" type="text" class="form-control" id="surname" name="surname" placeholder="Cognome">
                          <div v-if="!validation.surname.success" class="alert alert-danger">
                            {{validation.surname.message}}
                          </div>
                      </div>

                      <div class="form-group">
                          <label for="email">Email</label>
                          <input :disabled="formComplete" v-model="email" id="email" type="email" class="form-control" name="email" placeholder="Inserisci Email">
                          <div v-if="!validation.email.success" class="alert alert-danger">
                            {{validation.email.message}}
                          </div>
                      </div>

                      <div class="form-group">
                          <label for="phone">Telefono</label>
                          <input :disabled="formComplete" v-model="phone" id="phone" type="text" class="form-control" name="phone" placeholder="Inserisci numero di telefono">
                          <div v-if="!validation.phone.success" class="alert alert-danger">
                            {{validation.phone.message}}
                          </div>
                      </div>

                      <div class="form-group">
                          <label for="address">Indirizzo</label>
                          <input :disabled="formComplete" v-model="address" id="address" type="text" class="form-control" name="address" placeholder="Inserisci indirizzo per il recapito">
                          <div v-if="!validation.address.success" class="alert alert-danger">
                            {{validation.address.message}}
                          </div>
                      </div>
                  </div>

                  <div class="form-is-complete d-flex flex-column" v-else-if="!waitToken">
                    <div> <h4>Nome</h4> : {{this.formData.name}}</div>
                    <div> <h4>Cognome</h4> : {{this.formData.surname}}</div>
                    <div> <h4>Email</h4> : {{this.formData.email}}</div>
                    <div> <h4>Telefono</h4> : {{this.formData.phone}}</div>
                    <div> <h4>Indirizzo</h4> : {{this.formData.address}}</div>
                  </div>
                </div>
              </div>
              <!-- Box pagamento BrainTree-->
              <div v-if="formComplete" class="form-is-complete" :class="waitToken ? 'token-not-ready' : null">
                <Paybox @tokenReady="waitToken = false" @payload="payload" :tot="tot" :user="user" :cart="cart" v-show="!waitToken" :formData="formData" @payed="isPayed()"/>
                <div v-if="waitToken" class="d-flex wait-token align-items-center">
                  <h2>CONTROLLANDO I DATI ...</h2>
                  <i class="fa-solid fa-magnifying-glass"></i>
                </div>
              </div>
              <!-- Box pulsanti -->
              <div class="text-center mt-3">
                <button v-if="!formComplete" @click="controlInput()" type="button" class="btn option-btn">
                  Conferma i dati !
                </button>
              </div>
            </div>

            <div class="col-12 col-lg-4 mt-3">
              <div class="px-4 box-cart border">
                <div class="w-100 d-flex flex-column align-items-center">
                    <h3 class="pt-3 " style="font-weight:bold; color:black; align-self:flex-start;">
                      Il Tuo Ordine
                    </h3>
                    <div class="px-1 order-plate-box w-100">
                      <div class=" d-flex justify-content-between" v-for="(item,index) in cart" :key="index">
                        <p class="order-plate-name">{{item.plate.name}}</p> 
                        <div class="quantity-box">
                            <span class="mx-1">{{item.quantity}}x</span>
                            <span class="mx-1">{{(item.plate.price * item.quantity).toFixed(2)}} €</span>
                        </div>
                      </div>
                    </div>

                  <div class="w-100 footer-plate-box mt-2 pt-2">
                    <div class="d-flex justify-content-between">
                        <p> Subtotale </p>
                        <p class="mx-1">{{(tot).toFixed(2)}} €</p>
                    </div>

                    <div class="w-100 d-flex justify-content-between">
                        <p> Spese di consegna </p>
                        <p class="mx-1">{{deliveryCosts}} €</p>
                    </div>
                  </div>

                  <div class="mt-2 w-100 d-flex justify-content-between">
                      <p> <strong> Totale </strong> </p>
                      <p class="mx-1"> <strong> {{(tot + deliveryCosts).toFixed(2)}} € </strong> </p>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
  </div>

  <div v-else>
    <PayLoading />
  </div>
</template>

<script>
import Paybox from '../common/Paybox.vue';
import PayLoading from '../common/PayLoading.vue';
export default {
    name:"Payment",
    components: { Paybox, PayLoading },
    created(){
      if(this.$route.params.user)
        this.user = this.$route.params.user;
      if(this.$route.params.tot)
        this.tot = this.$route.params.tot;
      if(this.$route.params.cart)
        this.cart = this.$route.params.cart;
      
      if(!this.user || !this.tot){
        this.user = JSON.parse(localStorage.getItem('storedData2'));
        this.cart = JSON.parse(localStorage.getItem('storedData3'));
        this.tot = JSON.parse(localStorage.getItem('storedData1'));

        if(!this.user || !this.tot)
          this.$router.push('/');
      }

      if(this.tot > 15)
        this.deliveryCosts = 0;
      else
        this.deliveryCosts = 2.50;
    },
    data(){
      return{
        payloading: false,
        waitToken: false,
        formComplete: false,
        user: null,
        cart: null,
        tot: null,
        deliveryCosts: null,
        
        name: null,
        surname: null,
        email: null,
        phone: null,
        address: null,
        payed: false,
        formData: {
          name: null,
          surname: null,
          email: null,
          phone: null,
          address: null,
          status: null,
          total: null,
          user_id: null,
          plates: null,
          user_email: null,
        },
        validation: {
          name: {
            success: true,
            message: "",
          },
          surname: {
            success: true,
            message: "",
          },
          email: {
            success: true,
            message: "",
          },
          address: {
            success: true,
            message: "",
          },
          phone: {
            success: true,
            message: "",
          },
      },
      }
    },
    methods:{
      payload(result){
        this.payloading = result;
      },
      controlInput(){
      // validazione nome
      console.log(this.name);
      if (!this.name) {
        this.validation.name.success = false;
        this.validation.name.message = "Il nome non può essere vuoto";
      } else if (this.name.length > 30) {
        this.validation.name.success = false;
        this.validation.name.message =
          "Il nome non può superare i 30 caratteri";
      } else {
        this.validation.name.success = true;
        this.validation.name.message = "";
      }
      // validazione cognome
      if (!this.surname) {
        this.validation.surname.success = false;
        this.validation.surname.message = "Il cognome non può essere vuoto";
      } else if (this.surname.length > 30) {
        this.validation.surname.success = false;
        this.validation.surname.message =
          "Il cognome non può superare i 30 caratteri";
      } else {
        this.validation.surname.success = true;
        this.validation.surname.message = "";
      }
      // validazione email
      if (!this.email) {
        this.validation.email.success = false;
        this.validation.email.message = "La mail non può essere vuota";
      } else if (this.email.length > 255) {
        this.validation.email.success = false;
        this.validation.email.message =
          "La mail non può superare i 255 caratteri";
      } else if (
        !this.email.match(
          /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/
        )
      ) {
        this.validation.email.success = false;
        this.validation.email.message = "Formato della mail non valido";
      } else {
        this.validation.email.success = true;
        this.validation.email.message = "";
      }
      //validazione indirizzo
      if (!this.address) {
        this.validation.address.success = false;
        this.validation.address.message = "L'indirizzo non può essere vuoto";
      } else if (this.address.length > 255) {
        this.validation.address.success = false;
        this.validation.address.message =
          "L'indirizzo non può superare i 255 caratteri";
      } else {
        this.validation.address.success = true;
        this.validation.address.message = "";
      }
      // validazione telefono
      if (!this.phone) {
        this.validation.phone.success = false;
        this.validation.phone.message = "Inserire il numero di telefono";
      } else if (isNaN(this.phone)) {
        this.validation.phone.success = false;
        this.validation.phone.message =
          "Il telefono deve essere composto da numeri";
      } else if (
        this.phone.length < 8 ||
        this.phone.length > 11
      ) {
        this.validation.phone.success = false;
        this.validation.phone.message =
          "Il telefono deve essere compreso tra gli 8 e gli 11 caratteri";
      } else {
        this.validation.phone.success = true;
        this.validation.phone.message = "";
      }
    
      this.isValidate();
      },
      isValidate() {
      let control = true;
      for(let i in this.validation) 
        if(!this.validation[i].success) 
          control = false;
      
      if(!control)
        return;

      //se tutto va bene
      this.waitToken = true;

      this.formData.name = this.name;
      this.formData.surname = this.surname;
      this.formData.email = this.email;
      this.formData.phone = this.phone;
      this.formData.address = this.address;
      this.formData.status = 0;
      this.formData.total = this.tot + this.deliveryCosts;
      this.formData.user_id = this.user.id;
      this.formData.plates = this.cart;
      this.formData.user_email = this.user.email;

      this.formComplete = true;
      },
    },
}
</script>

<style lang="scss" scoped>
@import '../../sass/front.scss';
.pay-container {
    padding: 30px 0;
    position: relative;

    &::before{
      content: "";
      width: 100%;
      height: 256px;
      position: absolute;
      top: 0;
      z-index: -1;
      left: 0;
      background-color: #006D68;
      transform: skewY(-4deg);
      transform-origin: left;
  }
}

.form-is-complete{

  &.token-not-ready{
    height: 250px;
    display: flex;
    justify-content: center;
    align-items: center;

    .wait-token{
      margin-top: 150px;
    }
  }

  h4{
    display: inline-block;
  }

  .wait-token{

      .fa-magnifying-glass{
        font-size: 2em;
        margin-left: 15px;
        color: $primary_color;
        animation: search 2s linear infinite;
      }
    }

@keyframes search {
  0%{ transform: translate(0 , -10px); }
  25%{ transform: translate(10px , 0); }
  50%{ transform: translate(0 , 10px); }
  75%{ transform: translate(-10px , 0); }
  100%{ transform: translate(0 , -10px); }
}

  p{
    font-size: 1.3em;
  }
}

.form-edit-box{
  //margin-bottom: 30px;
  background-color: white;
  border-radius: 5px;

  &.form-complete{
    border-radius: unset;
    padding: 8px 15px;
    border-width: 1px 1px 0px 1px;
    border-style: solid;
    border-color: $primary-color;
  }

  .main-form-box{
    background-color: white;
    border-radius: 5px;
    padding: 12px 25px;
    border: 1px solid $primary-color;
  }

  .form-group{

    & label{
      font-weight: bold;
    }
  }
}

.box-cart{
  //max-height: calc(calc(100vh - (24px * 2) - (73px + 72px)) - 80px);
  max-height: 375px;
  background: rgba( 255, 255, 255, 1 );
  box-shadow: 0 8px 32px 0 rgba( 31, 38, 135, 0.2 );
  border-radius: 5px;
  overflow: hidden;

  .footer-plate-box{
    border-top: 1px solid $grey-color;
    border-bottom: 1px solid $grey-color;
  }

  .order-plate-box{
    line-height: 0.7;
    max-height: 180px;
    overflow-y: auto;
  }
}

.deniend-button{
  border: 2px solid  $light-color;
  background-color: $primary-color;
  color: $light-color;
  &:hover{
    cursor: no-drop;
  }
}

.option-btn{
  color: $light-color;
  background-color: $primary-color;
  border: 1px solid $primary-color;
  &:hover{
    color: $primary-color;
    background-color: $third-color;
    border: 1px solid $third-color;
  }
}


</style>