<x-app-layout>
    @section('title')
        UKM Juwara
    @endsection
    <div class="header-container">
        <div class="header">
            <div>
                <img src="/images/header.png" alt="Header">
            </div>
            <div>
                <img src="/images/header.png" alt="Header">
            </div>
        </div>
        <div class="cta">
            <div class="cta-item">
                <a href="">#UKMJUWARA 2021</a>
            </div>
            <div class="cta-item">
                <a href="">#UKMJUWARA GLOBAL</a>
            </div>
        </div>
    </div>

    <script>
        $(document).ready(function(){
            $('.header').slick();
        });
    </script>
</x-app-layout>
