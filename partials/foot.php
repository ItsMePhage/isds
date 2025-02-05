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

<!-- Template Main JS File -->
<script src="\<?= root ?>\assets\js\main.js"></script>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'))
        var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
            return new bootstrap.Tooltip(tooltipTriggerEl)
        })
    })
</script>

</html>