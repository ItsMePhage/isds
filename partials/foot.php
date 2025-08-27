<?php
// foot.php - Updated with modular JavaScript structure
?>

</body>

<!-- Vendor JS Files -->
<script src="\<?= root ?>\node_modules\jquery\dist\jquery.min.js"></script>
<script src="\<?= root ?>\node_modules\jquery-ui\dist\jquery-ui.min.js"></script>
<script src="\<?= root ?>\node_modules\sweetalert2\dist\sweetalert2.all.min.js"></script>
<script src="\<?= root ?>\node_modules\apexcharts\dist\apexcharts.min.js"></script>
<script src="\<?= root ?>\node_modules\bootstrap\dist\js\bootstrap.bundle.min.js"></script>
<script src="\<?= root ?>\node_modules\chart.js\dist\chart.umd.js"></script>
<script src="\<?= root ?>\node_modules\echarts\dist\echarts.min.js"></script>
<script src="\<?= root ?>\node_modules\quill\dist\quill.js"></script>
<script src="\<?= root ?>\assets\DataTables\datatables.min.js"></script>
<script src="\<?= root ?>\node_modules\tinymce\tinymce.min.js"></script>
<script src="\<?= root ?>\node_modules\imask\dist\imask.min.js"></script>
<script src="\<?= root ?>\node_modules\@fullcalendar\core\index.global.js"></script>
<script src="\<?= root ?>\node_modules\@fullcalendar\daygrid\index.global.js"></script>
<script src="\<?= root ?>\node_modules\@fullcalendar\interaction\index.global.js"></script>

<!-- Application JS Files (Modular Structure) -->
<!-- Load in specific order - dependencies first -->
<script src="\<?= root ?>\assets\js\utils.js"></script>
<script src="\<?= root ?>\assets\js\navigation.js"></script>
<script src="\<?= root ?>\assets\js\datatables.js"></script>
<script src="\<?= root ?>\assets\js\forms.js"></script>
<script src="\<?= root ?>\assets\js\dropdowns.js"></script>
<script src="\<?= root ?>\assets\js\crud-operations.js"></script>
<script src="\<?= root ?>\assets\js\modals.js"></script>
<script src="\<?= root ?>\assets\js\print.js"></script>
<script src="\<?= root ?>\assets\js\charts.js"></script>
<script src="\<?= root ?>\assets\js\calendar.js"></script>

<!-- Main Application Entry Point (Loads last) -->
<script src="\<?= root ?>\assets\js\main.js"></script>

</html>