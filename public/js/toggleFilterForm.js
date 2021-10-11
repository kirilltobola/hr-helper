let btn = document.querySelector('.hide-form-btn');
let div = document.querySelector('#filterFrom');
btn.onclick = function (){
    div.classList.toggle('position-absolute');
    div.classList.toggle('w-100');
    div.classList.toggle('h-auto');
    div.classList.toggle('d-none');
    div.classList.toggle('top-10');
    div.classList.toggle('start-0');
}
