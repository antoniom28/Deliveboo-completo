<template>
  <div class="home-top">
    <div class="input-box-main">
        <h1>I piatti che ami, a domicilio</h1>
        <div id="scrollUp" class="input d-flex flex-column align-items-center justify-content-evenly">
            <p class="m-0"> Inserisci il tuo indirizzo per trovare ristoranti nei dintorni </p>
            
            <div class="input-and-button">
                <div class="input-box d-flex justify-content-center align-items-center">
                    <i class="fa-solid fa-magnifying-glass"></i>
                    <div class="input-form">
                        <input v-model="inputText" type="text" class="form-control" placeholder="Inserisci il tuo indirizzo completo">
                    </div>
                </div>

                <button class=" text-center" v-if="inputText && inputText.length > 0"> 
                    <a class="d-flex align-items-center justify-content-center w-100 h-100" :href="`/main/${inputText}`">
                        Cerca
                    </a>
                </button>
                <button v-else disabled> 
                    Cerca
                </button>
            </div>
        </div>
    </div>

    <div class="bg-effect"></div>
    <div class="image">
        <img :src="require('../../../public/img/banner.png')" alt="">
    </div>
    <div class="deliveboo">
    </div>
</div>
</template>

<script>
export default {
    name:"HomeTop",
    data(){
        return{
            inputText: "",
        }
    },
}
</script>

<style lang="scss" scoped>
@import '../../sass/front.scss';
.input-and-button{
    width: 90%;
    display: flex;
    flex-direction: column;
    justify-content: center;
    align-items: center;

    @media screen and (min-width:567px) {
        &{
            flex-direction: row!important;
            justify-content: space-around!important;
        }
    }
}

a{
    text-decoration: unset!important;
    color: white;

    &:hover{
        color: white;
        font-size: 1.1em;
    }
}

.input-box{
    color: #495057;
    margin-bottom: 20px;
    background: rgba(0,0,0,.04);
    outline: 2px solid $grey_color;
    width: 90%;
    position: relative;
    border-radius: 5px;

    .fa-magnifying-glass{
      z-index: 1;
      color: $primary_color;
      font-size: 1.3em;
      position: absolute;
      top: 14px;
      left: 14px;
    }

    @media screen and (min-width:567px) {
        &{
            width: 70%!important;
            margin-bottom: unset;
        }
    }

    .input-form{
      width: 100%;
      position: relative;

      input{
        width: 100%;
        padding: 24px 10px 24px 50px;
        border: unset;
        background-color: unset;

        &:focus{
          color: #495057;
          background-color: white;
          outline: 2px solid black;
          box-shadow: unset;
        }
      }
    }
}

.home-top{
    height: 700px;
    overflow: hidden;
    position: relative;

    @media screen and (min-width: 992px) {
        &{
            height: 395px;
        }
    }
    
    .input-box-main{
        position: absolute;
        width: 100%;
        height: 260px;
        z-index: 1;
        top: 0;
        left: 0;

        @media screen and (min-width: 992px) {
            &{
                top: unset;
                width: unset;
                bottom: 10px;
                left: calc(20vw - 160px);
            }
        }

        button{
            border: unset;
            width: 90%;
            height: 48px;
            border-radius: 5px;
            background-color: $primary-color;
            color: white;

            @media screen and (min-width:567px) {
                &{
                    width: 20%!important;
                }
            }
        }

        button:disabled{
            cursor: no-drop;
            //color: unset;
            //outline: 2px solid red;
            //background-color: $grey-color!important;
        }

        h1{ 
            font-weight: bold;
            color: #440063;
            margin-left: 10px;
            font-size: 1.8em;

            @media screen and (min-width: 992px) {
                &{
                    margin-left: unset;
                    font-size: 2.8em;
                }
            }
        }

@keyframes shake {
    0%{
        transform: rotate(3deg);
    }
    100%{
        transform: rotate(-3deg);
    }
}

        .input{
            border-radius: 6px;
            background-color: white;
            width: 90%;
            margin: 0 auto;
            height: 180px;

            p{
                font-size: 1.2em;
            }

            @media screen and (min-width:567px) {
                &{
                    height: 150px;
                }
            }

            @media screen and (min-width:992px) {
                &{
                    all: unset;
                    border-radius: 6px;
                    background-color: white;
                    margin-top: 20px;
                    height: 180px;
                    width: 500px;
                }

                &.shake{
                    animation: shake 50ms linear infinite;
                    input{
                        outline: 3px solid black;
                    }
                }
            }
        }
    }

    .image{
        position: absolute;
        width: 80%;
        z-index: 1;
        max-width: 350px;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -25%);

        @media screen and (min-width: 992px){
            &{
                all: unset;
                position: absolute;
                width: 400px;
                z-index: 1;
                top: 80px;
                right: calc(20vw - 160px);
                transform: translate(0%, 0%);
            }
        }

        img{
            width: 100%;
        }
    }

    .bg-effect{
        position: relative;
        background-color: #d0eb99;
        height: 100%;

        &::before{
            content: "";
            width: 100%;
            height: 256px;
            position: absolute;
            right: 0;
            background-color: #00ccbc;
            transform: skewY(-4deg);
            transform-origin: left;
        }
    }
}
/*
.home-top{
    height: 445px;
    overflow: hidden;
    z-index: -1;
    position: relative;
    top: -65px;

    .image{
        position: absolute;
        width: 400px;
        z-index: 1;
        top: 80px;
        right: calc(20vw - 160px);
        transform: translate(0%, 0%);

        img{
            width: 100%;
        }
    }

    .input-box-main{
        position: absolute;
        height: 260px;
        z-index: 1;
        bottom: 10px;
        left: calc(20vw - 160px);
        // transform: translate(50%, 0%);

        h1{ 
            font-weight: bold; 
            color:$third_color;
            font-size: 2.8em;
        }

        .input{
            border-radius: 6px;
            background-color: white;
            margin-top: 20px;
            height: 180px;
        }
    }

    .bg-effect{
        position: relative;
        background-color: #d0eb99;
        height: 100%;

        &::before{
            content: "";
            width: 100%;
            height: 256px;
            position: absolute;
            right: 0;
            background-color: #00ccbc;
            transform: skewY(-4deg);
            transform-origin: left;
        }
    }
}
*/
</style>