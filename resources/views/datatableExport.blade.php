
@section('scripts')
    <script>
     $(function () {

		//Cambiar de formato los objetos de la clase .fecha
		var formatClassFecha = function(){
			$('.fecha').each(function( index ) {
				var fecha = $( this );
				var fechaStr = formatDate(fecha.data('fecha'));
				fecha.html(fechaStr);
			});
		}

		//Formato de fecha
		var formatDate = function(strDate){
			var strDateFormatted = '';
			if(strDate != '' && strDate != null){
				strDateFormatted = moment(strDate).format('DD/MM/YYYY hh:mm A');
			}
			return strDateFormatted;
		}

		formatClassFecha();

      	/*      	
      	para realizar la paginacion de una tabla lo unico que hay que hacer es asignarle un id a la tabla,
      	en este caso el id es "tabla" e invocar la función Datatable, lo demas que ven sobre esta función
      	son configuraciones de presentación
      	*/
      	//alert(fecha());
	 	var table = $('#tabla').DataTable({ 
	 		"lengthMenu": [[5, 10, 15, 25,50,100], [5, 10, 15, 25,50,100]],
	 		//"sScrollY": "350px",
	        "pagingType": "simple_numbers",
	        "bScrollCollapse": true,
	        //lengthChange: false,
	         rowReorder: {
            selector: 'td:nth-child(2)',            
        		},
        		rowReorder: false,
	        "responsive": true,
		    "language": { 
			    "sProcessing":     "Procesando...", 
			    "sLengthMenu":     "Mostrar _MENU_ registros", 
			    "sZeroRecords":    "No se encontraron resultados", 
			    "sEmptyTable":     "Ningún dato disponible en esta tabla", 
			    "sInfo":           "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros", 
			    "sInfoEmpty":      "Mostrando registros del 0 al 0 de un total de 0 registros", 
			    "sInfoFiltered":   "(filtrado de un total de _MAX_ registros)", 
			    "sInfoPostFix":    "", 
			    "sSearch":         "Buscar:", 
			    "sUrl":            "", 
			    "sInfoThousands":  ",", 
			    "sLoadingRecords": "Cargando...", 
			    "oPaginate": { 
			        "sFirst":    "Primero", 
			        "sLast":     "Último", 
			        "sNext":     "Siguiente", 
			        "sPrevious": "Anterior"
			    }
			},
        	dom: "<'row'<'form-inline' <'col-sm-offset-5'B>>>"
					 +"<'row' <'form-inline' <'col-sm-2'f>>>"
					 +"<rt>"
					 +"<'row'<'form-inline'"
					 +" <'col-sm-6 col-md-6 col-lg-6'l>"
					 +"<'col-sm-6 col-md-6 col-lg-6'p>>>",//'Bfrtip',
        	
	        buttons: [
	             {//Bton CVS
                extend: 'csvHtml5',
                exportOptions: {
                    columns: columnss
                },
                text:      '<i class="fa fa-file-text-o"></i>',
		                titleAttr: 'CSV',
		                filename:name+fecha()
            },
            {//Boton Excel
                extend: 'excelHtml5',
                exportOptions: {
                    columns: columnss
                },
                text:      '<i class="fa fa-file-excel-o"></i>',
		                titleAttr: 'Excel',
		                filename:name+fecha()
            },
            {//Boton PDF
                extend: 'pdfHtml5',
                exportOptions: {
                    columns: columnss

                },
                text:      '<i class="fa fa-file-pdf-o"></i>',
		                titleAttr: 'PDF',
		                title:title,
		                filename:name+fecha(),

		                   customize: function ( doc ) {//CARGA DE IMAGEN EN BASE 64
                    doc.content.splice( 1, 0, {
                        margin: [ 0, 0, 0, 12 ],
                        alignment: 'center',
                        image: '{{ $dataUri }}' //Variable que devuelve del controlador
                    } );
                }
            },
             {//Boton Imprimir
                extend: 'print',
                exportOptions: {
                    columns: [ 0, 1, 2, 3,4,5 ]
                },
                  //text: 'Imprimir'
                text:      '<i class="fa fa-print"></i>',
		                titleAttr: 'Imprimir'

              },
             {//Boton Ver
                extend: 'colvis',
                text: 'Ver Columnas'               
             }
                


	        ]

		

	 	});	 

		
		$('a[data-toggle="tab"]').on( 'shown.bs.tab', function (e) {
			$.fn.dataTable.tables( {visible: true, api: true} ).columns.adjust().draw();
		});

	  });
    </script>
@parent
@endsection
