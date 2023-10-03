$(function(){

    const $fecha_nacimiento = $("#fecha_nacimiento");

    let anioActual = new Date().getFullYear() - 18;

    $fecha_nacimiento.datepicker({
        autoclose: true,
        format: 'dd/mm/yyyy',
        endDate: new Date("12-31-"+anioActual)
    });

    const $egresado_section = $(".egresado-section"), $egresado = $("#egresado"), $ciclo = $("#ciclo"), $semestre = $("#semestre");

});


$("#dni").keyup(function(){
    const dni = $("#dni");
    if($(dni).val().length >= 8){
        $.ajax({
            url: "https://istalcursos.edu.pe/apirest/alumnos",
            type: "POST",
            data: {
                documento : $(this).val()
            },
            dataType : "json",
            beforeSend:function(){
	        	
		    	$("#nombres").val("Buscando ...")
                $("#apellidos").val("Buscando ...")
                $("#telefono").val("Buscando ...")
                $("#email").val("Buscando ...")
                $("#fecha_nacimiento").val("Buscando ...")
		    		
		    },
            success: function (res) {
                // IMPRIMIENDO LOS DATOS DEL API
                console.log("hola estamos en el res")
                console.log(res)
                if(res.success){
                    if(res.message === "consulta satisfactoria"){
                        
                        const data = res.data[0];
                        $("#nombres").val(data.NombreAlumno)
                        $("#apellidos").val(data.Apellidos)
                        // $("#telefono").val(data.celular)  b.celular 
                        $("#telefono").val(data.celular.replace(/ /g, ""))                  
                        $("#email").val(data.email)
                        $("#fecha_nacimiento").val( data.nacimiento.substring(8,10)+"/"+data.nacimiento.substring(5,7)+"/"+data.nacimiento.substring(0,4) )
                        $("#validationDni").html("Dni correcto.").removeClass("text-muted").removeClass("text-danger").addClass("text-success")
                        $(dni).removeClass("border-danger border-dark").addClass("border-success")
                        $("#btn-registrar").prop("disabled",false)

                        console.log(data.celular)

                    }else if(res.message === "No se encontraron coincidencias con el documento ingresado"){
                        $("#nombres").val("")
                        $("#apellidos").val("")
                        $("#telefono").val("")
                        $("#email").val("")
                        $("#fecha_nacimiento").val("")
                        $(dni).removeClass("border-success border-dark").addClass("border-danger")
                        $("#validationDni").html("El dni no existe en nuestros registros.").removeClass("text-muted").removeClass("text-success").addClass("text-danger")
                    }
                } 

            },error: function (request, status, error) {
                // alert(request.responseText);
                // console.log(request.responseText)
                const txt = request.responseText
                const text2 = txt.slice(0, -2)
                // console.log(text2)
                const obj = JSON.parse(text2);
                // console.log("esto es el obj de prueba: ",obj)

                if(obj.success){
                    if(obj.message === "consulta satisfactoria"){
                        
                        const data = obj.data[0];
                        $("#nombres").val(data.NombreAlumno)
                        $("#apellidos").val(data.Apellidos)
                        // $("#telefono").val(data.celular)  b.celular 
                        $("#telefono").val(data.celular.replace(/ /g, ""))                  
                        $("#email").val(data.email)
                        $("#fecha_nacimiento").val( data.nacimiento.substring(8,10)+"/"+data.nacimiento.substring(5,7)+"/"+data.nacimiento.substring(0,4) )
                        $("#validationDni").html("Dni correcto.").removeClass("text-muted").removeClass("text-danger").addClass("text-success")
                        $(dni).removeClass("border-danger border-dark").addClass("border-success")
                        $("#btn-registrar").prop("disabled",false)

                    }else if(obj.message === "No se encontraron coincidencias con el documento ingresado"){
                        $("#nombres").val("")
                        $("#apellidos").val("")
                        $("#telefono").val("")
                        $("#email").val("")
                        $("#fecha_nacimiento").val("")
                        $(dni).removeClass("border-success border-dark").addClass("border-danger")
                        $("#validationDni").html("El dni no existe en nuestros registros.").removeClass("text-muted").removeClass("text-success").addClass("text-danger")
                    }
                }

            }
        });

    }else{
        
        $("#nombres").val("")
        $("#apellidos").val("")
        $("#telefono").val("")
        $("#email").val("")
        $("#fecha_nacimiento").val("")
        $(dni).removeClass("border-success border-danger").addClass("border-dark")
        $("#validationDni").html("Ingrese su dni correcto para autocopletar su información.").removeClass("text-danger").removeClass("text-success").addClass("text-muted")
        $("#btn-registrar").prop("disabled",true)

    }
})