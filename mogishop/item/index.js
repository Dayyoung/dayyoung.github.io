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

const url = new URL(window.location.href);
const urlParams = url.searchParams;

getCartItem();

var itemIndex = urlParams.get('item'); // ekw000033653
console.log(urlParams.get('item')); // ekw000033653

$('.image_11_18_332').css("background-image", 'url(images/'+itemIndex+'.png)');

  if(itemIndex==0) $('.heading_1___carrot_15_145').html("Carrot")
  if(itemIndex==1) $('.heading_1___carrot_15_145').html("Tomato")
  if(itemIndex==2) $('.heading_1___carrot_15_145').html("Onion")
  if(itemIndex==3) {
    $('.heading_1___carrot_15_145').html("Potato")
    $('.price____5_15_147').html('Price : $7')
  }

$('.link___buy_15_153').click(function(){
    location.href = "../cart"
})


$('.link___add_cart_15_149').click(function(){
        createOrUpdateItem(itemIndex);
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


var CARDID;

function createOrUpdateItem(type){

  var visitNumber = localStorage.getItem('visitNumber');

  if(!visitNumber){
      visitNumber = generateRandomCode(3);
      localStorage.setItem('visitNumber', visitNumber);
  }

  var requestData = {};
  requestData["entry.1073279920"] = visitNumber; //userID

  //var cartID = getCartID();

  if(CARDID){
    requestData["edit2"] = CARDID; //Carrot
    requestData["entry.560925289"] = CARDID; //Carrot
  }

  var requestUrl =
    "https://docs.google.com/forms/u/0/d/e/1FAIpQLSfhZa0aZP9YnJV5Po2r1VRCLMUpnkoy2RqCLbmh4hl2V8Snvw/formResponse";


  if(type==0)requestData["entry.1032449173"] = ++CarrotCount; //Carrot
  if(type==1)requestData["entry.1175135802"] = ++TomatoCount; //Tomato
  if(type==2)requestData["entry.388180984"] = ++OnionCount; //Onion
  if(type==3)requestData["entry.1719807681"] = ++PotatoCount; //Potato


  $.post("https://corsproxy.io/?" + requestUrl, requestData, function (data) {
    //var responseUrl = $("a").first().attr("href").split("edit2=")[1];
    var responseUrl = $(data).find("a").first().attr("href");
    RESPONSE_KEY = responseUrl.split("edit2=")[1];
    console.log(RESPONSE_KEY);
    updateCartID(RESPONSE_KEY)
  });
}

function updateCartID(cartID){

  var requestUrl =
    "https://docs.google.com/forms/u/0/d/e/1FAIpQLSfhZa0aZP9YnJV5Po2r1VRCLMUpnkoy2RqCLbmh4hl2V8Snvw/formResponse";

  var requestData = {};
  requestData["edit2"] = cartID; //Carrot
  requestData["entry.560925289"] = cartID; //Carrot

  $.post("https://corsproxy.io/?" + requestUrl, requestData, function (data) {
    //var responseUrl = $("a").first().attr("href").split("edit2=")[1];
    var responseUrl = $(data).find("a").first().attr("href");
    console.log(responseUrl);
    RESPONSE_KEY = responseUrl.split("edit2=")[1];
    console.log(RESPONSE_KEY);
  });

}


function getCartID() {

  var visitNumber = localStorage.getItem('visitNumber');

  if(!visitNumber){
      visitNumber = generateRandomCode(3);
      localStorage.setItem('visitNumber', visitNumber);
  }

  var cartID;

  var requestUrl = 'https://docs.google.com/spreadsheets/d/e/2PACX-1vRUvdL55WbsPb3fkqtNE9CEopsc-L2RynZDmbH1WupmiMII84_i2te9juZEjTr_01JR2yQ-dmX3iN1t/pub?gid=1382901981&single=true&output=csv';

  requestUrl = 'https://docs.google.com/spreadsheets/d/1u-YNqG2eOLmP-yerGt4G4sYfKBGAvvzCA88t5pCO1nY/edit?resourcekey#gid=1382901981';

  $.ajax({
          type: "get",            
          url: requestUrl,         
          async: false,
          cache: false,              
          data: "",                
          success: function(res){   

          console.log(res); 
          var table = $(res).find('.waffle').find('td')
          //console.log(table); 

          table.each(function(i,item){
            //console.log(i +" / "+item)
            //console.log(item)

            if(i%13==1){
              var nowUserID =$(item).html()
              var nowCartID =$(item).next('td').find('div').html()
              var parent = $(item);

              $('body').append(parent)
              var count =$(item).next('td').next('td').html()
              // var nowCartID =$(item).next('td').find('div').html()
              // var nowCartID =$(item).next('td').find('div').html()
              // var nowCartID =$(item).next('td').find('div').html()
            
              if(nowUserID == visitNumber){
                  console.log(nowUserID)
                  console.log(nowCartID)
                  console.log(parent)
                  console.log(JSON.stringify(parent))


                   cartID = nowCartID;
              }

            } 


          });
          
          }
  })

  return cartID;

}

var CarrotCount;
var TomatoCount;
var OnionCount;
var PotatoCount;

function getCartItem() {

  var visitNumber = localStorage.getItem('visitNumber');

  if(!visitNumber){
      visitNumber = generateRandomCode(3);
      localStorage.setItem('visitNumber', visitNumber);
  }

  var cartID;

  var requestUrl = 'https://docs.google.com/spreadsheets/d/e/2PACX-1vRUvdL55WbsPb3fkqtNE9CEopsc-L2RynZDmbH1WupmiMII84_i2te9juZEjTr_01JR2yQ-dmX3iN1t/pub?gid=1382901981&single=true&output=csv';

  requestUrl = 'https://docs.google.com/spreadsheets/d/1u-YNqG2eOLmP-yerGt4G4sYfKBGAvvzCA88t5pCO1nY/edit?resourcekey#gid=1382901981';

  $.ajax({
          type: "get",            
          url: requestUrl,         
          async: false,
          cache: false,              
          data: "",                
          success: function(res){   

          console.log(res); 
          var table = $(res).find('.waffle').find('td')
          console.log(table); 

          var nowUserID;

          table.each(function(i,item){
            //console.log(i +" / "+item)
            //console.log(item)
            
            if(i%13==1){
               nowUserID =$(item).html()
              if(nowUserID == visitNumber){
                  console.log(nowUserID)
              }

            } 
            if(i%13==2){
              var nowCartID =$(item).find('div').html()
              if(nowUserID == visitNumber){
                  console.log(nowCartID)
                  CARDID = nowCartID;
              }

            }
            if(i%13==3){
              var nowCount =$(item).html()
              if(nowUserID == visitNumber){
                  console.log(nowCount)
                  if(nowCount==''){
                    nowCount=0
                  }
                  CarrotCount = parseInt(nowCount)
              }

            }
            if(i%13==4){
              var nowCount =$(item).html()
              if(nowUserID == visitNumber){
                  console.log(nowCount)
                  if(nowCount==''){
                    nowCount=0
                  }
                  TomatoCount = parseInt(nowCount)
              }

            }   
            if(i%13==5){
              var nowCount =$(item).html()
              if(nowUserID == visitNumber){
                  console.log(nowCount)
                  if(nowCount==''){
                    nowCount=0
                  }
                  OnionCount = parseInt(nowCount)
              }

            }   
            if(i%13==6){
              var nowCount =$(item).html()
              if(nowUserID == visitNumber){
                  console.log(nowCount)
                  if(nowCount==''){
                    nowCount=0
                  }
                  PotatoCount = parseInt(nowCount)
              }
            }  
          });
          
          }
  })

  return cartID;

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
