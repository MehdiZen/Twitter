window.onload = function() {
    let text = document.querySelector('textarea');
    let button = document.getElementById('button');
    button.addEventListener('click', function(e) { 
        result = text.value;
        console.log(result);
    });
}