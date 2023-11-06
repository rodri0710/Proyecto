// recupera datos de BBDD de tabla rol y la carga en tableServicio

var tableHabitaciones;
document.addEventListener("DOMContentLoaded", function(){
    tableHabitaciones = $("#tableHabitaciones").dataTable({
        "aProcessing": true,
        "aServerSide": true,
        "language":{
                "url":"//cdn.datatables.net/plug-ins/1.10.20/i18n/Spanish.json"
        },
        "ajax":{
                "url": " "+base_url+"/Habitacion/ObtenerHabitaciones",
                "dataSrc":""
       },
       "columns":[
        {"data":"IDcuarto"},
        {"data":"NombreDeCuarto"},
        {"data":"NombreDeServicio"},
        {"data":"Opciones"}
       ],
       'dom': 'lBfrtip',
        'buttons': [
            {
                "extend":"excelHtml5",
                "text": "<i class='fas fa-file-excel'></i> EXCEL",
                "titleAttr":"Exportar a Excel",
                "className":"btn btn-success",
                "title": 'Habitaciones'

            },
            {
                "extend":"pdfHtml5",
                "text": "<i class='fa-regular fa-file-pdf'></i> PDF",
                "titleAttr":"Exportar a PDF",
                "className":"btn btn-danger",
                "title": 'Habitaciones'
            }
        ],
       "resonsieve":"true",
       "bDestroy":true,
       "iDisplayLength":10,
       "order":[[0,"asc"]]
        });
        // captura datos del formulario usuario formUsuario
        var formHabitacion = document.querySelector('#formHabitacion');
        formHabitacion.onsubmit = function(e) {
            e.preventDefault();
            var cantHabitaciones = document.querySelector('#cantHabitaciones').value;
            var listServicioid = document.querySelector('#listServicioid').value;
            if(cantHabitaciones == "" || listServicioid ==""){
                swal("Atención","El campo cantidad de habitaciones debe ser llenado","error");
                return false;
            }

            var request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject("Microsoft.XMLHTTP");
            var ajaxUrl = base_url+"/Habitacion/setHabitaciones";
            var formData = new FormData(formHabitacion);
            request.open("POST", ajaxUrl,true);
            request.send(formData);
            request.onreadystatechange = function(){ 
                if(request.readyState==4 && request.status==200){
                    var objData = JSON.parse(request.responseText);
                    if(objData.status){
                        $('#modalFormHabitacion').modal('hide');
                        formHabitacion.reset();
                        swal("Habitación",objData.msg,"success");
                        tableHabitaciones.api().ajax.reload();
                    }else{
                        swal("Error",objData.mgs,"error");
                }
                }
            }
        }

        // captura datos del formulario usuario formServicioEdit para editar 
        var formHabitacionEdit = document.querySelector('#formHabitacionEdit');
        formHabitacionEdit.onsubmit = function(e) {
            e.preventDefault();
            var txtNombreEdit = document.querySelector('#txtNombreEdit').value;
            var txtIdEdit = document.querySelector('#txtIdEdit').value;
            if(txtNombreEdit == "" || txtIdEdit==""){
                swal("Atención","El campo nombre debe ser llenado","error");
                return false;
            }

            var request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject("Microsoft.XMLHTTP");
            var ajaxUrl = base_url+"/Habitacion/setHabitacion";
            var formData = new FormData(formHabitacionEdit);
            request.open("POST", ajaxUrl,true);
            request.send(formData);
            request.onreadystatechange = function(){ 
                if(request.readyState==4 && request.status==200){
                    var objData = JSON.parse(request.responseText);
                    if(objData.status){
                        $('#modalFormEditHabitacion').modal('hide');
                        formHabitacionEdit.reset();
                        swal("Habitación",objData.msg,"success");
                        tableHabitaciones.api().ajax.reload();
                    }else{
                        swal("Error",objData.mgs,"error");
                }
                }
            }
        }
});

// Agrega evento a botonVer y muestra datos en modal
function fntViewHabitacion(idHabitacion){
    var IDHabitacion = idHabitacion;
    var request = (window.XMLHttpRequest)? new XMLHttpRequest() : new ActiveXObject("Microsoft.XMLHTTP");
    var ajaxUrl = base_url+'/Habitacion/getHabitacion/'+IDHabitacion;
    request.open('GET', ajaxUrl, true);
    request.send();

    request.onreadystatechange = function() {
        if(request.readyState == 4 && request.status ==200){
            var objData = JSON.parse(request.responseText);
            if(objData.status){
                document.querySelector('#celIdentificacion').innerHTML = objData.msg.IDcuarto;
                document.querySelector('#celNombre').innerHTML = objData.msg.NombreDeCuarto;
                $('#modalViewHabitacion').modal('show');
            }else{
                swal("Error",objData.msg,"error");
            }
        }
    }
}

// Agrega evento a botonEdit y muestra datos en modal
function ftnEditHabitacion(idHabitacion){

    var IDHabitacion = idHabitacion;
    var request = (window.XMLHttpRequest)? new XMLHttpRequest() : new ActiveXObject("Microsoft.XMLHTTP");
    var ajaxUrl = base_url+'/Habitacion/getHabitacion/'+IDHabitacion;
    request.open('GET', ajaxUrl, true);
    request.send();

    request.onreadystatechange = function() {
        if(request.readyState == 4 && request.status ==200){
                var objData = JSON.parse(request.responseText);
                if(objData.status){
                    document.querySelector('#idHabitacionEdit').value = objData.msg.IDcuarto;
                    document.querySelector('#txtIdEdit').value = objData.msg.IDcuarto;
                    document.querySelector('#txtNombreEdit').value = objData.msg.NombreDeCuarto;

                }
            }
        $('#modalFormEditHabitacion').modal("show");
    }
   
}

//funcion que configura el boton de eliminar
function fntDelHabitacion(idHabitacion){
    var IDHabitacion = idHabitacion;
    swal({
            title:"Eliminar servicio",
            text:"Se eliminara habitaciones, camas y \nbaños pertenecientes a este servicio",
            type:"warning",
            showCancelButton:true,
            confirmButtonText:"Eliminar",
            cancelButtonText:"Cancelar",
            closeOnConfirm:false,
            closeOnCancel:true
    },function(isConfirm){
            if(isConfirm){
                    var request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject("Microsoft.XMLHTTP");
                    var ajaxUrl  = base_url+'/Habitacion/delHabitacion/';
                    var strData = "idHabitacion="+IDHabitacion;
                    request.open("POST",ajaxUrl,true);
                    request.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
                    request.send(strData);
                    // se espera respuesta de servidor a partir de mensaje
                    request.onreadystatechange = function() {
                            if(request.readyState == 4 && request.status == 200){
                                    console.log(request.responseText);                                        
                                    var objData = JSON.parse(request.responseText);
                                    if(objData.status){
                                            swal("Eliminar!",objData.msg,"success");
                                            tableHabitaciones.api().ajax.reload();
                                    }else{
                                            swal("Atencion",objData.msg,"error");
                                    }

                            }
                    }
            }
    });
   
}


//Ejecuta funcion cuando se abre ventana
window.addEventListener('load',function(){
    fntServiciosHabitacion();  // obtiene todos los servicios de BBDD
},false);

// funcion para obtener servicios que hace la peticion ajax
function fntServiciosHabitacion(){
    var ajaxUrl = base_url+'/Servicio/getSelectServicios';
    var request = (window.XMLHttpRequest)? new XMLHttpRequest() : new ActiveXObject("Microsoft.XMLHTTP");
    request.open("GET", ajaxUrl, true);
    request.send();

    request.onreadystatechange = function() {
        if(request.readyState == 4 && request.status ==200){
            document.querySelector('#listServicioid').innerHTML = request.responseText;
            // document.querySelector('#listServicioid').value = 1;
            $('#listServicioid').selectpicker('render');
        }   
    }
}

// click para abrir modal de nuevo usuario
$("#nuevoHabitacion").click(function(){
    document.querySelector('#idHabitacion').value = "";
    document.querySelector('#btnText').innerHTML = "Guardar";
    document.querySelector('#titleModal').innerHTML = "Nuevo habitación";
    document.querySelector('#formHabitacion').reset();
    $('#modalFormHabitacion').modal('show');
});