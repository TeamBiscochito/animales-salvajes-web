function init() {
    var inputFile = document.getElementById('inputfile');
    inputFile.addEventListener('change', mostrarImagen, false);
}

function mostrarImagen(event) {
    var file = event.target.files[0];
    var reader = new FileReader();
    reader.onload = function (event) {
        var img = document.getElementById('imganimal');
        img.src = event.target.result;
    }
    reader.readAsDataURL(file);
}

window.addEventListener('load', init, false);
