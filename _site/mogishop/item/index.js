$(function(){
  
  //Navigation  

  $('[class*="homebutton"]').click(function(){
    location.href = "../home"
  });
  $('[class*="menubutton"]').click(function(){
    location.href = "../menu"
  });
  $('[class*="itembutton"]').click(function(){
    location.href = "../item"
  });
  $('[class*="cartbutton"]').click(function(){
    location.href = "../cart"
  });
  $('[class*="posbutton"]').click(function(){
    location.href = "../pos"
  });


  var visitNumber = localStorage.getItem('visitNumber');

  if(!visitNumber){
      visitNumber = generateRandomCode(3);
      localStorage.setItem('visitNumber', visitNumber);
  }

    toastr.options.positionClass = 'toast-bottom-right';
    toastr.options.extendedTimeOut = 1000; //1000;
    toastr.options.timeOut = -1;
    toastr.options.fadeOut = 250;
    toastr.options.fadeIn = 250;    
    toastr.success("Welcome to number "+visitNumber)  


})


function checkData() {

    var requestUrl = 'https://docs.google.com/spreadsheets/d/e/2PACX-1vRU5V07x8i9gRwFJGCfVOwBPmIkmPzpNC6-gULXoGW_n5Lru2LkhjZwaCg68bwPt7grwW5ZZq_lIxO5/pub?gid=1524359055&single=true&output=csv'+"&cachenumber="+generateRandomCode(8);

    $.get( requestUrl, function( data ) {
    var jsonData = csvToJSON(data);
    console.log(jsonData);


    for(i in jsonData){
       var jsonItem = jsonData[i];
       console.log(jsonItem);

       if(jsonItem['Order Status'] == 'Preparing'){
         toastr.warning(jsonItem['Order Number'] + ' is Preparing..');  
       }
       if(jsonItem['Order Status'] == 'Completed'){
         toastr.success(jsonItem['Order Number'] + ' is Completed!');  
       }
    }

    });

}
function csvToJSON(csv_string) {
  const rows = csv_string.split("\r\n");
  const jsonArray = [];
  const header = rows[0].split(",");
  for (let i = 1; i < rows.length; i++) {
    let obj = {};
    let row = rows[i].split(",");
    for (let j = 0; j < header.length; j++) {
      obj[header[j]] = row[j];
    }
    jsonArray.push(obj);
  }
  return jsonArray;
}


function generateRandomCode(n) {
  let str = ''
  for (let i = 0; i < n; i++) {
    str += Math.floor(Math.random() * 10)
  }
  return str
}
