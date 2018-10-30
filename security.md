# Esquema de Seguridad

## 1 Verificación y Validación de credenciales ( LOGIN )
Esto no se debe hacer
```
select * from users where username=? and userpswd=?;
```
Este esquema de seguridad que muchos han utilizado genera perdida de información que puede ser vital para el aseguramiento de un sitio o negocio en la web.

¿Como validar las credenciales?
1. Verificar que el usuario exista
```
select * from users where username=?;
```
2. Si el usuario existe verificar si está activo
3. Si el usuario esta activo verificar que la contraseña sea valida
4. Si la contraseña está validad verificar si no está expirada
5. Si no está expirada la contraseña setear indicadores como fechadeUltimo logueo, intentos fallidos a 0, ip de donde inicia sesión, guardar bitacora de ingreso etc...

En el caso de que cualquiera de los anteriores falle se puede proceder a:

- Si hay más de n intentos fallidos seguidos proceder a bloquear usuario, notificar por correo el intento de ingreso, bloquear temporalmente o guardar en bitacora.
- Si el usuario no está activo, guardar en bitacora el intento de acceso.
- Si la contraseña está expirada enviar a cambiar contraseña
- Incrementar el contador de intentos fallidos para proceder al llegar un límite.

## 2 Autenticación

Cuando se quiere ingresar a un sitio protegido o privado el paso de autenticar al usuario que ingresa es necesario, esto se puede realizar guardando elementos en la sesión que identifiquen al usuario.

Pasos que se pueden realizar para autenticar un acceso a un recurso:

1. Verificar que el recurso esté protegido o requiere autenticación.
2. Verificar que existan credenciales a autenticar
3. Verificar que las credenciales autenticadas no han expirado.
4. Acceder al recurso

La autenticación puede fallar por vigencia de credenciales expirada, forzado de expiración de credenciales, o credenciales inexistentes. Para todos estos casos se puede reenviar a un Validador de credenciales. (login)

## 3 Verificación de Acceso

Se verifica que se puede o no realizar


Esquema de Datos

 usuario -- perfil unico  !!!!!!NO USAR

 fulanito -- publico
 menganito -- pulbico, administrador
 paquita -- publico , auditor
 gerente de operaciones -- publico, vendedor, auditor, almacenes

 (usuarios, roles,  usuarios_x_roles)

 estaEnRol($usuario, ['administrador','publico']) | verdadero o falso;

 p_rutas
 p_ruta
 f_rutas_ins
 f_rutas_del
 f_rutas_upd
 f_rutas_del

(funciones, funciones_rol)

autorizado($usuario,'p_ruta');


 5 tablas
