<!DOCTYPE html>

<html
  lang="en"
  class="light-style layout-wide customizer-hide"
  dir="ltr"
  data-theme="theme-default"
  data-assets-path="../../assets/"
  data-template="horizontal-menu-template">
  <head>
    <meta charset="utf-8" />
    <meta
      name="viewport"
      content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0" />

    <title>419</title>

    <meta name="description" content="" />

    <!-- Favicon -->
    <link rel="icon" type="image/x-icon" href="{{ asset('assets/img/favicon/favicon.ico') }}" />

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
      href="https://fonts.googleapis.com/css2?family=Public+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&ampdisplay=swap"
      rel="stylesheet" />

   <link rel="stylesheet" href="{{ asset('assets/css/demo.css') }}" />>

    <!-- Page CSS -->
    <!-- Page -->
    <link rel="stylesheet" href="{{ asset('assets/vendor/css/pages/page-misc.css') }}" />

  </head>

  <body>
    <!-- Content -->

    <!-- Not Authorized -->
    <div class="container-xxl container-p-y">
      <div class="misc-wrapper">
        <h2 class="mb-1 mx-2">Page expired please refresh the page</h2>
        <p class="mb-4 mx-2">
          The page you are currently trying to access has expired please refresh.
        </p>
        <a href="{{ route('logdashboard') }}" class="btn btn-primary mb-4">Back to home</a>
        <div class="mt-4">
          <img
            src="{{ asset('assets/img/illustrations/page-misc-you-are-not-authorized.png') }}"
            alt="page-misc-not-authorized"
            width="170"
            class="img-fluid" />
        </div>
      </div>
    </div>
    <div class="container-fluid misc-bg-wrapper">
      <img
        src="{{ asset('assets/img/illustrations/bg-shape-image-light.png') }}"
        alt="page-misc-not-authorized"
        data-app-light-img="illustrations/bg-shape-image-light.png"
        data-app-dark-img="illustrations/bg-shape-image-dark.png" />
    </div>
    <!-- /Not Authorized -->

    <!-- / Content -->

    <script src="{{ asset('assets/vendor/libs/jquery/jquery.js') }}"></script>
    <script src="{{ asset('assets/vendor/js/bootstrap.js') }}"></script>
    <script src="{{ asset('assets/vendor/js/menu.js') }}"></script>

    <!-- Main JS -->
    <script src="{{ asset('assets/js/main.js') }}"></script>

  </body>
</html>
