$().ready(function () {
    $("#frmNuevoAutor").click(function () {
    	$("#frmMenu #controlador").val("controladorAutores");
        $("#frmMenu #metodo").val("addAutor");
        $("#frmMenu").submit();
    });
    $("#frmVolverAutores").click(function () {
        $("#frmMenu #controlador").val("controladorAutores");
        $("#frmMenu #metodo").val("gestionAutores");
        $("#frmMenu").submit();
    });
    $("#tablaAutores img").click(function () {   
        $("#frmMenu #controlador").val("controladorAutores");
        $("#frmMenu #metodo").val("delAutor");
        $("#frmMenu #ID").val($(this).closest("tr").attr("id"));
        $("#frmMenu").submit();
    });
    $("#frmGuardarAutores").click(function () {
        $("#frmAutores #controlador").val("controladorAutores");
        $("#frmAutores #metodo").val("addAutorDo");
        $("#frmAutores").submit();
    });

});