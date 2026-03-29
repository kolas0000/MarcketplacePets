const btngetcode = document.getElementById('getCode');
const WindowCode = document.getElementById('gettingTheCode');

btngetcode.addEventListener('click', function() {
  WindowCode.classList.add('gettingTheCodeActive');
   overlay.classList.toggle("overlayActive");
   document.body.style.overflow = 'hidden';
})
