# Servicios
Caso : Cadena Hotelera Granada 5.

Cliente (Huesped) quiere reservar un habitación
de x fecha a y fecha.
// Detección de colisiones.

Habitacion | FchIniReserva (RI) | FchFinReserva (RF)
-------------------------------------------
1 | 20200318 | 20200320
2 | 20200316 | 20200401
3 | 20200413 | 20200416
1 | 20200325 | 20200327

Nueva Solicitud de Reserva
---------------------------
x | 20200319 | 20200320
    SI          SF 

---- > Tiempo es siempre positivo

!(SF < RI || SI > RF)

select habitacion, count(*) from Reservas where not ( rini > ? or rfin < ? group by habitacion );

$habitacionesDisponibles = array();
for $Registros as $registro
  if (count(*) = 0) {
    $habitacionesDisponible[] = $registro;
  }
endfor

# Capacidad de Planta
El Hogar --> Pastelería
------------------------------------------
Margen de Tiempo : 1Día
Capacidad de Produccion: 100

Productos bajos orden (producción o frabricación)
Agencias de Planificadores de Eventos
Agencias de Bienes Raices
Salas de Cine 
