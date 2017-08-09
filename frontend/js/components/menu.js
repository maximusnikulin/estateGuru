var bar = document.querySelector('.button--bar'); 
var menu = document.querySelector('.menu'); 
var overlay = document.querySelector('.menu__overlay'); 
var container = document.querySelector('.menu__container'); 

bar.addEventListener('click',function(){
    menu.classList.add('open')
});
overlay.addEventListener('click',function(){
    menu.classList.remove('open')
});