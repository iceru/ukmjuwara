<x-admin-layout>
    <div class="admin-content dashboard">
        <h4 class="mb-4">DASHBOARD</h4>
        <div class="row mb-5">
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
            <div class="col-6 col-lg-3 mb-3">
                <div class="stat-number">
                    <div class="icon">
                        <i class="fas fa-box"></i><span>Kategori</span>
                    </div>
                    <h1>{{ $categories }}</h1>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <div class="d-flex justify-content-between align-items-center">
                    <h5>Jumlah Klik</h5>
                    <form>
                        <div class="dates d-flex justify-content-between">
                            <div class="start me-3 d-flex align-items-center">
                                <label for="start_date" class="me-2">Start</label>
                                <input type="text" class="form-control" name="start_date" id="start_date" readonly
                                    required>
                            </div>
                            <div class="end d-flex align-items-center me-3">
                                <label for="start_date" class="me-2">End</label>
                                <input type="text" class="form-control" name="end_date" id="end_date" readonly
                                    required>
                            </div>
                            <button type="button" class="btn btn-primary" id="filterClick">Filter</button>
                        </div>
                    </form>
                </div>
                <hr>
            </div>
        </div>
        <div id="dashboard_click">
            @include('admin.dashboard-click')
        </div>

        <div class="mt-4">
            <a class="btn btn-primary align-items-center" href="https://analytics.google.com/analytics/web/"
                target="_blank">
                Open Google Analytics <i class="fas fa-chart-line ms-2"></i>
            </a>
        </div>
    </div>

    <script>
        $(document).ready(function() {
            $("#start_date").datepicker({
                maxDate: '-1'
            });
            $("#end_date").datepicker({
                maxDate: '0',
            });

            $('.table-clicks').DataTable({
                responsive: true,
                dom: 'Bfrtip',
                buttons: [
                    'csv', 'excel'
                ]
            });

            $('.loading').hide();
        });


        $('#filterClick').click(function(e) {
            e.preventDefault();
            var startValue = $('#start_date').val();
            var endValue = $('#end_date').val();

            if (startValue && endValue) {
                var start_date =
                    `${$.datepicker.formatDate("yy-mm-dd", new Date(startValue))} 00:00:00`;
                var end_date =
                    `${$.datepicker.formatDate("yy-mm-dd", new Date(endValue))} 23:59:59`;
                $('.loading').fadeIn();
                $.ajax({
                    type: "GET",
                    url: "/admin",
                    data: {
                        start_date,
                        end_date
                    },
                    success: function(response) {
                        window.myTotalVisitors.destroy();
                        window.myUserCountry.destroy();
                        window.myUserDevices.destroy();
                        window.myTopReferrers.destroy();
                        $('#dashboard_click').html(response.body);

                        $('#timeText').text(
                            `for ${$.datepicker.formatDate("dd-mm-yy", new Date(start_date))} until ${$.datepicker.formatDate("dd-mm-yy", new Date(end_date))}`
                        );
                        userDevicesChart(response.userDevices);
                        userCountryChart(response.userCountry);
                        totalVisitorsChart(response.totalVisitors);
                        userTopReferrers(response.topReferrers);
                        $('.table-clicks').DataTable({
                            responsive: true,
                            buttons: [
                                'excelHtml5',
                                'csvHtml5',
                            ]
                        })
                        $('.loading').fadeOut();
                    }
                });
            } else {
                alert('Tanggal belum diinput')
            }


        });
    </script>
</x-admin-layout>
