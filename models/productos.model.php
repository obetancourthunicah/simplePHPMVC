<?php
require_once 'libs/dao.php';

/**
 * ObtenerProductos
 * Obtiene todos los productos de la tabla productos.
 *
 * @return array
 */
function obtenerProductos()
{
    $sqlstr = "select * from productos;";
    $productos = array();
    $productos = obtenerRegistros($sqlstr);
    return $productos;
}

/**
 * Agrega Nuevo Producto a la tabla de productos
 *
 * @param Array $data arreglo con los campos del formulario
 *
 * @return integer Devuelve el id del producto generado.
 */
function agregarNuevoProducto($data)
{
    $insSql = "INSERT INTO `productos`
( `prddsc`, `prdcodbrr`, `prdSKU`, `prdStock`,
`prdPrcVVnt`, `prdPrcCpm`, `prdImgUri`, `prdEst`, `prdBio`)
VALUES ( '%s','%s', '%s', %d, %f, %f, '%s', '%s','%s');";

    $result = ejecutarNonQuery(
        sprintf(
            $insSql,
            $data["prddsc"],
            $data["prdcodbrr"],
            $data["prdSKU"],
            $data["prdStock"],
            $data["prdPrcVVnt"],
            $data["prdPrcCpm"],
            $data["prdImgUri"],
            $data["prdEst"],
            $data["prdBio"]
        )
    );
    if ($result) {
        return getLastInserId();
    }
    
    return false;
}
/**
 * Obtiene un Producto a partir del código suminstrado
 *
 * @param integer $prdcod Código de Producto
 *
 * @return Array
 */
function obtieneProductoPorId($prdcod)
{
    $sqlstr = "Select * from productos where prdcod=%d;";
    return obtenerUnRegistro(sprintf($sqlstr, $prdcod));
}

/**
 * Devuelve los Estados Posibles de un Producto
 *
 * @return array
 */
function obtenerEstados()
{
    return Array(
        Array("cod" => "ACT", "dsc" => "Activo"),
        Array("cod" => "PLN", "dsc" => "En Evaluación"),
        Array("cod" => "INA", "dsc" => "Inactivo")
    );
}

/**
 * Actualiza el Registro del Producto
 *
 * @param array $data Datos Del Formulario Debidamente Validados
 *
 * @return boolean
 */
function actualizarProducto($data)
{
    $updSql = "UPDATE `productos` set
 `prddsc` = '%s', `prdcodbrr` = '%s', `prdSKU` = '%s', `prdStock` = %d,
  `prdPrcVVnt` = %f, `prdPrcCpm` = %f, `prdImgUri` = '%s', `prdEst` = '%s',
  `prdBio`='%s' where prdCod = %d;";

    $result = ejecutarNonQuery(
        sprintf(
            $updSql,
            $data["prddsc"],
            $data["prdcodbrr"],
            $data["prdSKU"],
            $data["prdStock"],
            $data["prdPrcVVnt"],
            $data["prdPrcCpm"],
            $data["prdImgUri"],
            $data["prdEst"],
            $data["prdBio"],
            $data["prdcod"]
        )
    );
    return $result;
}

/**
 * Eliminando un Producto de l Base de Datos
 *
 * @param integer $prdcod Código del Producto a Eliminar
 *
 * @return boolean Resultado de la eliminación
 */
function eliminarProducto($prdcod)
{
    $delSql = "delete from `productos` where prdcod = %d;";
    return ejecutarNonQuery(
        sprintf(
            $delSql,
            $prdcod
        )
    );
}
?>
