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
            });
            userDevicesChart();
            userCountryChart();
            totalVisitorsChart();
            userTopReferrers();

            $('.loading').hide();
        });

        function userDevicesChart(data) {

            var primary = '#16857E'
            var secondary = '#58C082';
            var blue = '#4c57d3';
            var pink = '#f186b0';

            var userDevices = {!! json_encode($userDevice) !!}
            if (data) {
                userDevices = data;
            }
            var type = [];
            var pageViews = [];
            userDevices.rows.forEach(element => {
                type.push(element[0]);
                pageViews.push(element[1]);
            });
            var ctxTr7 = document.getElementById("user_devices").getContext("2d");
            window.myUserDevices = new Chart(ctxTr7, {
                type: 'doughnut',
                data: {
                    labels: type,
                    datasets: [{
                        label: 'User Devices',
                        backgroundColor: [primary, secondary, blue, 'lightgrey', pink],
                        data: pageViews
                    }]
                },
                options: {
                    responsive: true,
                    title: {
                        display: true,
                        text: 'User Devices'
                    }
                }
            });
        }

        function userTopReferrers(data) {

            var primary = '#16857E'
            var secondary = '#58C082';
            var blue = '#4c57d3';
            var pink = '#f186b0';

            var topReferrers = {!! json_encode($topReferrers) !!}
            if (data) {
                topReferrers = data;
            }
            var type = [];
            var pageViews = [];
            topReferrers.forEach(element => {
                type.push(element.url);
                pageViews.push(element.pageViews);
            });
            var trs = document.getElementById("top_referrers").getContext("2d");
            window.myTopReferrers = new Chart(trs, {
                type: 'bar',
                data: {
                    labels: type,
                    datasets: [{
                        label: 'Top Referrers',
                        backgroundColor: [primary, secondary, blue, 'lightgrey', pink],
                        data: pageViews
                    }]
                },
                options: {
                    elements: {
                        rectangle: {
                            borderWidth: 2,
                            borderColor: '#c1c1c1',
                        }
                    },
                    indexAxis: 'y',
                    responsive: true,
                    title: {
                        display: true,
                        text: 'Top Referrers'
                    }
                }
            });
        }


        function userCountryChart(data) {
            var primary = '#16857E'
            var secondary = '#58C082';
            var blue = '#4c57d3';
            var pink = '#f186b0';

            var userCountry = {!! json_encode($userCountry) !!}
            if (data) {
                userCountry = data;
            }
            var sortedCountry = userCountry.rows.sort((a, b) => b[1] - a[1]).slice(0, 5);
            var country = [];
            var pageViewsCountry = [];
            sortedCountry.forEach(element => {
                country.push(element[0]);
                pageViewsCountry.push(element[1]);
            });
            var ctxCountry = document.getElementById("user_country").getContext("2d");

            window.myUserCountry = new Chart(ctxCountry, {
                type: 'bar',
                data: {
                    labels: country,
                    datasets: [{
                        label: 'Users Country',
                        backgroundColor: [primary, secondary, blue, 'lightgrey', pink],
                        data: pageViewsCountry
                    }]
                },
                options: {
                    elements: {
                        rectangle: {
                            borderWidth: 2,
                            borderColor: '#c1c1c1',
                        }
                    },
                    indexAxis: 'y',
                    responsive: true,
                    title: {
                        display: true,
                        text: 'Country'
                    }
                }
            });
        }

        function totalVisitorsChart(data) {
            var secondary = '#58C082';
            var primary = '#16857E'

            var total_visitors = {!! json_encode($totalVisitors) !!}
            if (data) {
                total_visitors = data;
            }
            var date = [];
            var pageViews = [];
            var visitors = [];
            total_visitors.forEach(element => {
                date.push($.datepicker.formatDate('dd M', new Date(element.date)))
                pageViews.push(element.pageViews);
                visitors.push(element.visitors);
            });
            var ctxTv7 = document.getElementById("total_views").getContext("2d");

            window.myTotalVisitors = new Chart(ctxTv7, {
                type: 'line',
                data: {
                    labels: date,
                    datasets: [{
                            label: 'Page Views',
                            backgroundColor: [primary],
                            data: pageViews,
                            tension: 0.4,
                            borderColor: primary,
                        },
                        {
                            label: 'Visitors',
                            backgroundColor: [secondary],
                            data: visitors,
                            tension: 0.4,
                            borderColor: secondary,
                        }
                    ]
                },
                options: {
                    responsive: true,
                    title: {
                        display: true,
                        text: 'Fetch Users'
                    },
                    scales: {
                        y: {
                            ticks: {
                                stepSize: 50
                            }
                        }
                    }
                }
            });
        }

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

                        userDevicesChart(response.userDevices);
                        userCountryChart(response.userCountry);
                        totalVisitorsChart(response.totalVisitors);
                        userTopReferrers(response.topReferrers);
                        $('.table-clicks').DataTable({
                            responsive: true,
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
