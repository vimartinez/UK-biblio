<?php

header( 'Content-type: text/html; charset=utf-8' );

$search = $_GET["term"];
$server = "127.0.0.1";
$bd = "biblio";
$usr ="root";
$pass = "";

  
$conn = new mysqli($server, $usr, $pass, $bd);
if (mysqli_connect_errno()) {
    printf("Falló la conexión: %s\n", mysqli_connect_error());
    exit();
}
if (!$conn->set_charset("utf8")) {
    printf("Error cargando el conjunto de caracteres utf8: %s\n", $mysqli->error);
    exit();
}

$sql = "select id, nombre from paises where nombre like   '" . $search . "%'  ORDER BY nombre DESC";
if ($resultado = $conn->query($sql)) {
    while ($fila = $resultado->fetch_row()) {
    	printf ("%s (%s)\n", $fila[0], $fila[1]);
    //	echo '<div class="suggest-element"><a data="'.$fila[1].'" id="service'.$fila[0].'">'.utf8_encode($fila[1]).'</a></div>';
    }
}
else {
	echo "No se encontraron resultados";
}
$conn->close();
?>