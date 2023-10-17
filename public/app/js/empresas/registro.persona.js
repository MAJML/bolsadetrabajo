$(document).on("click", ".btn_persona_juridica", function(){

    DataSunat()

    $("#tipo_persona_id").val(1)

    $(".tipo_persona").html("Persona Juridica")
    $(".primera_data_label").html("Datos de la Empresa")

    $("#nombre_comercial").attr("placeholder", "Nombre de la Empresa")
    $("#ruc").attr("placeholder", "Escriba su RUC para autocompletar los datos")

    $("#name_comercio").attr("hidden", false)
    $("#name_comercio").attr("required", true)

    $("#razon_social").attr("hidden", false)
    $("#razon_social").attr("required", true)

    $("#actividad_economica_empresa").attr("hidden", false)
    $("#actividad_economica_empresa").attr("required", true)

    $("#direccion").attr("placeholder", "Dirección exacta de la Empresa")

    $(".formulario").attr("hidden", false)
    $(".caja_img_espera").attr("hidden", true)

    $("#telefono").attr("hidden", false)
    $("#telefono").attr("required", true)

    $("#pagina_web").attr("hidden", false)
    $("#pagina_web").attr("required", false)

    $("#email").attr("hidden", false)
    $("#email").attr("required", false)

    $("#caja_descripcion_item").attr("hidden", true)

    $("#caja_cargo_contacto_item").attr("hidden", false)
    $("#cargo_contacto").attr("required", true)

    $("#datos_del_paciente").attr("hidden", true)

    $("#nombre_paciente").attr("required", false)
    $("#enfermedad_paciente").attr("required", false)
    $("#evidencias").attr("required", false)

    $("#caja_logo_item").attr("hidden", false)
    $("#cajita_nombre_contacto").attr("hidden", false)
})

$(document).on("click", ".btn_persona_natural", function(){

    DataReniec()
    
    $("#tipo_persona_id").val(2)

    $(".tipo_persona").html("Persona Natural")
    $(".primera_data_label").html("Datos Generales")

    $("#nombre_comercial").attr("placeholder", "Nombre de la Persona Natural")
    $("#ruc").attr("placeholder", "Escriba su DNI para autocompletar los datos")
    $("#direccion").attr("placeholder", "Direccion")

    $("#name_comercio").attr("hidden", true)
    $("#name_comercio").attr("required", false)

    $("#razon_social").attr("hidden", true)
    $("#razon_social").attr("required", false)

    $("#actividad_economica_empresa").attr("hidden", true)
    $("#actividad_economica_empresa").attr("required", false)

    $("#telefono").attr("hidden", true)
    $("#telefono").attr("required", false)

    $("#pagina_web").attr("hidden", true)
    $("#pagina_web").attr("required", false)

    $("#email").attr("hidden", true)
    $("#email").attr("required", false)

    $("#cajita_nombre_contacto").attr("hidden", true)

    // $("#caja_logo_item").attr("hidden", true)
    // $("#caja_logo_item").attr("required", false)

    $("#caja_descripcion_item").attr("hidden", true)

    $("#caja_cargo_contacto_item").attr("hidden", true)
    $("#cargo_contacto").attr("required", false)

    $("#datos_del_paciente").attr("hidden", false)

    $("#nombre_paciente").attr("required", true)
    $("#enfermedad_paciente").attr("required", true)
    $("#evidencias").attr("required", true)

    $(".formulario").attr("hidden", false)
    $(".caja_img_espera").attr("hidden", true)

    $("#caja_logo_item").attr("hidden", true)

})

$(document).on("click", ".btn_persona_natural_empresa", function(){

    DataSunat()

    $("#cajita_nombre_contacto").attr("hidden", false)
    $("#tipo_persona_id").val(3)

    $(".tipo_persona").html("Persona Natural con Empresa")
    $(".primera_data_label").html("Datos Generales")

    $("#nombre_comercial").attr("placeholder", "Nombre de la Empresa")
    $("#ruc").attr("placeholder", "Escriba su RUC para autocompletar los datos")

    $("#name_comercio").attr("hidden", false)
    $("#name_comercio").attr("required", true)

    $("#razon_social").attr("hidden", false)
    $("#razon_social").attr("required", true)

    $("#actividad_economica_empresa").attr("hidden", false)
    $("#actividad_economica_empresa").attr("required", true)

    $("#direccion").attr("placeholder", "Dirección exacta de la Empresa")

    $(".formulario").attr("hidden", false)
    $(".caja_img_espera").attr("hidden", true)

    $("#telefono").attr("hidden", true)
    $("#telefono").attr("required", false)

    $("#pagina_web").attr("hidden", true)
    $("#pagina_web").attr("required", false)

    $("#email").attr("hidden", true)
    $("#email").attr("required", false)

    $("#caja_descripcion_item").attr("hidden", true)

    $("#caja_cargo_contacto_item").attr("hidden", true)
    $("#cargo_contacto").attr("required", false)

    $("#datos_del_paciente").attr("hidden", true)

    $("#nombre_paciente").attr("required", false)
    $("#enfermedad_paciente").attr("required", false)
    $("#evidencias").attr("required", false)

    $("#caja_logo_item").attr("hidden", true)
})

function DataReniec(){
    $("#dni").attr('hidden', false)
    $("#ruc").attr('hidden', true)
    $("#ruc").attr('required', false)
    $("#dni").attr('name', 'ruc')

    $("#registro_empresas").trigger("reset")
    $("#dni").css('border', '1px solid #27AE60')
    $("#nombre_comercial").attr('readonly', true)
    $("#razon_social").attr('readonly', false)
    $("#dni").keyup(function(){
        if($("#dni").val().length === 8){
            $data = $("#dni").val();
            actionAjax("/buscar_reniec/"+$data, null, "GET", function(data){
                respuesta = JSON.parse(data)
                /* console.log("esto es la respuesta de la data : ", respuesta) */
                if(respuesta.success == true){
                    $("#nombre_comercial").val(respuesta.data['nombre_completo'])    
                }else{
                    swal("Error", "No se encontro este documento", "warning");
                    $("#nombre_comercial").val('')            
                }

            });
        }
    })
}

function DataSunat(){
    $("#ruc").attr('hidden', false)
    $("#dni").attr('hidden', true)
    $("#dni").attr('required', false)
    $("#ruc").attr('name', 'ruc')

    $("#registro_empresas").trigger("reset")
    $("#ruc").css('border', '1px solid #27AE60')
    $("#nombre_comercial").attr('readonly', false)
    $("#razon_social").attr('readonly', true)

    $("#ruc").keyup(function(){
        if($("#ruc").val().length === 11){
            $data = $("#ruc").val();
            actionAjax("/buscar_sunat/"+$data, null, "GET", function(data){
                respuesta = JSON.parse(data)
                /* console.log("esta es la respuesta del ruc : ", respuesta) */
                if(respuesta.success == true){ 
                    $("#razon_social").val(respuesta.data['nombre_o_razon_social'])     
                    $("#direccion").val(respuesta.data['direccion'])   
                }else{
                    swal("Error", "No se encontro este documento", "warning"); 
                    $("#razon_social").val('')     
                    $("#direccion").val('')          
                }
            });
        }
    })
}
