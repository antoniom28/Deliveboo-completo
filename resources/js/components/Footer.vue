<template>
<div class="d-flex justify-content-center Bcolor">
  <div class="footer-container d-flex align-items-center">
    <div class="discover-deliveboo">
    <ul><span>Scopri Deliveboo</span>
      <li><a href="#">Investitori</a></li>
      <li><a href="#">Chi siamo</a></li>
      <li><a href="#">Ristoranti</a></li>
      <li><a href="#">Altro</a></li>
      <li><a href="#">Pressroom</a></li>
      <li><a href="#">Il nostro blog</a></li>
      <li><a href="#">Programmazione</a></li>
      <li><a href="#">Design</a></li>
      <li><a href="#">Lavora con noi</a></li>
      <li><a href="#">Diventa nostro partner</a></li>
    </ul>
    </div>
    <div class="legal-notices">
      <ul><span>Note legali</span>
        <li><a href="#">Termini & Condizioni</a></li>
        <li><a href="#">Informativa sulla privacy</a></li>
        <li><a href="#">Cookies</a></li>
      </ul>
    </div>
    <div class="help">
      <ul><span>Aiuto</span>
        <li><a href="#">Contatti</a></li>
        <li><a href="#">FAQ</a></li>
        <li><a href="#">Tipi di cucina</a></li>
      </ul>
    </div>
    <div class="take-deliveboo">
      <ul><span>Porta Deliveboo con te</span>
      <li> 
        <a href="#">
          <img :src="require('../../../public/img/app_store.png')" alt="">
        </a> 
      </li>
      <li> 
        <a href="#">
          <img :src="require('../../../public/img/g_play.png')" alt="">
        </a> 
      </li>
      </ul>
    </div>
    <div class="icons">
      <div class="social">
        <i class="fab fa-facebook"></i>
        <i class="fab fa-twitter"></i>
        <i class="fab fa-instagram"></i>
      </div>
      <div class="copyright">
        <em>© 2022 Deliveboo</em>
      </div>
    </div>
  </div>
</div>
</template>

<script>
export default {
  name: 'Footer'
}
</script>

<style lang="scss" scoped>

.Bcolor{
  background-color: #2e3333;
}

.footer-container{
  min-height: 0;
  background-color: #2E3333;
  width: 90%;
  padding: 15px 0;
  color: white;
  //margin-top: 30px;
  //display: flex;
  //justify-content: center;
  //flex-wrap: wrap;
  @media screen and (max-width:576px) {
      &{
        flex-direction: row;
        flex-wrap: wrap;
        justify-content: space-evenly;
      }

      & > div:not(:last-child){
        width: 100%!important;
      }

      & > div:nth-child(2){
        height: 360px;
      }
  }

  @media screen and (min-width:576px) {
      &{
        flex-direction: row;
        flex-wrap: wrap;
        justify-content: space-evenly;
      }

      & > div:not(:last-child){
        width: 45%!important;
      }

      & > div:nth-child(2){
        height: 360px;
      }
  }

  @media screen and (min-width:992px) {
      &{
        flex-direction: row;
        justify-content: space-between;
      }

      & > div:not(:last-child){
        width: 24%!important;
        height: 360px;
      }

      & > div:last-child{
        width: 100%!important;
      }
  }

  & > div{
    margin: 7px 0;
    padding: 10px 20px;
    line-height: 2;
    width: 90%;
  }

  ul{
    list-style: none;
    padding: unset;
  }

  ul span{
    font-size: 18px;
  }

  a{
    color: white;

    &:hover{
      text-decoration: none;
      color: #00B8A9;
    }
  }

  span{
    font-size: 1.1em;
    font-weight: bold;
  }
}

.discover-deliveboo, .legal-notices, .help, .take-deliveboo{
  background-color: #434848;
  //margin-right: 15px;
  //padding: 10px;
}

.take-deliveboo{
  li{
    margin: 8px 0;
  }

  img{
    width: 130px;
  }
}

.icons{
  width: 100%;
  display: flex;
  justify-content: space-between;

  em{
    font-size: 0.8em;
    color: #5a6161;
  }
  //margin-top: 50px;
  //height: 24px;
  //width: 24px;

  i{
    margin-right: 10px;
    font-size: 1.4em;
  }
}

.take-deliveboo{
  // background: url('https://consumer-component-library.roocdn.com/25.27.9/static/images/app-store-badges-it.svg');
  background-repeat: no-repeat;
  background-size: cover;
}


</style>