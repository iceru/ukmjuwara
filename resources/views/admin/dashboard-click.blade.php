<div class="loading"></div>
<div class="row mb-5">
    <div class="col-12 col-lg-6 mb-5">
        <nav>
            <div class="nav nav-tabs" id="nav-tab" role="tablist">
                @foreach ($catalogs_title as $catalog)
                    <button class="nav-link {{ $loop->first ? 'active' : '' }}" id="category_{{ $catalog->slug }}-tab"
                        data-bs-toggle="tab" data-bs-target="#category_{{ $catalog->slug }}" type="button" role="tab"
                        aria-controls="category_{{ $catalog->slug }}"
                        aria-selected="true">{{ $catalog->title }}</button>
                @endforeach
            </div>
        </nav>
        <div class="tab-content" id="nav-tabContent">
            @foreach ($catalogs_title as $key => $catalog)
                <div class="tab-pane fade {{ $loop->first ? 'show active' : '' }}" id="category_{{ $catalog->slug }}"
                    role="tabpanel" aria-labelledby="category_{{ $catalog->slug }}-tab">
                    <table class="table table-clicks" style="width: 100%" id="table">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Category</th>
                                <th>Clicks</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach (${'category_clicks_' . $key} as $category)
                                <tr>
                                    <td scope="row">{{ $loop->iteration }}</td>
                                    <td>{{ $category['category']['title'] }}</td>
                                    <td>{{ $category['total'] }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @endforeach
        </div>
    </div>
    <div class="col-12 col-lg-6 mb-5">
        <nav>
            <div class="nav nav-tabs" id="nav-tab" role="tablist">
                @foreach ($catalogs_title as $catalog)
                    <button class="nav-link {{ $loop->first ? 'active' : '' }}" id="category_{{ $catalog->slug }}-tab"
                        data-bs-toggle="tab" data-bs-target="#program_{{ $catalog->slug }}" type="button"
                        role="tab" aria-controls="program_{{ $catalog->slug }}"
                        aria-selected="true">{{ $catalog->title }}</button>
                @endforeach
            </div>
        </nav>
        <div class="tab-content" id="nav-tabContent">
            @foreach ($catalogs_title as $key => $catalog)
                <div class="tab-pane fade {{ $loop->first ? 'show active' : '' }}" id="program_{{ $catalog->slug }}"
                    role="tabpanel" aria-labelledby="program_{{ $catalog->slug }}-tab">
                    <table class="table table-clicks" style="width: 100%" id="table">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Program</th>
                                <th>Clicks</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach (${'program_clicks_' . $key} as $program)
                                <tr>
                                    <td scope="row">{{ $loop->iteration }}</td>
                                    <td>{{ $program->program->title }}</td>
                                    <td>{{ $program->total }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @endforeach
        </div>
    </div>
    <div class="col-12 col-lg-6 mb-5">
        <nav>
            <div class="nav nav-tabs" id="nav-tab" role="tablist">
                @foreach ($catalogs_title as $catalog)
                    <button class="nav-link {{ $loop->first ? 'active' : '' }}" id="state_{{ $catalog->slug }}-tab"
                        data-bs-toggle="tab" data-bs-target="#state_{{ $catalog->slug }}" type="button" role="tab"
                        aria-controls="state_{{ $catalog->slug }}" aria-selected="true">{{ $catalog->title }}</button>
                @endforeach
            </div>
        </nav>
        <div class="tab-content" id="nav-tabContent">
            @foreach ($catalogs_title as $key => $catalog)
                <div class="tab-pane fade {{ $loop->first ? 'show active' : '' }}" id="state_{{ $catalog->slug }}"
                    role="tabpanel" aria-labelledby="state_{{ $catalog->slug }}-tab">
                    <table class="table table-clicks" style="width: 100%" id="table">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Lokasi</th>
                                <th>Clicks</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach (${'state_clicks_' . $key} as $state)
                                <tr>
                                    <td scope="row">{{ $loop->iteration }}</td>
                                    <td>{{ $state['title'] }}</td>
                                    <td>{{ $state['total'] }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @endforeach
        </div>
    </div>
    <div class="col-12 col-lg-6 mb-5">
        <nav>
            <div class="nav nav-tabs" id="nav-tab" role="tablist">
                @foreach ($catalogs_title as $catalog)
                    <button class="nav-link {{ $loop->first ? 'active' : '' }}" id="gender_{{ $catalog->slug }}-tab"
                        data-bs-toggle="tab" data-bs-target="#gender_{{ $catalog->slug }}" type="button"
                        role="tab" aria-controls="gender_{{ $catalog->slug }}"
                        aria-selected="true">{{ $catalog->title }}</button>
                @endforeach
            </div>
        </nav>
        <div class="tab-content" id="nav-tabContent">
            @foreach ($catalogs_title as $key => $catalog)
                <div class="tab-pane fade {{ $loop->first ? 'show active' : '' }}" id="gender_{{ $catalog->slug }}"
                    role="tabpanel" aria-labelledby="gender_{{ $catalog->slug }}-tab">
                    <table class="table table-clicks" style="width: 100%" id="table">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Gender Pemilik</th>
                                <th>Clicks</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach (${'gender_clicks_' . $key} as $gender)
                                <tr>
                                    <td scope="row">{{ $loop->iteration }}</td>
                                    <td>{{ $gender['title'] == 'pria-wanita' ? 'Pria dan Wanita' : ucwords($gender['title']) }}
                                    </td>
                                    <td>{{ $gender['total'] }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @endforeach
        </div>
    </div>
    <div class="col-12 col-lg-6 mb-5">
        <nav>
            <div class="nav nav-tabs" id="nav-tab" role="tablist">
                @foreach ($catalogs_title as $catalog)
                    <button class="nav-link {{ $loop->first ? 'active' : '' }}" id="floating_{{ $catalog->slug }}-tab"
                        data-bs-toggle="tab" data-bs-target="#floating_{{ $catalog->slug }}" type="button"
                        role="tab" aria-controls="floating_{{ $catalog->slug }}"
                        aria-selected="true">{{ $catalog->title }}</button>
                @endforeach
            </div>
        </nav>
        <div class="tab-content" id="nav-tabContent">
            @foreach ($catalogs_title as $key => $catalog)
                <div class="tab-pane fade {{ $loop->first ? 'show active' : '' }}"
                    id="floating_{{ $catalog->slug }}" role="tabpanel"
                    aria-labelledby="floating_{{ $catalog->slug }}-tab">
                    <table class="table table-clicks" style="width: 100%" id="table">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Floating Button</th>
                                <th>Clicks</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach (${'floating_clicks_' . $key} as $floating)
                                <tr>
                                    <td scope="row">{{ $loop->iteration }}</td>
                                    <td>{{ $floating['title'] }}</td>
                                    <td>{{ $floating['total'] }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @endforeach
        </div>
    </div>
    <div class="col-6">
        <nav>
            <div class="nav nav-tabs" id="nav-tab" role="tablist">
                @foreach ($catalogs_title as $catalog)
                    <button class="nav-link {{ $loop->first ? 'active' : '' }}" id="ukm{{ $catalog->slug }}-tab"
                        data-bs-toggle="tab" data-bs-target="#ukm{{ $catalog->slug }}" type="button"
                        role="tab" aria-controls="ukm{{ $catalog->slug }}"
                        aria-selected="true">{{ $catalog->title }}</button>
                @endforeach
            </div>
        </nav>
        <div class="tab-content" id="nav-tabContent">
            @foreach ($catalogs_title as $key => $catalog)
                <div class="tab-pane fade {{ $loop->first ? 'show active' : '' }}" id="ukm{{ $catalog->slug }}"
                    role="tabpanel" aria-labelledby="ukm{{ $catalog->slug }}-tab">
                    <table class="table table-clicks" id="table">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>UKM</th>
                                <th>Views</th>
                                <th>Whatsapp</th>
                                <th>Website</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach (${'ukm_clicks_' . $key} as $ukm_clicks)
                                <tr>
                                    <td scope="row">{{ $loop->iteration }}</td>
                                    <td>{{ $ukm_clicks->title }}</td>
                                    <td>{{ views($ukm_clicks)->period(\CyrildeWit\EloquentViewable\Support\Period::create($start_formatted, $end_formatted))->unique()->count() }}
                                    </td>
                                    <td>{{ $ukm_clicks->whatsapp_clicks ? $ukm_clicks->whatsapp_clicks : 0 }}</td>
                                    <td>{{ $ukm_clicks->instagram_clicks ? $ukm_clicks->instagram_clicks : 0 }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @endforeach
        </div>
    </div>
</div>
<div class="row ">
    <div class="col-6">
        <h5 class="mb-3 mt-2">Analytics <span id="timeText">for the last 7 days</span></h5>
    </div>
    <hr>

    <div class="charts">
        <div class="row align-items-center">
            <div class="col-12 ">
                <div class="chart">
                    <canvas id="total_views" height=200 aria-label="Total Views" style="height: 300px !important"
                        role="img"></canvas>
                </div>
            </div>
            <div class="col-12 col-md-6">
                <table class="table table-clicks" id="tableViews">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Page</th>
                            <th>Pageviews</th>
                            <th>Visitors</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($mostVisited as $item)
                            <tr>
                                <td scope="row">{{ $loop->iteration }}</td>
                                <td>{{ substr($item[0], 0, 50) }}</td>
                                <td>{{ $item[2] }}</td>
                                <td>{{ $item[1] }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div class="col-12 col-md-6">
                <div class="chart">
                    <canvas id="user_country" height=200 aria-label="Users Country" role="img"></canvas>
                </div>
            </div>
            <div class="col-12 col-md-7">
                <div class="chart">
                    <canvas id="top_referrers" height=200 aria-label="Top Referrers" role="img"></canvas>
                </div>
            </div>
            <div class="col-12 col-md-5">
                <div class="chart">
                    <canvas id="user_devices" height=200 aria-label="Users Device" role="img"></canvas>
                </div>
            </div>
        </div>
    </div>

</div>
