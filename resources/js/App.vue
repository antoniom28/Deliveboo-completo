<template>
    <div id="main-container">
        <Header @clearCart="clearCart" :tot="tot" :user="user"/>
        <Main :prevUser="user" :prevOrder="order" @add="add"/>
        <Footer />
    </div>

</template>

<script>
import Header from './components/Header.vue';
import Main from './components/Main.vue';
import Footer from './components/Footer.vue';
export default{
    name: 'App',
    data(){
        return{
            tot: null,
            user: null,
            order: null,
            exist: false,
        }
    },
    components: {
        Header, 
        Main, 
        Footer,    
    },
    mounted() {
        console.log('what');
     //   if(this.exist){
            this.user = JSON.parse(localStorage.getItem('storedData2'));
            this.order = JSON.parse(localStorage.getItem('storedData3'));
            this.tot = JSON.parse(localStorage.getItem('storedData1'));
    //    }

        //da fixare qua, esce l'html se cerchi da URL
        if(this.user)
            axios.get(`../api/exist/${this.user.id}/${this.order[0].plate.name}`)
            .then((response)=> {
                console.log(response.data,'esiste?');
                this.exist = response.data;
                if(response.data == false){
                    this.user = null;
                    this.order = null;
                    this.tot = null;
                }
            });
        else{
            this.user = null;
            this.order = null;
            this.tot = null;
        }
    },
    watch:{
    tot(newName) {
        console.log('salvo tot',newName);
    let convert = JSON.stringify(newName);
        localStorage.setItem('storedData1', convert);
    },
    user(newName) {
        console.log('salvo user',newName);
        let convert = JSON.stringify(newName);
        localStorage.setItem('storedData2', convert);
    },
    order(newName) {
        let convert = JSON.stringify(newName);
        localStorage.setItem('storedData3', convert);
    },
    },
    methods:{
        clearCart(){
            this.tot = null;
            this.order = null;
            this.user = null;
        },
        add(tot,user,order){        
            this.tot = tot;
            this.user = user;
            this.order = order;
            let convert = JSON.stringify(order);
            localStorage.setItem('storedData3', convert);
        },
    },
}
</script>

<style lang="scss" scoped>
* {
    -webkit-user-select: none;  /* Chrome all / Safari all */
    -moz-user-select: none;     /* Firefox all */
    -ms-user-select: none;      /* IE 10+ */
    user-select: none;          /* Likely future */    
    font-family: plex-sans, "Helvetica Neue", Helvetica, Arial, "Microsoft YaHei", "Hiragino Sans GB", sans-serif;
}

</style>