// Login Page Flipbox control
$('.login-content [data-toggle="flip"]').click(function() {
    $('.login-box').toggleClass('flipped');
    return false;
});

// agregamos todos los eventos al momento de cargar pagina
var divLogin = document.querySelector("#divLoading");
document.addEventListener('DOMContentLoaded', function() {
    if(document.querySelector("#formLogin")){

        let formLogin = document.querySelector("#formLogin");
        formLogin.onsubmit = function(e) {
            e.preventDefault();

            let strEmail = document.querySelector("#txtEmail").value;
            let strPassword = document.querySelector("#txtPassword").value;
            

            if(strEmail=="" || strPassword==""){
                swal("Error", "Introduce usuario y contraseña","error");
                return false
            }else{
                divLogin.style.display="flex";
                var request = (window.XMLHttpRequest)? new XMLHttpRequest() : new ActiveXObject("Microsoft.XMLHTTP");
                var ajaxURL = base_url + "/Login/loginUser";
                var formData = new FormData(formLogin);
                request.open("POST", ajaxURL,true);
                request.send(formData);

                request.onreadystatechange = function() {
                    if(request.readyState == 4 && request.status == 200){
                        
                        var objData = JSON.parse(request.responseText);
                        if(objData.status){
                                console.log(objData.status);
                                window.location = base_url+'/Inicio';
                            }else{
                                swal('Atención', objData.msg, 'error');
                                document.querySelector('#txtPassword').value = '';
                            }

                    }
                    divLogin.style.display="none";
                    return false;
                }
               
            }
        }   
    }
    // genera token y guarda en base de datos de un personal
    if(document.querySelector("#formRecetPass")){
        let formRecetPass = document.querySelector("#formRecetPass");
        let txtEmailReset = document.querySelector("#txtEmailReset");
        formRecetPass.onsubmit = function(e) {
            e.preventDefault();   

            let strEmail = document.querySelector("#txtEmailReset").value;
            if(strEmail==""){
                swal("por favor", "Escribe tu correo electrónico", "error");
                return false;
            }else{
                var request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject("Microsoft.XMLHTTP");
                var formData = new FormData(formRecetPass);
                var ajaxURL = base_url+'/Login/resetPass';
                request.open("POST", ajaxURL, true);
                request.send(formData);

                request.onreadystatechange = function() {
                    if(request.readyState == 4 && request.status == 200){
                        
                        var objData = JSON.parse(request.responseText);
                        if(objData.status){
                                swal({
                                    title:"",
                                    text:objData.msg,
                                    type:"success",
                                    confirmButtonText:"Aceptar",
                                    closeOnConfirm:false,
                                },function(isConfirm){
                                    if(isConfirm){
                                        window.location=base_url;
                                    }
                                });
                            }else{
                                swal('Atención', objData.msg, 'error');   
                            }
                    }else{
                        swal("atención", "Error em el proceso","error");
                    }
                    
                    return false;
                }
                
            }
        }
    } 
    
    // restablece contrasenia
    if(document.querySelector("#formCambiarPass")){
        let formCambiarPass = document.querySelector("#formCambiarPass");
        formCambiarPass.onsubmit = function(e){
            e.preventDefault();
            let strPassword = document.querySelector("#txtPassword").value;
            let strPasswordConfirm = document.querySelector("#txtPasswordConfirm").value;
            let idUsuario = document.querySelector("#idUsuario").value;
            // console.log(strPasswordConfirm +" "+ strPassword);

            if(strPassword=="" || strPasswordConfirm ==""){
                swal("Por favor","Todos los campos son obligatorios","error");
                return false;
            }else{
                if(strPassword.length < 8){
                    swal("Atención","La contraseña debe tener minimo 8 caracteres","error");
                    return false;
                }

                if(strPassword != strPasswordConfirm){
                    swal("Atención","Las contraseñas no son iguales","error");
                    return false;
                }

                var request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject("Microsoft.XMLHTTP");
                var formData = new FormData(formCambiarPass);
                var ajaxURL = base_url+'/Login/setPassword';
                request.open("POST", ajaxURL, true);
                request.send(formData);

                request.onreadystatechange = function() {
                    if(request.readyState ==4 && request.status == 200){
                        var objData = JSON.parse(request.responseText);
                        if(objData.status){
                            swal({
                                title:"",
                                text: objData.msg,
                                type:"success",
                                confirmButtonText:"Iniciar sesión",
                                closeOnConfirm:false,
                            },function(isConfirm){
                                if(isConfirm){
                                    window.location=base_url+'/Login';
                                }
                            });
                        }else{
                            swal("Atención",objData.msg,"error");

                        }
                    }else{
                        swal("atención", "Error en el proceso","error");
                    }

                }
                
                

            }
        }
    }

}, false);