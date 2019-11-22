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

function obtenerCategoriaXCodigo($catcod)
{
    $sqlstr = "select * from categorias where catcod=%d;";
    $categoria = array();
    $categoria = obtenerUnRegistro(
        sprintf(
            $sqlstr,
            intval($catcod)
        )
    );
    return $categoria;
}

function agregarCategoria(catdsc, catest){
    $inssql = "insert into catetorias (catdsc, catest) values('%s', '%s);";
    $result = ejecutarNonQuery(
        sprintf($inssql, $catedsc, $catest)
    );
    if ($result >= 1){
      return getLastInserId();
    }
    return false;
}

function actualizarCategoria($catdsc, $catest, $catcod)
{
    $udpsql="update categorias set catdsc='%s' and catest='%s where catcod=%d";
    $result = ejecutarNonQuery(
        srpintf(
            $udpsql,
            $catdsc,
            $catest,
            intval($catcod)
        )
    );
    return $result >= 1;
}

function eliminarCategoria($catcod)
{
    $delsql = "delete from categorias where catcod=%d;";
    $result = ejecutarNonQuery(
        sprintf(
            $delsql,
            intval($catcod)
        )
    );
    return $result >= 1;
}

function getEstadosCategoria(){
    return array(
      array("catest"=>"ACT","catestdsc"=>"Activo"),
      array("catest"=>"INA","catestdsc"=>"Inactivo"),
      array("catest"=>"RET","catestdsc"=>"Retirado")
    );
}
?>
