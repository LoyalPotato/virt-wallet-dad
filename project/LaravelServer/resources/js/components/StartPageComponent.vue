<template>
  <div>
    <p>Welcome to Virtual Wallets</p>
    <p>Please sign in or register to enter the platform</p>
    <p>Msg about the infographics down there</p>
    <div class="container-small">
      <wallets-charts v-if="loaded" :chart-data="chartdata" :options="options" :styles="myStyles"></wallets-charts>
    </div>
  </div>
</template>

<script>
import WalletsCharts from "./WalletsChartComponent";
// NOTE: Aqui é só para apresentar all wallets ou info as a global?
export default {
  name: "StartPageComponent",
  components: {
    WalletsCharts
  },
  data() {
    return {
      loaded: false,
      chartdata: null,
      options: null,
    };
  },
  mounted() {
    // TEST Adding a new wallet and see if it updates
    this.loaded = false;
    try {
      axios
        .get("/api/wallets")
        .then(response => {
          this.fillData(response.data.data);
          this.loaded = true;
        })
        .catch(error => {
          console.log(error);
        });
    } catch (e) {
      console.error(e);
    }
  },
  methods: {
    fillData(responseData) {
      this.chartdata = {
        labels: ["Wallet"],
        datasets: [
          {
            label: "Total number of wallets",
            //BUG Aparece undefined, preciso de por uma second label right?
            data: [responseData.length], //NOTE: Eu estou a dar tudo da carteira, n um numero/array de nums
            borderWidth: 1, //NOTE: Border around the bar
            backgroundColor: '#4f9be8',
            hoverBackgroundColor: '#3f7fbf'
          },]
      };
      this.options = {
        options: {
          scales: {
            yAxes: [
              {
                ticks: { beginAtZero: true }
              }
            ],
            xAxes: [
              {
                gridLines: {
                  offsetGridLines: true
                }
              }
            ]
          },
          // TEST Responsiveness https://www.chartjs.org/docs/latest/general/responsive.html
          responsive: true,
          maintainAspectRatio: false
        }
      };
    }
  },
  computed: {
    
    myStyles() {
      return {
        height: "400px",
        width: "400px",
        position: "relative",
        "margin-left": "auto",
        "margin-right": "auto"
      };
    }

  }
};
</script>

<style>
p {
  text-align: center;
}

</style>