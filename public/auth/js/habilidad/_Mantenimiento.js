var OnSuccessRegistroHabilidad, OnFailureRegistroHabilidad;
$(function(){

    $("#tipo").val($("#tipo_mant").val());

    const $modal = $("#modalMantenimientoHabilidad"), $form = $("form#registroHabilidad");

    OnSuccessRegistroHabilidad = (data) => onSuccessForm(data, $form, $modal);
    OnFailureRegistroHabilidad = () => onFailureForm();
});
