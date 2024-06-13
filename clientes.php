<?php
require_once("layouts/headAdmin.php");
?>

<body>
    <?php
    require_once("layouts/headerAdmin.php");
    ?>
    <div class="container-fluid py-4">
        <div class="row d-flex align-items-center">
            <div class="col-auto title-clientes">
                <span>CLIENTES</span>
            </div>
            <div class="col-auto">
                <button type="button" class="btn btn-primary w-auto btn-clientes" id="agregar-cliente" data-bs-toggle="modal" data-bs-target="#modalAgregarCliente"><i class="fa-solid fa-file-circle-plus"></i> AGREGAR</button>
            </div>
        </div>
    </div>
    <!-- Modal Agregar Cliente -->
    <div class="modal fade" id="modalAgregarCliente" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header title-edit" style="background-color: #5410a2; margin-top: 0px;">
                    <p>AGREGAR CLIENTE</p>
                </div>
                <div class="modal-body">
                    <div class="container-fluid">
                        <div class="col mb-3">
                            <form id="form-cliente" action="">
                                <div class="row align-items-center">
                                    <div class="col-md-4">
                                        <div class="row">
                                            <label for="tipoDoc" class="col-auto col-form-label">Tipo de Doc:</label>
                                            <div class="col">
                                                <select title="Estado..." data-style="btn-secondary" class="form-control" name="tipoDoc" id="tipoDoc">
                                                    <option value="DNI">DNI</option>
                                                    <option value="RUC">RUC</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="row">
                                            <label for="documento" class="col-auto col-form-label">N° Doc:</label>
                                            <div class="col">
                                                <input type="text" class="form-control" id="documento" name="documento">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <button type="button" id="consultaReniec" class="btn btn-primary w-auto validar"><i class="fa-solid fa-circle-check"></i>&nbsp; VALIDAR</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <div class="col mb-3" style="background-color: #5410a2; color: #fff;">
                            <div class="col p-2">
                                <span>DATOS BUSCADOS</span>
                            </div>
                        </div>
                        <div class="col mb-3 px-3">
                            <form action="">
                                <input type="hidden" name="idCliente">
                                <div class="row align-items-center mb-3">
                                    <div class="col-md-5">
                                        <div class="row">
                                            <label for="tipoDocumento" class="col-auto col-form-label">Tipo de Doc:</label>
                                            <div class="col">
                                                <input disabled type="text" class="form-control" id="tipoDocumento" name="tipoDocumento">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="row">
                                            <label for="numeroDocumento" class="col-auto col-form-label">N° Doc:</label>
                                            <div class="col">
                                                <input disabled type="text" class="form-control" id="numeroDocumento" name="numeroDocumento">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row align-items-center mb-3">
                                    <div class="col-md-8">
                                        <div class="row">
                                            <label for="nombre" class="col-auto col-form-label">Nombre:</label>
                                            <div class="col">
                                                <input disabled type="text" class="form-control" id="nombre" name="nombre">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row align-items-center mb-3">
                                    <div class="col">
                                        <div class="row">
                                            <label for="razonSocial" class="col-auto col-form-label">Razon Social:</label>
                                            <div class="col">
                                                <input type="text" class="form-control" id="razonSocial" name="razonSocial">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col">
                                        <div class="row">
                                            <label for="nombreComercial" class="col-auto col-form-label">Nombre Comercial:</label>
                                            <div class="col">
                                                <input type="text" class="form-control" id="nombreComercial" name="nombreComercial">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row align-items-center mb-3">
                                    <div class="col-md-5">
                                        <div class="row">
                                            <label for="telefonoContacto" class="col-auto col-form-label">Telefono Contacto:</label>
                                            <div class="col">
                                                <input type="text" class="form-control" id="telefonoContacto" name="telefonoContacto">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-7">
                                        <div class="row">
                                            <label for="correoContacto" class="col-auto col-form-label">Correo Contacto:</label>
                                            <div class="col">
                                                <input type="email" class="form-control" id="correoContacto" name="correoContacto">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row align-items-center mb-3">
                                    <div class="col-md-5">
                                        <div class="row">
                                            <label for="contrasenia" class="col-auto col-form-label">Contraseña:</label>
                                            <div class="col input-group">
                                                <input type="password" class="form-control" id="contrasenia" name="contrasenia">
                                                <button class="input-group-text" type="button" id="togglePasswordVisibility" style="width: 50px;">
                                                    <i class="fa-solid fa-eye"></i>
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="modal-footer row align-items-center p-0 pt-2">
                                    <div class="row d-flex justify-content-end">
                                        <div class="col-md-3">
                                            <button type="button" class="btn btn-secondary cancelar" data-bs-dismiss="modal"><i class="fa-solid fa-circle-xmark"></i>&nbsp; Cancelar</button>
                                        </div>
                                        <div class="col-md-3">
                                            <button type="button" class="btn btn-primary salvar" id="guardar-cliente" data-bs-toggle="modal" data-bs-target="#modalAceptarCliente"><i class="fa-solid fa-floppy-disk"></i>&nbsp;Salvar</button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Aceptar Cliente-->
    <div class="modal fade" id="modalAceptarCliente" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header" style="background-color: #5410a2; color: #fff;">
                    <h1 class="modal-title fs-5" id="staticBackdropLabel">Desea Agregar Cliente</h1>
                </div>
                <div class="modal-body">
                    El cliente sera registrado.
                </div>
                <div class="modal-footer row align-items-center p-0">
                    <div class="row d-flex justify-content-end">
                        <div class="col-md-4">
                            <button type="button" class="btn btn-secondary cancelar" data-bs-target="#modalAgregarCliente" data-bs-toggle="modal"><i class="fa-solid fa-circle-xmark"></i>&nbsp; Cancelar</button>
                        </div>
                        <div class="col-md-4">
                            <button type="submit" id="btn-aceptar-cliente" class="btn btn-primary salvar"><i class="fa-solid fa-floppy-disk"></i>&nbsp;Salvar</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Eliminar Cliente-->
    <div class="modal fade" id="modalEliminarCliente" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header" style="background-color: #5410a2; color: #fff;">
                    <h1 class="modal-title fs-5" id="staticBackdropLabel">Desea Eliminar Cliente</h1>
                </div>
                <div class="modal-body">
                    El cliente sera eliminado.
                </div>
                <div class="modal-footer row align-items-center p-0">
                    <div class="row d-flex justify-content-end mb-4">
                        <div class="col-md-4">
                            <button type="button" class="btn btn-secondary cancelar" data-bs-toggle="modal"><i class="fa-solid fa-circle-xmark"></i>&nbsp; Cancelar</button>
                        </div>
                        <div class="col-md-4">
                            <button type="submit" class="btn btn-primary salvar"><i class="fa-solid fa-floppy-disk"></i>&nbsp;Salvar</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="container-fluid container-table my-4 shadow-lg bg-body-tertiary rounded">
        <div class="row">
            <table class="table table-cliente">
                <thead class="encabezadoEstatico">
                    <tr>
                        <th>NOMBRE O RAZÓN SOCIAL</th>
                        <th> N° DE DOC. IDENTIDAD</th>
                        <th>FECHA DE REGISTRO</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>CONSTRUCTORA Y CONSULTORA DE LA TORRE S.A.C.</td>
                        <td>20568757433</td>
                        <td>03 / 02 / 2024</td>
                        <td>
                            <button class="button__administrar" id="id-administrar" href="#"><i class="fa-solid fa-file-circle-plus"></i> ADMINISTRADOR</button>
                        </td>
                    </tr>

                </tbody>
            </table>
        </div>
    </div>

    <div class="container__desplegar" id="containerDesplegar">
        <div class="cabezado__desplegar">
            <i class="fa-solid fa-circle-user"></i>
            <span>CONSTRUCTORA Y CONSULTORIA DE LA TORRE S.A.C.</span>
            <i class="fa-solid fa-circle-xmark closed" id="closed-administrar"></i>
        </div>
        <div class="menu__desplegable">
            <span id="datos-generales"><i class="fa-solid fa-house"></i>DATOS GENERALES</span>
            <span id="restablecer-contrasenia"><i class="fa-solid fa-key"></i>RESTABLECER CONTRASEÑA</span>
            <span id="editar-perfil"><i class="fa-solid fa-marker"></i>EDITAR PERFIL</span>
            <span id="historial-pagos"><i class="fa-solid fa-file-lines"></i>FACTURAS</span>
            <span id="accesos"><i class="fa-solid fa-file-circle-check"></i>CREDENCIALES</span>
            <span id="contrato"><i class="fa-solid fa-file-circle-check"></i>CONTRATO</span>
        </div>

        <!-- ======================== APARTADO DE CLIENTES ================ -->
        <div class="cuerpo__general" id="cuerpo-general1">
            <div class="datos__generales">
                <div class="general__info">
                    <span class="title__general"><i class="fa-solid fa-circle-info"></i>INFORMACIÓN DE LA EMPRESA</span>
                    <div class="part__general">
                        <p>RUC: 20568757433</p>
                        <p>Razón Social: Constructora y Consultora de la Torre S.A.C.</p>
                        <p>Nombre Comercial: Casa Verde Inmobiliaria</p>
                        <p>Numero de Contacto: 987654321</p>
                        <p>Correo de Contacto: administracion@casaverdeinmobiliaria.com</p>
                        <p>Persona a Cargo: Dina Vallejos</p>
                        <p>Servicio Contratado: Correo corporativo / Pagina web</p>
                        <p>Ciclo de facturación: Ciclo 03</p>
                        <p>Renovación de contrato: 15/05/2024</p>
                    </div>
                </div>
                <div class="button__general">
                    <button class="general__facturas"><i class="fa-solid fa-file-circle-check"></i>VER FACTURAS</button>
                    <button class="general__contrato"><i class="fa-solid fa-file-circle-check"></i>CONTRATO</button>
                    <button class="general__credenciales"><i class="fa-solid fa-file-import"></i>CREDENCIALES</button>
                    <div class="eliminar">
                        <i class="fa-solid fa-trash" role="button" data-bs-toggle="modal" data-bs-target="#modalEliminarCliente" id="btn-eliminar-cliente"></i>
                    </div>
                </div>
            </div>
        </div>

        <!-- ======================== APARTADO DE RESTABLECER CONTRASEÑA ================ -->
        <div class="cuerpo__general2" id="cuerpo-general2">
            <div class="restablecer__contrasenia">
                <div class="contrasenia__general">
                    <div class="title__contrasenia">
                        <i class="fa-solid fa-triangle-exclamation"></i>
                        <p>RECUERDE QUE AL REALIZAR LA MODIFICACION DE CUALQUIER DATO PERSONAL O DE ACCESO DE UN USUARIO NO OLVIDE COMUNICARLO AL USUARIO PARA MAYOR INFORMACIÓN ESCRIBIR AL WHATSAPP - 984404105</p>
                    </div>
                </div>
            </div>
            <div class="container__checkbox">
                <form action="">
                    <label for="opcion1">
                        <input type="checkbox" class="check" name="opciones" value="opcion1"> Requerir que el usuario genere una nueva contraseña al iniciar sesión por primera vez.
                    </label>
                    <label for="opcion2">
                        <input type="checkbox" class="check" name="opciones" value="opcion2"> Generar una contraseña de manera automatica.
                    </label>
                    <label for="opcion3">
                        <input type="checkbox" class="check" name="opciones" value="opcion3"> Enviar la información del cambio de contraseña al correo electrónico.
                    </label>
                    <input type="text" class="one__contrasenia">
                    <label for="manual">
                        <input type="checkbox" class="check" name="segundaOpcion" value="manual"> Ingresar una contraseña de forma manual.
                    </label>
                    <input type="text" class="two__contrasenia">

                    <button class="button__contrasenia"><i class="fa-solid fa-key"></i>RESTABLECER CONTRASEÑA</button>
                </form>
            </div>
        </div>

        <!-- ======================== APARTADO DE EDITAR PERFIL ================ -->
        <div class="cuerpo__general3" id="cuerpo-general3">
            <div class="container-fluid">
                <div class="col title-edit" style="background-color: #5410a2;">
                    <p>EDITAR PERFIL</p>
                </div>
            </div>
            <div class="container-fluid">
                <div class="col mb-3 px-3">
                    <form action="">
                        <input type="hidden" name="idCliente">
                        <div class="row align-items-center mb-3">
                            <div class="col-md-4">
                                <div class="row">
                                    <label for="tipoDocumento" class="col-auto col-form-label">Tipo de Doc:</label>
                                    <div class="col">
                                        <select title="Seleccionar..." data-style="btn-secondary" class="form-control" name="tipoDocumento" id="tipoDocumento">
                                            <option value="dni">DNI / RUC</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="row">
                                    <label for="documento" class="col-auto col-form-label">N° Doc:</label>
                                    <div class="col">
                                        <input type="text" class="form-control" id="documento" name="documento">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row align-items-center mb-3">
                            <div class="col-md-8">
                                <div class="row">
                                    <label for="nombre" class="col-auto col-form-label">Nombre:</label>
                                    <div class="col">
                                        <input type="text" class="form-control" id="nombre" name="nombre">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row align-items-center mb-3">
                            <div class="col">
                                <div class="row">
                                    <label for="razonSocial" class="col-auto col-form-label">Razon Social:</label>
                                    <div class="col">
                                        <input type="text" class="form-control" id="razonSocial" name="razonSocial">
                                    </div>
                                </div>
                            </div>
                            <div class="col">
                                <div class="row">
                                    <label for="nombreComercial" class="col-auto col-form-label">Nombre Comercial:</label>
                                    <div class="col">
                                        <input type="text" class="form-control" id="nombreComercial" name="nombreComercial">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row align-items-center mb-3">
                            <div class="col-md-5">
                                <div class="row">
                                    <label for="telefonoContacto" class="col-auto col-form-label">Telefono Contacto:</label>
                                    <div class="col">
                                        <input type="text" class="form-control" id="telefonoContacto" name="telefonoContacto">
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-7">
                                <div class="row">
                                    <label for="correoContacto" class="col-auto col-form-label">Correo Contacto:</label>
                                    <div class="col">
                                        <input type="email" class="form-control" id="correoContacto" name="correoContacto">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row align-items-center mb-3">
                            <div class="col-md-5">
                                <div class="row">
                                    <label for="contrasenia" class="col-auto col-form-label">Contraseña</label>
                                    <div class="col input-group">
                                        <input type="password" class="form-control" id="contrasenia" name="contrasenia">
                                        <button class="input-group-text" type="button" id="togglePasswordVisibility" style="width: 50px;">
                                            <i class="fa-solid fa-eye"></i>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row align-items-center mb-3">
                            <div class="row d-flex justify-content-end">
                                <div class="col-md-3">
                                    <button type="button" class="btn btn-primary cancelar"><i class="fa-solid fa-circle-xmark"></i>&nbsp; Cancelar</button>
                                </div>
                                <div class="col-md-3">
                                    <button type="submit" class="btn btn-primary salvar"><i class="fa-solid fa-floppy-disk"></i>&nbsp;Salvar</button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <!-- ======================== APARTADO DE FACTURAS ================ -->
        <div class="cuerpo__general4" id="cuerpo-general4">
            <div class="container-fluid p-4">
                <button type="button" class="btn btn-primary w-auto clr-pa" id="agregar-factura" data-bs-toggle="modal" data-bs-target="#modalAgregarFactura"><i class="fa-solid fa-file-circle-plus"></i>&nbsp; AGREGAR</button>
            </div>
            <div class="container-fluid container-table my-4 shadow-lg bg-body-tertiary rounded" style="width: 90%; max-height: 400px;">
                <div class="row">
                    <table class="table table-reporte">
                        <thead class="encabezadoEstatico">
                            <tr>
                                <th>N°</th>
                                <th>MES</th>
                                <th>S/.</th>
                                <th>FECHA EMI.</th>
                                <th>FECHA VEN.</th>
                                <th>REPORTADO</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>001</td>
                                <td>Noviembre 2023</td>
                                <td>37.9</td>
                                <td>03/11/2023</td>
                                <td>04/11/2023</td>
                                <td>Pendiente</td>
                            </tr>
                            <tr>
                                <td>001</td>
                                <td>Noviembre 2023</td>
                                <td>37.9</td>
                                <td>03/11/2023</td>
                                <td>04/11/2023</td>
                                <td>Pendiente</td>
                            </tr>
                            <tr>
                                <td>001</td>
                                <td>Noviembre 2023</td>
                                <td>37.9</td>
                                <td>03/11/2023</td>
                                <td>04/11/2023</td>
                                <td>Pendiente</td>
                            </tr>
                            <tr>
                                <td>001</td>
                                <td>Noviembre 2023</td>
                                <td>37.9</td>
                                <td>03/11/2023</td>
                                <td>04/11/2023</td>
                                <td>Pendiente</td>
                            </tr>
                            <tr>
                                <td>001</td>
                                <td>Noviembre 2023</td>
                                <td>37.9</td>
                                <td>03/11/2023</td>
                                <td>04/11/2023</td>
                                <td>Pendiente</td>
                            </tr>
                            <tr>
                                <td>001</td>
                                <td>Noviembre 2023</td>
                                <td>37.9</td>
                                <td>03/11/2023</td>
                                <td>04/11/2023</td>
                                <td>Pendiente</td>
                            </tr>
                            <tr>
                                <td>001</td>
                                <td>Noviembre 2023</td>
                                <td>37.9</td>
                                <td>03/11/2023</td>
                                <td>04/11/2023</td>
                                <td>Pendiente</td>
                            </tr>
                            <tr>
                                <td>001</td>
                                <td>Noviembre 2023</td>
                                <td>37.9</td>
                                <td>03/11/2023</td>
                                <td>04/11/2023</td>
                                <td>Pendiente</td>
                            </tr>
                            <tr>
                                <td>001</td>
                                <td>Noviembre 2023</td>
                                <td>37.9</td>
                                <td>03/11/2023</td>
                                <td>04/11/2023</td>
                                <td>Pendiente</td>
                            </tr>
                            <tr>
                                <td>001</td>
                                <td>Noviembre 2023</td>
                                <td>37.9</td>
                                <td>03/11/2023</td>
                                <td>04/11/2023</td>
                                <td>Pendiente</td>
                            </tr>
                            <tr>
                                <td>001</td>
                                <td>Noviembre 2023</td>
                                <td>37.9</td>
                                <td>03/11/2023</td>
                                <td>04/11/2023</td>
                                <td>Pendiente</td>
                            </tr>
                            <tr>
                                <td>001</td>
                                <td>Noviembre 2023</td>
                                <td>37.9</td>
                                <td>03/11/2023</td>
                                <td>04/11/2023</td>
                                <td>Pendiente</td>
                            </tr>
                            <tr>
                                <td>001</td>
                                <td>Noviembre 2023</td>
                                <td>37.9</td>
                                <td>03/11/2023</td>
                                <td>04/11/2023</td>
                                <td>Pendiente</td>
                            </tr>
                            <tr>
                                <td>001</td>
                                <td>Noviembre 2023</td>
                                <td>37.9</td>
                                <td>03/11/2023</td>
                                <td>04/11/2023</td>
                                <td>Pendiente</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <!-- ======================== APARTADO DE CREDENCIALES ================ -->
        <div class="cuerpo__general5" id="cuerpo-general5">
            <div class="container-fluid p-4">
                <button type="button" class="btn btn-primary w-auto clr-cre" id="agregar-accesos" data-bs-toggle="modal" data-bs-target="#modalAgregarCredenciales"><i class="fa-solid fa-file-circle-plus"></i> AGREGAR</button>
            </div>
            <div class="container-fluid container-table my-4 shadow-lg bg-body-tertiary rounded" style="width: 90%; max-height: 400px;">
                <div class="row">
                    <table class="table table-credenciales">
                        <thead class="encabezadoEstatico">
                            <tr>
                                <th>Servicio</th>
                                <th>Tipo</th>
                                <th>N. Usuario</th>
                                <th>Contraseña</th>
                                <th>LINK DE ACCESO</th>
                                <th>F.INICIO</th>
                                <th>F.Renovación</th>
                                <th>Observación</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>Diseño</td>
                                <td>Web</td>
                                <td>admin53@tudominio.com</td>
                                <td>Adminn5553</td>
                                <td>www.microsoft.com</td>
                                <td>15/04/2023</td>
                                <td>15/05/2024</td>
                                <td>
                                    <a class="btn btn-primary btn-sm d-none d-sm-inline-block download-button" role="button" target="_blank" href="#">
                                        <i class="fas fa-download fa-sm text-white-50"></i>&nbsp;Ver historial
                                    </a>
                                </td>
                            </tr>
                            <tr>
                                <td>Diseño</td>
                                <td>Web</td>
                                <td>admin53@tudominio.com</td>
                                <td>Adminn5553</td>
                                <td>www.microsoft.com</td>
                                <td>15/04/2023</td>
                                <td>15/05/2024</td>
                                <td>
                                    <a class="btn btn-primary btn-sm d-none d-sm-inline-block download-button" role="button" target="_blank" href="#">
                                        <i class="fas fa-download fa-sm text-white-50"></i>&nbsp;Ver historial
                                    </a>
                                </td>
                            </tr>
                            <tr>
                                <td>Diseño</td>
                                <td>Web</td>
                                <td>admin53@tudominio.com</td>
                                <td>Adminn5553</td>
                                <td>www.microsoft.com</td>
                                <td>15/04/2023</td>
                                <td>15/05/2024</td>
                                <td>
                                    <a class="btn btn-primary btn-sm d-none d-sm-inline-block download-button" role="button" target="_blank" href="#">
                                        <i class="fas fa-download fa-sm text-white-50"></i>&nbsp;Ver historial
                                    </a>
                                </td>
                            </tr>
                            <tr>
                                <td>Diseño</td>
                                <td>Web</td>
                                <td>admin53@tudominio.com</td>
                                <td>Adminn5553</td>
                                <td>www.microsoft.com</td>
                                <td>15/04/2023</td>
                                <td>15/05/2024</td>
                                <td>
                                    <a class="btn btn-primary btn-sm d-none d-sm-inline-block download-button" role="button" target="_blank" href="#">
                                        <i class="fas fa-download fa-sm text-white-50"></i>&nbsp;Ver historial
                                    </a>
                                </td>
                            </tr>
                            <tr>
                                <td>Diseño</td>
                                <td>Web</td>
                                <td>admin53@tudominio.com</td>
                                <td>Adminn5553</td>
                                <td>www.microsoft.com</td>
                                <td>15/04/2023</td>
                                <td>15/05/2024</td>
                                <td>
                                    <a class="btn btn-primary btn-sm d-none d-sm-inline-block download-button" role="button" target="_blank" href="#">
                                        <i class="fas fa-download fa-sm text-white-50"></i>&nbsp;Ver historial
                                    </a>
                                </td>
                            </tr>
                            <tr>
                                <td>Diseño</td>
                                <td>Web</td>
                                <td>admin53@tudominio.com</td>
                                <td>Adminn5553</td>
                                <td>www.microsoft.com</td>
                                <td>15/04/2023</td>
                                <td>15/05/2024</td>
                                <td>
                                    <a class="btn btn-primary btn-sm d-none d-sm-inline-block download-button" role="button" target="_blank" href="#">
                                        <i class="fas fa-download fa-sm text-white-50"></i>&nbsp;Ver historial
                                    </a>
                                </td>
                            </tr>
                            <tr>
                                <td>Diseño</td>
                                <td>Web</td>
                                <td>admin53@tudominio.com</td>
                                <td>Adminn5553</td>
                                <td>www.microsoft.com</td>
                                <td>15/04/2023</td>
                                <td>15/05/2024</td>
                                <td>
                                    <a class="btn btn-primary btn-sm d-none d-sm-inline-block download-button" role="button" target="_blank" href="#">
                                        <i class="fas fa-download fa-sm text-white-50"></i>&nbsp;Ver historial
                                    </a>
                                </td>
                            </tr>
                            <tr>
                                <td>Diseño</td>
                                <td>Web</td>
                                <td>admin53@tudominio.com</td>
                                <td>Adminn5553</td>
                                <td>www.microsoft.com</td>
                                <td>15/04/2023</td>
                                <td>15/05/2024</td>
                                <td>
                                    <a class="btn btn-primary btn-sm d-none d-sm-inline-block download-button" role="button" target="_blank" href="#">
                                        <i class="fas fa-download fa-sm text-white-50"></i>&nbsp;Ver historial
                                    </a>
                                </td>
                            </tr>
                            <tr>
                                <td>Diseño</td>
                                <td>Web</td>
                                <td>admin53@tudominio.com</td>
                                <td>Adminn5553</td>
                                <td>www.microsoft.com</td>
                                <td>15/04/2023</td>
                                <td>15/05/2024</td>
                                <td>
                                    <a class="btn btn-primary btn-sm d-none d-sm-inline-block download-button" role="button" target="_blank" href="#">
                                        <i class="fas fa-download fa-sm text-white-50"></i>&nbsp;Ver historial
                                    </a>
                                </td>
                            </tr>
                            <tr>
                                <td>Diseño</td>
                                <td>Web</td>
                                <td>admin53@tudominio.com</td>
                                <td>Adminn5553</td>
                                <td>www.microsoft.com</td>
                                <td>15/04/2023</td>
                                <td>15/05/2024</td>
                                <td>
                                    <a class="btn btn-primary btn-sm d-none d-sm-inline-block download-button" role="button" target="_blank" href="#">
                                        <i class="fas fa-download fa-sm text-white-50"></i>&nbsp;Ver historial
                                    </a>
                                </td>
                            </tr>
                            <tr>
                                <td>Diseño</td>
                                <td>Web</td>
                                <td>admin53@tudominio.com</td>
                                <td>Adminn5553</td>
                                <td>www.microsoft.com</td>
                                <td>15/04/2023</td>
                                <td>15/05/2024</td>
                                <td>
                                    <a class="btn btn-primary btn-sm d-none d-sm-inline-block download-button" role="button" target="_blank" href="#">
                                        <i class="fas fa-download fa-sm text-white-50"></i>&nbsp;Ver historial
                                    </a>
                                </td>
                            </tr>
                            <tr>
                                <td>Diseño</td>
                                <td>Web</td>
                                <td>admin53@tudominio.com</td>
                                <td>Adminn5553</td>
                                <td>www.microsoft.com</td>
                                <td>15/04/2023</td>
                                <td>15/05/2024</td>
                                <td>
                                    <a class="btn btn-primary btn-sm d-none d-sm-inline-block download-button" role="button" target="_blank" href="#">
                                        <i class="fas fa-download fa-sm text-white-50"></i>&nbsp;Ver historial
                                    </a>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <!-- ======================== APARTADO DE CONTRATO ================ -->
        <div class="cuerpo__general6" id="cuerpo-general6">
            <div class="container-fluid p-4">
                <button type="button" class="btn btn-primary w-auto clr-con" id="agregar-contrato" data-bs-toggle="modal" data-bs-target="#modalAgregarContrato"><i class="fa-solid fa-file-circle-plus"></i> AGREGAR</button>
            </div>
            <div class="container-fluid container-table my-4 shadow-lg bg-body-tertiary rounded" style="width: 90%; max-height: 400px;">
                <div class="row">
                    <table class="table table-contrato">
                        <thead class="encabezadoEstatico">
                            <tr>
                                <th>SERVICIO</th>
                                <th>DOCUMENTO</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>Diseño</td>
                                <td>
                                    <a class="btn btn-primary btn-sm d-none d-sm-inline-block download-button" role="button" target="_blank" href="#">
                                        <i class="fas fa-download fa-sm text-white-50"></i>&nbsp;Ver historial
                                    </a>
                                </td>
                            </tr>
                            <tr>
                                <td>Diseño</td>
                                <td>
                                    <a class="btn btn-primary btn-sm d-none d-sm-inline-block download-button" role="button" target="_blank" href="#">
                                        <i class="fas fa-download fa-sm text-white-50"></i>&nbsp;Ver historial
                                    </a>
                                </td>
                            </tr>
                            <tr>
                                <td>Diseño</td>
                                <td>
                                    <a class="btn btn-primary btn-sm d-none d-sm-inline-block download-button" role="button" target="_blank" href="#">
                                        <i class="fas fa-download fa-sm text-white-50"></i>&nbsp;Ver historial
                                    </a>
                                </td>
                            </tr>
                            <tr>
                                <td>Diseño</td>
                                <td>
                                    <a class="btn btn-primary btn-sm d-none d-sm-inline-block download-button" role="button" target="_blank" href="#">
                                        <i class="fas fa-download fa-sm text-white-50"></i>&nbsp;Ver historial
                                    </a>
                                </td>
                            </tr>
                            <tr>
                                <td>Diseño</td>
                                <td>
                                    <a class="btn btn-primary btn-sm d-none d-sm-inline-block download-button" role="button" target="_blank" href="#">
                                        <i class="fas fa-download fa-sm text-white-50"></i>&nbsp;Ver historial
                                    </a>
                                </td>
                            </tr>
                            <tr>
                                <td>Diseño</td>
                                <td>
                                    <a class="btn btn-primary btn-sm d-none d-sm-inline-block download-button" role="button" target="_blank" href="#">
                                        <i class="fas fa-download fa-sm text-white-50"></i>&nbsp;Ver historial
                                    </a>
                                </td>
                            </tr>
                            <tr>
                                <td>Diseño</td>
                                <td>
                                    <a class="btn btn-primary btn-sm d-none d-sm-inline-block download-button" role="button" target="_blank" href="#">
                                        <i class="fas fa-download fa-sm text-white-50"></i>&nbsp;Ver historial
                                    </a>
                                </td>
                            </tr>
                            <tr>
                                <td>Diseño</td>
                                <td>
                                    <a class="btn btn-primary btn-sm d-none d-sm-inline-block download-button" role="button" target="_blank" href="#">
                                        <i class="fas fa-download fa-sm text-white-50"></i>&nbsp;Ver historial
                                    </a>
                                </td>
                            </tr>
                            <tr>
                                <td>Diseño</td>
                                <td>
                                    <a class="btn btn-primary btn-sm d-none d-sm-inline-block download-button" role="button" target="_blank" href="#">
                                        <i class="fas fa-download fa-sm text-white-50"></i>&nbsp;Ver historial
                                    </a>
                                </td>
                            </tr>
                            <tr>
                                <td>Diseño</td>
                                <td>
                                    <a class="btn btn-primary btn-sm d-none d-sm-inline-block download-button" role="button" target="_blank" href="#">
                                        <i class="fas fa-download fa-sm text-white-50"></i>&nbsp;Ver historial
                                    </a>
                                </td>
                            </tr>
                            <tr>
                                <td>Diseño</td>
                                <td>
                                    <a class="btn btn-primary btn-sm d-none d-sm-inline-block download-button" role="button" target="_blank" href="#">
                                        <i class="fas fa-download fa-sm text-white-50"></i>&nbsp;Ver historial
                                    </a>
                                </td>
                            </tr>
                            <tr>
                                <td>Diseño</td>
                                <td>
                                    <a class="btn btn-primary btn-sm d-none d-sm-inline-block download-button" role="button" target="_blank" href="#">
                                        <i class="fas fa-download fa-sm text-white-50"></i>&nbsp;Ver historial
                                    </a>
                                </td>
                            </tr>
                            <tr>
                                <td>Diseño</td>
                                <td>
                                    <a class="btn btn-primary btn-sm d-none d-sm-inline-block download-button" role="button" target="_blank" href="#">
                                        <i class="fas fa-download fa-sm text-white-50"></i>&nbsp;Ver historial
                                    </a>
                                </td>
                            </tr>

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Agregar Factura -->
    <div class="modal fade" id="modalAgregarFactura" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header title-edit" style="background-color: #00b807; margin-top: 0px;">
                    <p>AGREGAR FACTURA</p>
                </div>
                <div class="modal-body">
                    <div class="col mb-3 px-3">
                        <form id="form-factura" action="">
                            <input type="hidden" name="idCliente">
                            <div class="row align-items-center mb-3">
                                <div class="col-md-5">
                                    <div class="row">
                                        <label for="selectClientes" class="col-auto col-form-label">Clientes:</label>
                                        <div class="col">
                                            <select title="Clientes..." data-style="btn-secondary" class="form-control" name="selectClientes" id="selectClientes">
                                                <option value="dni">Jhon Casimiro</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="row">
                                        <label for="mes" class="col-auto col-form-label">Mes:</label>
                                        <div class="col">
                                            <input type="text" class="form-control" id="mes" name="mes">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="row">
                                        <label for="monto" class="col-auto col-form-label">Monto:</label>
                                        <div class="col">
                                            <input type="text" class="form-control" id="monto" name="monto">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row align-items-center mb-3">
                                <div class="col">
                                    <div class="row">
                                        <label for="fechaEmision" class="col-auto col-form-label">Fecha Emisión:</label>
                                        <div class="col">
                                            <input type="date" class="form-control" id="fechaEmision" name="fechaEmision">
                                        </div>
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="row">
                                        <label for="fechaVencimiento" class="col-auto col-form-label">Fecha Vencimiento:</label>
                                        <div class="col">
                                            <input type="date" class="form-control" id="fechaVencimiento" name="fechaVencimiento">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row align-items-center mb-3">
                                <div class="col-md-4">
                                    <div class="row">
                                        <label for="estado" class="col-auto col-form-label">Estado:</label>
                                        <div class="col">
                                            <select title="Estado..." data-style="btn-secondary" class="form-control" name="estado" id="estado">
                                                <option value="pendiente">Pendiente</option>
                                                <option value="pago">Pago</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-8">
                                    <div class="row">
                                        <label for="archivo" class="col-auto col-form-label">Archivo:</label>
                                        <div class="col">
                                            <input type="file" class="form-control" id="archivo" name="archivo">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="modal-footer row align-items-center p-0 pt-2">
                                <div class="row d-flex justify-content-end mb-3">
                                    <div class="col-md-3">
                                        <button type="button" class="btn btn-secondary cancelar" data-bs-dismiss="modal"><i class="fa-solid fa-circle-xmark"></i>&nbsp; Cancelar</button>
                                    </div>
                                    <div class="col-md-3">
                                        <button type="button" class="btn btn-primary salvar" data-bs-target="#modalAceptarFactura" data-bs-toggle="modal"><i class="fa-solid fa-floppy-disk"></i>&nbsp;Salvar</button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Aceptar Factura-->
    <div class="modal fade" id="modalAceptarFactura" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header" style="background-color: #00b807; color: #fff;">
                    <h1 class="modal-title fs-5" id="staticBackdropLabel">Desea Agregar Factura</h1>
                </div>
                <div class="modal-body">
                    La factura sera registrado.
                </div>
                <div class="modal-footer row align-items-center p-0">
                    <div class="row d-flex justify-content-end mb-3">
                        <div class="col-md-4">
                            <button type="button" class="btn btn-secondary cancelar" data-bs-target="#modalAgregarFactura" data-bs-toggle="modal"><i class="fa-solid fa-circle-xmark"></i>&nbsp; Cancelar</button>
                        </div>
                        <div class="col-md-4">
                            <button type="submit" id="btn-aceptar-factura" class="btn btn-primary salvar"><i class="fa-solid fa-floppy-disk"></i>&nbsp;Salvar</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Eliminar Factura-->
    <div class="modal fade" id="modalEliminarFactura" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header" style="background-color: #00b807; color: #fff;">
                    <h1 class="modal-title fs-5" id="staticBackdropLabel">Desea Eliminar Cliente</h1>
                </div>
                <div class="modal-body">
                    La factura sera eliminado.
                </div>
                <div class="modal-footer row align-items-center p-0">
                    <div class="row d-flex justify-content-end mb-3">
                        <div class="col-md-4">
                            <button type="button" class="btn btn-secondary cancelar" data-bs-toggle="modal"><i class="fa-solid fa-circle-xmark"></i>&nbsp; Cancelar</button>
                        </div>
                        <div class="col-md-4">
                            <button type="submit" class="btn btn-primary salvar"><i class="fa-solid fa-floppy-disk"></i>&nbsp;Salvar</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Agregar Credenciales o Accesos -->
    <div class="modal fade" id="modalAgregarCredenciales" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header title-edit" style="background-color: #106da2; margin-top: 0px;">
                    <p>AGREGAR CREDENCIALES</p>
                </div>
                <div class="modal-body">
                    <div class="col mb-3 px-3">
                        <form id="form-credenciales" action="">
                            <input type="hidden" name="idCliente">
                            <div class="row align-items-center mb-3">
                                <div class="col-md-5">
                                    <div class="row">
                                        <label for="selectClientes" class="col-auto col-form-label">Clientes:</label>
                                        <div class="col">
                                            <select title="Clientes..." data-style="btn-secondary" class="form-control" name="selectClientes" id="selectClientes">
                                                <option value="dni">Jhon Casimiro</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-5">
                                    <div class="row">
                                        <label for="selectServicios" class="col-auto col-form-label">Servicios:</label>
                                        <div class="col">
                                            <select title="Servicios..." data-style="btn-secondary" class="form-control" name="selectServicios" id="selectServicios">
                                                <option value="diseñoWeb">Diseño Web</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row align-items-center mb-3">
                                <div class="col">
                                    <div class="row">
                                        <label for="usuario" class="col-auto col-form-label">Usuario:</label>
                                        <div class="col">
                                            <input type="text" class="form-control" id="usuario" name="usuario">
                                        </div>
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="row">
                                        <label for="contraseniaUsuario" class="col-auto col-form-label">Contraseña:</label>
                                        <div class="col input-group">
                                            <input type="password" class="form-control" id="contraseniaUsuario" name="contraseniaUsuario">
                                            <button class="input-group-text" type="button" id="togglePasswordVisibility" style="width: 50px;">
                                                <i class="fa-solid fa-eye"></i>
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row align-items-center mb-3">
                                <div class="col-md-12">
                                    <div class="row">
                                        <label for="observacion" class="col-auto col-form-label">Observacion:</label>
                                        <div class="col">
                                            <input type="text" class="form-control" id="observacion" name="observacion">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="modal-footer row align-items-center p-0 pt-2">
                                <div class="row d-flex justify-content-end mb-3">
                                    <div class="col-md-3">
                                        <button type="button" class="btn btn-secondary cancelar" data-bs-dismiss="modal"><i class="fa-solid fa-circle-xmark"></i>&nbsp; Cancelar</button>
                                    </div>
                                    <div class="col-md-3">
                                        <button type="button" class="btn btn-primary salvar" data-bs-target="#modalAceptarCredenciales" data-bs-toggle="modal"><i class="fa-solid fa-floppy-disk"></i>&nbsp;Salvar</button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Aceptar Credenciales-->
    <div class="modal fade" id="modalAceptarCredenciales" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header" style="background-color: #106da2; color: #fff;">
                    <h1 class="modal-title fs-5" id="staticBackdropLabel">Desea Agregar Credencial</h1>
                </div>
                <div class="modal-body">
                    La credencial sera registrado.
                </div>
                <div class="modal-footer row align-items-center p-0">
                    <div class="row d-flex justify-content-end mb-3">
                        <div class="col-md-4">
                            <button type="button" class="btn btn-secondary cancelar" data-bs-target="#modalAgregarCredenciales" data-bs-toggle="modal"><i class="fa-solid fa-circle-xmark"></i>&nbsp; Cancelar</button>
                        </div>
                        <div class="col-md-4">
                            <button type="submit" id="btn-aceptar-credenciales" class="btn btn-primary salvar"><i class="fa-solid fa-floppy-disk"></i>&nbsp;Salvar</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Eliminar Credenciales-->
    <div class="modal fade" id="modalEliminarCredenciales" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header" style="background-color: #106da2; color: #fff;">
                    <h1 class="modal-title fs-5" id="staticBackdropLabel">Desea Eliminar Credenciales</h1>
                </div>
                <div class="modal-body">
                    La credencial sera eliminado.
                </div>
                <div class="modal-footer row align-items-center p-0">
                    <div class="row d-flex justify-content-end mb-3">
                        <div class="col-md-4">
                            <button type="button" class="btn btn-secondary cancelar" data-bs-toggle="modal"><i class="fa-solid fa-circle-xmark"></i>&nbsp; Cancelar</button>
                        </div>
                        <div class="col-md-4">
                            <button type="submit" class="btn btn-primary salvar"><i class="fa-solid fa-floppy-disk"></i>&nbsp;Salvar</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Agregar Contrato -->
    <div class="modal fade" id="modalAgregarContrato" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header title-edit" style="background-color: #4a4a4a; margin-top: 0px;">
                    <p>AGREGAR CONTRATO</p>
                </div>
                <div class="modal-body">
                    <div class="col mb-3 px-3">
                        <form id="form-contrato" action="">
                            <input type="hidden" name="idCliente">
                            <div class="row align-items-center mb-3">
                                <div class="col-md-5">
                                    <div class="row">
                                        <label for="selectAdmin" class="col-auto col-form-label">Admin:</label>
                                        <div class="col">
                                            <select title="Admin..." data-style="btn-secondary" class="form-control" name="selectAdmin" id="selectAdmin">
                                                <option value="dni">Jhon Casimiro</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-5">
                                    <div class="row">
                                        <label for="selectCredenciales" class="col-auto col-form-label">Credenciales:</label>
                                        <div class="col">
                                            <select title="Credenciales..." data-style="btn-secondary" class="form-control" name="selectCredenciales" id="selectCredenciales">
                                                <option value="diseñoWeb">Diseño Web</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row align-items-center mb-3">
                                <div class="col">
                                    <div class="row">
                                        <label for="fechaInicio" class="col-auto col-form-label">Fecha Inicio:</label>
                                        <div class="col">
                                            <input type="date" class="form-control" id="fechaInicio" name="fechaInicio">
                                        </div>
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="row">
                                        <label for="fechaRenovacion" class="col-auto col-form-label">Fecha Renovación:</label>
                                        <div class="col">
                                            <input type="date" class="form-control" id="fechaRenovacion" name="fechaRenovacion">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row align-items-center mb-3">
                                <div class="col-md-12">
                                    <div class="row">
                                        <label for="archivoContrato" class="col-auto col-form-label">Archivo Contrato:</label>
                                        <div class="col">
                                            <input type="file" class="form-control" id="archivoContrato" name="archivoContrato">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="modal-footer row align-items-center p-0 pt-2">
                                <div class="row d-flex justify-content-end mb-3">
                                    <div class="col-md-3">
                                        <button type="button" class="btn btn-secondary cancelar" data-bs-dismiss="modal"><i class="fa-solid fa-circle-xmark"></i>&nbsp; Cancelar</button>
                                    </div>
                                    <div class="col-md-3">
                                        <button type="button" class="btn btn-primary salvar" data-bs-target="#modalAceptarContrato" data-bs-toggle="modal"><i class="fa-solid fa-floppy-disk"></i>&nbsp;Salvar</button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Aceptar Contrato-->
    <div class="modal fade" id="modalAceptarContrato" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header" style="background-color: #4a4a4a; color: #fff;">
                    <h1 class="modal-title fs-5" id="staticBackdropLabel">Desea Agregar Contrato</h1>
                </div>
                <div class="modal-body">
                    El contrato sera registrado.
                </div>
                <div class="modal-footer row align-items-center p-0">
                    <div class="row d-flex justify-content-end mb-3">
                        <div class="col-md-4">
                            <button type="button" class="btn btn-secondary cancelar" data-bs-target="#modalAgregarContrato" data-bs-toggle="modal"><i class="fa-solid fa-circle-xmark"></i>&nbsp; Cancelar</button>
                        </div>
                        <div class="col-md-4">
                            <button type="submit" id="btn-aceptar-contrato" class="btn btn-primary salvar"><i class="fa-solid fa-floppy-disk"></i>&nbsp;Salvar</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Eliminar Contrato-->
    <div class="modal fade" id="modalEliminarContrato" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header" style="background-color: #4a4a4a; color: #fff;">
                    <h1 class="modal-title fs-5" id="staticBackdropLabel">Desea Eliminar Contrato</h1>
                </div>
                <div class="modal-body">
                    El contrato sera eliminado.
                </div>
                <div class="modal-footer row align-items-center p-0">
                    <div class="row d-flex justify-content-end mb-3">
                        <div class="col-md-4">
                            <button type="button" class="btn btn-secondary cancelar" data-bs-toggle="modal"><i class="fa-solid fa-circle-xmark"></i>&nbsp; Cancelar</button>
                        </div>
                        <div class="col-md-4">
                            <button type="submit" class="btn btn-primary salvar"><i class="fa-solid fa-floppy-disk"></i>&nbsp;Salvar</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js" integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script>
        document.getElementById('btn-aceptar-cliente').addEventListener('click', function() {
            document.getElementById('form-cliente').submit();
        });

        document.getElementById('btn-aceptar-factura').addEventListener('click', function() {
            document.getElementById('form-factura').submit();
        });

        document.getElementById('btn-aceptar-credenciales').addEventListener('click', function() {
            document.getElementById('form-credenciales').submit();
        });

        document.getElementById('btn-aceptar-contrato').addEventListener('click', function() {
            document.getElementById('form-contrato').submit();
        });
    </script>

    <script>
        // Función para realizar la búsqueda
        function buscarDNI() {
            var tipoDoc = $("#tipoDoc").val();
            var documento = $("#documento").val();

            if (tipoDoc == "DNI") {
                // Validar longitud del DNI
                if (documento.length !== 8) {
                    showModal('El DNI debe tener 8 dígitos');
                }
                if (!documento.trim()) {
                    showModal('Por favor, ingrese el DNI');
                }
            } else if(tipoDoc == "RUC"){
                // Validar longitud del DNI
                if (documento.length !== 11) {
                    showModal('El RUC debe tener 11 dígitos');
                }
                if (!documento.trim()) {
                    showModal('Por favor, ingrese el RUC');
                }
            }

            if (tipoDoc == "DNI") {
                $.ajax({
                    url: 'consulta-reniec.php',
                    type: 'POST',
                    data: {
                        documento: documento,
                        tipoDoc: tipoDoc
                    },
                    dataType: 'json',
                    success: function(persona) {
                        if (persona.numeroDocumento == documento) {
                            var nombreCompleto =persona.nombres+ ' ' + persona.apellidoPaterno + ' ' + persona.apellidoMaterno;
                            $('#nombre').val(nombreCompleto);
                            $('#numeroDocumento').val(persona.numeroDocumento);
                            $('#tipoDocumento').val('DNI');
                            $('#documento').val('');
                        }
                    }
                });
            } else if(tipoDoc == "RUC") {
                $.ajax({
                    url: 'consulta-reniec.php',
                    type: 'POST',
                    data: {
                        documento: documento,
                        tipoDoc: tipoDoc
                    },
                    dataType: 'json',
                    success: function(empresa) {
                        if (empresa.numeroDocumento == documento) {
                            $('#nombre').val(empresa.razonSocial);
                            $('#numeroDocumento').val(empresa.numeroDocumento);
                            $('#tipoDocumento').val('RUC');
                            $('#documento').val('');
                        }
                    }
                });
            }

        }

        function showModal(message, icon = "error") {
            const Toast = Swal.mixin({
                toast: true,
                position: "top-end",
                showConfirmButton: false,
                timer: 1500,
                timerProgressBar: true,
                didOpen: (toast) => {
                    toast.onmouseenter = Swal.stopTimer;
                    toast.onmouseleave = Swal.resumeTimer;
                }
            });
            Toast.fire({
                icon: icon,
                title: message
            });
        }


        $("#consultaReniec").click(buscarDNI);

        $('#documento,#numeroDocumento,#telefonocContacto').on('input', function() {
            this.value = this.value.replace(/\D/g, '');
        });
    </script>
    <?php
    require_once("layouts/footerAdmin.php");
    ?>
</body>

</html>