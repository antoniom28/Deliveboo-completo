/*let plates = <?php echo json_encode($plates); ?>;
        let quantity = <?php echo json_encode($data); ?>;*/
        const thisURL = window.location.href;
        console.log(thisURL);
        let plates;
        let quantity;
        
if (thisURL.endsWith("/admin/statistics")){
      getGenre();
       async function getGenre() {
            let response = await makeAxiosCall( '../api/statistics' );
            console.log(response.data);
            plates = response.data.plates;
          quantity = response.data.data;

          function makeAxiosCall(url) {
            return axios.get(url);
        }

        const labels = [];
        for(let i = 0; i<plates.length; i++){
            labels.push(plates[i].name)
        }
    
        const data = {
          labels: labels,
          datasets: [{
            label: 'Quali piatti preferiscono i tuoi clienti',
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
            data: quantity,
          }]
        };
      
        const config = {
          type: 'bar',
          data: data,
          options: {}
        };

        
        const myChart = new Chart(
            document.getElementById('myChart'),
            config
          );
        }

        
}


       