<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title><?= website ?> | <?= $page ?></title>
  <meta content="" name="description">
  <meta content="" name="keywords">

  <!-- Favicons -->
  <link rel="icon" href="\<?= root ?>\assets\img\logo.png">

  <!-- Vendor CSS Files -->
  <link rel="stylesheet" href="\<?= root ?>\node_modules\bootstrap\dist\css\bootstrap.min.css">
  <link rel="stylesheet" href="\<?= root ?>\node_modules\bootstrap-icons\font\bootstrap-icons.css">
  <link rel="stylesheet" href="\<?= root ?>\node_modules\boxicons\css\boxicons.min.css">
  <link rel="stylesheet" href="\<?= root ?>\node_modules\quill\dist\quill.snow.css">
  <link rel="stylesheet" href="\<?= root ?>\node_modules\quill\dist\quill.bubble.css">
  <link rel="stylesheet" href="\<?= root ?>\node_modules\remixicon\fonts\remixicon.css">
  <link rel="stylesheet" href="\<?= root ?>\assets\DataTables\datatables.min.css">
  <link rel="stylesheet" href="\<?= root ?>\node_modules\sweetalert2\dist\sweetalert2.min.css">

  <!-- Template Main CSS File -->
  <link rel="stylesheet" href="\<?= root ?>\assets\css\style.css">

  <!-- Google tag (gtag.js) -->
  <script async src="https://www.googletagmanager.com/gtag/js?id=G-FX8D7BF4SZ"></script>
  <script>
    window.dataLayer = window.dataLayer || [];
    function gtag() { dataLayer.push(arguments); }
    gtag('js', new Date());

    gtag('config', 'G-FX8D7BF4SZ');
  </script>

  <!-- Google reCAPTCHA -->
  <script src="https://www.google.com/recaptcha/api.js?render=<?= sitekey ?>"></script>
  <script>
    window.sitekey = "<?= sitekey ?>";
    const select_data_val = [];
  </script>

</head>

<body>