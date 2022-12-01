<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="apple-touch-icon" sizes="76x76" href="../assets/img/apple-icon.png">
    <link rel="icon" type="image/png" href="../assets/img/favicon.png">
    <title>
        @yield('title')
    </title>

    @include('includes.style')
</head>

<body class="g-sidenav-show  bg-gray-100">

    @include('includes.sidebar')

    <main class="main-content position-relative max-height-vh-100 h-100 mt-1 border-radius-lg ">

        @yield('content')
        <footer class="footer pt-3  ">
            <div class="container-fluid">
                <div class="row align-items-center justify-content-lg-between">
                    <div class="col-lg-6 mb-lg-0 mb-4">
                        <div class="copyright text-center text-sm text-muted text-lg-start">
                            ©
                            <script>
                                document.write(new Date().getFullYear())
                            </script>
                            Newus Technology
                        </div>
                    </div>
                </div>
            </div>
        </footer>
    </main>


    <!--   Core JS Files   -->
    @include('includes.script')


</body>

</html>
