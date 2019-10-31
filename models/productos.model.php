<?php

require_once 'libs/dao.php';

function obtenerTodosProductos(){
    /*$conn = new mysqli('server','user','pswd','db','port');
    if($conn->errno > 0){
      die();
    }
    $cursor = $conn->query("select * from productos;");
    $productos = array();
    if($cursor){
      foreach ($cursor as $registro){
        $productos[] = $registro;
      }
    }
    return $productos;
    */
    $productos = array();
    $productos = obtenerRegistros("select * from productos");
    return $productos;
}

function obtenerProductoXCodigo($prdcod)
{
    $sqlstr = "select * from productos where prdcod=%d;";
    $producto = array();
    $producto = obtenerUnRegistro(
        sprintf($sqlstr, $prdcod)
    );
    return $producto;
}

function agregarNuevoProducto($prddsc, $prdprc, $catcod) {
    $sqlIns = "insert into productos(prddsc, prdprc, catcod) value ('%s', %f, %d );";
    $result = ejecutarNonQuery(
    sprintf(
        $sqlIns,
        $prddsc,
        floatval($prdprc),
        intval($catcod)
    )
    );
    if ($result > 0) {
        return getLastInserId();
    } else {
        return 0;
    }
}
function actualizarProducto($prddsc, $prdprc, $catcod, $prdcod)
{
  $sqlUpd = "update productos set prddsc = '%s', prdprc = %f, catcod=%d where prdcod=%d;";
  $result = ejecutarNonQuery(
    sprintf(
      $sqlUpd,
      $prddsc,
      floatval($prdprc),
      intval($catcod),
      intval($prdcod)
    )
  );
  return $result;
}
//eliminarProducto
function eliminarProducto($prdcod)
{
  $sqlDlt = "delete from productos where prdcod=%d;";
  $result = ejecutarNonQuery(
    sprintf(
      $sqlDlt,
      intval($prdcod)
    )
  );
  return $result;
}

function obtenerCategorias()
{
    $sqlstr = "select * from categorias where catest='ACT';";
    $categorias = array();
    $categorias = obtenerRegistros($sqlstr);
    return $categorias;
}

?>
