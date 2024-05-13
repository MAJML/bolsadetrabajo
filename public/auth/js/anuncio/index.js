console.log('te extraño amor');
var hoy = new Date(); var año = hoy.getFullYear(); var mes = ('0' + (hoy.getMonth() + 1)).slice(-2); var dia = ('0' + hoy.getDate()).slice(-2); var fecha_actual = año + '-' + mes + '-' + dia;
$(function(){
    const $table = $("#tableAnuncio");

    var $dataTableAviso = $table.DataTable({
        columnDefs: [{
            "defaultContent": "-",
            "targets": "_all"
        }],
        "stripeClasses": ['odd-row', 'even-row'],
        "lengthChange": true,
        "lengthMenu": [[5,10,20,50,-1],[5,10,20,50,"Todo"]],
        "info": false,
        "ajax": {
            url: "/auth/anuncio/list_all",
            data: function(s){
            }
        },
        "columns": [
            { title: "N°", 
              data : null,
              render: function(data, type, row, meta){
                return meta.row + 1;
              }
            },
            { title: "Registo",
                data: "created_at",
                render: function (data) {
                if (data != null) return moment(data).format("DD-MM-YYYY");
                return "-";
                },
            },
            { title: "Titulo", data : 'titulo'},
            { title: "Enlace de Redirección", data: "enlace", class: "text-left"},
            { title: "Vigencia", data: "vigencia", class: "text-left"},
            {
                title: "Banner",
                data : null,
                render: function(data){ 
                    return '<img width="60%" src="../../../'+data.banner+'" alt="">'
                }
            }
        ],
        "rowCallback": function (row, data, index) {
            if(data.vigencia <= fecha_actual){
                $("td", row).css({
                    "background-color": "#f87171",
                    "color": "#fff"
                });
            }
        }
    });

});
