<!doctype html>
<html lang="en">


<!-- Mirrored from motrila.iranneginhotel.ir/ by HTTrack Website Copier/3.x [XR&CO'2014], Mon, 02 Dec 2019 09:28:36 GMT -->
<head>

    @include("admin.layout.head")

</head>

<body>
<!-- Preloader -->
@include("admin.layout.loader")
<!-- Preloader -->


<!-- ======================================
******* Page Wrapper Area Start **********
======================================= -->
<div class="ecaps-page-wrapper">
    <!-- Sidemenu Area -->
    <div class="ecaps-sidemenu-area">
        <!-- Desktop Logo -->
        <div class="ecaps-logo">
            <a href="index-2.html"><img class="desktop-logo" src="/admin/img/core-img/logo.png" alt="لوگوی دسک تاپ"> <img class="small-logo" src="/admin/img/core-img/small-logo.png" alt="آرم موبایل"></a>
        </div>

        <!-- Side Nav -->

        @include("admin.layout.sidenav")


    </div>

    <!-- Page Content -->
    <div class="ecaps-page-content">
        <!-- Top Header Area -->

        @include("admin.layout.topheader")

        <!-- Main Content Area -->
       @yield("content")


    </div>
</div>

<!-- ======================================
********* Page Wrapper Area End ***********
======================================= -->

@include("admin.layout.scripts")
</body>

<!-- Mirrored from motrila.iranneginhotel.ir/ by HTTrack Website Copier/3.x [XR&CO'2014], Mon, 02 Dec 2019 09:29:53 GMT -->
</html>

