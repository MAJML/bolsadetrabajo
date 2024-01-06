$(function() {
    console.log('cargado otra vez vex vez');
    const $table = $("#tableAlumno"), $dataTableAlumno = $table.DataTable({
        stripeClasses: [ "odd-row", "even-row" ],
        lengthChange: !0,
        lengthMenu: [ [15, 50, 100, 200, 500, -1 ], [ 15, 50, 100, 200, 500, "Todo" ] ],
        info: !1,
        ajax: {
            url: "/auth/alumno/list_all",
            dataSrc : function ( res ) { 
                // console.log(res.data);
                return res.data;
            }
        },
        columns: [ {
            title: "ID",
            data: "id",
            className: "text-center"
        }, {
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
        },{
            title: "CV",
            data: "id",
            render: function(data) {
                return "<a href='/auth/alumno/print_cv_pdf/" + data + "' class='btn btn-primary btn-xs' data-toggle='tooltip' title='CV'><i class='fa fa-address-card'></i></button>";
            }
        }, {
            title: "DNI",
            data: "dni"
        }, {
            title: "Apellidos",
            data: "apellidos"
        }, {
            title: "Nombres",
            data: "nombres"
        }, {
            title: "Teléfono",
            data: "telefono"
        }, 
        // {
        //     title: "E-mail",
        //     data: "email"
        // }, 
        {
            title: "Grado Académico",
            data: "egresado",
            render: function(data) {
                return data == TIPOS_ALUMNOS.ALUMNO ? "Alumno" : data == TIPOS_ALUMNOS.EGRESADO ? "Egresado" : data == TIPOS_ALUMNOS.TITULADO ? "Titulado" : "-";
            }
        }, {
            title: "Carrera",
            data: "areas.nombre",
            render: function(data) {
                return data || "-";
            }
        }, 
        // {
        //     title: "Ciudad",
        //     data: "provincias.nombre",
        //     render: function(data) {
        //         return data || "-";
        //     }
        // },
         {
            title: "Distrito de Residencia",
            data: "distritos.nombre",
            render: function(data) {
                return data || "-";
            }
        }, {
            title: "Información",
            data: null,
            render: function(data) {
                /* console.log("contando: ",data) */
                if( data.perfil_profesional == null || data.perfil_profesional == '' || data.area_id == null || data.area_id == '' || data.egresado != 0 || data.egresado != 1 || data.egresado != 2 || data.egresado != 3 || data.provincia_id == null || data.provincia_id == '' || data.distrito_id == null || data.distrito_id == '' || data.dni == null || data.dni == "" || data.telefono == null || data.telefono == "" || data.email == null || data.email == "" || data.fecha_nacimiento == null || data.fecha_nacimiento == "" || data.educaciones.length <1){ /**|| data.hoja_de_vida === null || data.hoja_de_vida === ""**/ 
                    //return "<img src='/auth/image/icon/warning.png' width='25px' title='Falta completar información'>";               
                    return "<p class='badge bg-danger p-5'>Falta</p>";             
                }else{
                    return "<p class='badge bg-success p-5'>Lleno</p>";
                }
            }
        },
        {
            title: "Estado",
            data: null,
            render: function(data){
                // console.log(data)
                if(data.aprobado == ESTADOS.CANCELADO){
                    return "<button type='button' class='btn btn-danger btn-xs btn-approved' data-toggle='tooltip' title='Aprobar'>Inactivo</button>";
                }else if(data.aprobado == ESTADOS.APROBADO){
                    return "<button type='button' class='btn btn-success btn-xs btn-cancel' data-toggle='tooltip' title='Dar de baja'>Activado</button>";
                }
                return "";
            },
            "orderable": false,
            "searchable": false,
            "width": "26px"
        },


        //  {
        //     data: null,
        //     render: function(data) {
        //         return data.aprobado == ESTADOS.CANCELADO ? "<button type='button' class='btn btn-success btn-xs btn-approved' data-toggle='tooltip' title='Aprobar'><i class='fa fa-check'></i></button>" : "";
        //     },
        //     orderable: !1,
        //     searchable: !1,
        //     width: "26px"
        // },
        //  {
        //     data: null,
        //     render: function(data) {
        //         return data.aprobado == ESTADOS.APROBADO ? "<button type='button' class='btn btn-warning btn-xs btn-cancel' data-toggle='tooltip' title='Dar de baja'><i class='fa fa-ban'></i></button>" : "";
        //     },
        //     orderable: !1,
        //     searchable: !1,
        //     width: "26px"
        // }, 


        {
            data: null,
            defaultContent: "<button type='button' class='btn btn-danger btn-xs btn-delete' data-toggle='tooltip' title='Eliminar'><i class='fa fa-trash'></i></button>",
            orderable: !1,
            searchable: !1,
            width: "26px"
        }
            // , {
            //     title: "Aprobado",
            //     data: "aprobado",
            //     render: function(data) {
            //         return data || "0";
            //     }
            // }
        ]
    });
    $table.on("click", ".btn-cancel", function() {
        const id = $dataTableAlumno.row($(this).parents("tr")).data().id, formData = new FormData();
        formData.append("_token", $("input[name=_token]").val()), formData.append("id", id), 
        formData.append("update_id", ESTADOS.CANCELADO), confirmAjax("/auth/alumno/update", formData, "POST", null, null, function() {
            $dataTableAlumno.ajax.reload(null, !1);
        });
    }), $table.on("click", ".btn-approved", function() {
        const id = $dataTableAlumno.row($(this).parents("tr")).data().id, formData = new FormData();
        formData.append("_token", $("input[name=_token]").val()), formData.append("id", id), 
        formData.append("update_id", ESTADOS.APROBADO), confirmAjax("/auth/alumno/update", formData, "POST", null, null, function() {
            $dataTableAlumno.ajax.reload(null, !1);
        });
    }), $table.on("click", ".btn-delete", function() {
        const id = $dataTableAlumno.row($(this).parents("tr")).data().id, formData = new FormData();
        formData.append("_token", $("input[name=_token]").val()), formData.append("id", id), 
        confirmAjax("/auth/alumno/delete", formData, "POST", null, null, function() {
            $dataTableAlumno.ajax.reload(null, !1);
        });
    });
});