* codprd bigint(18) AI
dscprd varchar(70) // Descripcion comercial
sdscprd varchar(255) //descripción corta
ldscprd text // descripción larga
skuprd varchar(128) UI Codigo interno empresa
bcdprd varchar(128) UI codigo de barra
stkprd int stock
typprd char(3) tipo de producto | RTL, SRV, ISK (Retail, Servicio, Infinite Stock))
prcprd decimal(12,2) precio
urlprd varchar(255) // url imagen del producto
urlthbprd varchar(255) // url imagen pequeña del producto
estprd char(3) |ACT|INA|PLN|RET|DSC
                Activo, Inactivo, Planificación, Retirado, Descontinuado


Crear el WW , de esta tabla. 


*usercod bigint(18) UZ
*codprd bigint(18)
crrctd int(5)
crrprc decima(12,2)
crrfching datetime


addProductToCart(codprd, usercod, crrctd, crrprc)
modifyQty(codprd, usercod, crrctd);
removeProductFromCart(codprd, usercod);
cleanCart(usercod);
