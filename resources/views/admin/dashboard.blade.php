<x-admin-layout>
    <div class="admin-content dashboard">
        <h4 class="mb-4">DASHBOARD</h4>
        <div class="row mb-4">
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
            <nav>
                <div class="nav nav-tabs" id="nav-tab" role="tablist">
                    <button class="nav-link active" id="nav-home-tab" data-bs-toggle="tab" data-bs-target="#nav-home"
                        type="button" role="tab" aria-controls="nav-home" aria-selected="true">Home</button>
                    <button class="nav-link" id="nav-profile-tab" data-bs-toggle="tab" data-bs-target="#nav-profile"
                        type="button" role="tab" aria-controls="nav-profile" aria-selected="false">Profile</button>
                    <button class="nav-link" id="nav-contact-tab" data-bs-toggle="tab" data-bs-target="#nav-contact"
                        type="button" role="tab" aria-controls="nav-contact" aria-selected="false">Contact</button>
                </div>
            </nav>
            <div class="tab-content" id="nav-tabContent">
                <div class="tab-pane fade show active" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab">
                    <table class="table" id="table">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Catalog</th>
                                <th>Category</th>
                                <th>Clicks</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($category_clicks_0 as $category)
                            <tr>
                                <td scope="row">{{$loop->iteration}}</td>
                                <td>{{ $category->catalog->title }}</td>
                                <td>{{ $category->category->title }}</td>
                                <td>{{ $category->clicks }}</td>
                                <td></td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <div class="tab-pane fade" id="nav-profile" role="tabpanel" aria-labelledby="nav-profile-tab">...</div>
                <div class="tab-pane fade" id="nav-contact" role="tabpanel" aria-labelledby="nav-contact-tab">...</div>
            </div>
        </div>
        <div class="row ">
            <div class="col-6">
                <h5 class="mb-3 mt-2">Analytics for the last <span id="timeText"></span></h5>
            </div>
            <div class="col-6 d-flex justify-content-end">
                <select class="form-select mb-3" aria-label="Filter">
                    <option value="7day" selected>7 Day</option>
                    <option value="1month">1 Months</option>
                    <option value="3months">3 Months</option>
                </select>
            </div>
            <hr>
            <div class="3months charts">
                <div class="row align-items-center">
                    <div class="col-12 col-lg-5 mb-5">
                        <div class="chart">
                            <canvas id="mostviewed" height=200 aria-label="Most Views 3 Months" role="img"></canvas>
                        </div>
                    </div>
                    <div class="col-12 col-lg-7 mb-5">
                        <div class="chart">
                            <canvas id="top_referrers" height=200 aria-label="Top Referrers 3 Months"
                                role="img"></canvas>
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="chart">
                            <canvas id="totalViews" height=200 aria-label="Total Views in 3 Months" role="img"></canvas>
                        </div>
                    </div>
                </div>
            </div>

            <div class="1month charts">
                <div class="row align-items-center">
                    <div class="col-12 col-lg-5 mb-5">
                        <div class="chart">
                            <canvas id="mostviewed1" height=200 aria-label="Most Views 3 Months" role="img"></canvas>
                        </div>
                    </div>
                    <div class="col-12 col-lg-7 mb-5">
                        <div class="chart">
                            <canvas id="top_referrers1" height=200 aria-label="Top Referrers 3 Months"
                                role="img"></canvas>
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="chart">
                            <canvas id="totalViews1" height=200 aria-label="Total Views in 3 Months"
                                role="img"></canvas>
                        </div>
                    </div>
                </div>
            </div>

            <div class="7day charts">
                <div class="row align-items-center">
                    <div class="col-12 col-lg-5 mb-5">
                        <div class="chart">
                            <canvas id="mostviewed7" height=200 aria-label="Most Views 3 Months" role="img"></canvas>
                        </div>
                    </div>
                    <div class="col-12 col-lg-7 mb-5">
                        <div class="chart">
                            <canvas id="top_referrers7" height=200 aria-label="Top Referrers 3 Months"
                                role="img"></canvas>
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="chart">
                            <canvas id="totalViews7" height=200 aria-label="Total Views in 3 Months"
                                role="img"></canvas>
                        </div>
                    </div>
                </div>
            </div>

        </div>

        <div class="mt-4">
            <a class="btn btn-primary align-items-center" href="https://analytics.google.com/analytics/web/"
                target="_blank">
                Open Google Analytics <i class="fas fa-chart-line ms-2"></i>
            </a>
        </div>
    </div>

    <script>
        $(document).ready(function () {
            $(".form-select").change(function(){
                $(this).find("option:selected").each(function(){
                    var optionValue = $(this).attr("value");
                    if(optionValue){
                        $(".charts").not("." + optionValue).hide();
                        $("." + optionValue).show();
                        $("#timeText").html($(this).text())
                    } else{
                        $(".box").hide();
                    }
                });
            }).change();

            var primary = '#063934'
            var secondary = '#B46F41';
            var blue = '#4c57d3';
            var pink = '#f186b0';

            //3 Months
            var mv3 =  {!!json_encode($mostVisited3)!!}
            var pageTitle3 = [];
            var pageViews3 = [];
            mv3.forEach(element => {
                pageTitle3.push(element.pageTitle.substr(0, 20))
                pageViews3.push(element.pageViews)
            });
            var ctx3 = document.getElementById("mostviewed").getContext("2d");
            window.myBar = new Chart(ctx3, {
                type: 'pie',
                data: {
                    labels: pageTitle3,
                    datasets: [{
                    label: 'Total Views',
                    backgroundColor: [primary,secondary, blue, 'lightgrey', pink],
                    data: pageViews3
                }]
                },
                options: {
                    responsive: true,
                    title: {
                        display: true,
                        text: 'Most Visited Pages'
                    }
                }
            });

            var tr3 =  {!!json_encode($topReferrers3)!!}
            var url3 = [];
            var pageViews3 = [];
            tr3.forEach(element => {
                url3.push(element.url)
                pageViews3.push(element.pageViews)
            });
            var ctxTr3 = document.getElementById("top_referrers").getContext("2d");
            window.myBar = new Chart(ctxTr3, {
                type: 'bar',
                data: {
                    labels: url3,
                    datasets: [{
                        label: 'Total Referrers',
                        backgroundColor: [primary,secondary, blue, 'lightgrey', pink],
                        data: pageViews3
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
                        text: 'Fetch Referrers'
                    }
                }
            });

            var tv3 =  {!!json_encode($totalVisitors1)!!}
            var date3 = [];
            var pageViews3 = [];
            tv3.forEach(element => {
                date3.push(element.date.substr(0, 10))
                pageViews3.push(element.pageViews)
            });
            var ctxTv3 = document.getElementById("totalViews").getContext("2d");
            window.myBar = new Chart(ctxTv3, {
                type: 'line',
                data: {
                    labels: date3,
                    datasets: [{
                        label: 'Page Views',
                        backgroundColor: [primary],
                        data: pageViews3
                    }]
                },
                options: {
                    responsive: true,
                    title: {
                        display: true,
                        text: 'Fetch Users'
                    }
                }
            });

            var mv1 =  {!!json_encode($mostVisited1)!!}
            var pageTitle1 = [];
            var pageViews1 = [];
            mv1.forEach(element => {
                pageTitle1.push(element.pageTitle.substr(0, 15))
                pageViews1.push(element.pageViews)
            });
            var ctx1 = document.getElementById("mostviewed1").getContext("2d");
            window.myBar = new Chart(ctx1, {
                type: 'pie',
                data: {
                    labels: pageTitle1,
                    datasets: [{
                        label: 'Total Views',
                        backgroundColor: [primary,secondary, blue, 'lightgrey', pink],
                        data: pageViews1
                    }]
                },
                options: {
                    responsive: true,
                    title: {
                        display: true,
                        text: 'Most Visited Pages'
                    }
                }
            });

            var tr1 =  {!!json_encode($topReferrers1)!!}
            var url1 = [];
            var pageViews1 = [];
            tr1.forEach(element => {
                url1.push(element.url)
                pageViews1.push(element.pageViews)
            });
            var ctxTr1 = document.getElementById("top_referrers1").getContext("2d");
            window.myBar = new Chart(ctxTr1, {
                type: 'bar',
                data: {
                    labels: url1,
                    datasets: [{
                        label: 'Total Referrers',
                        backgroundColor: [primary,secondary, blue, 'lightgrey', pink],
                        data: pageViews1
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
                        text: 'Fetch Referrers'
                    }
                }
            });

            var tv1 =  {!!json_encode($totalVisitors1)!!}
            var date1 = [];
            var pageViews1 = [];
            tv1.forEach(element => {
                date1.push(element.date.substr(0, 10))
                pageViews1.push(element.pageViews)
            });
            var ctxTv1 = document.getElementById("totalViews1").getContext("2d");
            window.myBar = new Chart(ctxTv1, {
                type: 'line',
                data: {
                    labels: date1,
                    datasets: [{
                        label: 'Page Views',
                        backgroundColor: [primary],
                        data: pageViews1
                    }]
                },
                options: {
                    responsive: true,
                    title: {
                        display: true,
                        text: 'Fetch Users'
                    }
                }
            });

            var mv7 =  {!!json_encode($mostVisited7)!!}
            var pageTitle7 = [];
            var pageViews7 = [];
            var urlMv7 = [];
            mv7.forEach(element => {
                pageTitle7.push(element.pageTitle.substr(0, 30))
                pageViews7.push(element.pageViews)
                urlMv7.push(element.url)
            });
            var ctx7 = document.getElementById("mostviewed7").getContext("2d");
            window.myBar = new Chart(ctx7, {
                type: 'pie',
                data: {
                    labels: pageTitle7,
                    datasets: [{
                    label: 'Total Views',
                    backgroundColor: [primary,secondary, blue, 'lightgrey', pink],
                    data: pageViews7
                }]
                },
                options: {
                    responsive: true,
                    title: {
                        display: true,
                        text: 'Most Visited Pages'
                    }
                }
            });

            var tr7 =  {!!json_encode($topReferrers7)!!}
            var url7 = [];
            var pageViews7 = [];
            tr7.forEach(element => {
                url7.push(element.url)
                pageViews7.push(element.pageViews)
            });
            var ctxTr7 = document.getElementById("top_referrers7").getContext("2d");
            window.myBar = new Chart(ctxTr7, {
                type: 'bar',
                data: {
                    labels: url7,
                    datasets: [{
                        label: 'Total Referrers',
                        backgroundColor: [primary,secondary, blue, 'lightgrey', pink],
                        data: pageViews7
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
                        text: 'Fetch Referrers'
                    }
                }
            });

            var tv7 =  {!!json_encode($totalVisitors7)!!}
            var date7 = [];
            var pageViews7 = [];
            tv7.forEach(element => {
                date7.push(element.date.substr(0, 10))
                pageViews7.push(element.pageViews)
            });
            var ctxTv7 = document.getElementById("totalViews7").getContext("2d");
            window.myBar = new Chart(ctxTv7, {
                type: 'line',
                data: {
                    labels: date7,
                    datasets: [{
                        label: 'Page Views',
                        backgroundColor: [primary],
                        data: pageViews7
                    }]
                },
                options: {
                    responsive: true,
                    title: {
                        display: true,
                        text: 'Fetch Users'
                    }
                }
            });
        });


        //7 day
        window.onload = function() {

        };
    </script>
</x-admin-layout>