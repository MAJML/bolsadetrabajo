console.log("esto es nuevo js")
$(function(){
    const $table = $("#tableAvisoPostulantes"), $empresa_filter_id = $("#empresa_filter_id");

    const $dataTableAviso = $table.DataTable({
        columnDefs: [{
            "defaultContent": "-",
            "targets": "_all"
        }],
        "stripeClasses": ['odd-row', 'even-row'],
        "lengthChange": true,
        "lengthMenu": [[15,75,200,500,-1],[15,75,200,500,"Todo"]],
        "info": false,
        "ajax": {
            url: "/auth/avisoPostulacion/list_all",
            data: function(s){
                if($empresa_filter_id.val() != ""){ s.empresa_filter_id = $empresa_filter_id.val(); }
            }
        },
        "columns": [
            { title: "ID", 
              data : 'id'},
            { title: "Fecha Postulación", data : 'fecha_postulacion'},
            { title: "Nombre", data: "nombres", class: "text-left"},
            { title: "Apellidos", data: "apellidos", class: "text-left"},
            { title: "DNI", data: "dni"},
            { title: "Estado", data: "estado"},
            { title: "Titulo Oferta", data: "titulo", class: "text-left"},
            { title: "Empresa", data: "nombre_comercial", class: "text-left"},
            { title: "Ruc", data: "ruc"}
        ]
        
    });
    $empresa_filter_id.on("change", function(){
        $dataTableAviso.ajax.reload();
    })

});
