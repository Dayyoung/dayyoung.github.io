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


$('[class*="link___detail"]').each(function(i,item){
    console.log(item);
    $(item).click(function(){
        location.href = "../item?item="+i
    })
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


function generateRandomCode(n) {
  let str = ''
  for (let i = 0; i < n; i++) {
    str += Math.floor(Math.random() * 10)
  }
  return str
}
