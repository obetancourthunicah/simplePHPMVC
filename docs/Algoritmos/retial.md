# Consideraciones de un E Commerce Retail B2C

Catálogo de Producto -> Nos muestra los productos que ofrecemos (opciones de filtrado) detalles relevantes (Precio, Peso, Shipping, Existencia)

Tablas
-- productos
-- carretillacompras
-- facturas|ordenesdecompra
-- historial|decompra

Carretilla de Compra
Almacen temporal de los productos que se desean adquirir. Producto, Cliente, Cantidad, Precio, FechaHoraDeIngreso.

Checkout
Donde se confirma la adquisición del producto mediante una transacción económica. (Se debe rebajar
el stock del producto)

## El comportamiento del Stock

### Mostrando el Producto
Stock Disponible = StockReal - Stock Reservado
COD DSC STCK PRECIO
SKU1 Panadol 10 100

5 Persnos al mismo tiempo
3 No han reservado
2 han reservado 1 cada uno

Al momento de mostrar un producto (inventario) en
elementos de catálogo de producto se debe mostrar
el stock disponible
Proposito (No Vender mas de lo que tengo).

### Agregando a la carretilla de compras.
Si StockReal - Stock Reservado - CantidadSolicitad >= 0
    Yo agrego a la carretilla de compras
Sino
    Pido Disculpa y que modifique la cantidad solicitada.

### Checkout
Si StockReal - stock que reserve >=0
    Reducir del Stock Real el Stock reservado, Agregar a los historicos el producto, Eliminar la reserva de la carretilla de compra.

COD DSC STCK PRECIO
SKU1 Panadol 9 100


## Politicas de Reserva

Costo de oportunidad: Si no vendo aun reservado Costo de Oportunidad

Venta Fallida: Venta fallida:

Politica de Aseguramiento de Venta:
Estricta -- No hay Reserva de Producto
Balance -- Reserva bajo la condición de un tiempo limite. Cantidades solicitadas
Floja -- Caprisa ADIDAS -- reserva y espera hasta que me paguen

Si se permite agregar a la carretilla de compra autenticado o de forma anónima.
