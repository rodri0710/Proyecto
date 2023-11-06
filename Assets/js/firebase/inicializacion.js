function listenerEvent(){
  // $(location).attr('href','http://localhost/eCall/Monitoreo/');
  const firebaseConfig = {
    apiKey: "AIzaSyCKsWQG2dIE0jMGkX59LrdbiS_GbLz6QB4",
    authDomain: "ecall00.firebaseapp.com",
    databaseURL: "https://ecall00-default-rtdb.firebaseio.com",
    projectId: "ecall00",
    storageBucket: "ecall00.appspot.com",
    messagingSenderId: "807268156762",
    appId: "1:807268156762:web:e954c19aedbf3b44a11f63",
    measurementId: "G-QWND46VLK1"
  };
  
  firebase.initializeApp(firebaseConfig);

  //Actualizacion de CAMAS alarmadas
  var starCountRef = firebase.database().ref("AlarmaDeCamas");
  var camas = [];
  var idServicio =""; 
  starCountRef.on('value', (snapshot) => {
    // limpia cards de camas alarmadas a su color predeterminado
    $(document).ready(function () {
      // console.log(camas);
      camas.forEach(function(idCama) {
        console.log(idCama);
        $('#'+idServicio).css('background-color', '#FFFFFF');
        $('#'+idCama+"c").css('background-color', '#FFFFFF');
       });
    });
    // pinta cards de camas alarmadas  
    snapshot.forEach(function(childSnapshot) {
      var key = childSnapshot.key;
      var childData = childSnapshot.val();
      
      // console.log(key);
      // console.log(childData);
    var cama = childData["cama"];
    var sala = childData["sala"];
    var servicio = childData["servicio"];
    var idCama = servicio+""+sala+""+cama;
    idServicio = servicio+"";
    camas.push(idCama);
    camas = [...new Set(camas)]
    $(document).ready(function () {
      // console.log(camas);
      // console.log(sanitarios);
      $('#'+idServicio).css('background-color', '#18f0e2');
      $('#'+idCama+"c").css('background-color', '#18f0e2');
    });
    
  })
});


  //Actualizacion de SANITARIOS alarmadas
  var sanitarioRef = firebase.database().ref("AlarmaDeSanitarios");
  var sanitarios = [];
  var idServicio =""; 
  sanitarioRef.on('value', (snapshot) => {
    // limpia cards de camas alarmadas a su color predeterminado
    $(document).ready(function () {
      sanitarios.forEach(function(idSanitario) {
        console.log(idSanitario);
        $('#'+idServicio).css('background-color', '#FFFFFF');
        $('#'+idSanitario+"s").css('background-color', '#FFFFFF');
       });
    });
    // pinta cards de camas alarmadas  
    snapshot.forEach(function(childSnapshot) {
      var key = childSnapshot.key;
      var childData = childSnapshot.val();
      
      // console.log(key);
      // console.log(childData);
    var sanitario = childData["sanitario"];
    var sala = childData["sala"];
    var servicio = childData["servicio"];
    var idSanitario = servicio+""+sala+""+sanitario;
    idServicio = servicio+"";
    sanitarios.push(idSanitario);
    sanitarios = [...new Set(sanitarios)]
    $(document).ready(function () {
      // console.log(sanitarios);
      // console.log(idServicio);
      $('#'+idServicio).css('background-color', '#18f0e2');
      $('#'+idSanitario+"s").css('background-color', '#18f0e2');
    });
    
  })
});

}