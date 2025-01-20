<!DOCTYPE html>
<html>
  <head>
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
    <title>Kaiadmin Bootstrap 5 Admin Dashboard</title>
    <meta
      content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0, shrink-to-fit=no"
      name="viewport"
    />
    <link rel="icon" href="assets/img/kaiadmin/favicon.ico" type="image/x-icon" />
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />

    <script src="{{asset('admin/assets/js/plugin/webfont/webfont.min.js')}}"></script>
    <script>
      WebFont.load({
        google: { families: ["Public Sans:300,400,500,600,700"] },
        custom: {
          families: [
            "Font Awesome 5 Solid",
            "Font Awesome 5 Regular",
            "Font Awesome 5 Brands",
            "simple-line-icons",
          ],
          urls: ["assets/css/fonts.min.css"],
        },
        active: function () {
          sessionStorage.fonts = true;
        },
      });
    </script>

    <link rel="stylesheet" href="{{asset('admin/assets/css/bootstrap.min.css')}}" />
    <link rel="stylesheet" href="{{asset('admin/assets/css/plugins.min.css')}}" />
    <link rel="stylesheet" href="{{asset('admin/assets/css/kaiadmin.min.css')}}" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link href="{{asset('admin/assets/styles.css')}}" rel="stylesheet" />
    <link href="{{asset('admin/assets/prism.css')}}" rel="stylesheet" />
  </head>
  <body>
    <div class="wrapper">

    @include('layouts.inc.admin.sidebar')

      <div class="main-panel">

            @yield('content')
      </div>
    </div>
  </body>


  <script src="{{asset('admin/assets/js/core/jquery-3.7.1.min.js')}}"></script>
  <script src="{{asset('admin/assets/js/core/popper.min.js')}}"></script>
  <script src="{{asset('admin/assets/js/core/bootstrap.min.js')}}"></script>
  <script src="{{asset('admin/assets/js/plugin/jquery-scrollbar/jquery.scrollbar.min.js')}}"></script>
  <script src="{{asset('admin/assets/js/plugin/datatables/datatables.min.js')}}"></script>
  <script src="{{asset('admin/assets/js/kaiadmin.min.js')}}"></script>
  <script src="{{asset('admin/assets/prism.js')}}"></script>
  <script src="{{asset('admin/assets/prism-normalize-whitespace.min.js')}}"></script>
  <script type="text/javascript">
    // Optional
    Prism.plugins.NormalizeWhitespace.setDefaults({
      "remove-trailing": true,
      "remove-indent": true,
      "left-trim": true,
      "right-trim": true,
    });

    // handle links with @href started with '#' only
    $(document).on("click", 'a[href^="#"]', function (e) {
      // target element id
      var id = $(this).attr("href");

      // target element
      var $id = $(id);
      if ($id.length === 0) {
        return;
      }

      // prevent standard hash navigation (avoid blinking in IE)
      e.preventDefault();

      // top position relative to the document
      var pos = $id.offset().top - 80;

      // animated top scrolling
      $("body, html").animate({ scrollTop: pos });
    });
    document.querySelector('.toggle-sidebar').addEventListener('click', function () {
  document.querySelector('.sidebar').classList.toggle('hidden'); // Hide/show sidebar
});

document.querySelector('.sidenav-toggler').addEventListener('click', function () {
  document.querySelector('.sidebar').classList.toggle('collapsed'); // Collapse sidebar
});

  </script>
</html>
