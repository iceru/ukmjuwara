<x-admin-layout>
    <div class="admin-content dashboard">
        <h4 class="mb-4">DASHBOARD</h4>
        <div class="row">
            <div class="col-6 col-lg-3 mb-3">
                <div class="stat-number">
                    <div class="icon">
                        <i class="fas fa-store"></i> <span>UKM</span>
                    </div>
                    <h1>{{ $ukms }}</h1>
                </div>
            </div>
            <div class="col-6 col-lg-3 mb-3">
                <div class="stat-number">
                    <div class="icon">
                        <i class="fas fa-newspaper"></i> <span>Artikel</span>
                    </div>
                    <h1>{{ $articles }}</h1>
                </div>
            </div>
            <div class="col-6 col-lg-3 mb-3">
                <div class="stat-number">
                    <div class="icon">
                        <i class="fas fa-list-alt"></i> <span>Katalog</span>
                    </div>
                    <h1>{{ $catalogs }}</h1>
                </div>
            </div>
        </div>
    </div>
</x-admin-layout>
