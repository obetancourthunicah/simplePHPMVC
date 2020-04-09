<?php
/**
 * PHP Version 7
 * Modelo de Datos para modelo
 *
 * @category Data_Model
 * @package  Models/Productos
 * @author   Orlando J Betancourth <orlando.betancourth@gmail.com>
 * @license  Comercial http://
 *
 * @version CVS: 1.0.0
 *
 * @link http://url.com
 */

require_once "libs/dao.php";


/*----------------------------------------------------------------
 Constantes como funciones
-----------------------------------------------------------------*/
/**
 * Obtiene la Delta para Carretilla Autenticada
 *
 * @return integer
 */
function getAuthTimeDelta()
{
    return 21600; // 6 * 60 * 60; // horas * minutos * segundo
    // No puede ser mayor a 34 días
}
/**
 * Obtiene la Delta para Carretilla Anónima
 *
 * @return integer
 */
function getUnAuthTimeDelta()
{
    return 600 ;// 10 * 60; //h , m, s
    // No puede ser mayor a 34 días
}

/**
 * Obtiene todos los productos
 *
 * @return array Arreglo con los Productos
 */
function todosLosProductos()
{
    $sqlSelect = "SELECT * FROM productos;";

    return obtenerRegistros($sqlSelect);
}

/**
 * Obtiene los Productos para el catálogo
 *
 * @return array Arreglo de Productos
 */
function productoCatalogo()
{
    $sqlSelect = "SELECT codprd, dscprd, stkprd, skuprd, urlthbprd, prcprd
        from productos where estprd in('ACT','DSC');";
    $tmpProducto =  obtenerRegistros($sqlSelect);
    $assocProducto = array();
    foreach ($tmpProducto as $producto) {
        //Cambiando a imagen predeterminada si no hay imagen
        $assocProducto[$producto["codprd"]] = $producto;
        if (preg_match('/^\s*$/', $producto["urlthbprd"])) {
            $assocProducto[$producto["codprd"]]["urlthbprd"]
                = "public/imgs/noprodthb.png";
        }
    }
    // Para quitar los reservados de usuario authenticados
    $timeDelta =  getAuthTimeDelta(); // 6 * 60 * 60; //h , m, s
    $sqlSelectReserved = "select codprd, sum(crrctd) as reserved
    from carretilla where TIME_TO_SEC(TIMEDIFF(now(), crrfching)) <= %d
    group by codprd;
    ";
    $arrReserved = obtenerRegistros(
        sprintf(
            $sqlSelectReserved,
            $timeDelta
        )
    );
    foreach ($arrReserved as $reserved) {
        if (isset($assocProducto[$reserved["codprd"]])) {
            $assocProducto[$reserved["codprd"]]["stkprd"]
                = $assocProducto[$reserved["codprd"]]["stkprd"]
                  - $reserved["reserved"];
        }
    }
    // Para quitar los reservados de usuarion no autenticados
    $timeDelta = getUnAuthTimeDelta(); // 10 * 60; //h , m, s
    $sqlSelectReserved = "select codprd, sum(crrctd) as reserved
    from carretillaanon where TIME_TO_SEC(TIMEDIFF(now(), crrfching)) <= %d
    group by codprd;
    ";
    $arrReserved = obtenerRegistros(
        sprintf(
            $sqlSelectReserved,
            $timeDelta
        )
    );
    foreach ($arrReserved as $reserved) {
        if (isset($assocProducto[$reserved["codprd"]])) {
            $assocProducto[$reserved["codprd"]]["stkprd"]
                = $assocProducto[$reserved["codprd"]]["stkprd"]
                  - $reserved["reserved"];
        }
    }
    return $assocProducto;
}
/**
 * Obtiene un producto
 *
 * @param integer $codprd Código de Producto
 *
 * @return void
 */
function obtenerUnProducto($codprd)
{
    $sqlSelect = "SELECT * FROM productos WHERE codprd = %d;";

    return obtenerUnRegistro(
        sprintf($sqlSelect, $codprd)
    );
}

/**
 * Obtiene solo un registro del catalogo con los datos de Stock Disponible
 *
 * @param integer $codprd Código del Producto
 *
 * @return void Arreglo del Producto
 */
function getOneProductoCatalogo($codprd)
{
    $sqlSelect = "SELECT codprd, dscprd, stkprd, skuprd, urlthbprd, prcprd
        from productos where  codprd=%d;";
    $tmpProducto =  obtenerRegistros(sprintf($sqlSelect, $codprd));
    $assocProducto = array();
    foreach ($tmpProducto as $producto) {
        //Cambiando a imagen predeterminada si no hay imagen
        $assocProducto[$producto["codprd"]] = $producto;
        if (preg_match('/^\s*$/', $producto["urlthbprd"])) {
            $assocProducto[$producto["codprd"]]["urlthbprd"]
                = "public/imgs/noprodthb.png";
        }
    }
    // Para quitar los reservados de usuario authenticados
    $timeDelta =  getAuthTimeDelta(); // 6 * 60 * 60; //h , m, s
    $sqlSelectReserved = "select codprd, sum(crrctd) as reserved
    from carretilla where TIME_TO_SEC(TIMEDIFF(now(), crrfching)) <= %d
    and codprd = %d
    group by codprd;
    ";
    $arrReserved = obtenerRegistros(
        sprintf(
            $sqlSelectReserved,
            $timeDelta,
            $codprd
        )
    );
    foreach ($arrReserved as $reserved) {
        if (isset($assocProducto[$reserved["codprd"]])) {
            $assocProducto[$reserved["codprd"]]["stkprd"]
                = $assocProducto[$reserved["codprd"]]["stkprd"]
                  - $reserved["reserved"];
        }
    }
    // Para quitar los reservados de usuarion no autenticados
    $timeDelta = getUnAuthTimeDelta(); // 10 * 60; //h , m, s
    $sqlSelectReserved = "select codprd, sum(crrctd) as reserved
    from carretillaanon where TIME_TO_SEC(TIMEDIFF(now(), crrfching)) <= %d
    and codprd = %d
    group by 1;
    ";
    $arrReserved = obtenerRegistros(
        sprintf(
            $sqlSelectReserved,
            $timeDelta,
            $codprd
        )
    );
    foreach ($arrReserved as $reserved) {
        if (isset($assocProducto[$reserved["codprd"]])) {
            $assocProducto[$reserved["codprd"]]["stkprd"]
                = $assocProducto[$reserved["codprd"]]["stkprd"]
                  - $reserved["reserved"];
        }
    }
    if (count($assocProducto)) {
        return $assocProducto[$codprd];
    } else {
        return array();
    }
}
/**
 * Creando un nuevo Producto
 *
 * @param string  $dscprd    Descripción Comercial
 * @param string  $sdscprd   Descripción Corta
 * @param string  $ldscprd   Descripción Larga
 * @param string  $skuprd    Código de Producto
 * @param string  $bcdprd    Código de Barra
 * @param integer $stkprd    Stock del Producto
 * @param string  $typprd    Tipo de Producto
 * @param double  $prcprd    Precio del Producto
 * @param string  $urlprd    Url de Imagen de Portada
 * @param string  $urlthbprd Url de Imagen de Catálogo
 * @param string  $estprd    Estado de Producto
 *
 * @return integer Codigo del producto agregado
 */
function insertProducto(
    $dscprd,
    $sdscprd,
    $ldscprd,
    $skuprd,
    $bcdprd,
    $stkprd,
    $typprd,
    $prcprd,
    $urlprd,
    $urlthbprd,
    $estprd
) {
    $sqlInsert = "INSERT INTO productos (dscprd, sdscprd, ldscprd, skuprd,
        bcdprd, stkprd, typprd, prcprd, urlprd, urlthbprd, estprd)
        VALUES ('%s', '%s', '%s', '%s', '%s', %d, '%s',
        %lf, '%s', '%s', '%s');";

    $isOk = ejecutarNonQuery(
        sprintf(
            $sqlInsert,
            $dscprd,
            $sdscprd,
            $ldscprd,
            $skuprd,
            $bcdprd,
            $stkprd,
            $typprd,
            $prcprd,
            '',
            '',
            $estprd
        )
    );
    return getLastInserId();
}

/**
 * Actualizar Datos del Productos
 *
 * @param string  $dscprd    Descripción Comercial
 * @param string  $sdscprd   Descripción Corta
 * @param string  $ldscprd   Descripción Larga
 * @param string  $skuprd    Código de Producto
 * @param string  $bcdprd    Código de Barra
 * @param integer $stkprd    Inventario de Producto
 * @param string  $typprd    Tipo de Producto
 * @param double  $prcprd    Precio del Producto
 * @param string  $urlprd    Imagen de Portada
 * @param string  $urlthbprd Imágen de Catálogo
 * @param string  $estprd    Estado del Producto
 * @param integer $codprd    Código del Producto
 *
 * @return integer Registros Modificados
 */
function updateProducto(
    $dscprd,
    $sdscprd,
    $ldscprd,
    $skuprd,
    $bcdprd,
    $stkprd,
    $typprd,
    $prcprd,
    $urlprd,
    $urlthbprd,
    $estprd,
    $codprd
) {
    $sqlUpdate = "UPDATE productos SET dscprd = '%s', sdscprd = '%s',
        ldscprd = '%s', skuprd = '%s', bcdprd = '%s', stkprd = %d,
        typprd = '%s', prcprd = %lf, estprd = '%s' WHERE codprd = %d;";

    return ejecutarNonQuery(
        sprintf(
            $sqlUpdate,
            $dscprd,
            $sdscprd,
            $ldscprd,
            $skuprd,
            $bcdprd,
            $stkprd,
            $typprd,
            $prcprd,
            $estprd,
            $codprd
        )
    );
}

/**
 * Cambia la Url de la Imagen del producto
 *
 * @param string  $url    URl del archivo ya sea local o absoluta
 * @param integer $codprd Código del Producto
 * @param string  $type   PRT : Imagen de portada, THB : Imagen Catálogo
 *
 * @return integer Registros Afectados
 */
function setImageProducto($url, $codprd, $type="PRT")
{
    $sqlUpdatePRT = "UPDATE productos SET urlprd = '%s' WHERE codprd = %d;";
    $sqlUpdateTHB = "UPDATE productos SET urlthbprd = '%s' WHERE codprd = %d;";
    $sqlUpdate = ($type === "PRT") ? $sqlUpdatePRT : $sqlUpdateTHB;
    return ejecutarNonQuery(
        sprintf(
            $sqlUpdate,
            $url,
            $codprd
        )
    );
}

/**
 * Elimina el Producto de la Tabla
 *
 * @param integer $codprd Codigo del producto
 *
 * @return integer Registro Afectados
 */
function deleteProducto($codprd)
{
    $sqlDelete = "DELETE FROM productos WHERE codprd = %d;";

    return ejecutarNonQuery(
        sprintf($sqlDelete, $codprd)
    );
}


/*----------------------------------------------------------------
 Métodos para la Carretilla
-----------------------------------------------------------------*/
/**
 * Agregar un producto a la carretilla anonima
 *
 * @param integer $codprod    Codigo de Producto
 * @param string  $uniqueUser Codigo de Identificacion anonima
 * @param integer $cantidad   Cantidad de Producto
 * @param float   $precio     Precio del Producto
 *
 * @return void
 */
function addToCartAnon($codprod, $uniqueUser, $cantidad, $precio)
{

    $productoCart = getOneProductoCatalogo($codprod);

    if (count($productoCart)) {
        if ($productoCart["stkprd"] >= $cantidad) {
            $sqlins = "INSERT INTO `carretillaanon`
            (`anoncod`, `codprd`, `crrctd`, `crrprc`, `crrfching`)
            VALUES ('%s', %d, %d, %f, now())
            ON DUPLICATE KEY UPDATE crrctd = crrctd + VALUES(crrctd),
            crrfching = now();";

            return ejecutarNonQuery(
                sprintf(
                    $sqlins,
                    $uniqueUser,
                    $codprod,
                    $cantidad,
                    $precio
                )
            );
        }
    }
    return 0;
}

/**
 * Agregar un producto a la carretilla autenticada
 *
 * @param integer $codprod  Codigo de Producto
 * @param integer $usuario  Codigo de Identificacion anonima
 * @param integer $cantidad Cantidad de Producto
 * @param float   $precio   Precio del Producto
 *
 * @return void
 */
function addToCartAuth($codprod, $usuario, $cantidad, $precio)
{
    $productoCart = getOneProductoCatalogo($codprod);
    error_log(json_encode($productoCart));
    if (count($productoCart)) {
        if ($productoCart["stkprd"] >= $cantidad) {
            $sqlins = "INSERT INTO `carretilla`
            (`usercod`, `codprd`, `crrctd`, `crrprc`, `crrfching`)
            VALUES (%d, %d, %d, %f, now())
            ON DUPLICATE KEY UPDATE crrctd = crrctd + VALUES(crrctd),
            crrfching = now();";

            return ejecutarNonQuery(
                sprintf(
                    $sqlins,
                    $usuario,
                    $codprod,
                    $cantidad,
                    $precio
                )
            );
        }
    }
    return 0;
}

/**
 * Elimina de la carretilla anonima un producto
 *
 * @param integer $codprod    Código del Producto
 * @param string  $uniqueUser Codigo de Usuario Anonimo
 * @param integer $cantidad   Cantidad a reducir
 *
 * @return integer Registro afectados
 */
function rmvCartAnon($codprod, $uniqueUser, $cantidad)
{
    $productoCart = array();
    $sqlSel = "select * from carretillaanon where anoncod='%s' and codprd=%d;";

    $productoCart = obtenerUnRegistro(
        sprintf(
            $sqlSel,
            $uniqueUser,
            $codprod
        )
    );
    if (count($productoCart)) {
        $newContidad = $productoCart["crrctd"] - $cantidad;
        if ($productoCart["crrctd"] - $cantidad > 0) {
            //solo se actualiza
            $sqlupd = "UPDATE carretillaanon set crrctd = %d, crrfching = now()
                where anoncod='%s' and codprd=%d;
            ";
            return ejecutarNonQuery(
                sprintf(
                    $sqlupd,
                    $newContidad,
                    $uniqueUser,
                    $codprod
                )
            );
        } else {
            $sqldel = "DELETE from carretillaanon where anoncod='%s' and codprd=%d;";
            return ejecutarNonQuery(
                sprintf(
                    $sqldel,
                    $uniqueUser,
                    $codprod
                )
            );
        }
    }
    return 0;
}

/**
 * Elimina de la carretilla un producto
 *
 * @param integer $codprod  Código del Producto
 * @param integer $usuario  Codigo de Usuario Autenticado
 * @param integer $cantidad Cantidad a reducir
 *
 * @return integer Registro afectados
 */
function rmvCartAuth($codprod, $usuario, $cantidad)
{
    $productoCart = array();
    $sqlSel = "select * from carretilla where usercod=%d and codprd=%d;";

    $productoCart = obtenerUnRegistro(
        sprintf(
            $sqlSel,
            $usuario,
            $codprod
        )
    );
    if (count($productoCart)) {
        $newContidad = $productoCart["crrctd"] - $cantidad;
        if ($newContidad > 0) {
            //solo se actualiza
            $sqlupd = "UPDATE carretilla set crrctd = %d, crrfching = now()
                where usercod=%d and codprd=%d;
            ";
            return ejecutarNonQuery(
                sprintf(
                    $sqlupd,
                    $newContidad,
                    $usuario,
                    $codprod
                )
            );
        } else {
            $sqldel = "DELETE from carretilla where usercod=%d and codprd=%d;";
            return ejecutarNonQuery(
                sprintf(
                    $sqldel,
                    $usuario,
                    $codprod
                )
            );
        }
    }
    return 0;
}

/**
 * Get Products in Cart for unique user
 *
 * @param string $uniqueUser Codigo de Sesión anonima
 *
 * @return integer
 */
function getCartProductsData($uniqueUser)
{
    $sqlstr = " select count(*) as productos from `carretillaanon`
    where anoncod = '%s' and TIME_TO_SEC(TIMEDIFF(now(), crrfching)) <= %d;";

    $data =  obtenerUnRegistro(
        sprintf(
            $sqlstr,
            $uniqueUser,
            getUnAuthTimeDelta()
        )
    );

    if (count($data) > 0) {
        return $data["productos"];
    }
    return 0;
}

/**
 * Get Products in Cart for authenticated user
 *
 * @param integer $usercod Código de usuario Autenticado
 *
 * @return integer
 */
function getCartProducts($usercod)
{
    $sqlstr = " select count(*) as productos from `carretilla`
    where usercod = %d and TIME_TO_SEC(TIMEDIFF(now(), crrfching)) <= %d;";

    $data =  obtenerUnRegistro(
        sprintf(
            $sqlstr,
            $usercod,
            getAuthTimeDelta()
        )
    );

    if (count($data) > 0) {
        return $data["productos"];
    }
    return 0;
}

/**
 * Pasa los productos de la carretilla anonima a la carretilla autenticada
 *
 * @param string  $uniqueUser Código de Usuario Anonimo
 * @param integer $user       Código de Usuario Autenticado
 *
 * @return integer  Cantidad de Productos en la Carretilla Autenticada
 */
function passAnonCartToCart($uniqueUser, $user)
{
    // Iniciamos Transacción para realizar varias sentencias
    // Y confirmar al final del Ciclo si no hay algun error
    iniciarTransaccion(); /// BEGIN
    $sqlins = "INSERT INTO `carretilla`
        (`usercod`, `codprd`, `crrctd`, `crrprc`, `crrfching`)
      SELECT %d as `usercodt`, `codprd` as codprdt,
        `crrctd` as crrctdt, `crrprc` as crrprct, `crrfching` as crrfchingt
         FROM `carretillaanon`
      where `anoncod` = '%s'
      ON DUPLICATE KEY UPDATE
        `carretilla`.`crrctd` = `carretilla`.crrctd + VALUES(`carretilla`.`crrctd`),
         crrfching = now();
    ";
    ejecutarNonQuery(
        sprintf(
            $sqlins,
            $user,
            $uniqueUser
        )
    );
    $sqldel = "DELETE FROM `carretillaanon` where anoncod = '%s';";
    ejecutarNonQuery(
        sprintf(
            $sqldel,
            $uniqueUser
        )
    );
    terminarTransaccion(); // COMMIT END
    // terminarTransaccion(false); // ROLLBACK END
    return getCartProducts($user);
}

/**
 * Obtiene los Productos de la Carretilla Anónima
 *
 * @param integer $usuario Código de Usuario Anonimo
 *
 * @return array Registros de Productos en la Carretilla
 */
function getAnonCartDetail($usuario)
{
    $sqlstr = "
      select a.codprd, b.skuprd, b.dscprd, a.crrctd, a.crrprc
      from `carretillaanon` a inner join `productos` b on a.codprd = b.codprd
      where a.anoncod = '%s' and TIME_TO_SEC(TIMEDIFF(now(), a.crrfching)) <= %d;
    ";

    $arrProductos = obtenerRegistros(
        sprintf(
            $sqlstr,
            $usuario,
            getUnAuthTimeDelta()
        )
    );
    $arrProductosFinal = array();
    $arrProductosFinal["products"] = array();
    $arrProductosFinal["totctd"] = 0;
    $arrProductosFinal["total"] = 0;
    $counter = 1;
    foreach ($arrProductos as $producto) {
        $producto["line"] = $counter;
        $producto["total"]
            = number_format(
                $producto["crrctd"] * $producto["crrprc"],
                2
            );
        $arrProductosFinal["totctd"] += $producto["crrctd"];
        $arrProductosFinal["total"] += ($producto["crrctd"] * $producto["crrprc"]);
        $arrProductosFinal["products"][] = $producto;
        $counter ++;
    }
    $arrProductosFinal["total"] = number_format($arrProductosFinal["total"], 2);
    return $arrProductosFinal;
}

/**
 * Obtiene los Productos de la Carretillas
 *
 * @param integer $usuario Código de Usuario
 *
 * @return array Registros de Productos en la Carretilla
 */
function getAuthCartDetail($usuario)
{
    $sqlstr = "
      select a.codprd, b.skuprd, b.dscprd, a.crrctd, a.crrprc
      from `carretilla` a inner join `productos` b on a.codprd = b.codprd
      where a.usercod = %d and TIME_TO_SEC(TIMEDIFF(now(), a.crrfching)) <= %d;
    ";
    $arrProductos = obtenerRegistros(
        sprintf(
            $sqlstr,
            $usuario,
            getAuthTimeDelta()
        )
    );
    $arrProductosFinal = array();
    $arrProductosFinal["products"] = array();
    $arrProductosFinal["totctd"] = 0;
    $arrProductosFinal["total"] = 0;
    $counter = 1;
    foreach ($arrProductos as $producto) {
        $producto["line"] = $counter;
        $producto["total"]
            = number_format(
                $producto["crrctd"] * $producto["crrprc"],
                2
            );
        $arrProductosFinal["totctd"] += $producto["crrctd"];
        $arrProductosFinal["total"] += ($producto["crrctd"] * $producto["crrprc"]);
        $arrProductosFinal["products"][] = $producto;
        $counter ++;
    }
    $arrProductosFinal["total"] = number_format($arrProductosFinal["total"], 2);
    return $arrProductosFinal;
}

/**
 * Borra la carretilla completa autenticada
 *
 * @param Integer $usuario Código de Usuario
 *
 * @return integer Registro Afectados
 */
function deleteCartAuth($usuario)
{
    $sqlDel = "DELETE from carretilla
      where usercod=%d;";

    return ejecutarNonQuery(
        sprintf(
            $sqlDel,
            $usuario
        )
    );
}

/**
 * Borra la carretilla completa no autenticada
 *
 * @param string $uniqueUser Usuario Anónimo
 *
 * @return integer Registros Afectados
 */
function deleteCartUnAuth($uniqueUser)
{
    $sqlDel = "DELETE from carretillaanon
      where anoncod='%s';";

    return ejecutarNonQuery(
        sprintf(
            $sqlDel,
            $uniqueUser
        )
    );
}

/**
 * Elimina los productos reservados fuera de tiempo
 *
 * @return void
 */
function cleanTimeOutCart()
{
    //
    $contador = 0;
    iniciarTransaccion();
    //Borrando Carretilla Anonima
    $sqlDel = "DELETE from carretillaanon
      where TIME_TO_SEC(TIMEDIFF(now(), crrfching)) > %d";

    $contador += ejecutarNonQuery(
        sprintf(
            $sqlDel,
            getUnAuthTimeDelta()
        )
    );
    // Borrando Carretilla Autenticada
    $sqlDel = "DELETE from carretilla
      where TIME_TO_SEC(TIMEDIFF(now(), crrfching)) > %d";

    $contador += ejecutarNonQuery(
        sprintf(
            $sqlDel,
            getAuthTimeDelta()
        )
    );
    terminarTransaccion();
    return $contador;
}
/**
 * Resetea el tiempo de la carretilla
 *
 * @param integer $usuario Usuario de la carretilla
 *
 * @return void
 */
function resetCartTime($usuario)
{
    $sqlUpd = "UPDATE carretilla set crrfching = now() where usercod=%d;";
    return ejecutarNonQuery(
        sprintf(
            $sqlUpd,
            $usuario
        )
    );
}
/**
 * Genera y guarda la factura de la carretilla de compra
 *
 * @param integer $usuario     Usuario de carretilla
 * @param string  $jsonPayment Respuesta de Pasarela de Pago
 *
 * @return boolean Si la factura fue generada satisfactoriamente.
 */
function crearFactura($usuario, $jsonPayment)
{
    $fctcod = false;
    iniciarTransaccion();
    //Crear la cabecera de la factura
    $sqlins = "INSERT INTO `factura`
    ( `fctfch`, `userCode`, `fctEst`, `fctMonto`,
      `fctIva`, `fctShip`, `fctTotal`, `fctPayRef`, `fctShpAddr`)
    VALUES ( now(), %d, 'APR', 0, 0, 0, 0, '', '');";
    if (ejecutarNonQuery(sprintf($sqlins, $usuario))) {
        //Crear el detalle de la factura
        $fctcod = getLastInserId();
        $carretilla = getAuthCartDetail($usuario)["products"];
        $subtotal = 0;
        $total = 0;
        $sqldetins = "INSERT INTO `factura_detalle`
            (`fctcod`, `codprd`, `fctDsc`, `fctCtd`, `fctPrc`)
            VALUES
            (%d, %d, '%s', %d, %f);";
        //Actualizar el stock de productos
        $sqlupdate = "UPDATE productos set stkprd = stkprd - %d
            where codprd = %d;";
        foreach ($carretilla as $producto) {
            $subtotal += ($producto["crrctd"] * $producto["crrprc"]);
            $total += ($producto["crrctd"] * $producto["crrprc"]);
            ejecutarNonQuery(
                sprintf(
                    $sqldetins,
                    $fctcod,
                    $producto["codprd"],
                    $producto["dscprd"],
                    $producto["crrctd"],
                    $producto["crrprc"]
                )
            );
            ejecutarNonQuery(
                sprintf(
                    $sqlupdate,
                    $producto["crrctd"],
                    $producto["codprd"]
                )
            );
        }
        //Acutalizar totales de la factura
        $sqlUpdtotal = "update `factura` set
            `fctMonto` = %f, `fctIva` = %f, `fctShip`=%f, `fctTotal`=%f
            where `fctcod` = %d;";
        ejecutarNonQuery(
            sprintf(
                $sqlUpdtotal,
                $subtotal,
                0,
                0,
                $total,
                $fctcod
            )
        );
        //Crear forma de pago de la factura
        $sqlInsFrmPago = "INSERT INTO `factura_forma_pago`
            (`fctcod`, `fctfrmpago`, `fctfrmdata`)
            VALUES
            (%d, 'PAYPAL', '%s');";
        ejecutarNonQuery(
            sprintf(
                $sqlInsFrmPago,
                $fctcod,
                $jsonPayment
            )
        );
        //Eliminar carretilla del usuario.
        deleteCartAuth($usuario);
    } else {
        terminarTransaccion(false);
        return false;
    }
    terminarTransaccion(true);
    return $fctcod;
}
?>
