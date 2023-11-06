// recupera datos de BBDD de tabla Camas y la carga en tableCamas

var tableSanitario;
document.addEventListener("DOMContentLoaded", function(){
    tableSanitario = $("#tableSanitario").dataTable({
        "aProcessing": true,
        "aServerSide": true,
        "language":{
                "url":"//cdn.datatables.net/plug-ins/1.10.20/i18n/Spanish.json"
        },
        "ajax":{
                "url": " "+base_url+"/Sanitario/ObtenerSanitarios",
                "dataSrc":""
       },
       "columns":[
        {"data":"IDsanitario"},
        {"data":"NombreDeSanitario"},
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
                "title": 'Sanitarios'

            },
            {
                "extend":"pdfHtml5",
                "text": "<i class='fa-regular fa-file-pdf'></i> PDF",
                "titleAttr":"Exportar a PDF",
                "className":"btn btn-danger",
                "title": 'Sanitarios'
            }
        ],
       "resonsieve":"true",
       "bDestroy":true,
       "iDisplayLength":10,
       "order":[[0,"asc"]]
        });
        // captura datos de Sanitarios del formulario formUsuario
        var formSanitario = document.querySelector('#formSanitario');
        formSanitario.onsubmit = function(e) {
            e.preventDefault();
            var listServicioid = document.querySelector('#listServicioid').value;
            var listHabitacionid = document.querySelector('#listHabitacionid').value;
            var cantSanitarios = document.querySelector('#cantSanitarios').value;
            if(cantSanitarios == "" || listServicioid == 0 || listHabitacionid == "" ){
                swal("Atención","Todos los campos son obligatorios","error");
                return false;
            }

            var request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject("Microsoft.XMLHTTP");
            var ajaxUrl = base_url+"/Sanitario/setSanitarios";
            var formData = new FormData(formSanitario);
            request.open("POST", ajaxUrl,true);
            request.send(formData);
            request.onreadystatechange = function(){ 
                if(request.readyState==4 && request.status==200){
                    var objData = JSON.parse(request.responseText);
                    if(objData.status){
                        $('#modalFormSanitario').modal('hide');
                        formSanitario.reset();
                        swal("Sanitario",objData.msg,"success");
                        tableSanitario.api().ajax.reload();
                    }else{
                        swal("Error",objData.mgs,"error");
                }
                }
            }
        }

        // captura datos del formulario usuario formServicioEdit para editar 
        var formSanitarioEdit = document.querySelector('#formSanitarioEdit');
        formSanitarioEdit.onsubmit = function(e) {
            e.preventDefault();
            var txtNombreEdit = document.querySelector('#txtNombreEdit').value;
            var txtIdEdit = document.querySelector('#txtIdEdit').value;
            if(txtNombreEdit == "" || txtIdEdit==""){
                swal("Atención","El campo nombre debe ser llenado","error");
                return false;
            }

            var request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject("Microsoft.XMLHTTP");
            var ajaxUrl = base_url+"/Sanitario/setSanitario";
            var formData = new FormData(formSanitarioEdit);
            request.open("POST", ajaxUrl,true);
            request.send(formData);
            request.onreadystatechange = function(){ 
                if(request.readyState==4 && request.status==200){
                    var objData = JSON.parse(request.responseText);
                    if(objData.status){
                        $('#modalFormEditSanitario').modal('hide');
                        formSanitarioEdit.reset();
                        swal("Sanitario",objData.msg,"success");
                        tableSanitario.api().ajax.reload();
                    }else{
                        swal("Error",objData.mgs,"error");
                }
                }
            }
        }
});

//Ejecuta funcion cuando se abre ventana
window.addEventListener('load',function(){
    fntServiciosSanitario();
},false);

// carga desde base de datos los registros de servicios
function fntServiciosSanitario(){
    var ajaxUrl = base_url+"/Sanitario/getSelectServicios";
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
    fnthabitacionSanitario();
});

// carga desde base de datos los registros de servicios
function fnthabitacionSanitario(){
    var idServicio = document.querySelector("#listServicioid").value;
    console.log(idServicio);
    var ajaxUrl = base_url+"/Sanitario/getSelectHabitaciones/"+idServicio;
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
function fntViewSanitario(idSanitario){
    var IDSanitario = idSanitario;
    var request = (window.XMLHttpRequest)? new XMLHttpRequest() : new ActiveXObject("Microsoft.XMLHTTP");
    var ajaxUrl = base_url+'/Sanitario/getSanitario/'+IDSanitario;
    request.open('GET', ajaxUrl, true);
    request.send();

    request.onreadystatechange = function() {
        if(request.readyState == 4 && request.status ==200){
            var objData = JSON.parse(request.responseText);
            if(objData.status){
                document.querySelector('#celIdentificacion').innerHTML = objData.msg.IDsanitario;
                document.querySelector('#celNombre').innerHTML = objData.msg.NombreDeSanitario;
                document.querySelector('#celHabitacion').innerHTML = objData.msg.NombreDeCuarto;
                document.querySelector('#celServicio').innerHTML = objData.msg.NombreDeServicio;
                $('#modalViewSanitario').modal('show');
            }else{
                swal("Error",objData.msg,"error");
            }
        }
    }
}

//funcion que configura el boton de eliminar
function fntDelSanitario(idSanitario){
    var IDSanitario = idSanitario;
    swal({
            title:"Eliminar Sanitario",
            text:"Se eliminara los datos de sanitario seleccionada",
            type:"warning",
            showCancelButton:true,
            confirmButtonText:"Eliminar",
            cancelButtonText:"Cancelar",
            closeOnConfirm:false,
            closeOnCancel:true
    },function(isConfirm){
            if(isConfirm){
                    var request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject("Microsoft.XMLHTTP");
                    var ajaxUrl  = base_url+'/Sanitario/delSanitario/';
                    var strData = "idSanitario="+IDSanitario;
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
                                            tableSanitario.api().ajax.reload();
                                    }else{
                                            swal("Atencion",objData.msg,"error");
                                    }

                            }
                    }
            }
    });
   
}


// click para abrir modal de nueva cama
$("#nuevoSanitario").click(function(){
    document.querySelector('#idSanitario').value = "";
    document.querySelector('#btnText').innerHTML = "Guardar";
    document.querySelector('#titleModal').innerHTML = "Nuevos camas";
    document.querySelector('#formSanitario').reset();
    $('#modalFormSanitario').modal('show');
});
