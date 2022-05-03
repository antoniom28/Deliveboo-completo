<template>
  <div v-if="tokenGenerate" class="payment-box">
      <v-braintree 
        :authorization="Token"
        @success="onSuccess"
        @error="onError"
    >
    <template #button="slotProps">
      <div class="text-center" @click="slotProps.submit">
        <button type="button" id="btn_pay" class="w-75 btn option-btn">Paga</button>
       <!-- <router-link class="btn back_to_home d-none" id="back_to_home" :to="{ name: 'main'}">Torna alla Home</router-link> -->
      </div>
    </template>
    </v-braintree>
  </div>
</template>

<script>
export default {
  name:"Paybox",
  data(){
    return{
      Token: null,
      tokenGenerate: false,
    }
  },
  props:{
    formData: Object,
    user: Object,
    tot: Number,
    cart: Array,
  },
  created(){
  axios
      .get("../api/order/generate")
      .then((response) => {
        this.Token = response.data.token;
        console.log(response.data,'genera token');
          this.tokenGenerate = true;
        setTimeout(() => {
          this.$emit('tokenReady');
        }, 1000);
        
       // dataShared.loaded = true;
      })
      .catch(function (error) {});
  },
  methods: {
    pay(dataPayment){
      axios.post('../api/payment/' , this.formData)
              .then((response) => {
          // handle success
              console.log(dataPayment,'si è qui');
              console.log(dataPayment.data.transaction,'si è qui22');
              if(response.data.status){
                localStorage.setItem('storedData1', null);
                localStorage.setItem('storedData2', null);
                localStorage.setItem('storedData3', null);
                console.log(this.user);
                setTimeout(() => {
                  this.$router.push({
                    name: 'SuccessPayment', 
                    params: { user: this.user , cart: this.cart , tot: this.tot , transaction:dataPayment.data.transaction}
                  });
                }, 1000);
              }
          });
    },
    onSuccess (payload) {
      this.$emit('payload' , true);
      let nonce = payload.nonce;
      this.formData.tokenClient = nonce;
      axios
        .post("../api/order/make/payment" , this.formData)
        .then((response) => {
          console.log(response.data, 'dopo pagamento');
          if(response.data.success){
            this.pay(response.data);
           /* document.getElementById("btn_pay").classList.add("d-none");
            document.getElementById("back_to_home").classList.remove("d-none");
            document.getElementById("back_to_home").classList.add("d-flex");*/
          }
          else{
            this.$emit('payload' , false);
            console.log('NON PAGATO');
            }

       //   self.clearCart();
         // self.redirect();
        })
        .catch(function (error) {});
      // Do something great with the nonce...
    },
    onError (error) {
      let message = error.message;
      // Whoops, an error has occured while trying to get the nonce
      console.log(message,'errore di mess in paybox');
    }
  }
}
</script>

<style lang="scss" scoped>
@import '../../sass/_variables.scss';
.payment-box{
  padding-bottom: 20px;
  border-top: 1px solid $primary-color;
  border-bottom: 1px solid $primary-color;
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

.back_to_home{
    background-color: #00ccbb;
    color: white;
    font-size: 15px;
    padding: 9px;
    border-radius: 10px;
    text-align: center!important;
    &:hover{
      text-decoration: none;
    }
}
</style>