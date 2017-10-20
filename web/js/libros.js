$().ready(function () {
    $("#frmNuevoLibro").click(function () {
    	$("#frmMenu #controlador").val("controladorLibros");
        $("#frmMenu #metodo").val("addLibro");
        $("#frmMenu").submit();
    });
     $("#frmVolverStaff").click(function () {
        $("#frmMenu #controlador").val("controladorPrincipal");
        $("#frmMenu #metodo").val("admin");
        $("#frmMenu").submit();
    });
     $("#frmVolverLibro").click(function () {
        $("#frmMenu #controlador").val("controladorLibros");
        $("#frmMenu #metodo").val("gestionLibros");
        $("#frmMenu").submit();
    });
      $("#tablaLibros td").click(function () {  
        $("#frmMenu #controlador").val("controladorLibros");
        $("#frmMenu #metodo").val("detalleLibro");
        $("#frmMenu #ID").val($(this).closest("tr").attr("id"));
        $("#frmMenu").submit();
    });

});