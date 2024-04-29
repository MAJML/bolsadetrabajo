$(function(){
    console.log('esto es el actualizado');
    
    const $table = $("#tableAviso"), $empresa_filter_id = $("#empresa_filter_id"), $aviso_estado = $("#aviso_estado");
    var hoy = new Date(); var año = hoy.getFullYear(); var mes = ('0' + (hoy.getMonth() + 1)).slice(-2); var dia = ('0' + hoy.getDate()).slice(-2); var fecha_actual = año + '-' + mes + '-' + dia;
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
                if($aviso_estado.val() != ""){ s.aviso_estado = $aviso_estado.val(); }
            }
        },
        "columns": [
            { title: "N°", data: null, className: "text-center",
                render: function(data, type, row, meta){
                    return meta.row + 1;
                } },
            {
                title: "Año R",
                data: "created_at",
                render: function(data) {
                    return null != data ? moment(data).format("YYYY") : "-";
                }
            }, {
                title: "Mes R",
                data: "created_at",
                render: function(data) {
                    return null != data ? moment(data).format("MM") : "-";
                }
            },{
                title: "Dia R",
                data: "created_at",
                render: function(data) {
                    return null != data ? moment(data).format("DD") : "-";
                }
            },
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
                        return "ESTUDIANTE"
                    }else if(data.solicita_grado_a == 1){
                        return "EGRESADO"
                    }else if(data.solicita_grado_a == 2){
                        return "TITULADO"
                    }
                }
            },
                //{ title: "Área", data: "areas.nombre"},
            // { title: "Modalidad", data: "modalidades.nombre", class: ""},
            // { title: "Horario", data: "horarios.nombre", class: ""},
            //{ title: "Departamento", data: "provincias.nombre", render: function(data){ if(data){ return data} return "-"}},
            { title: "Distrito", data: "distritos.nombre", render: function(data){ if(data){ return data} return "-"}},
            { title: "Salario", 
                data: null, 
                render: function(data){
                    if (!isNaN(data.salario)) {
                        return 'S/ '+data.salario
                    } else {
                        return data.salario
                    }

                }
            },
            {
                data: null,
                render: function(data){
                    if(data.estado_aviso == 0){
                        return "<button type='button' class='btn btn-warning btn-xs btn-approved' data-toggle='tooltip' title='Aprobar'><i class='fa fa-ban'></i></button>";
                    }else if(data.estado_aviso == 1){
                        return "<button type='button' class='btn btn-success btn-xs btn-cancel' data-toggle='tooltip' title='Dar de baja'><i class='fa fa-check'></i></button>";
                    }
                    return "";
                },
                "orderable": false,
                "searchable": false,
                "width": "26px"
            },
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
        ],
        "rowCallback": function (row, data, index) {
            if(data.periodo_vigencia < fecha_actual){
                $("td", row).css({
                    "background-color": "#f87171",
                    "color": "#fff"
                });
            }
        }   
    });

    $empresa_filter_id.on("change", function(){
        $dataTableAviso.ajax.reload();
    })
    $aviso_estado.on("change", function(){
        $dataTableAviso.ajax.reload();
    })

    $table.on("click", ".btn-cancel", function () {
        const id = $dataTableAviso.row($(this).parents("tr")).data().id;
        const formData = new FormData();
        formData.append('_token', $("input[name=_token]").val());
        formData.append('id', id);
        formData.append('update_id', 0);
        confirmAjax(`/auth/aviso/updateAvisoEstado`, formData, "POST", null, null, function () {
            $dataTableAviso.ajax.reload(null, false);
        });
    });

    $table.on("click", ".btn-approved", function () {
        const id = $dataTableAviso.row($(this).parents("tr")).data().id;
        const formData = new FormData();
        formData.append('_token', $("input[name=_token]").val());
        formData.append('id', id);
        formData.append('update_id', 1);
        confirmAjax(`/auth/aviso/updateAvisoEstado`, formData, "POST", null, null, function () {
            $dataTableAviso.ajax.reload(null, false);
        });
    });


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
