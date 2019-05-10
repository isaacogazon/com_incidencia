jQuery(document).ready(function ($) {
    moment.locale('es');
    alert('ssss');

    $('input').on('change', '#jform_tipo', function(){
        e.preventDefault();
        alert('cambia');
        var tipo = $('#jform_tipo').val();
        fechaFin(tipo);
    })

    function fechaFin(tipo){
        (tipo === 'Problema software')? $('#jform_fechafin').val(moment().add(3, 'days').format('DD-MM-YYYY HH:mm:ss')) : "";
        (tipo === 'Problema hardware')? $('#jform_fechafin').val(moment().add(4, 'days').format('DD-MM-YYYY HH:mm:ss')) : "";
        (tipo === 'Componente imperfecto')? $('#jform_fechafin').val(moment().add(5, 'days').format('DD-MM-YYYY HH:mm:ss')) : "";
        (tipo === 'Ninguna de las anteriores')? $('#jform_fechafin').val(moment().add(7, 'days').format('DD-MM-YYYY HH:mm:ss')) : "";

    }

});
    
