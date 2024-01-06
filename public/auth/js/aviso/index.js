$(function(){
    console.log('esto es el actualizado');
    
    const $table = $("#tableAviso"), $empresa_filter_id = $("#empresa_filter_id");

    const $dataTableAviso = $table.DataTable({
        // esta codigo es para eliminar el alert de datatable
        columnDefs: [{
            "defaultContent": "-",
            "targets": "_all"
        }],

        "stripeClasses": ['odd-row', 'even-row'],
        "lengthChange": true,
        "lengthMenu": [[15,75,200,500,-1],[15,75,200,500,"Todo"]],
        "info": false,
        //"buttons": [],
        "ajax": {
            url: "/auth/aviso/list_all",
            data: function(s){
                if($empresa_filter_id.val() != ""){ s.empresa_filter_id = $empresa_filter_id.val(); }
            }
        },
        "columns": [
            { title: "ID", data: "id", className: "text-center" },
            { title: "Fecha de Registro", data: "created_at", render:function(data) 
            {       
                if(data != null)return moment(data).format("DD-MM-YYYY");
                return "-";
            }},
            { title: "Nombre comercial de la empresa", data: "empresas.nombre_comercial"},
            { title: "Puesto de Trabajo", data: "titulo"},
            { 
                title: "Carrera que Solicita",
                data: "areas.nombre",
                class: "txt_claro"
            },
            {
                title: "Grado academico requerido",
                data : null,
                render: function(data){ 
                    if(data.solicita_grado_a == 0){
                        return "Estudiante"
                    }else if(data.solicita_grado_a == 1){
                        return "Egresado"
                    }else if(data.solicita_grado_a == 2){
                        return "Titulado"
                    }
                }
            },
                //{ title: "Área", data: "areas.nombre"},
            // { title: "Modalidad", data: "modalidades.nombre", class: ""},
            // { title: "Horario", data: "horarios.nombre", class: ""},
            //{ title: "Departamento", data: "provincias.nombre", render: function(data){ if(data){ return data} return "-"}},
            { title: "Distrito", data: "distritos.nombre", render: function(data){ if(data){ return data} return "-"}},
            { title: "Salario", data: "salario"},
            {
                data: null,
                defaultContent:
                    "<button type='button' class='btn btn-success p-3 btn-xs btn-seguimiento' title='Ver Aviso'><i class='fa fa-eye'></i></button>",
                "orderable": false,
                "searchable": false,
                "width": "26px"
            },
            {
                data: null,
                defaultContent:
                    "<button type='button' class='btn-primary p-3 btn-xs btn-editar' title='Editar Aviso'><i class='fa fa-edit'></i></button>",
                "orderable": false,
                "searchable": false,
                "width": "26px"
            },
            {
                data: null,
                defaultContent:
                    "<button type='button' class='btn btn-info p-3 btn-xs btn-update' data-toggle='tooltip' title='Ver Postulantes'><i class='fa fa-users'></i></button>",
                "orderable": false,
                "searchable": false,
                "width": "26px"
            },
            {
                data: null,
                defaultContent:
                    "<button type='button' class='btn btn-danger p-3 btn-xs btn-delete' data-toggle='tooltip' title='Eliminar'><i class='fa fa-trash'></i></button>",
                "orderable": false,
                "searchable": false,
                "width": "26px"
            }
        ]
        
    });

    $empresa_filter_id.on("change", function(){
        $dataTableAviso.ajax.reload();
    })

    $table.on("click", ".btn-seguimiento", function () {
        const id = $dataTableAviso.row($(this).parents("tr")).data().id;
        invocarModalView2(id)
    });

    $table.on("click", ".btn-editar", function () {
        const id = $dataTableAviso.row($(this).parents("tr")).data().id;
        invocarModalViewEditar(id)
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
        confirmAjax(`/auth/aviso/delete`, formData, "POST", null, null, function () {
            $dataTableAviso.ajax.reload(null, false);
        });
    });

    function invocarModalView(id) {
        invocarModal(`/auth/aviso/partialViewPostulante/${id ? id : 0}`, function ($modal) {
            if ($modal.attr("data-reload") === "true") $dataTableAviso.ajax.reload(null, false);
        });
    }

    function invocarModalView2(id){
        invocarModal(`/auth/aviso/partialViewAviso/${id ? id : 0}`, function ($modal) {
            if ($modal.attr("data-reload") === "true") $dataTableAviso.ajax.reload(null, false);
        });
    }

    function invocarModalViewEditar(id){
        invocarModal(`/auth/aviso/partialViewEditarAviso/${id ? id : 0}`, function ($modal) {
            if ($modal.attr("data-reload") === "true") $dataTableAviso.ajax.reload(null, false);
        });
    }





});
