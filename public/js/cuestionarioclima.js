$(document).ready(function () {
    //Traer preguntas de selección.
    printClimaTable();
    //Traer preguntas de desarrollo.
    printClimaDesarrollo();

});
var webservice = "http://localhost:8081";
//Preguntas
function printClimaTable() {
    const clima = {
        'data': [{
            'id': '01',
            'texto': 'En esta unidad los trabajos están bien definidos y organizados.',
            'inverso': false
        }, {
            'id': '02',
            'texto': 'En esta unidad no siempre está claro quién debe tomar las decisiones.',
            'inverso': true
        }, {
            'id': '03',
            'texto': 'Esta unidad se preocupa de que yo tenga claro su funcionamiento, en quienes recae la autoridad y cuáles son las tareas y responsabilidades de cada uno.',
            'inverso': false
        }, {
            'id': '04',
            'texto': 'En esta unidad no es necesario pedir permiso para hacer cada cosa.',
            'inverso': false
        },{
            'id': '05',
            'texto': 'Las ideas nuevas no se toman mucho en cuenta, debido a que existen demasiadas reglas, detalles administrativos y trámites que cumplir.',
            'inverso': true
        },{
            'id': '06',
            'texto': 'A veces trabajamos en forma desorganizada y sin planificación.',
            'inverso': true
        },{
            'id': '07',
            'texto': 'En algunas de las labores en que me he desempeñado, no he sabido exactamente quién era mi jefe directo.',
            'inverso': true
        },{
            'id': '08',
            'texto': 'Quienes dirigen esta unidad prefieren reunir a las personas más apropiadas para hacer un trabajo, aunque esto signifique cambiarlas de sus puestos habituales.',
            'inverso': false
        },{
            'id': '09',
            'texto': 'En esta unidad hay poca confianza en la responsabilidad individual respecto del trabajo.',
            'inverso': true
        },{
            'id': '10',
            'texto': 'Quienes dirigen esta unidad prefieren que si uno está haciendo bien las cosas, siga adelante con confianza en vez de coordinarlo.',
            'inverso': false
        },{
            'id': '11',
            'texto': 'En esta unidad los jefes dan las indicaciones generales de lo que se debe hacer y se le deja al personal la responsabilidad sobre el trabajo específico.',
            'inverso': false
        },{
            'id': '12',
            'texto': 'Para que un trabajo quede bien es necesario que sea hecho con audacia, responsabilidad e iniciativa.',
            'inverso': false
        },{
            'id': '13',
            'texto': 'Cuando se nos presentan problemas en el trabajo debemos resolverlos por sí solos y no recurrir necesariamente a los jefes.',
            'inverso': false
        },{
            'id': '14',
            'texto': 'Es común en esta unidad que los errores sean superados sólo con disculpas.',
            'inverso': true
        },{
            'id': '15',
            'texto': 'Uno de los problemas que tenemos es que la gente no asume las responsabilidades en el trabajo.',
            'inverso': true
        },{
            'id': '16',
            'texto': 'En esta unidad los que se desempeñan mejor en su trabajo pueden llegar a ocupar los mejores puestos.',
            'inverso': false
        },{
            'id': '17',
            'texto': 'En esta unidad existe mayor preocupación por destacar el trabajo bien hecho que el mal hecho.',
            'inverso': false
        },{
            'id': '18',
            'texto': 'En esta unidad mientras mejor sea el trabajo que se haga, mejor es el reconocimiento que se recibe.',
            'inverso': false
        },{
            'id': '19',
            'texto': 'En esta unidad existe una tendencia a ser más negativo que positivo.',
            'inverso': true
        },{
            'id': '20',
            'texto': 'En esta unidad no hay recompensa ni reconocimiento por el trabajo bien hecho.',
            'inverso': true
        },{
            'id': '21',
            'texto': 'En esta unidad los errores son sancionados.',
            'inverso': false
        },{
            'id': '22',
            'texto': 'En esta unidad se trabaja en forma lenta pero segura y sin riesgos.',
            'inverso': false
        },{
            'id': '23',
            'texto': 'Este esta unidad se ha desarrollado porque se arriesgó cuando fue necesario.',
            'inverso': false
        },{
            'id': '24',
            'texto': 'En esta unidad la toma de decisiones se hace en forma cautelosa para alcanzar los fines propuestos.',
            'inverso': true
        },{
            'id': '25',
            'texto': 'La dirección de esta unidad está dispuesta a correr los riesgos de una buena iniciativa.',
            'inverso': false
        },{
            'id': '26',
            'texto': 'Para que esta unidad sea superior a otros, a veces hay que correr grandes riesgos.',
            'inverso': false
        },{
            'id': '27',
            'texto': 'Entre el personal de esta unidad predomina un ambiente de amistad.',
            'inverso': false
        },{
            'id': '28',
            'texto': 'Esta unidad se caracteriza por un ambiente cómodo y relajado.',
            'inverso': false
        },{
            'id': '29',
            'texto': 'En esta unidad cuesta mucho llegar a tener amigos.',
            'inverso': true
        },{
            'id': '30',
            'texto': 'En esta unidad la mayoría de las personas es indiferente hacia los demás.',
            'inverso': true
        },{
            'id': '31',
            'texto': 'En esta unidad existen relaciones humanas entre la administración y el personal.',
            'inverso': false
        },{
            'id': '32',
            'texto': 'En esta unidad los jefes son poco comprensivos cuando se comete un error.',
            'inverso': true
        },{
            'id': '33',
            'texto': 'En esta unidad la administración se esfuerza por conocer las aspiraciones de cada uno.',
            'inverso': false
        },{
            'id': '34',
            'texto': 'En esta unidad no existe mucha confianza entre superior y subordinado.',
            'inverso': true
        },{
            'id': '35',
            'texto': 'La administración de esta unidad muestra interés por las personas, por sus problemas e inquietudes.',
            'inverso': false
        },{
            'id': '36',
            'texto': 'En esta unidad cuando tengo que hacer un trabajo difícil puedo contar con la ayuda de mi jefe y mis compañeros.',
            'inverso': false
        },{
            'id': '37',
            'texto': 'En esta unidad, se nos exige un rendimiento muy alto en nuestro trabajo.',
            'inverso': false
        },{
            'id': '38',
            'texto': 'Para la administración de esta unidad toda tarea puede ser mejor hecha.',
            'inverso': false
        },{
            'id': '39',
            'texto': 'En esta unidad la jefatura continuamente insiste que mejoremos nuestro trabajo individual y en grupo.',
            'inverso': false
        },{
            'id': '40',
            'texto': 'Esta unidad mejorará el rendimiento por sí solo cuando los trabajadores estén contentos.',
            'inverso': false
        },{
            'id': '41',
            'texto': 'En esta unidad se valoran más las características personales del trabajador que su rendimiento en el trabajo.',
            'inverso': true
        },{
            'id': '42',
            'texto': 'En esta unidad las personas parecen darle mucha importancia al hecho de hacer bien su trabajo.',
            'inverso': false
        },{
            'id': '43',
            'texto': 'En esta unidad, la mejor manera de causar una buena impresión es evitar las discusiones y los desacuerdos.',
            'inverso': true
        },{
            'id': '44',
            'texto': 'La dirección estima que las discrepancias entre las distintas secciones y personas pueden ser útiles para esta unidad.',
            'inverso': false
        },{
            'id': '45',
            'texto': 'En esta unidad se nos alienta para que digamos lo que pensamos, aunque estemos en desacuerdo con nuestros jefes.',
            'inverso': false
        },{
            'id': '46',
            'texto': 'En esta unidad no se toman en cuenta las distintas opiniones para llegar a un acuerdo.',
            'inverso': true
        },{
            'id': '47',
            'texto': 'Las personas están satisfechas de estar en esta unidad',
            'inverso': false
        },{
            'id': '48',
            'texto': 'Siento que pertenezco a un grupo de trabajo que funciona bien.',
            'inverso': false
        },{
            'id': '49',
            'texto': 'Hasta donde yo me doy cuenta existe lealtad hacia esta unidad.',
            'inverso': false
        },{
            'id': '50',
            'texto': 'En esta unidad la mayoría de las personas están más preocupadas de sus propios intereses.',
            'inverso': true
        },{
            'id': '51.1',
            'texto': 'Mi Jefatura directa Dr. Vasquez se comunica de forma adecuada sin intención de perjudicarme.',
            'inverso': false
        },{
            'id': '51.2',
            'texto': 'Jefatura Dra. Pino se comunica de forma adecuada sin intención de perjudicarme.',
            'inverso': false
        },{
            'id': '52.1',
            'texto': 'Mi jefatura directa se preocupa de generar un ambiente laboral positivo.',
            'inverso': false
        },{
            'id': '52.2',
            'texto': 'Jefatura Dra. Pino se preocupa de generar un ambiente laboral positivo.',
            'inverso': false
        },{
            'id': '53.1',
            'texto': 'Mi jefatura directa establece canales de retroalimentación de las actividades que realizo habitualmente.',
            'inverso': false
        },{
            'id': '53.2',
            'texto': 'Mi jefatura Dra. Pino establece canales de retroalimentación de las actividades que realizo habitualmente.',
            'inverso': false
        },{
            'id': '54.1',
            'texto': 'Mi jefatura directa es capaz de tomar decisiones apropiadas cuando algo ocurre mal dentro de esta unidad.',
            'inverso': false
        },{
            'id': '54.2',
            'texto': 'Mi jefatura Dra. Pino es capaz de tomar decisiones apropiadas cuando algo ocurre mal dentro de esta unidad.',
            'inverso': false
        },{
            'id': '55.1',
            'texto': 'Mi jefatura directa es capaz de delegarme una tarea sin estar constantemente supervisando mi desempeño.',
            'inverso': false
        },{
            'id': '55.2',
            'texto': 'Mi jefatura Dra. Pino es capaz de delegarme una tarea sin estar constantemente supervisando mi desempeño.',
            'inverso': false
        },{
            'id': '56.1',
            'texto': 'Mi jefatura directa es capaz de motivarnos y apoyarnos para lograr nuestros objetivos como unidad.',
            'inverso': false
        },{
            'id': '56.2',
            'texto': 'Mi jefatura Dra. Pino es capaz de motivarnos y apoyarnos para lograr nuestros objetivos como unidad.',
            'inverso': false
        },{
            'id': '57.1',
            'texto': 'Mi jefatura directa logra adaptarse y cumplir sus funciones de líder en las diversas situaciones de nuestra unidad.',
            'inverso': false
        },{
            'id': '57.2',
            'texto': 'Mi jefatura Dra. Pino logra adaptarse y cumplir sus funciones de líder en las diversas situaciones de nuestra unidad.',
            'inverso': false
        },{
            'id': '58.1',
            'texto': 'Yo considero que mi jefe directo es una persona que me representa.',
            'inverso': false
        },{
            'id': '58.2',
            'texto': 'Yo considero que mi jefe Dra. Pino es una persona que me representa.',
            'inverso': false
        },{
            'id': '59.1',
            'texto': 'Considero que mi jefe directo se preocupa de  mi desarrollo profesional.',
            'inverso': false
        },{
            'id': '59.2',
            'texto': 'Considero que mi jefe Dra. Pino se preocupa de  mi desarrollo profesional.',
            'inverso': false
        },{
            'id': '60.1',
            'texto': 'Mi jefatura directa es una persona constante y responsable en su labor.',
            'inverso': false
        },{
            'id': '60.2',
            'texto': 'Mi jefatura Dra. Pino es una persona constante y responsable en su labor.',
            'inverso': false
        }]
    };

    var trData = '';
    
    for (let i = 0; i < clima.data.length; i++) {
        var id_pregunta = clima.data[i].id;
        var inverso = clima.data[i].inverso;

        trData += 
            '<tr class="text-center">' +
            '<td><strong>' + clima.data[i].id + '</strong></td>' +
            '<td class="text-sm-start">' + clima.data[i].texto + '</td>'

            +
            '<td class="align-middle"><div class="">' +
            '<input class="form-check-input" type="radio" id="p' + cambiarPuntoPorGuionBajo(id_pregunta) + '" name="p' + cambiarPuntoPorGuionBajo(id_pregunta) + '" value="'+ escalaInversa(inverso, 1) +'">' +
            '<div class=""><label></label></div>' +
            '</div></td>'

            +
            '<td class="align-middle"><div class="">' +
            '<input class="form-check-input" type="radio" id="p' + cambiarPuntoPorGuionBajo(id_pregunta) + '" name="p' + cambiarPuntoPorGuionBajo(id_pregunta) + '" value="'+ escalaInversa(inverso, 2) +'">' +
            '<div class=""><label></label></div>' +
            '</div></td>'

            +
            '<td class="align-middle"><div class="">' +
            '<input class="form-check-input" type="radio" id="p' + cambiarPuntoPorGuionBajo(id_pregunta) + '" name="p' + cambiarPuntoPorGuionBajo(id_pregunta) + '" value="'+ escalaInversa(inverso, 3) +'">' +
            '<div class=""><label></label></div>' +
            '</div></td>'

            +
            '<td class="align-middle"><div class="">' +
            '<input class="form-check-input" type="radio" id="p' + cambiarPuntoPorGuionBajo(id_pregunta) + '" name="p' + cambiarPuntoPorGuionBajo(id_pregunta) + '" value="'+ escalaInversa(inverso, 4) +'">' +
            '<div class=""><label></label></div>' +
            '</div></td>' +
            '</tr>';
    }
    $('#clima-tbody').append(trData);
    
    //$("#tableclima").find("input").attr("disabled", "disabled");
    //$("#tableclima").find("input").attr("hidden", "hidden");
}

//Preguntas de desarrollo
function printClimaDesarrollo(){

    const desarrollo = {
        'data': [{
                'id': '01',
                'texto': '¿Cuáles son las principales fortalezas del equipo?'
            },{
                'id': '02',
                'texto': '¿Cuáles son los principales aspectos que debería mejorar el equipo?'
            },{
                'id': '03',
                'texto': '¿Qué ideas propone usted para abordar los aspectos a mejorar?'
            },{
                'id': '04',
                'texto': '¿Hay algo más que desea agregar?'
            }]

    };

    var trData2 = '';

    for (let i = 0; i < desarrollo.data.length; i++) {
    
        trData2 += 
        //Pega de html de como quiero ver las preguntas de desarrollo
        '<div class="mb-3">'+
            '<label for="'+ desarrollo.data[i].id +'" class="form-label">'+ desarrollo.data[i].texto +'</label>'+
            '<textarea class="form-control" id="pd_'+ desarrollo.data[i].id +'" rows="3"></textarea>'+
        '</div>';
    }
    
    $('#desarrollo-tbody').append(trData2);
}

function cambiarPuntoPorGuionBajo(id_pregunta){
    
    if(id_pregunta.includes('.')){
        id_pregunta = id_pregunta.replace('.', '_')
        return id_pregunta;
    }else{
        return id_pregunta;
    }
}

function escalaInversa(inverso, opcion){

    switch(opcion){
        case 1:
            if(inverso == false){
                return inverso = 1;
            }
            if(inverso == true){
                return inverso = 4;
            }
        break;

        case 2:
            if(inverso == false){
                return inverso = 2;
            }
            if(inverso == true){
                return inverso = 3;
            }
        break;

        case 3:
            if(inverso == false){
                return inverso = 3;
            }
            if(inverso == true){
                return inverso = 2;
            }
        break;

        case 4:
            if(inverso == false){
                return inverso = 4;
            }
            if(inverso == true){
                return inverso = 1;
            }
        break;
    }
}

//Calcular algunos datos antes de guardar
function calcularPromedioS1(){

    var total_s1 = 0;
    var promedio = 0;

    total_s1 += $('input[name="p01"]').is(':checked') ? parseInt($('input[name="p01"]:checked').val()) : 0;
    total_s1 += $('input[name="p02"]').is(':checked') ? parseInt($('input[name="p02"]:checked').val()) : 0;
    total_s1 += $('input[name="p03"]').is(':checked') ? parseInt($('input[name="p03"]:checked').val()) : 0;
    total_s1 += $('input[name="p04"]').is(':checked') ? parseInt($('input[name="p04"]:checked').val()) : 0;
    total_s1 += $('input[name="p05"]').is(':checked') ? parseInt($('input[name="p05"]:checked').val()) : 0;
    total_s1 += $('input[name="p06"]').is(':checked') ? parseInt($('input[name="p06"]:checked').val()) : 0;
    total_s1 += $('input[name="p07"]').is(':checked') ? parseInt($('input[name="p07"]:checked').val()) : 0;
    total_s1 += $('input[name="p08"]').is(':checked') ? parseInt($('input[name="p08"]:checked').val()) : 0;
    total_s1 += $('input[name="p09"]').is(':checked') ? parseInt($('input[name="p09"]:checked').val()) : 0;
    total_s1 += $('input[name="p10"]').is(':checked') ? parseInt($('input[name="p10"]:checked').val()) : 0;
    total_s1 += $('input[name="p11"]').is(':checked') ? parseInt($('input[name="p11"]:checked').val()) : 0;
    total_s1 += $('input[name="p12"]').is(':checked') ? parseInt($('input[name="p12"]:checked').val()) : 0;
    total_s1 += $('input[name="p13"]').is(':checked') ? parseInt($('input[name="p13"]:checked').val()) : 0;
    total_s1 += $('input[name="p14"]').is(':checked') ? parseInt($('input[name="p14"]:checked').val()) : 0;
    total_s1 += $('input[name="p15"]').is(':checked') ? parseInt($('input[name="p15"]:checked').val()) : 0;
    total_s1 += $('input[name="p16"]').is(':checked') ? parseInt($('input[name="p16"]:checked').val()) : 0;
    total_s1 += $('input[name="p17"]').is(':checked') ? parseInt($('input[name="p17"]:checked').val()) : 0;
    total_s1 += $('input[name="p18"]').is(':checked') ? parseInt($('input[name="p18"]:checked').val()) : 0;
    total_s1 += $('input[name="p19"]').is(':checked') ? parseInt($('input[name="p19"]:checked').val()) : 0;
    total_s1 += $('input[name="p20"]').is(':checked') ? parseInt($('input[name="p20"]:checked').val()) : 0;
    total_s1 += $('input[name="p21"]').is(':checked') ? parseInt($('input[name="p21"]:checked').val()) : 0;
    total_s1 += $('input[name="p22"]').is(':checked') ? parseInt($('input[name="p22"]:checked').val()) : 0;
    total_s1 += $('input[name="p23"]').is(':checked') ? parseInt($('input[name="p23"]:checked').val()) : 0;
    total_s1 += $('input[name="p24"]').is(':checked') ? parseInt($('input[name="p24"]:checked').val()) : 0;
    total_s1 += $('input[name="p25"]').is(':checked') ? parseInt($('input[name="p25"]:checked').val()) : 0;
    total_s1 += $('input[name="p26"]').is(':checked') ? parseInt($('input[name="p26"]:checked').val()) : 0;
    total_s1 += $('input[name="p27"]').is(':checked') ? parseInt($('input[name="p27"]:checked').val()) : 0;
    total_s1 += $('input[name="p28"]').is(':checked') ? parseInt($('input[name="p28"]:checked').val()) : 0;
    total_s1 += $('input[name="p29"]').is(':checked') ? parseInt($('input[name="p29"]:checked').val()) : 0;
    total_s1 += $('input[name="p30"]').is(':checked') ? parseInt($('input[name="p30"]:checked').val()) : 0;
    total_s1 += $('input[name="p31"]').is(':checked') ? parseInt($('input[name="p31"]:checked').val()) : 0;
    total_s1 += $('input[name="p32"]').is(':checked') ? parseInt($('input[name="p32"]:checked').val()) : 0;
    total_s1 += $('input[name="p33"]').is(':checked') ? parseInt($('input[name="p33"]:checked').val()) : 0;
    total_s1 += $('input[name="p34"]').is(':checked') ? parseInt($('input[name="p34"]:checked').val()) : 0;
    total_s1 += $('input[name="p35"]').is(':checked') ? parseInt($('input[name="p35"]:checked').val()) : 0;
    total_s1 += $('input[name="p36"]').is(':checked') ? parseInt($('input[name="p36"]:checked').val()) : 0;
    total_s1 += $('input[name="p37"]').is(':checked') ? parseInt($('input[name="p37"]:checked').val()) : 0;
    total_s1 += $('input[name="p38"]').is(':checked') ? parseInt($('input[name="p38"]:checked').val()) : 0;
    total_s1 += $('input[name="p39"]').is(':checked') ? parseInt($('input[name="p39"]:checked').val()) : 0;
    total_s1 += $('input[name="p40"]').is(':checked') ? parseInt($('input[name="p40"]:checked').val()) : 0;
    total_s1 += $('input[name="p41"]').is(':checked') ? parseInt($('input[name="p41"]:checked').val()) : 0;
    total_s1 += $('input[name="p42"]').is(':checked') ? parseInt($('input[name="p42"]:checked').val()) : 0;
    total_s1 += $('input[name="p43"]').is(':checked') ? parseInt($('input[name="p43"]:checked').val()) : 0;
    total_s1 += $('input[name="p44"]').is(':checked') ? parseInt($('input[name="p44"]:checked').val()) : 0;
    total_s1 += $('input[name="p45"]').is(':checked') ? parseInt($('input[name="p45"]:checked').val()) : 0;
    total_s1 += $('input[name="p46"]').is(':checked') ? parseInt($('input[name="p46"]:checked').val()) : 0;
    total_s1 += $('input[name="p47"]').is(':checked') ? parseInt($('input[name="p47"]:checked').val()) : 0;
    total_s1 += $('input[name="p48"]').is(':checked') ? parseInt($('input[name="p48"]:checked').val()) : 0;
    total_s1 += $('input[name="p49"]').is(':checked') ? parseInt($('input[name="p49"]:checked').val()) : 0;
    total_s1 += $('input[name="p50"]').is(':checked') ? parseInt($('input[name="p50"]:checked').val()) : 0;

    promedio = (total_s1 / 50);
    return promedio;
}

function calcularPromedioS2(){
    var total_s2 = 0;
    var promedio = 0;

    total_s2 += $('input[name="p51_1"]').is(':checked') ? parseInt($('input[name="p51_1"]:checked').val()) : 0;
    total_s2 += $('input[name="p51_2"]').is(':checked') ? parseInt($('input[name="p51_2"]:checked').val()) : 0;
    total_s2 += $('input[name="p52_1"]').is(':checked') ? parseInt($('input[name="p52_1"]:checked').val()) : 0;
    total_s2 += $('input[name="p52_2"]').is(':checked') ? parseInt($('input[name="p52_2"]:checked').val()) : 0;
    total_s2 += $('input[name="p53_1"]').is(':checked') ? parseInt($('input[name="p53_1"]:checked').val()) : 0;
    total_s2 += $('input[name="p53_2"]').is(':checked') ? parseInt($('input[name="p53_2"]:checked').val()) : 0;
    total_s2 += $('input[name="p54_1"]').is(':checked') ? parseInt($('input[name="p54_1"]:checked').val()) : 0;
    total_s2 += $('input[name="p54_2"]').is(':checked') ? parseInt($('input[name="p54_2"]:checked').val()) : 0;
    total_s2 += $('input[name="p55_1"]').is(':checked') ? parseInt($('input[name="p55_1"]:checked').val()) : 0;
    total_s2 += $('input[name="p55_2"]').is(':checked') ? parseInt($('input[name="p55_2"]:checked').val()) : 0;
    total_s2 += $('input[name="p56_1"]').is(':checked') ? parseInt($('input[name="p56_1"]:checked').val()) : 0;
    total_s2 += $('input[name="p56_2"]').is(':checked') ? parseInt($('input[name="p56_2"]:checked').val()) : 0;
    total_s2 += $('input[name="p57_1"]').is(':checked') ? parseInt($('input[name="p57_1"]:checked').val()) : 0;
    total_s2 += $('input[name="p57_2"]').is(':checked') ? parseInt($('input[name="p57_2"]:checked').val()) : 0;
    total_s2 += $('input[name="p58_1"]').is(':checked') ? parseInt($('input[name="p58_1"]:checked').val()) : 0;
    total_s2 += $('input[name="p58_2"]').is(':checked') ? parseInt($('input[name="p58_2"]:checked').val()) : 0;
    total_s2 += $('input[name="p59_1"]').is(':checked') ? parseInt($('input[name="p59_1"]:checked').val()) : 0;
    total_s2 += $('input[name="p59_2"]').is(':checked') ? parseInt($('input[name="p59_2"]:checked').val()) : 0;
    total_s2 += $('input[name="p60_1"]').is(':checked') ? parseInt($('input[name="p60_1"]:checked').val()) : 0;
    total_s2 += $('input[name="p60_2"]').is(':checked') ? parseInt($('input[name="p60_2"]:checked').val()) : 0;

    promedio = (total_s2 / 20);
    return promedio;
}

function calcularDesSS2(){
    
    //Variables
    var media = calcularPromedioS2();
    var n = 20; 
    var sumatoria = 0;
    var varianza = 0;
    var desviacion = 0;
    var respuestas = [];

    respuestas.push($('input[name="p51_1"]').is(':checked') ? parseInt($('input[name="p51_1"]:checked').val()) : 0);
    respuestas.push($('input[name="p51_2"]').is(':checked') ? parseInt($('input[name="p51_2"]:checked').val()) : 0);
    respuestas.push($('input[name="p52_1"]').is(':checked') ? parseInt($('input[name="p52_1"]:checked').val()) : 0);
    respuestas.push($('input[name="p52_2"]').is(':checked') ? parseInt($('input[name="p52_2"]:checked').val()) : 0);
    respuestas.push($('input[name="p53_1"]').is(':checked') ? parseInt($('input[name="p53_1"]:checked').val()) : 0);
    respuestas.push($('input[name="p53_2"]').is(':checked') ? parseInt($('input[name="p53_2"]:checked').val()) : 0);
    respuestas.push($('input[name="p54_1"]').is(':checked') ? parseInt($('input[name="p54_1"]:checked').val()) : 0);
    respuestas.push($('input[name="p54_2"]').is(':checked') ? parseInt($('input[name="p54_2"]:checked').val()) : 0);
    respuestas.push($('input[name="p55_1"]').is(':checked') ? parseInt($('input[name="p55_1"]:checked').val()) : 0);
    respuestas.push($('input[name="p55_2"]').is(':checked') ? parseInt($('input[name="p55_2"]:checked').val()) : 0);
    respuestas.push($('input[name="p56_1"]').is(':checked') ? parseInt($('input[name="p56_1"]:checked').val()) : 0);
    respuestas.push($('input[name="p56_2"]').is(':checked') ? parseInt($('input[name="p56_2"]:checked').val()) : 0);
    respuestas.push($('input[name="p57_1"]').is(':checked') ? parseInt($('input[name="p57_1"]:checked').val()) : 0);
    respuestas.push($('input[name="p57_2"]').is(':checked') ? parseInt($('input[name="p57_2"]:checked').val()) : 0);
    respuestas.push($('input[name="p58_1"]').is(':checked') ? parseInt($('input[name="p58_1"]:checked').val()) : 0);
    respuestas.push($('input[name="p58_2"]').is(':checked') ? parseInt($('input[name="p58_2"]:checked').val()) : 0);
    respuestas.push($('input[name="p59_1"]').is(':checked') ? parseInt($('input[name="p59_1"]:checked').val()) : 0);
    respuestas.push($('input[name="p59_2"]').is(':checked') ? parseInt($('input[name="p59_2"]:checked').val()) : 0);
    respuestas.push($('input[name="p60_1"]').is(':checked') ? parseInt($('input[name="p60_1"]:checked').val()) : 0);
    respuestas.push($('input[name="p60_2"]').is(':checked') ? parseInt($('input[name="p60_2"]:checked').val()) : 0);
    
    //Calcular la varianza
    for(var i = 0; i<n; i++ ){
        sumatoria = Math.pow(respuestas[i] - media, 2);
        varianza = varianza + sumatoria;
    }

    varianza = (varianza/(n - 1));

    //Calcular la desviación
    desviacion = Math.sqrt(varianza);
    desviacion = desviacion.toFixed(9);  

    return desviacion;
}

//Hacer un Ajax para almacenar el cuestionario en BD.
//Esta hueá no funciona ctmmmmmm me quiero morir
function guardarRespuestasClima() {
    $.ajax({
        method: 'POST',
        url: webservice + '/guardar/cuestionario/clima',
        headers: {
            
        },
        crossDomain: true,
        dataType: 'text',
        data: {
            //_token: $('meta[name="csrf-token"]').attr('content'),
            //Enviar 
            //Email, id_curso

            //Preguntas de sexo y edad.
            genero: $("input[name='genero']:checked").val(),
            edad: $("#edad").val(),

            //Preguntas Normales.
            p01: $("input[name='p01']:checked").val(),
            p02: $("input[name='p02']:checked").val(),
            p03: $("input[name='p03']:checked").val(),
            p04: $("input[name='p04']:checked").val(),
            p05: $("input[name='p05']:checked").val(),
            p06: $("input[name='p06']:checked").val(),
            p07: $("input[name='p07']:checked").val(),
            p08: $("input[name='p08']:checked").val(),
            p09: $("input[name='p09']:checked").val(),
            p10: $("input[name='p10']:checked").val(),
            p11: $("input[name='p11']:checked").val(),
            p12: $("input[name='p12']:checked").val(),
            p13: $("input[name='p13']:checked").val(),
            p14: $("input[name='p14']:checked").val(),
            p15: $("input[name='p15']:checked").val(),
            p16: $("input[name='p16']:checked").val(),
            p17: $("input[name='p17']:checked").val(),
            p18: $("input[name='p18']:checked").val(),
            p19: $("input[name='p19']:checked").val(),
            p20: $("input[name='p20']:checked").val(),
            p21: $("input[name='p21']:checked").val(),
            p22: $("input[name='p22']:checked").val(),
            p23: $("input[name='p23']:checked").val(),
            p24: $("input[name='p24']:checked").val(),
            p25: $("input[name='p25']:checked").val(),
            p26: $("input[name='p26']:checked").val(),
            p27: $("input[name='p27']:checked").val(),
            p28: $("input[name='p28']:checked").val(),
            p29: $("input[name='p29']:checked").val(),
            p30: $("input[name='p30']:checked").val(),
            p31: $("input[name='p31']:checked").val(),
            p32: $("input[name='p32']:checked").val(),
            p33: $("input[name='p33']:checked").val(),
            p34: $("input[name='p34']:checked").val(),
            p35: $("input[name='p35']:checked").val(),
            p36: $("input[name='p36']:checked").val(),
            p37: $("input[name='p37']:checked").val(),
            p38: $("input[name='p38']:checked").val(),
            p39: $("input[name='p39']:checked").val(),
            p40: $("input[name='p40']:checked").val(),
            p41: $("input[name='p41']:checked").val(),
            p42: $("input[name='p42']:checked").val(),
            p43: $("input[name='p43']:checked").val(),
            p44: $("input[name='p44']:checked").val(),
            p45: $("input[name='p45']:checked").val(),
            p46: $("input[name='p46']:checked").val(),
            p47: $("input[name='p47']:checked").val(),
            p48: $("input[name='p48']:checked").val(),
            p49: $("input[name='p49']:checked").val(),
            p50: $("input[name='p50']:checked").val(),
            
            //Preguntas de liderazgo.
            p51_1: $("input[name='p51_1']:checked").val(),
            p51_2: $("input[name='p51_2']:checked").val(),
            p52_1: $("input[name='p52_1']:checked").val(),
            p52_2: $("input[name='p52_2']:checked").val(),
            p53_1: $("input[name='p53_1']:checked").val(),
            p53_2: $("input[name='p53_2']:checked").val(),
            p54_1: $("input[name='p54_1']:checked").val(),
            p54_2: $("input[name='p54_2']:checked").val(),
            p55_1: $("input[name='p55_1']:checked").val(),
            p55_2: $("input[name='p55_2']:checked").val(),
            p56_1: $("input[name='p56_1']:checked").val(),
            p56_2: $("input[name='p56_2']:checked").val(),
            p57_1: $("input[name='p57_1']:checked").val(),
            p57_2: $("input[name='p57_2']:checked").val(),
            p58_1: $("input[name='p58_1']:checked").val(),
            p58_2: $("input[name='p58_2']:checked").val(),
            p59_1: $("input[name='p59_1']:checked").val(),
            p59_2: $("input[name='p59_2']:checked").val(),
            p60_1: $("input[name='p60_1']:checked").val(),
            p60_2: $("input[name='p60_2']:checked").val(),

            //Preguntas de desarrollo.
            pd_01: $("#pd_01").val(),
            pd_02: $("#pd_02").val(),
            pd_03: $("#pd_03").val(),
            pd_04: $("#pd_04").val(),

            //Cálculos
            s1_promedio: calcularPromedioS1(),
            s2_promedio: calcularPromedioS2(),
            s2_des_estandard: calcularDesSS2()
            
        },

        success: function(result){
            console.log(result);
         },
        error: function(jqXHR, textStatus, errorThrown){
            console.log(errorThrown)
        }

    });
}




