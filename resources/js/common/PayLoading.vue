<template>
  <div class="main-container">
    <div class="preloader-box">
      <div class="preloader">
          <Preloader />
      </div>
    </div>
    <div class="text">
        <h1>Pagamento in corso</h1>
        <p>Attendi, non ricaricare la pagina ! </p>
      </div>
  </div>
</template>

<script>
import Preloader from '../components/Preloader.vue'
export default {
  components: { Preloader },
    name:"PayLoading"
}
</script>

<style lang="scss" scoped>

.main-container{
  width: 100vw;
  height: 100vh;
  position: fixed;
  z-index: 10000;
  top: 0;
  left: 0;
  background-color: white;
}

.preloader-box{
    background: url('https://deliveroo.it/assets/images/error-pages/background-7edaa013aceff22965bdb7fbf274b4a2.svg');
    filter: invert(1);
    text-align: center;
    position: relative;
    height: 300px;

      h1{
        font-size: 40px;
      }
}

.preloader{
    position: absolute;
    width: 100px;
    height: 100px;
    filter: invert(1);
    left: 50%;
    top: 75%;
    background-repeat: no-repeat;
    background-size: cover;
    transform: translate(-50%, 100%);
}

.text{
    padding-top: 160px;
    text-align: center;
    background-color: white;

  p{
    margin-bottom: 50px;
  }

  .back{
    background-color: #00ccbb;
    color: white;
    font-size: 15px;
    padding: 9px;
    border-radius: 10px;

    &:hover{
      text-decoration: none;
    }
  }
}
</style>