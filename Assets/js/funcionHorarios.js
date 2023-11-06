
$(document).ready(function() {
    
    //llenar datos por ajax de profesion 
    fntProfesionesHorario();
    fntServiciosHorario();
    cargaCalendario();
    
    
});

// abre modal para generar horarios
$("#btnGenerarHorario").click(function(){
    $('#modalFormGeneerarHorarios').modal();
});

//si hay evento en select se enlista los nombres en modal GENERAR HORARIO
$("#listProfesionGenHorid").change(function(){
    fntNombresHorario();
});
$("#listServicioGenHorId").change(function(){
    fntNombresHorario();
});

//si hay evento en select se enlista los nombres en modal ACTUALIZAR, AGREAGAR HORARIO
$("#listEditServicioid").change(function(){
    fntNombresEditModalPrincipalHorario(0);
});
$("#listEditProfesionid").change(function(){
    fntNombresEditModalPrincipalHorario(0);
});

//si hay evento en select se enlista los nombres en modal AGREGAR
$("#listAgregarServicioid").change(function(){
    fntNombresAgregarModalPrincipalHorario();
});
$("#listAgregarProfesionid").change(function(){
    fntNombresAgregarModalPrincipalHorario();
});

// si presionar AGREGAR en modal, guarda datos de nuevo horario

$("#btnAgregarModal").click(function(){
    fntGuardarEventoUnico();

    // $('#calendar').fullCalendar('renderEvent',nuevoEvento);
    $('#modalFormAgregarHorarios').modal('toggle');
    $("#formHorariosAgregar").trigger("reset");
});

// si presionar ELIMINAR en modal, guarda datos de nuevo horario
$("#btnBorrarModal").click(function(){
    let idRegistro = $('#idHoraTrabajoEdit').val();
    fntDelTurno(idRegistro);

    // $('#calendar').fullCalendar('renderEvent',nuevoEvento);
    $('#modalFormEditHorarios').modal('toggle');
    $("#formHorariosEdit").trigger("reset");
});

// si presionar MODIFICAR en modal, guarda datos de nuevo horario
$("#btnModificarModal").click(function(){

    fntModificarEventoUnico();

    // $('#calendar').fullCalendar('renderEvent',nuevoEvento);
    $('#modalFormEditHorarios').modal('toggle');
    $("#formHorariosEdit").trigger("reset");
});

// aparecer input dependiendo select en Form GENERAR
$('#listRangoDiasGenHorid').change(function(e) {
    switch($(this).val()){
        case "1":
            $("#divIntervaloAgregar").css("display", "none"); //esconde
            break;
        case "2":
            $("#divIntervaloAgregar").css("display", "block");
            $("#divIntervaloAgregar option[value=3]").hide();
            $("#divIntervaloAgregar option[value=4]").hide();
            $("#divIntervaloAgregar option[value=5]").hide();
            $("#divIntervaloAgregar option[value=6]").hide();
            $("#divIntervaloAgregar option[value=7]").hide();
            break;
        case "3":
            $("#divIntervaloAgregar").css("display", "block");
            $("#divIntervaloAgregar option[value=3]").show();            
            $("#divIntervaloAgregar option[value=4]").show();            
            $("#divIntervaloAgregar option[value=5]").show();            
            $("#divIntervaloAgregar option[value=6]").show();            
            $("#divIntervaloAgregar option[value=7]").show();            
            break;
    }
    
})

// si presionar GENERAR en modal, generar horarios segun datos introducidos
$("#btnGenerar").click(function(){
    $("#divIntervaloAgregar").css("display", "none"); //esconde
    fntGenerarAgregarHoraios();

    $('#modalFormGeneerarHorarios').modal('toggle');
    $("#formHorariosGenerar").trigger("reset");
});


//------------*****Funciones******-------------

//carga los datos de calendario
function cargaCalendario(){
    $('#calendar').fullCalendar({
        header: {
            left: 'prev,next,today',
            center: 'title',
            right: 'month,agendaWeek,agendaDay'
        },
        // defaultDate: '2023-08-09',
        buttonIcons: true,
        weekNumbers: false,
        editable: true,
        eventLimit: true,

        year: 'numeric', month: 'string', day: 'numeric',
        
        dayClick: function (date, jsEvent, view) {
            // alert('Has hecho click en: '+ date.format('h:mm'));
            $('#FechaInicialModalAgregar').val(date.format('DD/MM/YYYY'))
            $('#FechaFinModalAgregar').val(date.format('DD/MM/YYYY'))
            $('#HoraInicialModalAgregar').val("08:00")
            $('#HoraFianlModalAgregar').val("08:05")
            $('#modalFormAgregarHorarios').modal();
        }, 
        events: base_url + '/Horarios/getSelectHorarios',
        eventClick: function (calEvent, jsEvent, view) {
            // alert(Object.values(calEvent));
            $('#TituloModalEditLabel').text(calEvent.title);
            $('#idHoraTrabajoEdit').val(calEvent.IDFechaTrabajo);
            $('#listEditServicioid').val(calEvent.IDservicio);
            $('#listEditProfesionid').val(calEvent.IDTprofesion);
            fntNombresEditModalPrincipalHorario(calEvent.IDpersonalDS);

            $('#ObservacionesModalEdit').val(calEvent.Descripcion);
            $('#FechaInicialModalEdit').val(calEvent.start.format('DD/MM/YYYY'));
            $('#HoraInicialModalEdit').val(calEvent.start.format('HH:mm'));
      
            $('#FechaFinModalEdit').val(calEvent.end.format('DD/MM/YYYY'));
            $('#HoraFinalModalEdit').val(calEvent.end.format('HH:mm'));
            $('#ColorModalEdit').val(calEvent.color);
            // $('#listEditNombreid').selectpicker('render'); 
            $('#modalFormEditHorarios').modal();
        },
          
    });
};



// traer de BBDD las profesiones
function fntProfesionesHorario(){
    var ajaxUrl = base_url+'/Profesion/getSelectProfesiones';
    var request = (window.XMLHttpRequest)? new XMLHttpRequest() : new ActiveXObject("Microsoft.XMLHTTP");
    request.open("GET", ajaxUrl, true);
    request.send();
    
    request.onreadystatechange = function() {
      
        if(request.readyState == 4 && request.status ==200){
            
            document.querySelector('#listaProfesionesid').innerHTML = request.responseText;
            document.querySelector('#listProfesionGenHorid').innerHTML = request.responseText;
            document.querySelector('#listEditProfesionid').innerHTML = request.responseText;
            document.querySelector('#listAgregarProfesionid').innerHTML = request.responseText;
            document.querySelector('#listaProfesionesid').value = 0;
            document.querySelector('#listProfesionGenHorid').value = 0;
            document.querySelector('#listEditProfesionid').value = 0;
            document.querySelector('#listAgregarProfesionid').value = 0;
            // // $('#listProfesionid').selectpicker('render');       
        }
    }
}
// traer de BBDD los servicios
function fntServiciosHorario(){
    var request = (window.XMLHttpRequest)? new XMLHttpRequest(): new ActiveXObject("Microsoft.XMLHTTP");
    var ajaxUrl = base_url+"/Cama/getSelectServicios";
    
    request.open("GET",ajaxUrl,true);
    request.send();

    request.onreadystatechange = function(){
        if(request.readyState ==4 && request.status == 200){
            document.querySelector("#listaServiciosid").innerHTML=request.responseText;   
            document.querySelector("#listServicioGenHorId").innerHTML=request.responseText;   
            document.querySelector("#listEditServicioid").innerHTML=request.responseText;   
            document.querySelector("#listAgregarServicioid").innerHTML=request.responseText;   
            document.querySelector("#listaServiciosid").value = 0;   
            document.querySelector("#listServicioGenHorId").value = 0;   
            document.querySelector("#listEditServicioid").value = 0;   
            document.querySelector("#listAgregarServicioid").value = 0;   
        }
    }
}


//por evento en selects de servicio o profesional en modal se llama los nombres de bbdd
function fntNombresHorario(){
    var idServicio = document.querySelector("#listServicioGenHorId").value;
    var idProfesion = document.querySelector("#listProfesionGenHorid").value;
    console.log("servicio "+idServicio+ " Profesion "+idProfesion);
    var request = (window.XMLHttpRequest)? new XMLHttpRequest(): new ActiveXObject("Microsoft.XMLHTTP");
    var ajaxUrl = base_url+"/Horarios/getSelectNombres/"+idServicio+"/"+idProfesion;
    request.open("GET",ajaxUrl,true);
    request.send();

    request.onreadystatechange = function(){
        if(request.readyState ==4 && request.status == 200){
            
            document.querySelector("#listNombreGenHorid").innerHTML = request.responseText;
            document.querySelector("#listNombreGenHorid").value = 0;
            // $('#listNombreGenHorid').selectpicker('render');
            // console.log(request.responseText);
        }
    }

}

//por evento en selects de servicio o profesional en modal PRINCIPAL EDITAR Y BORRAR se llama los nombres de bbdd
function fntNombresEditModalPrincipalHorario(DSpersonalDS){
    var idServicio = document.querySelector("#listEditServicioid").value;
    var idProfesion = document.querySelector("#listEditProfesionid").value;
    console.log("servicio "+idServicio+ " Profesion "+idProfesion);
    var request = (window.XMLHttpRequest)? new XMLHttpRequest(): new ActiveXObject("Microsoft.XMLHTTP");
    var ajaxUrl = base_url+"/Horarios/getSelectNombres/"+idServicio+"/"+idProfesion;
    request.open("GET",ajaxUrl,true);
    request.send();

    request.onreadystatechange = function(){
        if(request.readyState ==4 && request.status == 200){
            
            // document.querySelector("#listNombreGenHorid").innerHTML = request.responseText;
            document.querySelector("#listEditNombreid").innerHTML = request.responseText;
            // document.querySelector("#listNombreGenHorid").value = 0;
            document.querySelector("#listEditNombreid").value = DSpersonalDS;
            // $('#listNombreGenHorid').selectpicker('render');
            // console.log(request.responseText);
        }
    }

}

//por evento en selects de servicio o profesional en modal PRINCIPAL AGREGAR se llama los nombres de bbdd
function fntNombresAgregarModalPrincipalHorario(){
    var idServicio = document.querySelector("#listAgregarServicioid").value;
    var idProfesion = document.querySelector("#listAgregarProfesionid").value;
    console.log("servicio "+idServicio+ " Profesion "+idProfesion);
    var request = (window.XMLHttpRequest)? new XMLHttpRequest(): new ActiveXObject("Microsoft.XMLHTTP");
    var ajaxUrl = base_url+"/Horarios/getSelectNombres/"+idServicio+"/"+idProfesion;
    request.open("GET",ajaxUrl,true);
    request.send();

    request.onreadystatechange = function(){
        if(request.readyState ==4 && request.status == 200){
            
            // document.querySelector("#listNombreGenHorid").innerHTML = request.responseText;
            document.querySelector("#listAgregarNombreid").innerHTML = request.responseText;
            // document.querySelector("#listNombreGenHorid").value = 0;
            document.querySelector("#listAgregarNombreid").value = 0;
            // $('#listNombreGenHorid').selectpicker('render');
            // console.log(request.responseText);
        }
    }

}




//Guardar datos de formulario de nuevo Horario (Formulario GUAARDAR model)
function fntGuardarEventoUnico(){
    var formAgregarUnicoHorario = document.querySelector("#formHorariosAgregar");

    // var intIdPersonalAgregar =$('#idPersonalAgregar').val();
    var intListAgregarServicioid =$('#listAgregarServicioid').val();
    var intIistAgregarProfesionid =$('#listAgregarProfesionid').val();
    var intListAgregarNombreid =$('#listAgregarNombreid').val();
    var strFechaInicialModalAgregar =$('#FechaInicialModalAgregar').val();
    var strHoraInicialModalAgregar =$('#HoraInicialModalAgregar').val();
    var strFechaFinModalAgregar =$('#FechaFinModalAgregar').val();
    var strHoraFianlModalAgregar =$('#HoraFianlModalAgregar').val();
    var strColorModalAgregar =$('#ColorModalAgregar').val();
    var strObservacionesModalAgregar =$('#ObservacionesModalAgregar').val();
    if(intListAgregarServicioid =='' ||intIistAgregarProfesionid =='' ||
     intListAgregarNombreid=='0' || strFechaInicialModalAgregar=='' || strHoraInicialModalAgregar=='' || 
     strFechaFinModalAgregar =='' || strHoraFianlModalAgregar ==''){
        
        swal("Atencion","Todos los campos son obligatorios","error");
        return false;
    }

    var request = (window.XMLHttpRequest)? new XMLHttpRequest(): new ActiveXObject("Microsoft.XMLHTTP");
    var ajaxUrl = base_url+"/Horarios/setFechaTurno";
    var formData = new FormData(formAgregarUnicoHorario);
    request.open("POST",ajaxUrl,true);
    request.send(formData);

    request.onreadystatechange = function(){  
        if(request.readyState == 4 && request.status == 200){
                var objData = JSON.parse(request.responseText);
            if(objData.status){
                $('#modalFormAgregarHorarios').modal('hide');
                formAgregarUnicoHorario.reset();
                swal("Horario",objData.msg,"success");
                $('#calendar').fullCalendar('refetchEvents');
            }else{
                swal("Error",objData.msg,"error")
            }
        }
    }
}

//ELIMINA datos de formulario de fehaTurno (Formulario EDIT model)
function fntDelTurno(idHoraTrabajoEdit){
    swal({
            title:"Eliminar Turno",
            text:"Esta seguro de eliminar?",
            type:"warning",
            showCancelButton:true,
            confirmButtonText:"Eliminar",
            cancelButtonText:"Cancelar",
            closeOnConfirm:false,
            closeOnCancel:true
    },function(isConfirm){
            if(isConfirm){
                    var request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject("Microsoft.XMLHTTP");
                    var ajaxUrl  = base_url+'/Horarios/delTurno/';
                    var strData = "idHoraTrabajoEdit="+idHoraTrabajoEdit;
                    request.open("POST",ajaxUrl,true);
                    request.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
                    request.send(strData);
                    // se espera respuesta de servidor a partir de mensaje
                    request.onreadystatechange = function() {
                            if(request.readyState == 4 && request.status == 200){
                                    // console.log(request.responseText);                                        
                                    var objData = JSON.parse(request.responseText);
                                    if(objData.status){
                                            swal("Eliminar!",objData.msg,"success");
                                            $('#modalFormEditHorarios').modal('hide');
                                            $('#calendar').fullCalendar('refetchEvents');
                                            
                                    }else{
                                            swal("Atencion",objData.msg,"error");
                                    }

                            }
                    }
            }
    });
}

//MOdifica o actualiza registro de fechaTurno( con formulario edit)
function fntModificarEventoUnico(){
    var formHorariosEditregistro = document.querySelector("#formHorariosEdit");

    var IntIdHoraTrabajoEdit =$('#idHoraTrabajoEdit').val();
    var intlistEditServicioid =$('#listEditServicioid').val();
    var intListEditProfesionid =$('#listEditProfesionid').val();
    var IntListEditNombreid =$('#listEditNombreid').val();
    var strFechaInicialModalEdit =$('#FechaInicialModalEdit').val();
    var strHoraInicialModalEdit =$('#HoraInicialModalEdit').val();
    var strFechaFinModalEdit =$('#FechaFinModalEdit').val();
    var strHoraFinalModalEdit =$('#HoraFinalModalEdit').val();
    var strColorModalEdit =$('#ColorModalEdit').val();
    var strObservacionesModalEdit =$('#ObservacionesModalEdit').val();
    if(IntIdHoraTrabajoEdit =='' || intlistEditServicioid =='' || intListEditProfesionid =='' ||
    IntListEditNombreid=='' || strFechaInicialModalEdit=='' || strHoraInicialModalEdit=='' || 
    strFechaFinModalEdit =='' || strHoraFinalModalEdit ==''){
        
        swal("Atencion","Todos los campos son obligatorios","error");
        return false;
    }

    var request = (window.XMLHttpRequest)? new XMLHttpRequest(): new ActiveXObject("Microsoft.XMLHTTP");
    var ajaxUrl = base_url+"/Horarios/updateFechaTurno";
    var formData = new FormData(formHorariosEditregistro);
    request.open("POST",ajaxUrl,true);
    request.send(formData);

    request.onreadystatechange = function(){  
        if(request.readyState == 4 && request.status == 200){
            // console.log(request.responseText);
                var objData = JSON.parse(request.responseText);
            if(objData.status){
                $('#modalFormEditHorarios').modal('hide');
                formHorariosEditregistro.reset();
                swal("Horario",objData.msg,"success");
                $('#calendar').fullCalendar('refetchEvents');
            }else{
                swal("Error",objData.msg,"error")
            }
        }
    }
}



// Genera y agregar HORARIOS a FechaTurno( con formulario generar)
function fntGenerarAgregarHoraios(){

    var formHorariosGenerar = document.querySelector("#formHorariosGenerar");
    
    var intListServicioGenHorId =$('#listServicioGenHorId').val();
    var intListProfesionGenHorid =$('#listProfesionGenHorid').val();
    var intListNombreGenHorid =$('#listNombreGenHorid').val();
    var intListRangoDiasGenHorid =$('#listRangoDiasGenHorid').val();
    var strFechaRangoModalGenHor =$('#FechaRangoModalGenHor').val();
    var strHoraInicioGenerarid =$('#HoraInicioGenerarid').val();
    var strHoraFinGenerarid =$('#HoraFinGenerarid').val();
    var intListIntervaloDiasGenHorid =$('#listIntervaloDiasGenHorid').val();
    
    var strColorModalAgregar =$('#ColorModalAgregar').val();
    var ObservacionesModalAgregar =$('#ObservacionesModalAgregar').val();

    if(intListServicioGenHorId =='' || intListProfesionGenHorid =='' || intListRangoDiasGenHorid =='' ||
    strFechaRangoModalGenHor=='' || strHoraInicioGenerarid=='' || strHoraFinGenerarid=='' || 
    intListIntervaloDiasGenHorid =='' || intListNombreGenHorid == '0'){
        
        swal("Atencion","Todos los campos son obligatorios","error");
        return false;
    }

    var request = (window.XMLHttpRequest)? new XMLHttpRequest(): new ActiveXObject("Microsoft.XMLHTTP");
    var ajaxUrl = base_url+"/Horarios/setGenerarHorariosFechaTurno";
    var formData = new FormData(formHorariosGenerar);
    request.open("POST",ajaxUrl,true);
    request.send(formData);

    request.onreadystatechange = function(){  
        if(request.readyState == 4 && request.status == 200){
            // console.log(request.responseText);
                var objData = JSON.parse(request.responseText);
            if(objData.status){
                $('#modalFormGeneerarHorarios').modal('hide');
                formHorariosGenerar.reset();
                swal("Horario",objData.msg,"success");
                $('#calendar').fullCalendar('refetchEvents');
            }else{
                swal("Error",objData.msg,"error")
            }
        }
    }

}

$("#FechaRangoModalGenHor").daterangepicker({
    "autoApply":true,
    locale: {
        format: 'DD/M/YYYY'
      }
});

$(".FechaUnica").daterangepicker({
    singleDatePicker: true,
    "autoApply":true,
    locale: {
        format: 'DD/M/YYYY'
      }
});

// despliega plugin de hora par su configiracion
jQuery(function($) {
    $('.clockpicker').clockpicker();
});