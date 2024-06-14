<footer style="background-color: #33076e; margin-top: auto; padding: 2rem 0; flex-shrink: 0;">
    <div class="container-fluid d-flex flex-column align-items-center">
        <div class="col-12 mb-3" style="max-width: 400px;">
            <img class="img-fluid" src="assets/img/MANUAL DE IDENTIDAD - V&S.png" alt="marca 1">
        </div>
        <div class="col-12 mb-3 text-footer text-center text-white">
            <p>TODOS LOS DERECHOS RESERVADOS - <span id="currentYear">2018 - 2024</span></p>
            <p>POWERED BY CORPORACION VYS PERÚ E.I.R.L - RUC: 20612408824</p>
            <p>CENTRAL TELEFóNICA: +51 917 344 290</p>
        </div>
    </div>
</footer>
<script>
    document.addEventListener("DOMContentLoaded", function() {
        var currentYearElement = document.getElementById('currentYear');
        var currentYear = new Date().getFullYear();
        currentYearElement.textContent = '2018 - ' + currentYear;
    });
</script>