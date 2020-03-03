<?php 
require_once 'libs/dao.php';

function obtenerCentrosDeCostos()
{
    $sqlstr = "select * from centrocostos;";
    return obtenerRegistros($sqlstr);
}

function obtenerCCxCodigo($cccod)
{
    $sqlstr = "select * from centrocostos where cccod=%d;";
    return obtenerUnRegistro(
        sprintf(
            $sqlstr,
            $cccod
        )
    );
}

function agregCentroCosts($ccdsc, $ccest)
{
    $sqlins = "insert into centrocostos (ccdsc, ccest) value('%s', '%s');";
    return ejecutarNonQuery(
        sprintf(
            $sqlins,
            $ccdsc,
            $ccest
        )
    );
}

function actualizarCC($ccdsc, $ccest, $cccod)
{
    $sqlupd = "update centrocostos set ccdsc='%s', ccest='%s' where cccod=%d;";
    return ejecutarNonQuery(
        sprintf(
            $sqlupd,
            $ccdsc,
            $ccest,
            $cccod
        )
    );
}

function eliminarCC($cccod)
{
    $sqldel = "delete from centrocostos where cccod=%d;";
    return ejecutarNonQuery(
        sprintf(
            $sqldel,
            $cccod
        )
    );
}

?>
