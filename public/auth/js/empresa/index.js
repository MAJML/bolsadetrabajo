var $dataTableEmpresa, $dataTable;
$(function(){

    const $table = $("#tableEmpresa");

    $dataTableEmpresa = $table.DataTable({
        "stripeClasses": ['odd-row', 'even-row'],
        "lengthChange": true,
        "lengthMenu": [[15,50,100,200,-1],[15,50,100,200,"Todo"]],
        "info": false,
        //"buttons": [],
        "ajax": {
            url: "/auth/empresa/list_all"
        },
        "columns": [
            { title: "ID", data: "id", className: "text-center" },
            { title: "RUC", data: "ruc"},
            { title: "Razón Social", data: "razon_social"},  
            { title: "Nombre de la Empresa", data: "nombre_comercial", class: "hidden"},
            { title: "Ciudad", data: "provincias.nombre", class: "hidden", render: function(data){ if(data){ return data} return "-"}},
            { title: "Distrito", data: "distritos.nombre", class: "hidden", render: function(data){ if(data){ return data} return "-"}},
            { title: "Dirección", data: "direccion", class: "hidden"},
            { title: "Teléfono Empresa", data: "telefono", class: "hidden"},
            { title: "E-mail", data: "email"},
            { 
                title: "Nombre Contacto", data: null,
                render: function(data){
                    // console.log(data)
                    if(data){
                        return data.nombre_contacto+" "+ data.apellido_contacto;
                    }
                },
                "orderable": false,
                "searchable": false,
                "width": "26px"
            },
            { title: "Cargo Contacto", data: "cargo_contacto", class: "hidden"},
            { title: "Teléfono Contacto", data: "telefono_contacto"},
            { title: "Email del Contacto", data: "email_contacto", class: "hidden"},
            { 
                title: "Tipo de Persona", data: null,
                render: function(data){
                    // console.log(data)
                    if(data.tipo_persona == 1){
                        return "Persona Juridica";
                    }else if(data.tipo_persona == 2){
                        return "Persona Natural";
                    }else if(data.tipo_persona == 3){
                        return "Persona Natural con Negocio";
                    }
                    return "";
                },
                "orderable": false,
                "searchable": false,
                "width": "35px"
            },
            { title: "Fecha de Registro", data: "created_at", render:function(data)
            {
                if(data != null)return moment(data).format("DD-MM-YYYY");
                return "-";
                
            }},
                 
            {
                data: null,
                defaultContent:
                    "<button type='button' class='btn btn-info btn-xs btn-update' data-toggle='tooltip' title='Ver'><i class='fa fa-eye'></i></button>",
                "orderable": false,
                "searchable": false,
                "width": "26px"
            },
            {
                data: null,
                render: function(data){
                    // console.log(data)
                    if(data.aprobado == ESTADOS.CANCELADO){
                        return "<button type='button' class='btn btn-warning btn-xs btn-approved' data-toggle='tooltip' title='Aprobar'><i class='fa fa-ban'></i></button>";
                    }else if(data.aprobado == ESTADOS.APROBADO){
                        return "<button type='button' class='btn btn-success btn-xs btn-cancel' data-toggle='tooltip' title='Dar de baja'><i class='fa fa-check'></i></button>";
                    }
                    return "";
                },
                "orderable": false,
                "searchable": false,
                "width": "26px"
            },
            // {
            //     data: null,
            //     render: function(data){
            //         if(data.aprobado == ESTADOS.APROBADO){
            //             return "<button type='button' class='btn btn-warning btn-xs btn-cancel' data-toggle='tooltip' title='Dar de baja'><i class='fa fa-ban'></i></button>";
            //         }
            //         return "";
            //     },
            //     "orderable": false,
            //     "searchable": false,
            //     "width": "26px"
            // },
            {
                data: null,
                defaultContent:
                    "<button type='button' class='btn btn-danger btn-xs btn-delete' data-toggle='tooltip' title='Eliminar'><i class='fa fa-trash'></i></button>",
                "orderable": false,
                "searchable": false,
                "width": "26px"
            }
        ]
    });

    $table.on("click", ".btn-update", function () {
        const id = $dataTableEmpresa.row($(this).parents("tr")).data().id;
        invocarModalView(id);
    });

    $table.on("click", ".btn-cancel", function () {
        const id = $dataTableEmpresa.row($(this).parents("tr")).data().id;
        const formData = new FormData();
        formData.append('_token', $("input[name=_token]").val());
        formData.append('id', id);
        formData.append('update_id', ESTADOS.CANCELADO);
        confirmAjax(`/auth/empresa/update`, formData, "POST", null, null, function () {
            $dataTableEmpresa.ajax.reload(null, false);
        });
    });

    $table.on("click", ".btn-approved", function () {
        const id = $dataTableEmpresa.row($(this).parents("tr")).data().id;
        const formData = new FormData();
        formData.append('_token', $("input[name=_token]").val());
        formData.append('id', id);
        formData.append('update_id', ESTADOS.APROBADO);
        confirmAjax(`/auth/empresa/update`, formData, "POST", null, null, function () {
            $dataTableEmpresa.ajax.reload(null, false);
        });
    });

    $table.on("click", ".btn-delete", function () {
        const id = $dataTableEmpresa.row($(this).parents("tr")).data().id;
        const formData = new FormData();
        formData.append('_token', $("input[name=_token]").val());
        formData.append('id', id);
        confirmAjax(`/auth/empresa/delete`, formData, "POST", null, null, function () {
            $dataTableEmpresa.ajax.reload(null, false);
        });
    });


    $("#modalRegistrarEmpresa").on("click", function () {
        invocarModalView();
    });

    function invocarModalView(id) {
        console.log("este es el id: ", id)
        invocarModal(`/auth/empresa/partialView/${id ? id : 0}`, function ($modal) {
            if ($modal.attr("data-reload") === "true") $dataTableEmpresa.ajax.reload(null, false);
        });
    }
});
