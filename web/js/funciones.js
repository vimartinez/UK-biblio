$().ready(function () {
    $("#mnuServicios").click(function () {
    	$("#frmMenu #controlador").val("ControladorPrincipal");
        $("#frmMenu #metodo").val("servicios");
        $("#frmMenu").submit();
    });
    $("#mnuCatalogo").click(function () {
    	$("#frmMenu #controlador").val("ControladorPrincipal");
        $("#frmMenu #metodo").val("catalogo");
        $("#frmMenu").submit();
    });
    $("#mnuLinks").click(function () {
    	$("#frmMenu #controlador").val("ControladorPrincipal");
        $("#frmMenu #metodo").val("links");
        $("#frmMenu").submit();
    });
    $("#mnuLogin").click(function () {
    	$("#frmMenu #controlador").val("ControladorPrincipal");
        $("#frmMenu #metodo").val("Login");
        $("#frmMenu").submit();
    });
    $("#mnuContacto").click(function () {
    	$("#frmMenu #controlador").val("ControladorPrincipal");
        $("#frmMenu #metodo").val("contacto");
        $("#frmMenu").submit();
    });
    $("#mnuAcercaDe").click(function () {
    	$("#frmMenu #controlador").val("ControladorPrincipal");
        $("#frmMenu #metodo").val("acercaDe");
        $("#frmMenu").submit();
    });
     $("#mnuAdmin").click(function () {
    	$("#frmMenu #controlador").val("ControladorPrincipal");
        $("#frmMenu #metodo").val("admin");
        $("#frmMenu").submit();
    });
});