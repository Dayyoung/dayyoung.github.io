var USERDATA;

function goItem() {

	USERDATA = getUserData();

	this.viewItem();
}

function getUserData(){
  var userID = localStorage.getItem('userID');
  var cartList = GsheetToJSON('https://docs.google.com/spreadsheets/d/1u-YNqG2eOLmP-yerGt4G4sYfKBGAvvzCA88t5pCO1nY/edit?resourcekey#gid=1382901981')
  var cartItem;

  for(i in cartList){
  	var nowCartItem = cartList[i];
  	if(nowCartItem.userID == userID){
  		cartItem = nowCartItem;
  	}
  }
  return cartItem;
}

function viewItem(){

	var url = new URL(window.location.href);
	var urlParams = url.searchParams;

	var itemIndex = urlParams.get('item'); 
	console.log(urlParams.get('item')); 

	$('.image_11_18_332').css("background-image", 'url(images/'+itemIndex+'.png)');

	  if(itemIndex==0) {$('.heading_1___carrot_15_145').html("Carrot")
	    $('.it_is_so_fresh_carrot__15_146').html('Price : $5')}
	  if(itemIndex==1) {$('.heading_1___carrot_15_145').html("Tomato")
	    $('.it_is_so_fresh_carrot__15_146').html('Price : $5')}
	  if(itemIndex==2) {$('.heading_1___carrot_15_145').html("Onion")
	    $('.it_is_so_fresh_carrot__15_146').html('Price : $5')}
	  if(itemIndex==3) {$('.heading_1___carrot_15_145').html("Potato")
	    $('.it_is_so_fresh_carrot__15_146').html('Price : $7')}


	  if(!USERDATA)USERDATA = {};
	  if(!USERDATA.Carrot)USERDATA.Carrot=0;
	  if(!USERDATA.Tomato)USERDATA.Tomato=0;
	  if(!USERDATA.Onion)USERDATA.Onion=0;
	  if(!USERDATA.Potato)USERDATA.Potato=0;

	  if(itemIndex==0) $('.amount____5_15_147').html("Amount : " + USERDATA.Carrot)
	  if(itemIndex==1) $('.amount____5_15_147').html("Amount : " + USERDATA.Tomato)
	  if(itemIndex==2) $('.amount____5_15_147').html("Amount : " + USERDATA.Onion)
	  if(itemIndex==3) $('.amount____5_15_147').html("Amount : " + USERDATA.Potato)
    

	$('.link___add_cart_15_149').off('click').click(function(){
			var isSuccess = createOrUpdateItem(itemIndex);
			if(isSuccess){
				goItem();
			}
	});

	$('.link___delete_15_153').off('click').click(function(){
	    	var isSuccess = createOrUpdateItem(itemIndex,'delete');
			if(isSuccess){
				goItem();
			}
	})
}
