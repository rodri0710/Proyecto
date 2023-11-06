// recupera datos de BBDD de tabla rol y la carga en tableRol

var tableRoles;
document.addEventListener("DOMContentLoaded", function(){
        tableRoles = $("#tableRoles").dataTable({
        "aProcessing": true,
        "aServerSide": true,
        "language":{
                "url":"//cdn.datatables.net/plug-ins/1.10.20/i18n/Spanish.json"
        },
        "ajax":{
                "url": " "+base_url+"/Roles/ObtenerRoles",
                "dataSrc":""
       },
       "columns":[
        {"data":"IDrol"},
        {"data":"NombreRol"},
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
                "title": 'Roles'

            },
            {
                "extend":"pdfHtml5",
                "text": "<i class='fa-regular fa-file-pdf'></i> PDF",
                "titleAttr":"Exportar a PDF",
                "className":"btn btn-danger",
                "title": 'Roles'
            }
        ],
       "resonsieve":"true",
       "bDestroy":true,
       "iDisplayLength":10,
       "order":[[0,"desc"]]
        });
        //nuevo rol
        var formRol = document.querySelector("#formRol");
        formRol.onsubmit = function(e){
                e.preventDefault();
                
                var intIdRol = document.querySelector('#idRol').value;
                var strNombre = document.querySelector('#txtDescripcion').value;
                var strDescripcion = document.querySelector('#txtDescripcion').value;
                if(strNombre == '' || strDescripcion == ''){
                        swal("Atecion","Todos los campos son obligatorios","error");
                        return false;
                }
                var request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject("Microsoft.XMLHTTP");
                var ajaxUrl = base_url+'/Roles/setRol';
                var formData = new FormData(formRol);
                request.open("POST", ajaxUrl,true);
                request.send(formData);
                request.onreadystatechange = function(){  
                        if(request.readyState == 4 && request.status == 200){
                                var objData = JSON.parse(request.responseText);
                                if(objData.status){
                                        $('#modalFormRol').modal('hide');
                                        formRol.reset();
                                        swal("Roles de usuario",objData.msg,"success");
                                        tableRoles.api().ajax.reload();
                                }else{
                                        swal("Error",objData.mgs,"error");
                                }
                        }
                }
        }
});

// abre modal para nuevo Rol
$( "#nuevoRol" ).click(function() {
        // alert( "Handler for .click() called." );
        document.querySelector('#idRol').value = "";
        document.querySelector('#btnText').innerHTML = "Guardar";
        document.querySelector('#titleModal').innerHTML = "Nuevo Rol";
        document.querySelector('#formRol').reset();
        $('#modalFormRol').modal('show');
 });

 //enlaza 
 $('#tableRoles').DataTable()

 // cargar la pagina colocando los eventos onclick a cada uno de los botones
 window.addEventListener('load',function(){
        // ftnEditRol();
        // fntDelRol();
        // fntPermisos();
 },false);

 function ftnEditRol(idRol){
        
        document.querySelector('#titleModal').innerHTML = "Actualizar Rol";
        document.querySelector('.modal-header').classList.replace("headerReister","headerUpdate");
        document.querySelector('#btnActionForm').classList.replace("btn-primary","btn-info");
        document.querySelector('#btnText').innerHTML = "Actualizar";
        
        var idrol = idRol;
        var request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject("Microsoft.XMLHTTP");
        var ajaxUrl  = base_url+'/Roles/getRol/'+idrol;
        request.open("GET",ajaxUrl,true);
        request.send();
        // coloca datos  recuperados de BBDD de pertenecientes a los campos en modal
        request.onreadystatechange = function() {
                if(request.readyState == 4 && request.status == 200){
                        var objData = JSON.parse(request.responseText);
                        // console.log(objData);                                        
                        if(objData.status){
                                document.querySelector('#idRol').value =  objData.data.IDrol;
                                document.querySelector('#txtNombre').value = objData.data.NombreRol;
                                document.querySelector('#txtDescripcion').value = objData.data.Descripcion;
                                $('#modalFormRol').modal('show');
                        }else{
                                swal("Error",objData.msg,"error");
                        }

                }
        }
 }

 //funcion que configura el boron de eliminar
 function fntDelRol(idRol){
        var idrol = idRol;
        swal({
                title:"Eliminar Rol",
                text:"Esta seguro de eliminar el Rol",
                type:"warning",
                showCancelButton:true,
                confirmButtonText:"Eliminar",
                cancelButtonText:"Cancelar",
                closeOnConfirm:false,
                closeOnCancel:true
        },function(isConfirm){
                if(isConfirm){
                        var request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject("Microsoft.XMLHTTP");
                        var ajaxUrl  = base_url+'/Roles/delRol/';
                        var strData = "idrol="+idrol;
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
                                                tableRoles.api().ajax.reload();
                                        }else{
                                                swal("Atencion",objData.msg,"error");
                                        }

                                }
                        }
                }
        });
       
 }

 // funcion para dar permisos de personal
 function fntPermisos(idRol){
        var idrol = idRol;
        var request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject("Microsoft.XMLHTTP");
        var ajaxUrl  = base_url+'/Permisos/getPermisosRol/'+idrol;
        request.open("GET",ajaxUrl,true);
        request.send();
        // coloca datos  recuperados de BBDD de pertenecientes a los campos en modal
        request.onreadystatechange = function() {
                if(request.readyState == 4 && request.status == 200){
                        // console.log(request.responseText);                                        
                        document.querySelector('#contentAjax').innerHTML = request.responseText;
                        $('.modalPermisos').modal('show');
                        document.querySelector('#formPermisos').addEventListener('submit', fntSavePermisos,false);
                        
                }
        }

 }


 // funcion que envia datos de permisos de los modelos a BBDD
 function fntSavePermisos(evnet){
        evnet.preventDefault();
        var request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
        var ajaxUrl = base_url+'/Permisos/setPermisos'; 
        var formElement = document.querySelector("#formPermisos");
        var formData = new FormData(formElement);
        request.open("POST",ajaxUrl,true);
        request.send(formData);
    
        request.onreadystatechange = function(){
            if(request.readyState == 4 && request.status == 200){
                var objData = JSON.parse(request.responseText);
                if(objData.status)
                {
                    swal("Permisos de usuario", objData.msg ,"success");
                }else{
                    swal("Error", objData.msg , "error");
                }
            }
        }
        
    }


