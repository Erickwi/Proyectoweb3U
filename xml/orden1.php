<?php
include('../php/dbconnection.php');
  $getPro= "Select DISTINCT codigo_productos,nombre_productos, cantidad_productos  from ordenes_produccion op, productos p,productos_materiales pm, materiales m where pm.materiales_id_materiales=m.id_materiales and op.productos_id_productos=p.id_productos and pm.productos_id_productos=p.id_productos;";
  $getPro1= mysqli_query($con, $getPro);
$total1=0;
$rowP = mysqli_fetch_assoc($getPro1);
  
$c_pro=$rowP['cantidad_productos'];


CrearXML();
function LeerXML(){
  $usuarios=simplexml_load_file("xml");
  foreach($usuarios as $usuario){
    echo "Nombre". $usuario->NOMBRE."<br>";
  }
}

function CrearXML(){
  $doc =new DOMDocument('1.0');
  $doc->formatOutput=true;

  $raiz=$doc->createElement("USUARIOS");
  $raiz=$doc->appendChild($raiz);

  $usuario=$doc->createElement("USUARIO");
  $usuario=$raiz->appendChild($usuario);


  $nombre =$doc-> createElement("NOMBRE");
  $nombre=$usuario->appendChild($nombre);
  $textNombre=$doc->createTextNode($c_pro);
  $textNombre=$nombre->appendChild($textNombre);

  $telefono=$doc-> createElement("TELEFONO");
  $telefono=$usuario->appendChild($telefono);
  $textTelefono=$doc->createTextNode("0998797324");
  $textTelefono=$telefono->appendChild($textTelefono);
  echo 'Escrito'. $doc->save("xml") .'bytes <br><br>';  

  
}
?>