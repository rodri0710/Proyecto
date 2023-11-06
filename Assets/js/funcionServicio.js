// recupera datos de BBDD de tabla rol y la carga en tableServicio

var tableServicios;
document.addEventListener("DOMContentLoaded", function(){
    tableServicios = $("#tableServicios").dataTable({
        "aProcessing": true,
        "aServerSide": true,
        "language":{
                "url":"//cdn.datatables.net/plug-ins/1.10.20/i18n/Spanish.json"
        },
        "ajax":{
                "url": " "+base_url+"/Servicio/ObtenerServicios",
                "dataSrc":""
       },
       "columns":[
        {"data":"IDservicio"},
        {"data":"NombreDeServicio"},
        {"data":"Descripcion"},
        {"data":"Opciones"}
       ],
       'dom': 'lBfrtip',
        'buttons': [
            {
                "extend":"excelHtml5",
                "text": "<i class='fas fa-file-excel'></i> EXCEL",
                "titleAttr":"Exportar a Excel",
                "className":"btn btn-success",
                "title": 'Servicios'

            },
            {
                "extend":"pdfHtml5",
                "text": "<i class='fa-regular fa-file-pdf'></i> PDF",
                "titleAttr":"Exportar a PDF",
                "className":"btn btn-danger",
                "title": 'Servicios'
            }
        ],
       "resonsieve":"true",
       "bDestroy":true,
       "iDisplayLength":10,
       "order":[[0,"asc"]]
        });
        // captura datos del formulario usuario formUsuario
        var formServicio = document.querySelector('#formServicio');
        formServicio.onsubmit = function(e) {
            e.preventDefault();
            var cantServicios = document.querySelector('#cantServicios').value;
            if(cantServicios == ""){
                swal("Atención","El campo nombre debe ser llenado","error");
                return false;
            }

            var request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject("Microsoft.XMLHTTP");
            var ajaxUrl = base_url+"/Servicio/setServicios";
            var formData = new FormData(formServicio);
            request.open("POST", ajaxUrl,true);
            request.send(formData);
            request.onreadystatechange = function(){ 
                if(request.readyState==4 && request.status==200){
                    var objData = JSON.parse(request.responseText);
                    if(objData.status){
                        $('#modalFormServicio').modal('hide');
                        formServicio.reset();
                        swal("Servicio",objData.msg,"success");
                        tableServicios.api().ajax.reload();
                    }else{
                        swal("Error",objData.mgs,"error");
                }
                }
            }
        }

        // captura datos del formulario usuario formServicioEdit para editar 
        var formServicioEdit = document.querySelector('#formServicioEdit');
        formServicioEdit.onsubmit = function(e) {
            e.preventDefault();
            var txtNombreEdit = document.querySelector('#txtNombreEdit').value;
            var txtDescripcionEdit = document.querySelector('#txtDescripcionEdit').value;
            if(txtNombreEdit == ""){
                swal("Atención","El campo nombre debe ser llenado","error");
                return false;
            }

            var request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject("Microsoft.XMLHTTP");
            var ajaxUrl = base_url+"/Servicio/setServicio";
            var formData = new FormData(formServicioEdit);
            request.open("POST", ajaxUrl,true);
            request.send(formData);
            request.onreadystatechange = function(){ 
                if(request.readyState==4 && request.status==200){
                    var objData = JSON.parse(request.responseText);
                    if(objData.status){
                        $('#modalFormEditServicio').modal('hide');
                        formServicio.reset();
                        swal("Servicio",objData.msg,"success");
                        tableServicios.api().ajax.reload();
                    }else{
                        swal("Error",objData.mgs,"error");
                }
                }
            }
        }
});

// Agrega evento a botonVer y muestra datos en modal
function fntViewServicio(idServicio){
    var IDServicio = idServicio;
    var request = (window.XMLHttpRequest)? new XMLHttpRequest() : new ActiveXObject("Microsoft.XMLHTTP");
    var ajaxUrl = base_url+'/Servicio/getServicio/'+IDServicio;
    request.open('GET', ajaxUrl, true);
    request.send();

    request.onreadystatechange = function() {
        if(request.readyState == 4 && request.status ==200){
            var objData = JSON.parse(request.responseText);
            if(objData.status){
               
                document.querySelector('#celIdentificacion').innerHTML = objData.msg.IDservicio;
                document.querySelector('#celNombre').innerHTML = objData.msg.NombreDeServicio;
                document.querySelector('#celDescripcion').innerHTML = objData.msg.Descripcion;
            
                $('#modalViewServicio').modal('show');
            }else{
                swal("Error",objData.msg,"error");
            }
        }
    }
}

// Agrega evento a botonEdit y muestra datos en modal
function ftnEditServicio(idServicio){

    var IDServicio = idServicio;
    var request = (window.XMLHttpRequest)? new XMLHttpRequest() : new ActiveXObject("Microsoft.XMLHTTP");
    var ajaxUrl = base_url+'/Servicio/getServicio/'+IDServicio;
    request.open('GET', ajaxUrl, true);
    request.send();

    request.onreadystatechange = function() {
        if(request.readyState == 4 && request.status ==200){
                var objData = JSON.parse(request.responseText);
                if(objData.status){
                    document.querySelector('#idServicioEdit').value = objData.msg.IDservicio;
                    document.querySelector('#txtNombreEdit').value = objData.msg.NombreDeServicio;
                    document.querySelector('#txtDescripcionEdit').value = objData.msg.Descripcion;
                }
            }
        $('#modalFormEditServicio').modal("show");
    }
   
}

 //funcion que configura el boton de eliminar
 function fntDelServicio(idServicio){
    var IDServicio = idServicio;
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
                    var ajaxUrl  = base_url+'/Servicio/delServicio/';
                    var strData = "idServicio="+IDServicio;
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
                                            tableServicios.api().ajax.reload();
                                    }else{
                                            swal("Atencion",objData.msg,"error");
                                    }

                            }
                    }
            }
    });
   
}

// click para abrir modal de nuevo usuario
$("#nuevoServicio").click(function(){
    document.querySelector('#idServicio').value = "";
    document.querySelector('#btnText').innerHTML = "Guardar";
    document.querySelector('#titleModal').innerHTML = "Nuevo Servicio";
    document.querySelector('#formServicio').reset();
    $('#modalFormServicio').modal('show');
});