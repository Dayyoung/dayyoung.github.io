/*
  Hello World
*/
var dojichart = new DojiChart.core.Chart(document.getElementById("my-dojichart"), {
  fieldMap: {
    time: "t",
    open: "o",
    high: "h",
    low: "l",
    close: "c",
  },
  crosshair: true
});

// Create a chart panel in the region named 'price'
// var price_chart_panel = new DojiChart.panel.TimeValuePanel({
//   primaryLayer: new DojiChart.layer.CandleLayer(),
//   height: 200,
//   grid: true
// });


// Candlestick layer
var candle_layer = new DojiChart.layer.CandleLayer({
  bearBodyColor: "red",
  bullBodyColor: "blue"
});

// Price chart panel
var price_chart_panel = new DojiChart.panel.TimeValuePanel({
  primaryLayer: candle_layer,
  height: 250,
  grid: true
});

dojichart.addComponent("price", price_chart_panel);


//dojichart.addComponent("price", price_chart_panel);

// Dummy data
var data_arr = [
  {"t":"03:00","o":1.0664,"h":1.06646,"l":1.06625,"c":1.06646,"v":67},
  {"t":"03:05","o":1.06645,"h":1.06661,"l":1.06637,"c":1.06658,"v":86},
  {"t":"03:10","o":1.06661,"h":1.06663,"l":1.06647,"c":1.06651,"v":79},
  {"t":"03:15","o":1.0665,"h":1.0665,"l":1.06639,"c":1.06641,"v":30},
  {"t":"03:20","o":1.06637,"h":1.06639,"l":1.06618,"c":1.06628,"v":71},
  {"t":"03:25","o":1.0663,"h":1.06635,"l":1.06591,"c":1.06635,"v":163},
  {"t":"03:30","o":1.06634,"h":1.0664,"l":1.06625,"c":1.06628,"v":123},
  {"t":"03:35","o":1.06629,"h":1.06636,"l":1.06607,"c":1.06617,"v":117},
  {"t":"03:40","o":1.06619,"h":1.06627,"l":1.06583,"c":1.06584,"v":234},
  {"t":"03:45","o":1.06584,"h":1.06601,"l":1.06581,"c":1.06584,"v":51},
  {"t":"03:50","o":1.06585,"h":1.06595,"l":1.06581,"c":1.06594,"v":60},
  {"t":"03:55","o":1.06595,"h":1.06598,"l":1.06588,"c":1.06595,"v":51},
  {"t":"04:00","o":1.06594,"h":1.06597,"l":1.06576,"c":1.06579,"v":92},
  {"t":"04:05","o":1.06577,"h":1.0659,"l":1.06575,"c":1.06581,"v":87},
  {"t":"04:10","o":1.06584,"h":1.06584,"l":1.06557,"c":1.06576,"v":106},
  {"t":"04:15","o":1.06576,"h":1.06594,"l":1.06571,"c":1.06582,"v":59},
  {"t":"04:20","o":1.06581,"h":1.06589,"l":1.06569,"c":1.06586,"v":83},
  {"t":"04:25","o":1.06585,"h":1.06589,"l":1.06577,"c":1.06588,"v":59},
  {"t":"04:30","o":1.0659,"h":1.06593,"l":1.06583,"c":1.06591,"v":38},
  {"t":"04:35","o":1.06592,"h":1.06612,"l":1.06591,"c":1.06602,"v":68},
  {"t":"04:40","o":1.066,"h":1.06624,"l":1.06598,"c":1.06601,"v":113},
  {"t":"04:45","o":1.06603,"h":1.0661,"l":1.06588,"c":1.06606,"v":141},
  {"t":"04:50","o":1.06607,"h":1.06623,"l":1.06607,"c":1.06616,"v":31},
  {"t":"04:55","o":1.06614,"h":1.06618,"l":1.06605,"c":1.06614,"v":49},
  {"t":"05:00","o":1.06613,"h":1.06613,"l":1.06576,"c":1.06593,"v":162},
  {"t":"05:05","o":1.0659,"h":1.06597,"l":1.06588,"c":1.06593,"v":52},
  {"t":"05:10","o":1.06595,"h":1.06602,"l":1.06578,"c":1.06578,"v":63},
  {"t":"05:15","o":1.0658,"h":1.06588,"l":1.06565,"c":1.06572,"v":70},
  {"t":"05:20","o":1.06573,"h":1.0659,"l":1.06566,"c":1.06587,"v":79},
  {"t":"05:25","o":1.06588,"h":1.06589,"l":1.0658,"c":1.0658,"v":37},
  {"t":"05:30","o":1.06583,"h":1.06598,"l":1.06583,"c":1.06595,"v":83},
  {"t":"05:35","o":1.06594,"h":1.06609,"l":1.06565,"c":1.06579,"v":93},
  {"t":"05:40","o":1.06578,"h":1.06587,"l":1.06556,"c":1.06566,"v":92},
  {"t":"05:45","o":1.06568,"h":1.06602,"l":1.06568,"c":1.06601,"v":48},
  {"t":"05:50","o":1.06602,"h":1.06651,"l":1.06599,"c":1.06642,"v":130},
  {"t":"05:55","o":1.06644,"h":1.06651,"l":1.06619,"c":1.06619,"v":161},
  {"t":"06:00","o":1.06617,"h":1.06629,"l":1.0661,"c":1.06618,"v":140},
  {"t":"06:05","o":1.06618,"h":1.06647,"l":1.06595,"c":1.06595,"v":172},
  {"t":"06:10","o":1.06593,"h":1.06599,"l":1.06569,"c":1.06577,"v":174},
  {"t":"06:15","o":1.06579,"h":1.06598,"l":1.06578,"c":1.06592,"v":62},
  {"t":"06:20","o":1.06593,"h":1.06644,"l":1.06591,"c":1.06601,"v":105},
  {"t":"06:25","o":1.06601,"h":1.06622,"l":1.0659,"c":1.06602,"v":170},
  {"t":"06:30","o":1.06605,"h":1.06645,"l":1.06605,"c":1.06632,"v":152},
  {"t":"06:35","o":1.06629,"h":1.06641,"l":1.06622,"c":1.06632,"v":91},
  {"t":"06:40","o":1.06634,"h":1.06641,"l":1.06621,"c":1.06621,"v":147},
  {"t":"06:45","o":1.0662,"h":1.06643,"l":1.0662,"c":1.0664,"v":94},
  {"t":"06:50","o":1.06642,"h":1.06673,"l":1.06638,"c":1.0667,"v":124}
];

function shuffle(array) {
  var currentIndex = array.length, temporaryValue, randomIndex;

  // While there remain elements to shuffle...
  while (0 !== currentIndex) {

    // Pick a remaining element...
    randomIndex = Math.floor(Math.random() * currentIndex);
    currentIndex -= 1;

    // And swap it with the current element.
    temporaryValue = array[currentIndex];
    array[currentIndex] = array[randomIndex];
    array[randomIndex] = temporaryValue;
  }

  return array;
}

// Load data
dojichart.loadData(data_arr, "EURUSD", "M5");

setInterval(function() {

  //data_arr = shuffle(data_arr);

const rand1 = 1.0663;
const rand2 = rand1 + Math.random() * 0.00008;
const rand3 = rand1 - Math.random() * 0.00008;
const rand4 = rand1 + Math.random() * 0.00008;

console.log(rand1.toFixed(5))
console.log(rand2.toFixed(5))
console.log(rand3.toFixed(5))
console.log(rand4.toFixed(5))

  data_arr.pop()
  
  var data = {"t":"06:50","o":rand1.toFixed(5),"h":rand2.toFixed(5),"l":rand3.toFixed(5),"c":rand4.toFixed(5),"v":124}
  data_arr.push(data)
  
  dojichart.loadData(data_arr, "EURUSD", "M5");
}, 300);




/* end of file */