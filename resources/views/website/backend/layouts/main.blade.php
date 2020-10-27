
<!DOCTYPE html>
<html>
    <head>
        <!-- META TAGS -->
        @include('website.backend.layouts.head')
    </head>

    <body class="hold-transition skin-blue sidebar-mini">

        <!-- START WRAPPER SECTION -->
        <div class="wrapper">

            <!-- START MAIN-HEADER SECTION -->
            <header class="main-header">
                @include('website.backend.layouts.header')
            </header><!-- MAIN-HEADER SECTION END-->

            @include('website.backend.layouts.sidebar')


            <!-- START CONTENT WRAPPER SECTION -->
            <div class="content-wrapper">
                <!-- START MAIN CONTENT SECTION -->
                <section class="content wrapper-main-content">
                    <div class="row">
                        <div class="col-sm-12">
                            @yield('content')
                        </div>
                    </div>
                </section><!-- MAIN CONTENT SECTION END -->
            </div><!-- CONTENT WRAPPER SECTION END -->

            @include('website.backend.layouts.footbar')
        </div><!-- WRAPPER SECTION END -->
        @include('website.backend.layouts.foot')

    <!-- start Image upload -->
    <script>
        function previewFile(input){
            var file=$("input[type=file]").get(0).files[0];
            if (file)
            {
                var reader = new FileReader();
                reader.onload = function()
                {
                    $('#previewImg').attr("src",reader.result);
                }                
                reader.readAsDataURL(file);
            }
        }
    </script>
    
    @stack('scripts')

    </body>
</html>