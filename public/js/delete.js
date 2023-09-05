$(document).ready(function(e){
    $('#capturar').click(function (e) { 
        //e.preventDefault();
        //console.log(e.target);
        
        const contacto = e.target.getAttribute("data-id");

        //console.log(contacto);

        if(e.target.classList.contains('btn-danger')){
            swal({
                title: "¿Deseas eliminar este contacto?",
                text: "No se puede deshacer esta acción",
                icon: "warning",
                buttons: true,
                dangerMode: true,
                buttons: ["Cancelar", "Aceptar"],
              })
              .then((willDelete) => {
                if (willDelete) {

                    var ruta = '/contactos/'+contacto

                    $.ajax({
                        type: "delete",
                        url: ruta,
                        data: {
                            "id": contacto
                        },
                        dataType: "json",
                        success: function (response) {
                            if(response.success === true){
                                swal("Eliminado", "El contacto se ha eliminado", "success");
                                //se eliminado del renderizado del HTML
                                e.target.parentNode.parentNode.remove();
                            }
                        },
                        error: function( jqXHR, textStatus, errorThrown ) {
                            swal("Error", "No se pudo procesar la solicitud", "warning");
                        }
                    });
                }
              });
        }
    });




    /*
    $('#capturar').click(function (e) { 
        //e.preventDefault();
        //console.log(e.target);
        
        const contacto = e.target.getAttribute("data-id");

        //console.log(contacto);

        if(e.target.classList.contains('btn-danger')){
            const opcion = confirm('¿Desear eliminar este contacto?');
            if(opcion){

                var ruta = '/contactos/'+contacto

                    $.ajax({
                        type: "delete",
                        url: ruta,
                        data: {
                            "id": contacto
                        },
                        dataType: "json",
                        success: function (response) {
                            console.log(response);
                            if(response.status == 200){
                                alert("Contacto eliminado correctamente");
                            }
                        },
                        error: function( jqXHR, textStatus, errorThrown ) {
                            alert("No se pudo procesar la solicitud");
                        }
                    });

            }
        }
    });
    */

});