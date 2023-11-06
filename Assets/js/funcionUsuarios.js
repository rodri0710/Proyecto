var tableUsuarios;
//Ejecuta funcion cuando termine de cargar todo el DOM
document.addEventListener("DOMContentLoaded",function(){
    // carga datos en de personal en ventana de personal
    tableUsuarios = $("#tableUsuarios").dataTable({
        "aProcessing": true,
        "aServerSide": true,
        "language":{
                "url":"//cdn.datatables.net/plug-ins/1.10.20/i18n/Spanish.json"
        },
        "ajax":{
                "url": " "+base_url+"/Usuarios/getUsuarios",
                "dataSrc":""
       },
       "columns":[
        {"data":"IDpersonalDS"},
        {"data":"Nombres"},
        {"data":"Apellidos"},
        {"data":"Email"},
        {"data":"NombreDeServicio"},
        {"data":"NombreDeProfesion"},
        {"data":"NombreDeGrupo"},
        {"data":"NombreRol"},
        {"data":"Habilitado"},
        {"data":"Opciones"}
       ],
       'dom': 'lBfrtip',
        'buttons': [
            {
                "extend":"excelHtml5",
                "text": "<i class='fas fa-file-excel'></i> EXCEL",
                "titleAttr":"Exportar a Excel",
                "className":"btn btn-success",
                "title": 'Usuarios'

            },
            {
                "extend":"pdfHtml5",
                "text": "<i class='fa-regular fa-file-pdf'></i> PDF",
                "titleAttr":"Exportar a PDF",
                "className":"btn btn-danger",
                "title": 'Usuarios'
            }
        ],
       "resonsieve":"true",
       "bDestroy":true,
       "iDisplayLength":10,
       "order":[[0,"desc"]]
        });

    var formUsuario = document.querySelector("#formUsuario");
    formUsuario.onsubmit = function(e) {
        e.preventDefault();
        var strIdentificacion = document.querySelector("#txtIdentificacion").value;
        var strNombre = document.querySelector("#txtNombres").value;
        var strApellidoPaterno = document.querySelector("#txtApellidoPaterno").value;
        var strApellidoMaterno = document.querySelector("#txtApellidoMaterno").value;
        var strEmail = document.querySelector("#txtEmail").value;
        var strContrasena = document.querySelector("#txtContrasena").value;
        var intProfesionid = document.querySelector("#listProfesionid").value;
        var intRolid = document.querySelector("#listRolid").value;
        var intServicioid = document.querySelector("#listServicioid").value;
        var intGrupoid = document.querySelector("#listGrupoid").value;
        var strhabilitado = document.querySelector("#txtHabilitado").checked;
        if(strNombre=='' || strApellidoPaterno=='' || strApellidoMaterno =='' || strEmail=='' ||
            intProfesionid=='' || intGrupoid=='' || intRolid=='' || intServicioid==''){
                swal("Atencion","Todos los campos son obligatorios","error");
                return false;
        }

        var request = (window.XMLHttpRequest)? new XMLHttpRequest(): new ActiveXObject("Microsoft.XMLHTTP");
        var ajaxUrl = base_url + "/Usuarios/setUsuario";
        var formData = new FormData(formUsuario);
        request.open("POST", ajaxUrl,true);
        request.send(formData);
        request.onreadystatechange = function(){  
            if(request.readyState == 4 && request.status == 200){
                    var objData = JSON.parse(request.responseText);
                if(objData.status){
                    $('#modalFormUsuario').modal('hide');
                    formUsuario.reset();
                    swal("Usuarios",objData.msg,"success");
                    tableUsuarios.api().ajax.reload();
                }else{
                    swal("Error",objData.msg,"error")
                }
            }
        }
    }

},false);

//Ejecuta funcion cuando se abre ventana
window.addEventListener('load',function(){
    fntRolesUsuario();
    fntProfesionesUsuario();
    fntServiciosUsuario();
    // let idServicio = $("#listServicioid").val();
    // let idProfesion = $("#listProfesionid").val();
    // fntGruposUsuario(idProfesion,idServicio);
    // fntViewUsuario();
    // fntEditUsuario();
    // fntDelUsuario();
},false);

// funcion para obtener roles que hace la peticion ajax
function fntRolesUsuario(){
    var ajaxUrl = base_url+'/Roles/getSelectRoles';
    var request = (window.XMLHttpRequest)? new XMLHttpRequest() : new ActiveXObject("Microsoft.XMLHTTP");
    request.open("GET", ajaxUrl, true);
    request.send();

    request.onreadystatechange = function() {
        if(request.readyState == 4 && request.status ==200){
            document.querySelector('#listRolid').innerHTML = request.responseText;
            document.querySelector('#listRolid').value = 1;
            // $('#listRolid').selectpicker('render');
        }   
    }
}


// funcion para obtener profesiones que hace la peticion ajax
function fntProfesionesUsuario(){
    var ajaxUrl = base_url+'/Profesion/getSelectProfesiones';
    var request = (window.XMLHttpRequest)? new XMLHttpRequest() : new ActiveXObject("Microsoft.XMLHTTP");
    request.open("GET", ajaxUrl, true);
    request.send();

    request.onreadystatechange = function() {
        if(request.readyState == 4 && request.status ==200){
            document.querySelector('#listProfesionid').innerHTML = request.responseText;
            document.querySelector('#listProfesionid').value = 1;
            // $('#listProfesionid').selectpicker('render');
        }   
    }
}

// funcion para obtener grupos que hace la peticion ajax
function fntGruposUsuario(idProfesion,idServicio){
    var ajaxUrl = base_url+'/Grupo/getSelectGrupos/'+idProfesion+'/'+idServicio;
    var request = (window.XMLHttpRequest)? new XMLHttpRequest() : new ActiveXObject("Microsoft.XMLHTTP");
    request.open("GET", ajaxUrl, true);
    request.send();

    request.onreadystatechange = function() {
        if(request.readyState == 4 && request.status ==200){
            document.querySelector('#listGrupoid').innerHTML = request.responseText;
            // document.querySelector('#listGrupoid').value = 1;
            $('#listGrupoid').selectpicker('refresh');
        }   
    }
}

// funcion para obtener servicios que hace la peticion ajax
function fntServiciosUsuario(){
    var ajaxUrl = base_url+'/Servicio/getSelectServicios';
    var request = (window.XMLHttpRequest)? new XMLHttpRequest() : new ActiveXObject("Microsoft.XMLHTTP");
    request.open("GET", ajaxUrl, true);
    request.send();

    request.onreadystatechange = function() {
        if(request.readyState == 4 && request.status ==200){
            document.querySelector('#listServicioid').innerHTML = request.responseText;
            document.querySelector('#listServicioid').value = 1;
            // $('#listServicioid').selectpicker('render');
        }   
    }
}

// Agrega evento a botonVer y muestra datos en modal
function fntViewUsuario(idPersona){
    var IDpersonal = idPersona;
    var request = (window.XMLHttpRequest)? new XMLHttpRequest() : new ActiveXObject("Microsoft.XMLHTTP");
    var ajaxUrl = base_url+'/Usuarios/getUsuario/'+IDpersonal;
    request.open('GET', ajaxUrl, true);
    request.send();

    request.onreadystatechange = function() {
        if(request.readyState == 4 && request.status ==200){
            var objData = JSON.parse(request.responseText);
            if(objData.status){
                var habilitadoUsuario = objData.msg.Habilitado.toUpperCase()==="SI"?
                '<div class="row justify-content-center"><button class="btn btn-success" type="button" disabled ="">SI</button></div>' :
                '<div class="row justify-content-center"><button class="btn btn-warning" type="button" disabled ="">NO</button></div>';
                
                document.querySelector('#celIdentificacion').innerHTML = objData.msg.IDpersonalDS;
                document.querySelector('#celNombres').innerHTML = objData.msg.Nombres;
                document.querySelector('#celApellidoPaterno').innerHTML = objData.msg.ApellidoPaterno;
                document.querySelector('#celApellidoMaterno').innerHTML = objData.msg.ApellidoMaterno;
                document.querySelector('#celEmail').innerHTML = objData.msg.Email;
                document.querySelector('#celServicio').innerHTML = objData.msg.NombreDeServicio;
                document.querySelector('#celGrupo').innerHTML = objData.msg.NombreDeGrupo;
                document.querySelector('#celRol').innerHTML = objData.msg.NombreRol;
                document.querySelector('#celHabilitado').innerHTML = habilitadoUsuario;
                $('#modalViewUser').modal('show');
            }else{
                swal("Error",objData.msg,"error");
            }
        }
    }
}

// Agrega evento a botonEdit y muestra datos en modal
function fntEditUsuario(idPersona){
    document.querySelector('#titleModal').innerHTML = "Actualizar Usuario";
    document.querySelector('#btnText').innerHTML = "Actualizar";

    var IDpersonal = idPersona;
    var request = (window.XMLHttpRequest)? new XMLHttpRequest() : new ActiveXObject("Microsoft.XMLHTTP");
    var ajaxUrl = base_url+'/Usuarios/getUsuario/'+IDpersonal;
    request.open('GET', ajaxUrl, true);
    request.send();

    request.onreadystatechange = function() {
        if(request.readyState == 4 && request.status ==200){
                var objData = JSON.parse(request.responseText);
                if(objData.status){
                    document.querySelector('#idUsuario').value = objData.msg.IDpersonalDS;
                    document.querySelector('#txtIdentificacion').value = objData.msg.IDpersonalDS;
                    document.querySelector('#txtNombres').value = objData.msg.Nombres;
                    document.querySelector('#txtApellidoPaterno').value = objData.msg.ApellidoPaterno;
                    document.querySelector('#txtApellidoMaterno').value = objData.msg.ApellidoMaterno;
                    document.querySelector('#txtEmail').value = objData.msg.Email;
                    document.querySelector('#listProfesionid').value = objData.msg.IDTprofesion;
                    $('#listProfesionid').selectpicker('render');
                    document.querySelector('#listServicioid').value = objData.msg.IDservicio;
                    $('#listServicioid').selectpicker('render');
                    document.querySelector('#listGrupoid').value = objData.msg.IDGrupo;
                    $('#listGrupoid').selectpicker('render');
                    document.querySelector('#listRolid').value = objData.msg.IDrol;
                    $('#listRolid').selectpicker('render');
                    if(objData.msg.Habilitado.toUpperCase()==="SI"){
                        document.querySelector('#txtHabilitado').checked = true;
                    }else{
                        document.querySelector('#txtHabilitado').checked = false;
                    }
                    $('#txtHabilitado').selectpicker('render');
                }
            }
        $('#modalFormUsuario').modal("show");
    }
   
}

 //funcion que configura el boton de eliminar
 function fntDelUsuario(idPersona){
    var idUsuario = idPersona;
    swal({
            title:"Eliminar Usuario",
            text:"Esta seguro de eliminar el Usuario",
            type:"warning",
            showCancelButton:true,
            confirmButtonText:"Eliminar",
            cancelButtonText:"Cancelar",
            closeOnConfirm:false,
            closeOnCancel:true
    },function(isConfirm){
            if(isConfirm){
                    var request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject("Microsoft.XMLHTTP");
                    var ajaxUrl  = base_url+'/Usuarios/delUsuario/';
                    var strData = "idUsuario="+idUsuario;
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
                                            tableUsuarios.api().ajax.reload();
                                    }else{
                                            swal("Atencion",objData.msg,"error");
                                    }

                            }
                    }
            }
    });
   
}

// click para abrir modal de nuevo usuario
$("#nuevoUsuario").click(function(){
    document.querySelector('#idUsuario').value = "";
    document.querySelector('#btnText').innerHTML = "Guardar";
    document.querySelector('#titleModal').innerHTML = "Nuevo Usuario";
    document.querySelector('#formUsuario').reset();

    let idServicio = $("#listServicioid").val();
    let idProfesion = $("#listProfesionid").val();
    fntGruposUsuario(idProfesion,idServicio);

    $('#modalFormUsuario').modal('show');
});

$("#listServicioid").change(function(){

let idServicio = $("#listServicioid").val();
let idProfesion = $("#listProfesionid").val();
fntGruposUsuario(idProfesion,idServicio);

});

$("#listProfesionid").change(function(){

    let idServicio = $("#listServicioid").val();
    let idProfesion = $("#listProfesionid").val();
    fntGruposUsuario(idProfesion,idServicio);
    
    });