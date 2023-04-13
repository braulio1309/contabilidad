var idioma=
            {
                "sProcessing":     "Procesando...",
                "sLengthMenu":     "Mostrar _MENU_",
                "sZeroRecords":    "No se encontraron resultados",
                "sEmptyTable":     "NingÃºn dato disponible en esta tabla",
                "sInfo":           "_START_ al _END_ de un total de _TOTAL_ registros",
                "sInfoEmpty":      "0 al 0 de un total de 0 registros",
                "sInfoFiltered":   "(filtrado de un total de _MAX_ registros)",
                "sInfoPostFix":    "",
                "sSearch":         "Buscar:",
                "sUrl":            "",
                "sInfoThousands":  ",",
                "sLoadingRecords": "Cargando...",
                "oPaginate": {
                    "sFirst":    "Primero",
                    "sLast":     "Ãšltimo",
                    "sNext":     ">>",
                    "sPrevious": "<<"
                },
                "oAria": {
                    "sSortAscending":  ": Activar para ordenar la columna de manera ascendente",
                    "sSortDescending": ": Activar para ordenar la columna de manera descendente"
                },
                "buttons": {
                    "copyTitle": 'Informacion copiada',
                    "copyKeys": 'Use your keyboard or menu to select the copy command',
                    "copySuccess": {
                        "_": '%d filas copiadas al portapapeles',
                        "1": '1 fila copiada al portapapeles'
                    },

                    "pageLength": {
                    "_": "Mostrar %d",
                    "-1": "Mostrar Todo"
                    }
                }
            };

// Call the dataTables jQuery plugin
$(document).ready(function() {
  $('#dataTable').DataTable( {
    "paging": false,
    "lengthChange": false,
    "searching": false,
    "ordering": true,
    "info": false,
	"order": [[0,'desc']],
    "autoWidth": false,
    "language": idioma,
    dom: 'lBfrtipF<"float-right">',
    buttons: {
          dom: {
            container:{
              tag:'div',
			  className:'flexcontent'
            }
          },
          buttons: [
					
                    {
                        extend:    'pdfHtml5',
                        text:      '<i class="fa fa-file-pdf"></i>',
                        title:'PDF',
                        titleAttr: 'PDF',
                        className: 'btn btn-danger  float-right export pdf',
                        alignment: "left",
                        exportOptions: {
                            columns: [':visible :not(:last-child)']
                        },
                        customize: function (doc) {
                          doc.content[1].table.widths = 
                              Array(doc.content[1].table.body[0].length + 1).join('*').split('');
                          doc.defaultStyle.alignment = 'center';
                          doc.styles.tableHeader.alignment = 'center';
                          doc.styles.tableHeader.fontSize = 14;
                        }
                    },
                    {
                        extend:    'excelHtml5',
                        text:      '<i class="fa fa-file-excel"></i>',
                        title:'Excel',
                        titleAttr: 'Excel',
                        className: 'btn btn-success float-right export excel',
                        exportOptions: {
                            columns: [':visible :not(:last-child)']
                        },
                    },
                    // {
                    //     extend:    'print',
                    //     text:      '<i class="fa fa-print"></i>',
                    //     title:'Titulo de tabla en impresion',
                    //     titleAttr: 'Imprimir',
                    //     className: 'btn btn-warning float-right export imprimir',
                    //     exportOptions: {
                    //         columns: [':visible :not(:last-child)']
                    //     }
                    // },
                ]
        }
    });
});
