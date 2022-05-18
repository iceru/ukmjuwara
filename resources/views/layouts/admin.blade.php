<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>#UKMJuWAra</title>

    <!-- Styles -->
    <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.25/css/dataTables.bootstrap5.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.2.9/css/responsive.dataTables.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" integrity="sha512-iBBXm8fW90+nuLcSKlbmrPcLa0OT92xO1BIsZ+ywDWZCvqsWgccV3gFoRBv0z+8dLJgyAHIhR35VZc2oM/gI1w==" crossorigin="anonymous" />
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">

    @yield('css')

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js" integrity="sha512-894YE6QWD5I59HgZOGReFYm4dnWc1Qt5NtvYSaNcOP+u1T9qYdvdihz0PPSiiqn/+/3e7Jo4EaG7TubfWGUrMQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://cdn.datatables.net/1.10.24/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.24/js/dataTables.bootstrap5.min.js"></script>
    <script src="https://cdn.datatables.net/responsive/2.2.9/js/dataTables.responsive.min.js"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js@3.2.1/dist/chart.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" integrity="sha512-iBBXm8fW90+nuLcSKlbmrPcLa0OT92xO1BIsZ+ywDWZCvqsWgccV3gFoRBv0z+8dLJgyAHIhR35VZc2oM/gI1w==" crossorigin="anonymous" />
    <script src='https://cdn.tiny.cloud/1/w6cvfb6bgswq49z8hbl7msw8t7r9cw5auu24heasdln1q2fy/tinymce/5/tinymce.min.js' referrerpolicy="origin">


    </script>
</head>

<body class="font-sans antialiased">
    <div class="container-fluid administrator">
        <div class="row">
            @include('layouts.navigation-admin')
            @include('layouts.sidebar-admin')

            <!-- Page Content -->
            <main class="col-12 col-lg-10 content-admin">
                {{ $slot }}
            </main>
        </div>
    </div>

    @yield('js')

    <script>
        $(document).ready(function(){
            $('.hamburger').click(function(){
                $('.sidebar-admin').toggleClass('active');
                $('body').css('overflow-y', 'hidden');
            })

            $('.button-close').click(function () {
                $('.sidebar-admin').removeClass('active');
                $('body').css('overflow-y', 'auto');
            })

            tinymce.init({
                selector: 'textarea',
                plugins: 'link image imagetools paste forecolor',
                paste_as_text: true,
                toolbar: [
                    {
                        name: 'history', items: [ 'undo', 'redo' ]
                    },
                    {
                        name: 'styles', items: [ 'styleselect' ]
                    },
                    {
                        name: 'formatting', items: [ 'bold', 'italic', 'underline']
                    },
                    {
                        name: 'alignment', items: [ 'alignleft', 'aligncenter', 'alignright', 'alignjustify' ]
                    },
                    {
                        name: 'indentation', items: [ 'outdent', 'indent' ]
                    },
                    {
                        name: 'colors', items: ['forecolor']
                    }
                ],
                a11y_advanced_options: true,
                toolbar_mode: 'floating',
                tinycomments_mode: 'embedded',
                tinycomments_author: 'UKM Juwara',
                height : "350",
                color_cols: 5,
                color_map: [
                    '16857E', 'Primary',
                    '58C082', 'Secondary',
                    '000000', 'Black',
                    'FFFFFF', 'White',
                ],
                image_title: true,
                automatic_uploads: true,
                images_upload_url: '/upload/image',
                file_picker_types: 'image',
                file_picker_callback: function(cb, value, meta) {
                    var input = document.createElement('input');
                    input.setAttribute('type', 'file');
                    input.setAttribute('accept', 'image/*');
                    input.onchange = function() {
                        var file = this.files[0];

                        var reader = new FileReader();
                        reader.readAsDataURL(file);
                        reader.onload = function () {
                            var id = 'blobid' + (new Date()).getTime();
                            var blobCache =  tinymce.activeEditor.editorUpload.blobCache;
                            var base64 = reader.result.split(',')[1];
                            var blobInfo = blobCache.create(id, file, base64);
                            blobCache.add(blobInfo);
                            cb(blobInfo.blobUri(), { title: file.name });
                        };
                    };
                    input.click();
                }
            });
        })
    </script>
</body>

</html>
