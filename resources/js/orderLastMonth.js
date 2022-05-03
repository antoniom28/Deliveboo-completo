/*let plates = <?php echo json_encode($plates); ?>;
        let quantity = <?php echo json_encode($data); ?>;*/
        const thisURL = window.location.href;
        console.log(thisURL);
        let howMuchOrder;
        let howMuchMoney;
        let days;

        /*const month = ["Gennaio","Febbraio","Marzo","Aprile","Maggio","Giugno","Luglio","Agosto","Settembre","Ottobre","Novembre","Dicembre"];
        const dayOfMonth = [31,28,31,30,31,30,31,31,30,31,30,31];

        const d = new Date();
        let name = month[d.getMonth()];
        let day = dayOfMonth[d.getMonth()];
        console.log(day,name);*/

if (thisURL.endsWith("/admin/statistics")){
      getGenre();
        function makeAxiosCall(url) {
          return axios.get(url);
      }

       async function getGenre() {
            let response = await makeAxiosCall( '../api/lastMonth' );
            console.log(response.data);
            howMuchOrder = response.data.howMuchOrder;
            howMuchMoney = response.data.howMuchMoney;
            days = howMuchOrder.length;

        const labels = [];

        for(let i = 0; i<howMuchOrder.length; i++)
            labels.push(i+1);
    
            const orderData = {
              labels: labels,
              datasets: [{
                label: 'Totale ordini in questo mese',
                backgroundColor: [
                  'red',
                  'orange',
                  'lightcoral',
                  'yellow',
                  'green',
                  'lightgreen',
                  'blue',
                  'lightblue',
                  'purple',
                  'violet',
                  'pink',
                ],
                borderColor: ['rgb(255, 99, 132)','rgb(125, 99, 132)'],
                data: howMuchOrder,
              }]
            };

            const moneyData = {
              labels: labels,
              datasets: [{
                label: 'I tuoi guadagni in questo mese',
                backgroundColor: [
                  'red',
                  'orange',
                  'lightcoral',
                  'yellow',
                  'lightyellow',
                  'green',
                  'lightgreen',
                  'blue',
                  'lightblue',
                  'purple',
                  'violet',
                  'pink',
                ],
                borderColor: ['rgb(255, 99, 132)','rgb(125, 99, 132)'],
                data: howMuchMoney,
              }]
            };
      
        const orderConfig = {
          type: 'bar',
          data: orderData,
          options: {}
        };

        const moneyConfig = {
          type: 'line',
          data: moneyData,
          options: {}
        };

        const orderChart = new Chart(
          document.getElementById('orderChart'),
          orderConfig
        );

        const moneyChart = new Chart(
          document.getElementById('moneyChart'),
          moneyConfig
        );
    }   
}


       