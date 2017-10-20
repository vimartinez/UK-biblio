<?php
//require_once 'ModeloPrincipal.php';

$search = $_GET["term"];
$server = "127.0.0.1";
$bd = "biblio";
$usr ="root";
$pass = "";

  
$conn = new mysqli($server, $usr, $pass, $bd);

//$mp = new ModeloPrincipal("");
//$conn = $mp->conectarBD();
if (mysqli_connect_errno()) {
    printf("Falló la conexión: %s\n", mysqli_connect_error());
    exit();
}
if (!$conn->set_charset("utf8")) {
    printf("Error cargando el conjunto de caracteres utf8: %s\n", $mysqli->error);
    exit();
}
$res = array();
$sql = "select id, nombre as value from paises where nombre like   '" . $search . "%'  ORDER BY nombre DESC";
if ($resultado = $conn->query($sql)) {
    while ($fila = $resultado->fetch_array(MYSQLI_ASSOC)) {
		$res[] = $fila;
    }
}
echo json_encode($res);
$conn->close();
//$mp->desconectarBD($conn);
?>

 