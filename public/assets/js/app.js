(function ($) {

    $(document).ready(function() {

        var table = $('#ks-datatable').DataTable({
            lengthChange: false,
            "language": {
                "url": "//cdn.datatables.net/plug-ins/1.10.18/i18n/Spanish.json"
            },
            initComplete: function () {
                $('.dataTables_wrapper select').select2({
                    minimumResultsForSearch: Infinity
                });
            }
        });


        $(function () {

        	$("#role").on('change', function () {

        		var selectValue = $(this).val();
        		switch(selectValue) 
        		{
        		    case "0":
                        $("#restaurant_id").hide();
                        break;

                  	case "1":
        				$("#restaurant_id").hide();
        				break;

        			case "2":
        				$("#restaurant_id").show();
        		}

        	}).change();
        });    

        $(".calendar").flatpickr(); // jQuery



        //Función para confirmar eliminado de usuario
        $('.delete').click(function() {
            var id = $(this).attr('data-id');

            swal({
              title: "¿Desea eliminar el usuario?",
              text: "",
              type: "warning",
              showCancelButton: true,
              confirmButtonClass: "btn-danger",
              confirmButtonText: "Si!!",
              cancelButtonText: "No!!",
              closeOnConfirm: false,
              closeOnCancel: false
            },
            function(isConfirm) {
              if (isConfirm) {

                swal({
                    title:'¡Usuario eliminado!',
                    text: '',
                    type: 'success'
                }, 
                function() {
                  $("#myform"+id).submit();
                });

              } else {

                swal("Cancelado", "El usuario no será eliminado!!", "error");

              }
            });
        })


        $('.generated').click(function() {
            
          swal({
            position: 'top',
            type: 'success',
            title: 'Sus códigos serán generados en breve.',
            showConfirmButton: true,
            //timer: 1500
          },
            function() 
            {
              $("#generated").submit();
            }
          );

        })

        $("#input-file").fileinput({
            showPreview: false,
            showUpload: false,
            elErrorContainer: '#kartik-file-errors',
            allowedFileExtensions: ["csv"]
            //uploadUrl: '/site/file-upload-single'
        });

    });

})(jQuery);

function myFunction() {
    //onclick="myFunction()"
    //alert("Hello! I am an alert box!");
    $("#generated").submit();
}

