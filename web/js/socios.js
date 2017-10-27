$().ready(function () {
    $("#frmNuevoSocio").click(function () {
    	$("#frmMenu #controlador").val("controladorSocios");
        $("#frmMenu #metodo").val("addSocio");
        $("#frmMenu").submit();
    });
    $("#frmGuardarSocio2").click(function () {
        $("#frmAltaSocios2 #controlador").val("controladorSocios");
        $("#frmAltaSocios2 #metodo").val("addSocioDo");
        if($("#frmClave").val().length < 6 ){
            $('#frmClave').get(0).setCustomValidity('La clave debe tener al menos 6 caracteres');
            return;
        }
        if($("#frmClave2").val().length < 6 ){
            $('#frmClave2').get(0).setCustomValidity('La clave debe tener al menos 6 caracteres');
            return;
        }
      //  if($("#frmClave").val() != $("#frmClave2").val()){
      //      $('#frmClave2').get(0).setCustomValidity('Las claves ingresadas no coinciden.');
      //      return;
      //  }
        if($("#frmProvincia").val() == 0){
            $('#frmProvincia').get(0).setCustomValidity('Debe seleccionar una provincia.');
            return;
        }
        $("#frmAltaSocios2").submit();
    });
     $("#frmVolverSocio").click(function () {
        $("#frmMenu #controlador").val("controladorSocios");
        $("#frmMenu #metodo").val("gestionSocios");
        $("#frmMenu").submit();
    });
    $("#frmVolverStaff").click(function () {
        $("#frmMenu #controlador").val("controladorPrincipal");
        $("#frmMenu #metodo").val("admin");
        $("#frmMenu").submit();
    });
    $( "#frmLocalidad" ).autocomplete({
        source: function( request, response ) {
        $.ajax( {
          url: 'index.php',
        data: {
            controlador: 'controladorSocios',
            metodo: 'socioAutocomplete',
            term: request.term
        },
        type: 'POST',
          dataType: "json",
          success: function( data ) {
            response( data );
          },
          error: function (xhr, status) {
            alert('Error cargando las localidades.');
        },
        } );
      },
      minLength: 2,
      select: function( event, ui ) {
        $( "#frmNac" ).val(ui.item.value)
        $( "#autPais" ).val(ui.item.id)
      }
    });
    $("#tablaSocios img").click(function () {  
        $("#frmMenu #controlador").val("controladorSocios");
        $("#frmMenu #metodo").val("delSocio");
        $("#frmMenu #ID").val($(this).closest("tr").attr("id"));
        $("#textoDialogo").html("Esta acción borrará un socio, ¿Desea continuar?");
        $('#dialog').dialog('open');
    });
});