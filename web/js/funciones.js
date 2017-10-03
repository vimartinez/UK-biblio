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
     $("#mnuSocios").click(function () {
        $("#frmMenu #controlador").val("ControladorPrincipal");
        $("#frmMenu #metodo").val("socios");
        $("#frmMenu").submit();
    });
      $("#mnuSalir").click(function () {
        $("#frmMenu #controlador").val("ControladorPrincipal");
        $("#frmMenu #metodo").val("salir");
        $("#frmMenu").submit();
    });
     $("#frmLoginEnviar").click(function () {
    	$("#frmlogin #controlador").val("ControladorPrincipal");
        $("#frmlogin #metodo").val("loginDo");
        $("#frmlogin").submit();
    }); 
    $("#func-1").click(function () {
        $("#frmMenu #controlador").val("ControladorPrincipal");
        $("#frmMenu #metodo").val("gestionLibros");
        $("#frmMenu").submit();
    }); 
    $("#func-2").click(function () {
        $("#frmMenu #controlador").val("ControladorPrincipal");
        $("#frmMenu #metodo").val("gestionAutores");
        $("#frmMenu").submit();
    });  
    $("#func-3").click(function () {
        $("#frmMenu #controlador").val("ControladorPrincipal");
        $("#frmMenu #metodo").val("gestionSocios");
        $("#frmMenu").submit();
    });
    $("#func-4").click(function () {
        $("#frmMenu #controlador").val("ControladorPrincipal");
        $("#frmMenu #metodo").val("reservaLibros");
        $("#frmMenu").submit();
    });
});