var OnSuccessRegistroReferenciaLaboral, OnFailureRegistroReferenciaLaboral;
$(function(){

    const $modal = $("#modalMantenimientoReferenciaLaboral"), $form = $("form#registroReferenciaLaboral");

    OnSuccessRegistroReferenciaLaboral = (data) => onSuccessForm(data, $form, $modal);
    OnFailureRegistroReferenciaLaboral = () => onFailureForm();
});
