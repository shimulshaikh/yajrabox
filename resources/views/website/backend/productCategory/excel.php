dom: 'lBfrtip',
                buttons: [
                    {
                        extend: 'excelHtml5',
                        filename : "{{$filename}}",
                        exportOptions: {
                            columns: ':visible'
                        }
                    },
                    {
                        extend: 'pdfHtml5',
                        filename : "{{$filename}}",
                        exportOptions: {
                            columns: ':visible'
                        }
                    },
                    'colvis'
                ],