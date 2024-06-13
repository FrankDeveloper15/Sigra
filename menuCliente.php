<?php
require_once("layouts/headCliente.php");
?>

<body>
    <?php
    require_once("layouts/headerCliente.php");
    ?>
    <main>
        <div class="container-fluid py-sm-3 py-5">
            <div class="row p-5 ">
                <div class="col-12 col-lg-6">
                    <span class="title__info"><i class="fa-solid fa-circle-info"></i>INFORMACIÓN DE LA EMPRESA</span>
                    <div class="info">
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
                <div class="col-12 col-lg-6 d-flex flex-column align-items-center justify-content-center">
                    <div class="w-100">
                        <div class="row w-100 mb-3 justify-content-center mt-5">
                            <div class="col-12 col-md-4 d-flex justify-content-center mb-3 mb-md-0">
                                <a href="facturasCliente.php" class="btn btn-primary clr-fac" role="button"><i class="fa-solid fa-file-circle-check"></i> VER FACTURAS</a>
                            </div>
                            <div class="col-12 col-md-4  d-flex justify-content-center mb-3 mb-md-0">
                                <a href="contratosCliente.php" class="btn btn-primary clr-con" ><i class="fa-solid fa-file-circle-check"></i> CONTRATO</a>
                            </div>
                            <div class="col-12 col-md-4 d-flex justify-content-center mb-3 mb-md-0">
                                <a href="credencialesCliente.php" class="btn btn-primary clr-cre" role="button"><i class="fa-solid fa-file-import"></i> CREDENCIALES</a>
                            </div>
                        </div>
                        <div class="row w-100 justify-content-center mt-5">
                            <div class="col-md-4 d-flex justify-content-center mb-3 mb-md-0">
                                <a href="reportePagoCliente.php" class="btn btn-primary clr-pa" id="reportarPagoBtn" role="button"><i class="fa-solid fa-file-circle-check"></i> REPORTAR PAGO</a>
                            </div>
                            <div class="col-md-5 d-flex justify-content-center mb-3 mb-md-0">
                                <a href="url_contactar_soporte" class="btn btn-primary clr-so" role="button"><i class="fa-regular fa-circle-question"></i> CONTACTAR A SOPORTE</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div id="myModal" class="modal">
            <!-- Modal content -->
            <div class="modal-content">
                <div class="reporte-menu">
                    <div class="background-text">REPORTAR PAGO</div>
                    <label for="modalToggle" class="close1">&times;</label>
                </div>
                <div class="select-container">
                    <div class="column">
                        <label for="selectMonth">Mes</label>
                        <select id="selectMonth" class="select-element">
                            <option>Enero</option>
                            <option>Febrero</option>
                            <option>Marzo</option>
                            <option>Abril</option>
                            <option>Mayo</option>
                            <option>Junio</option>
                            <option>Julio</option>
                            <option>Agosto</option>
                            <option>Setiembre</option>
                            <option>Octubre</option>
                            <option>Noviembre</option>
                            <option>Diciembre</option>
                        </select>
                    </div>
                    <div class="column">
                        <label for="selectYear">Año</label>
                        <select id="selectYear" class="select-element">
                            <option>2010</option>
                            <option>2011</option>
                            <option>2022</option>
                            <option>2013</option>
                            <option>2014</option>
                            <option>2015</option>
                            <option>2016</option>
                            <option>2017</option>
                            <option>2018</option>
                            <option>2019</option>
                            <option>2020</option>
                            <option>2021</option>
                            <option>2022</option>
                            <option>2023</option>
                        </select>
                    </div>
                </div>

                <div class="select-container">
                    <label for="selectService">Servicio</label>
                    <select id="selectService" class="select-element">
                        <option>DESARROLLO DE SOFTWARE/APPS EMPRESARIALES</option>
                        <option>IMPLEMENTACIÓN DE CORREO CORPORATIVO</option>
                        <option>SERVICIOS DE CONTACT CENTER-TELEMARKETING Y VENTAS</option>
                        <option>SOFTWARE DE GESTIÓN DE COMPAÑIAS DE SEGURO</option>
                        <option>SERVICIOS CONTABLES, FINANCIEROS Y TRIBUTARIOS</option>
                        <option>DISEÑO GRAFICO PROFESIONAL</option>
                        <option>SERVICIOS DE BUFFET Y CATERING</option>
                        <option>ESTIMULACIÓN TEMPRANA</option>
                        <option>ASESORÍA Y CONSULTORES EN MARKETING Y REDES SOCIALES</option>
                        <option>VENTA DE PRODUCTOS PARA ÓPTICA</option>
                        <option>SERVICIO DE CONSTRUCCIÓN EN GENERAL</option>
                        <option>SERVICIO DE PANADERÍA Y PASTELERÍA PERSONALIZADA</option>
                    </select>
                </div>

                <div class="file-input-container">
                    <label for="myFile">Seleccionar Archivo</label>
                    <input type="file" id="myFile" name="filename" class="file-input">
                </div>
                <div class="contenedor_botones">
                    <button class="button_1" onclick="cerrarModal()">CERRAR</button>
                    <button class="button_2" onclick="abrirConfirmacion()">GUARDAR</button>
                </div>
            </div>
        </div>


        <!-- Popup de Confirmación -->
        <div id="confirmPopup" class="modal">
            <div class="modal-confirmacion">
                <div class="reporte-menu2">
                    <div class="background-text2">REPORTAR PAGO</div>
                    <label for="modalToggle" class="close2">&times;</label>
                </div>
                <p>¿Está seguro(a) de reportar el pago del mes de "<span id="mesSeleccionado"></span>"?</p>
                <div class="contenedor_botones">
                    <button class="button si" onclick="guardarPago()">SI</button>
                    <button class="button no" onclick="cerrarConfirmPopup()">NO</button>
                </div>
            </div>
        </div>

    </main>
    <?php
    require_once("layouts/footer.php");
    ?>
</body>

</html>