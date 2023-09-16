document.addEventListener("DOMContentLoaded", (e) => {

    addEventListener("click", function(e){
       
        if(e.target.classList.contains('ver')){

            var id = e.target.getAttribute('data-id');
            var ruta = '/contactos/ver/'+id

            $.ajax({
                type: "get",
                url: ruta,
                data: {
                    id:id
                },
                dataType: "JSON",
                success: function (response) {
                    if(response.success === true){
                         //se ajusta el idioma a español
                        moment.locale('es')
                        //se renderizan los valores en los inputs del fomulario para mostrar el contacto
                        document.getElementById('nombreModal').value = response.nombre
                        document.getElementById('telefonoModal').value = response.telefono
                        document.getElementById('correoModal').value = response.correo
                        //formato hace 1 dia
                        document.getElementById('registrado').textContent = moment(response.created_at, "YYYYMMDD").fromNow();
                    }
                },
                error: function( jqXHR, textStatus, errorThrown ) {
                    //una alerta de error
                    //swal("Error", "No se pudo procesar la solicitud", "warning");
                    //se cierra automaticamente del modal - se definio un tiempo para que se pueda cerrar por el ciclo de vida del DOM
                    setInterval(function(){
                        document.getElementById('cerrarModal').click()
                    },100); 
                    

                }
            });
        
        
        
        }
    
    
    
    });




});