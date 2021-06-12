<x-app-layout>
    @section('title')
        UKM Juwara
    @endsection
    <div class="header">
        <div>
            <img src="" alt="">
        </div>
        
    </div>

    <script>
        $(document).ready(function(){
            $('.header').slick({
                arrow: true
            });
        });
    </script>
</x-app-layout>