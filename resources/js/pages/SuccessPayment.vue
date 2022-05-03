<template>
  <div v-if="show" class="main-container d-flex align-items-center flex-column">
    <div class="success-box text-center">

        <div class="success">
            <h2>Pagamento riuscito!</h2>
            <div class="check">
                <i class="fa-solid fa-check"></i>
            </div>
        </div>

        <div class="fluid-container flex-column data-box">
            <div class="data-main-box row row-cols-1">
                <div class="col data d-flex justify-content-between">
                    <p>Tipo Pagamento</p>
                    <p>{{transaction.paymentInstrumentType}} - {{transaction.creditCard.cardType}}</p>
                </div>

                <div class="col data d-flex justify-content-between">
                    <p>A Favore</p>
                    <p>{{user.name}} - {{user.activity}}</p>
                </div>

                <div class="col data d-flex justify-content-between">
                    <p>Email</p>
                    <p>{{user.email}}</p>
                </div>

                <div class="col data d-flex justify-content-between">
                    <p>Totale</p>
                    <h4 class="total"> {{tot.toFixed(2)}} € </h4>
                </div>

                <div class="col data d-flex justify-content-between">
                    <p>ID Transazione</p>         
                    <p>{{transaction.networkTransactionId}}</p>
                </div>
            </div>

            <div class="mt-1 mb-3 w-100 order">
                <h3>Il tuo ordine :</h3> 
                <ul>
                    <li v-for="(elem,index) in cart" :key="index">
                        {{elem.plate.name}} - {{elem.quantity}}x
                    </li>
                </ul>
            </div>

            <a href="/">
                <button type="button" class="btn option-btn">Torna alla home</button>
            </a>
        </div>
    </div>
  </div>
</template>

<script>
export default {
    name:"SuccessPayment",
    data(){
        return{
            user: null,
            tot: null,
            cart: null,
            transaction: null,
            show: false, //VA MESSO FALSE ALLA FINE DI LUCA
        }
    },
    created(){
        console.log(this.$route)
        this.user = this.$route.params.user;
        this.cart = this.$route.params.cart;
        this.tot = this.$route.params.tot;
        this.transaction = this.$route.params.transaction;
        if(this.cart && this.user)
            this.show = true;
        else
            this.$router.push({
                name: 'main', 
            });
    },
}
</script>

<style lang="scss" scoped>
@import '../../sass/_variables.scss';
.main-container {
    padding: 30px 0;
    height: 100%;
    position: relative;
    background-color: #d0eb99;

    &::before{
      content: "";
      width: 100%;
      height: 256px;
      position: absolute;
      top: 0;
      left: 0;
      background-color: #00ccbc;
      transform: skewY(-4deg);
      transform-origin: left;
  }
}

ul{
    list-style-type: none;
    padding: 0px;
}

.success-box{
    background-color: white;
    position: relative;
    z-index: 2;
    color: black;
    //font-size: 15px;
    padding: 20px 45px;
    border-radius: 10px;
    width: 90%;

    @media screen and (min-width:768px){
        width: 700px!important;
    }

    .data-box{
        p{ font-size: 1.2em; }
        p:first-child{
            font-size: 1.5em;
        }
        @media screen and (min-width:576px){
            p{ font-size: 1em; }
            p:first-child{
                font-size: 1em;
            }
        }

        .data-main-box{
            line-height: 0.5;
            margin: 20px 0 5px 0;

            & > .data {
                margin: 10px 0;
            }

            @media screen and (min-width:576px){
                line-height: 1;

                & > .data {
                    margin: unset;
                }
            }
        }

        .order{
            max-height: 150px;
            overflow-y: auto;
            text-align: start;
        }

        .data{
            flex-direction: column;
            
            @media screen and (min-width:576px) {
                flex-direction: row;
            }

            .total{
                font-weight: bold;
            }

            p:first-child{
                color: $darkgrey-color;
            }
        }
    }

    .success{
        color: green;

        .check{
            .fa-check{
                font-size: 1.9em;
                padding: 15px;
                border: 2px solid green;
                border-radius: 50%;
            }
        }
    }

    a{ text-decoration-line: none; }
  }

.option-btn{
    color: $light-color;
    background-color: $primary-color;
    border: 1px solid $third-color;
    &:hover{
    color: $primary-color;
    background-color: $third-color;
    border: 1px solid $third-color;
    }
}
</style>