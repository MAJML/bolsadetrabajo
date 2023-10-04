$(function(){

    // sintaxis para abrir nuevo modal de registros
    
    $("#open").click(function(){
        $("#modal_container").addClass("show")
    })

    $("#close").click(function(){
        $("#modal_container").removeClass("show")
    })


    const $table = $("#tablePostulante");

    const $dataTablePostulante = $table.DataTable({
        columnDefs: [{
            "defaultContent": "-",
            "targets": "_all"
        }],
        "stripeClasses": ['odd-row', 'even-row'],
        "lengthChange": true,
        "lengthMenu": [[50,100,200,500,-1],[50,100,200,500,"Todo"]],
        "info": false,
        //"buttons": [],
        "ajax": {
            url: "/auth/aviso/list_all_postulantes",
            // url: "/auth/alumno/list_all",
            data: function (s) {
                s.id = $("#id").val();
            }
        },
        "columns": [
            { 
                title: "#", data: "alumnos.id", className: "text-center"
            },
            { title: "Alumno", data: "alumnos", className: "text-center", render: function (data){
                return data.nombres + " " + data.apellidos;
            }},{
                title: "CV",data: "alumnos", className: "text-center", render: function (data){
                    return "<a href='/auth/alumno/print_cv_pdf/" + data.id + "' class='btn btn-success btn-xs p-1' data-toggle='tooltip' title='CV'><i class='fa fa-address-card'></i></button>";
            }},
            { title: "DNI", data: "alumnos.dni", className: "text-center" },
            { title: "Teléfono", data: "alumnos.telefono", className: "text-center" },
            {
                title: "Estado", data: "alumnos", className: "text-center", render: function (data){
                    if (data.egresado == 1){
                        return "Estudiante";
                    }else if (data.egresado == 2){
                        return "Egresado";
                    }else if (data.egresado == 3){
                        return "Titulado";
                    }
                         
            }},
            { title: "E-mail", data: "alumnos.email", className: "text-center" },
            { title: "Usuario", data: "alumnos.usuario_alumno", className: "text-center" },
            { title: "Fecha de Registro", data: "created_at", render:function(data)
            {
                if(data != null)return moment(data).format("DD-MM-YYYY");
                return "-";
            }}
        ]
    });

    const $table3 = $("#tableSeguimientosInter");

    const $dataTablePostulante3 = $table3.DataTable({
        columnDefs: [{
            "defaultContent": "-",
            "targets": "_all"
        }],
        "stripeClasses": ['odd-row', 'even-row'],
        "lengthChange": true,
        "lengthMenu": [[50,100,200,500,-1],[50,100,200,500,"Todo"]],
        "info": false,
        //"buttons": [],
        "ajax": {
            url: "/auth/aviso/ajax_list2",
            // url: "/auth/alumno/list_all",
            data: function (s) {
                s.id = $("#id").val();
            }
        },
        "columns": [
            { 
                title: "#", data: "id", className: "text-center"
            },
            { title: "Fecha del envio de los postulantes", data: "fecha_envio_postulantes", className: "text-center" },
            { title: "Fecha del Seguimiento", data: "fecha_seguimiento", className: "text-center" },
            { title: "Comentarios", data: "comentarios", className: "text-center" }
        ]
    });




});
