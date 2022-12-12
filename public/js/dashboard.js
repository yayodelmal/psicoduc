// $(document).ready(function () {
//     traerDatos();
// });

function traerDatos() {
    $.ajax({
        method: 'GET',
        url: '/traerFuncionariosUnidad',
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        crossDomain: true,
        dataType: 'text',
        data: {

        },

        success: function(result){

            var resultado = JSON.parse(result);
            procesaData(resultado["intervencion"]);

         },
        error: function(jqXHR, textStatus, errorThrown){
            console.log(errorThrown)
        }

    });
}

function procesaData(data){

    var unidades = [];
    var totalFuncionarios = [];

    for (var i = 0; i < data.length; i++) {

        var unidad = data[i].unidad;
        var total = data[i].total_funcionarios;

        unidades.push(unidad);
        totalFuncionarios.push(total);
    }

    const ctx = document.getElementById('myChart');

    new Chart(ctx, {
        type: 'doughnut',
        data: {
            labels: unidades,
            datasets: [{
                label: 'Cantidad de funcionarios',
                data: totalFuncionarios,
                borderWidth: 1,
                backgroundColor: ['#ffce56', '#cc65fe', '#ff6384', '#36a2eb']
            }]
        },
        options: {

        scales: {
            y: {
            beginAtZero: true
            }
        }
        }
    });

}

