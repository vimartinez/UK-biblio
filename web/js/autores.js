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

});