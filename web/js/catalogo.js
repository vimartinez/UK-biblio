$().ready(function () {
    $("#tablaLibros td").click(function () {  
        if ($(this).children().first().attr('id') == "detalleLibro"){
             $("#frmMenu #controlador").val("controladorLibros");
            $("#frmMenu #metodo").val("libroDet");
            $("#frmMenu #ID").val($(this).closest("tr").attr("id"));
            $("#frmMenu").submit();
            return;
        }
        else {
                if ($(this).children().first().attr('id') == "reservaLibro"){
                    $("#frmMenu #controlador").val("controladorLibros");
                    $("#frmMenu #metodo").val("reservarLibro");
                    $("#frmMenu #ID").val($(this).closest("tr").attr("id"));
                    $("#textoDialogo").html("Se generará la reserva del libro, ¿desea continuar?");
                    $('#dialog').dialog('open');
                    return;
            }
        }
    });
    $("#frmVolverCatalogo").click(function () {
        $("#frmMenu #controlador").val("controladorPrincipal");
        $("#frmMenu #metodo").val("catalogo");
        $("#frmMenu").submit();
    });
     $("#frmReservar").click(function () {
        $("#frmMenu #controlador").val("controladorLibros");
        $("#frmMenu #metodo").val("reservarLibro");
        $("#frmMenu #ID").val($("#idLibr").val());
        $("#textoDialogo").html("Se generará la reserva del libro, ¿desea continuar?");
        $('#dialog').dialog('open');
        return;
    });
});