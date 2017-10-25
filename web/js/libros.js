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
     $("#frmGuardarLibro").click(function () {
        $("#frmAltaLibro #controlador").val("controladorLibros");
        $("#frmAltaLibro #metodo").val("addLibroDo");
        $("#frmAltaLibro").submit();
    });
      $("#tablaLibros td").click(function () {  
        if ($(this).children().first().attr('id') == "delLibro"){
             $("#frmMenu #controlador").val("controladorLibros");
            $("#frmMenu #metodo").val("delLibro");
            $("#frmMenu #ID").val($(this).closest("tr").attr("id"));
            $("#textoDialogo").html("Se eliminarán todas las copias del libro seleccionado, ¿desea continuar?");
            $('#dialog').dialog('open');
            return;
        }
        else {
                if ($(this).children().first().attr('id') == "imprEtiquetas"){
                    $("#frmMenu #controlador").val("controladorLibros");
                    $("#frmMenu #metodo").val("imprimirEtiquetas");
                    $("#frmMenu #ID").val($(this).closest("tr").attr("id"));
                    $("#textoDialogo").html("Se imprimirán las etiquetas para el libro seleccionado, ¿desea continuar?");
                    $('#dialog').dialog('open');
                    return;
            }
            else {
                $("#frmMenu #controlador").val("controladorLibros");
                $("#frmMenu #metodo").val("detalleLibro");
                $("#frmMenu #ID").val($(this).closest("tr").attr("id"));
                $("#frmMenu").submit();
                return;
            }
        }
    });
    $("#frmNuevoAutor").click(function () {
        $("#frmMenu #controlador").val("controladorAutores");
        $("#frmMenu #metodo").val("addAutor");
        $("#frmMenu").submit();
    });
    $("#tablaLibrosDet td").click(function () {  
        if ($(this).children().first().attr('id') == "updEstadoCopia"){
            $("#frmMenu #controlador").val("controladorLibros");
            $("#frmMenu #metodo").val("updEstadoCopia");
            $("#frmMenu #ID").val($(this).closest("tr").attr("id"));
            $("#frmMenu").submit();
            return;
        }
    });
    $("#frmActualizarEstado").click(function () {
        $("#frmEstadoCopia #controlador").val("controladorLibros");
        $("#frmEstadoCopia #metodo").val("updEstadoCopiaDo");
        $("#frmEstadoCopia").submit();
    });
});