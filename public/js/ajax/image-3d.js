$(document).ready(function(){
    // var image = $('.iamge-array').data('image');
    var image = new Array();
    for(let i = 1 ; i < 8 ; i++){
        image.push($('.iamge-array').data('image' + i));
    }
    console.log(image);
    var threesixty = new ThreeSixty(document.getElementById('threesixty'), {
        image : image,
        width: 500,
        height: 500,
        prev: document.getElementById('prev'),
        next: document.getElementById('next')
      });
      
      threesixty.play();
})