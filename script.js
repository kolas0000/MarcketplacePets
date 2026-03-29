const menu = document.querySelector('.menu');
const OpenWhoyou = document.getElementById('clickme');
const howyou = document.getElementById('Whoyou');
const overlay = document.getElementById('overlay');
const ExitWhoyou = document.getElementById('ExitWhoyou');
const specialistsBlock = document.getElementById('specialistsBlock');


OpenWhoyou.addEventListener('click', function() {
   howyou.classList.toggle("WhoyouActive");
   overlay.classList.toggle("overlayActive");

   
   const scrollBarWidth = window.innerWidth - document.documentElement.clientWidth;
   document.body.style.overflow = 'hidden';
    document.body.style.paddingRight = scrollBarWidth + 'px';
    specialistsBlock.style.paddingRight = 30 + 'px';
})

ExitWhoyou.addEventListener('click', function() {
    overlay.classList.remove("overlayActive");
    howyou.classList.remove("WhoyouActive");
    document.body.style.overflow = '';
    document.body.style.paddingRight = '';
    specialistsBlock.style.paddingRight = '';
})