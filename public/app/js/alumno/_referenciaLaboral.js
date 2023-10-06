var OnSuccessRegistroReferenciaLaboral, OnFailureRegistroReferenciaLaboral;
$(function(){

    const $modal = $("#modalMantenimientoReferenciaLaboral"), $form = $("form#registroReferenciaLaboral");

    OnSuccessRegistroReferenciaLaboral = (data) => onSuccessForm(data, $form, $modal);
    OnFailureRegistroReferenciaLaboral = () => onFailureForm();
});

$(document).on('change', '#estado', function(event) {
    // $('#estado').val($("#estado option:selected").text());
    inputs_validation()
});


function inputs_validation(){
    $("#inicio_curso").hide();
    $("#fin_curso").hide();
    var txt = $('#estado').val()
    if(txt == "En Curso"){
        $("#inicio_curso").show();     
        $("#fin_curso").attr('required', false)
        $("#inicio_curso").attr('required', false);
    }
    else if(txt == "Culminado"){
        $("#inicio_curso").show();
        $("#fin_curso").show();
        $("#inicio_curso").attr('required', true)
        $("#fin_curso").attr('required', true);
    }
}
inputs_validation()

