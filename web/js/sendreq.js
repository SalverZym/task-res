
let button = document.getElementById('delete');
const url = window.location.href;
const segments = url.split("/");
const lastSegment = segments[segments.length - 1];

button.addEventListener( 'click', ()=>{
    console.log('sddsdgdsg');
    fetch('/write/' + lastSegment, { method: 'DELETE' });
});