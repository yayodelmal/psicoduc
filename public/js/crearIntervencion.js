$(document).ready(function () {
    cargar_meses();
});
   
function cargar_meses() {
const meses = ["Enero", "Febrero", "Marzo", "Abril", "Mayo", "Junio", "Julio", "Agosto", "Septiembre",
            "Octubre", "Noviembre", "Diciembre"];
            
    for (var index = 0; index <= meses.length-1; index++) {
    $('#mes').append('<option value="' + meses[index] + '">' + meses[index] + '</option>');
    }
}