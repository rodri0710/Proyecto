// recupera datos de BBDD de tabla Camas y la carga en tableCamas

var tableCamas;
document.addEventListener("DOMContentLoaded", function(){
    tableCamas = $("#tableCamas").dataTable({
        "aProcessing": true,
        "aServerSide": true,
        "language":{
                "url":"//cdn.datatables.net/plug-ins/1.10.20/i18n/Spanish.json"
        },
        "ajax":{
                "url": " "+base_url+"/Cama/ObtenerCamas",
                "dataSrc":""
       },
       "columns":[
        {"data":"IDcama"},
        {"data":"NombreDeCama"},
        {"data":"NombreDeCuarto"},
        {"data":"NombreDeServicio"},
        {"data":"CodFisico"},
        {"data":"Opciones"}
       ], 
       'dom': 'lBfrtip',
        'buttons': [
            {
                "extend":"excelHtml5",
                "text": "<i class='fas fa-file-excel'></i> EXCEL",
                "titleAttr":"Exportar a Excel",
                "className":"btn btn-success",
                "title": 'Camas'

            },
            {
                "extend":"pdfHtml5",
                "text": "<i class='fa-regular fa-file-pdf'></i> PDF",
                "titleAttr":"Exportar a PDF",
                "className":"btn btn-danger",
                "title": 'Camas'
            }
        ],
       "resonsieve":"true",
       "bDestroy":true,
       "iDisplayLength":10,
       "order":[[0,"asc"]]
        });
        // captura datos de cama del formulario formUsuario
        var formCama = document.querySelector('#formCama');
        formCama.onsubmit = function(e) {
            e.preventDefault();
            var listServicioid = document.querySelector('#listServicioid').value;
            var listHabitacionid = document.querySelector('#listHabitacionid').value;
            var cantCamas = document.querySelector('#cantCamas').value;
            if(cantCamas == "" || listServicioid == 0 || listHabitacionid == "" ){
                swal("Atención","Todos los campos son obligatorios","error");
                return false;
            }

            var request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject("Microsoft.XMLHTTP");
            var ajaxUrl = base_url+"/Cama/setCamas";
            var formData = new FormData(formCama);
            request.open("POST", ajaxUrl,true);
            request.send(formData);
            request.onreadystatechange = function(){ 
                if(request.readyState==4 && request.status==200){
                    var objData = JSON.parse(request.responseText);
                    if(objData.status){
                        $('#modalFormCama').modal('hide');
                        formCama.reset();
                        swal("Cama",objData.msg,"success");
                        tableCamas.api().ajax.reload();
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
                        swal("Sanitario",objData.msg,"success");
                        tableHabitaciones.api().ajax.reload();
                    }else{
                        swal("Error",objData.mgs,"error");
                }
                }
            }
        }
});

//Ejecuta funcion cuando se abre ventana
window.addEventListener('load',function(){
    fntServiciosCama();
},false);

// carga desde base de datos los registros de servicios
function fntServiciosCama(){
    var ajaxUrl = base_url+"/Cama/getSelectServicios";
    var request = new XMLHttpRequest()? new XMLHttpRequest(): new ActiveXObject("Microsoft.XMLHTTP");
    request.open("GET", ajaxUrl,true);
    request.send();

    request.onreadystatechange = function(){
        if(request.readyState==4 && request.status==200){
            document.querySelector("#listServicioid").innerHTML=request.responseText;
            // $("#listServicioid").selectpicker('render');
        }
    }
}

$("#listServicioid").change(function(){
    fnthabitacionCama();
});

// carga desde base de datos los registros de servicios
function fnthabitacionCama(){
    var idServicio = document.querySelector("#listServicioid").value;
    console.log(idServicio);
    var ajaxUrl = base_url+"/Cama/getSelectHabitaciones/"+idServicio;
    var request = new XMLHttpRequest()? new XMLHttpRequest(): new ActiveXObject("Microsoft.XMLHTTP");
    request.open("GET", ajaxUrl,true);
    request.send();

    request.onreadystatechange = function(){
        if(request.readyState==4 && request.status==200){
            document.querySelector("#listHabitacionid").innerHTML=request.responseText;
            // $("#listHabitacionid").selectpicker('refresh');
        }
    }
}

// Agrega evento a botonVer y muestra datos en modal
function fntViewCama(idCama){
    var IDCama = idCama;
    var request = (window.XMLHttpRequest)? new XMLHttpRequest() : new ActiveXObject("Microsoft.XMLHTTP");
    var ajaxUrl = base_url+'/Cama/getCama/'+IDCama;
    request.open('GET', ajaxUrl, true);
    request.send();

    request.onreadystatechange = function() {
        if(request.readyState == 4 && request.status ==200){
            var objData = JSON.parse(request.responseText);
            if(objData.status){
                document.querySelector('#celIdentificacion').innerHTML = objData.msg.IDcama;
                document.querySelector('#celNombre').innerHTML = objData.msg.NombreDeCama;
                document.querySelector('#celHabitacion').innerHTML = objData.msg.NombreDeCuarto;
                document.querySelector('#celServicio').innerHTML = objData.msg.NombreDeServicio;
                $('#modalViewCama').modal('show');
            }else{
                swal("Error",objData.msg,"error");
            }
        }
    }
}

//funcion que configura el boton de eliminar
function fntDelCama(idCama){
    var IDCama = idCama;
    swal({
            title:"Eliminar Cama",
            text:"Se eliminara los datos de cama seleccionada",
            type:"warning",
            showCancelButton:true,
            confirmButtonText:"Eliminar",
            cancelButtonText:"Cancelar",
            closeOnConfirm:false,
            closeOnCancel:true
    },function(isConfirm){
            if(isConfirm){
                    var request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject("Microsoft.XMLHTTP");
                    var ajaxUrl  = base_url+'/Cama/delCama/';
                    var strData = "idCama="+IDCama;
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
                                            tableCamas.api().ajax.reload();
                                    }else{
                                            swal("Atencion",objData.msg,"error");
                                    }

                            }
                    }
            }
    });
   
}


// click para abrir modal de nueva cama
$("#nuevoCama").click(function(){
    document.querySelector('#idCama').value = "";
    document.querySelector('#btnText').innerHTML = "Guardar";
    document.querySelector('#titleModal').innerHTML = "Nuevos camas";
    document.querySelector('#formCama').reset();
    fntServiciosCama();
    $('#modalFormCama').modal('show');
});
