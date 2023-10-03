//var OnSuccessRegistroExperienciaLaboral,
//var OnFailureRegistroExperienciaLaboral;
$(function(){

    const $modal = $("#modalMantenimientoExperienciaLaboral"), $form = $("form#registroExperienciaLaboral");

    $form.on('submit', function (e) {
        e.preventDefault();

        for(var instanceName in CKEDITOR.instances) {
            CKEDITOR.instances[instanceName].updateElement();
        }
        const formData = new FormData($(this)[0]);
        // formData.append('descripcion', CKEDITOR.instances['descripcion'].getData());
        actionAjax("/alumno/perfil/experiencia", formData, "POST", function(data){
            onSuccessForm(data, $form, $modal, null, true);
        });
    });


    //OnSuccessRegistroExperienciaLaboral = (data) => onSuccessForm(data, $form, $modal);
    //OnFailureRegistroExperienciaLaboral = () => onFailureForm();
});
