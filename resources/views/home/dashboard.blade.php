@php
    $pagename = 'Dashboard';
    $pagecramp = 'View summarised statistics !';
@endphp


@extends('partials.main')
@section('content')
    <div class="row">

        <div class="col-md-8 col-lg-8 col-sm-12 col-xl-8">
            <div class="row">
                <!-- table card-1 start -->
                <div class="col-md-12 col-sm-12 col-lg-6 col-xl-6">
                    <div class="card flat-card">
                        <div class="row-table">
                            <div class="col-sm-6 card-body br">
                                <div class="row">
                                    <div class="col-sm-4">
                                        <i class="icon feather icon-users text-c-green mb-1 d-block"></i>
                                    </div>
                                    <div class="col-sm-8 text-md-center">
                                        <h5>{{ $no_customers }}</h5>
                                        <span>Customers</span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-6 card-body">
                                <div class="row">
                                    <div class="col-sm-4">
                                        <i class="icon feather icon-shopping-cart text-c-red mb-1 d-block"></i>
                                    </div>
                                    <div class="col-sm-8 text-md-center">
                                        <h5>{{ $no_bookings }}</h5>
                                        <span>No Of Bookings</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row-table">
                            <div class="col-sm-6 card-body br">
                                <div class="row">
                                    <div class="col-sm-4">
                                        <i class="icon feather icon-file-text text-c-blue mb-1 d-block"></i>
                                    </div>
                                    <div class="col-sm-8 text-md-center">
                                        <h5>{{ $no_rooms }}</h5>
                                        <span>No Of Properties</span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-6 card-body">
                                <div class="row">
                                    <div class="col-sm-4">
                                        <i class="icon feather icon-users text-c-yellow mb-1 d-block"></i>
                                    </div>
                                    <div class="col-sm-8 text-md-center">
                                        <h5>{{ $no_users }}</h5>
                                        <span>Users</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- widget primary card start -->
                    <div class="card flat-card widget-primary-card">
                        <div class="row-table">
                            <div class="col-sm-3 card-body">
                                <i class="feather icon-star-on"></i>
                            </div>
                            <div class="col-sm-9">
                                <h4>{{ $no_ratings }}</h4>
                                <h6>Ratings Received</h6>
                            </div>
                        </div>
                    </div>
                    <!-- widget primary card end -->
                </div>
                <!-- table card-1 end -->
                <!-- table card-2 start -->

                <!-- table card-2 end -->
                <!-- Widget primary-success card start -->
                <div class="col-md-12 col-sm-12 col-lg-6 col-xl-6">
                    <div class="card support-bar overflow-hidden">
                        <div class="card-body pb-0">
                            <h2 class="m-0">350</h2>
                            <span class="text-c-blue">Support Requests</span>
                            <p class="mb-3 mt-3">Total number of support requests that come in.</p>
                        </div>
                        <div id="support-chart"></div>
                        <div class="card-footer bg-primary text-white">
                            <div class="row text-center">
                                <div class="col">
                                    <h4 class="m-0 text-white">10</h4>
                                    <span>Open</span>
                                </div>
                                <div class="col">
                                    <h4 class="m-0 text-white">5</h4>
                                    <span>Running</span>
                                </div>
                                <div class="col">
                                    <h4 class="m-0 text-white">3</h4>
                                    <span>Solved</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Widget primary-success card end -->
            </div>


            <!-- prject ,team member start -->
            <div class="col-xl-12 col-md-12 col-sm-12 p-0">
                <div class="card table-card">
                    <div class="card-header">
                        <h5>Recent Bookings</h5>
                        <div class="card-header-right">
                            <div class="btn-group card-option">
                                <button type="button" class="btn dropdown-toggle" data-toggle="dropdown"
                                    aria-haspopup="true" aria-expanded="false">
                                    <i class="feather icon-more-horizontal"></i>
                                </button>
                                <ul class="list-unstyled card-option dropdown-menu dropdown-menu-right">
                                    <li class="dropdown-item full-card"><a href="#!"><span><i
                                                    class="feather icon-maximize"></i> maximize</span><span
                                                style="display:none"><i class="feather icon-minimize"></i>
                                                Restore</span></a></li>
                                    <li class="dropdown-item minimize-card"><a href="#!"><span><i
                                                    class="feather icon-minus"></i> collapse</span><span
                                                style="display:none"><i class="feather icon-plus"></i>
                                                expand</span></a></li>
                                    <li class="dropdown-item reload-card"><a href="#!"><i
                                                class="feather icon-refresh-cw"></i> reload</a></li>
                                    <li class="dropdown-item close-card"><a href="#!"><i
                                                class="feather icon-trash"></i>
                                            remove</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="card-body p-0">
                        <div class="table-responsive">
                            <table class="table table-hover mb-0">
                                <thead>
                                    <tr>
                                        <th>
                                            Client
                                        </th>
                                        <th>Name</th>
                                        <th>Room</th>
                                        <th>Price</th>
                                        <th>Start - Duration</th>
                                        <th class="text-right">Priority</th>
                                    </tr>
                                </thead>
                                <tbody>

                                    @foreach ($bookings as $booking)
                                        <tr>
                                            <td>{{ $booking->user->name }}</td>
                                            <td></td>
                                            <td>{{ $booking->room->name }}</td>
                                            <td>{{ number_format($booking->total()) }}</td>
                                            <td>{{ Carbon\Carbon::parse($booking->start_date)->toDateString() . ' - ' . $booking->nights() }}
                                            </td>

                                            <td class="text-right"><label class="badge badge-light-success">High</label>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-4 col-lg-4 col-xl-4 col-sm-12">
            <div class="col-xl-12 col-md-12">
                <div class="col">
                    <div class="card">
                        <div class="card-body">
                            <div class="row align-items-center">
                                <div class="col-6">
                                    <h3>$16,756</h3>
                                    <h6 class="text-muted m-b-0">Visits<i class="fa fa-caret-down text-c-red m-l-10"></i>
                                    </h6>
                                </div>
                                <div class="col-6">
                                    <div id="seo-chart1" class="d-flex align-items-end"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col">
                    <div class="card">
                        <div class="card-body">
                            <div class="row align-items-center">
                                <div class="col-6">
                                    <h3>49.54%</h3>
                                    <h6 class="text-muted m-b-0">Bounce Rate<i
                                            class="fa fa-caret-up text-c-green m-l-10"></i>
                                    </h6>
                                </div>
                                <div class="col-6">
                                    <div id="seo-chart2" class="d-flex align-items-end"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col">
                    <div class="card">
                        <div class="card-body">
                            <div class="row align-items-center">
                                <div class="col-6">
                                    <h3>1,62,564</h3>
                                    <h6 class="text-muted m-b-0">Products<i
                                            class="fa fa-caret-down text-c-red m-l-10"></i>
                                    </h6>
                                </div>
                                <div class="col-6">
                                    <div id="seo-chart3" class="d-flex align-items-end"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>



        <!-- prject ,team member start -->
        <!-- seo start -->

        <!-- seo end -->


    </div>
@endsection
