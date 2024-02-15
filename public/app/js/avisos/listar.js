var $dataTableAviso, $dataTable;
$(function(){
    console.log('cambiado');
    const $table = $("#tableAviso");

    $dataTableAviso = $table.DataTable({
        "stripeClasses": ['odd-row', 'even-row'],
        "lengthChange": true,
        "lengthMenu": [[50,100,200,500,-1],[50,100,200,500,"Todo"]],
        "info": false,
        "buttons": [],
        "ajax": {
            url: "/empresa/avisos/listar_json"
        },
        "columns": [
            { title: "Fecha de Registro", data: "created_at"},
            { title: "Titulo", data: "titulo"},
            // { title: "Modalidad", data: "modalidades.nombre", class: ""},
            // { title: "Horario", data: "horarios.nombre", class: ""},
            { title: "Distrito", data: "distritos.nombre", render: function(data){ if(data){ return data} return "-"}},
            { title: "Salario", data: "salario"},
            {
                data: null,
                defaultContent:
                    "<button type='button' class='btn btn-warning btn-xs btn-update' data-toggle='tooltip' title='Actualizar'><i class='fa fa-pencil'></i></button>",
                "orderable": false,
                "searchable": false,
                "width": "26px"
            },
            {
                data: null,
                render: function(data){
                   return "<a href='/empresa/"+data.empresas.id+"/aviso/"+data.id+"' style='padding: 5px;font-size: 12px;' class='btn btn-primary btn-xs' data-toggle='tooltip' title='Ver Postulantes'><i class='fa fa-users'></i></button>";
                   /* return "<a href='/empresa/"+data.empresas.link+"/aviso/"+data.link+"' style='padding: 5px;font-size: 12px;' class='btn btn-primary btn-xs' data-toggle='tooltip' title='Ver Postulantes'><i class='fa fa-users'></i></button>"; */
                },
                "orderable": false,
                "searchable": false,
                "width": "26px"
            }
            /* ,
            {
                data: null,
                defaultContent:
                    "<button type='button' class='btn btn-danger btn-xs btn-delete' data-toggle='tooltip' title='Eliminar'><i class='fa fa-trash'></i></button>",
                "orderable": false,
                "searchable": false,
                "width": "26px"
            } */
        ]
    });

    $table.on("click", ".btn-update", function () {
        const id = $dataTableAviso.row($(this).parents("tr")).data().id;
        invocarModalView(id);
    });

    $table.on("click", ".btn-delete", function () {
        const id = $dataTableAviso.row($(this).parents("tr")).data().id;
        const formData = new FormData();
        formData.append('_token', $("input[name=_token]").val());
        formData.append('id', id);
        confirmAjax(`/empresa/avisos/delete`, formData, "POST", null, null, function () {
            $dataTableAviso.ajax.reload(null, false);
        });
    });

    $("#modalRegistrarAviso").on("click", function () {
        invocarModalView();
    });

    function invocarModalView(id) {
        invocarModal(`/empresa/avisos/partialView/${id ? id : 0}`, function ($modal) {
            if ($modal.attr("data-reload") === "true") $dataTableAviso.ajax.reload(null, false);
        });
    }

    $table.on("click", ".btn-see", function () {
        const id = $dataTableAviso.row($(this).parents("tr")).data().id;
        invocarModal(`/empresa/avisos/partialViewPostulante/${id ? id : 0}`, function ($modal) {
            if ($modal.attr("data-reload") === "true") $dataTableAviso.ajax.reload(null, false);
        });
    });

});
