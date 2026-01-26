@extends('admin.layouts.app')

@section('content')
    <!-- BEGIN: Content-->
    <!-- BEGIN: Content-->
    <div class="app-content content ">
        <div class="content-overlay"></div>
        <div class="header-navbar-shadow"></div>
        <div class="content-wrapper container-xxl p-0">

            <div class="content-body">

                <!-- Ajax Sourced Server-side -->
                <section id="ajax-datatable">
                    <!-- Responsive tables start -->
                    <div class="row">
                        <div class="col-12">


                            <div class="card">
                                <div class="card-body">
                                    <table class="table">
                                        <tr>
                                            <th>Coupon Code</th>
                                            <td>{{ $coupon->code ?? '' }}</td>
                                        </tr>
                                        <tr>
                                            <th>Expire Date</th>
                                            <td>{{ $coupon->expire_date ?? '' }}</td>
                                        </tr>
                                        <tr>
                                            <th>Discount Amount</th>
                                            <td>{{ $coupon->amount ?? '' }}</td>
                                        </tr>
                                        <tr>
                                            <th>Admin User</th>
                                            <td>{{ $coupon->admin->name ?? '' }}</td>
                                        </tr>
                                        <tr>
                                            <th>Use Count</th>
                                            <td>{{ $coupon->use_count ?? '' }}</td>
                                        </tr>
                                        <tr>
                                            <th>Total Use Discount</th>
                                            <td>{{ $coupon->total_use_discount ?? '' }}</td>
                                        </tr>
                                    </table>
                                </div>
                            </div>

                            <div class="card card-company-table">

                                <div class="table-responsive" id="table-responsive">
                                    <table class="table mb-0">
                                        <thead class="table-dark">
                                            <tr>
                                                <th scope="col">#</th>
                                                <th scope="col">Code</th>

                                                <th>Plan Amount</th>
                                                <th>Add On Amount</th>
                                                <th>Discount Amount</th>
                                                <th>Gst Amount</th>
                                                <th>Final Amount</th>
                                                <th>Paid Amount</th>
                                                <th>Due Amount</th>
                                                <th>Created at</th>

                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php $i = 1; ?>
                                            @foreach ($subscriptions as $item)
                                                <tr>
                                                    <td>{{ $i }}</td>
                                                    <td>
                                                        <div class="d-flex align-items-center">
                                                            <div class="avatar rounded">
                                                                <div class="avatar-content">
                                                                    <img src="{{ $item->user->image }}" width="50"
                                                                        height="50" alt="Toolbar svg" />
                                                                </div>
                                                            </div>
                                                            <div>
                                                                <div class="fw-bolder"><a
                                                                        href="{{ route('admin.vendors.show', $item->user->id) }}">{{ $item->user->name }}
                                                                    </a></div>
                                                                <div class="font-small-2 text-muted">{{ $item->user->email }}
                                                                </div>
                                                                <div class="font-small-2 text-muted">{{ $item->user->mobile }}
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </td>
                                                    <td>{{ $item->amount ?? '' }}</td>
                                                    <td>{{ $item->add_on_amount }}</td>
                                                    <td>{{ $item->discount_amount }}</td>
                                                    <td>{{ $item->gst_amount }}</td>
                                                    <td>{{ $item->total_amount }}</td>
                                                    <td>{{ $item->paid_amount }}</td>
                                                    <td>{{ $item->due_amount }}</td>
                                                    <td>{{ date('d-m-Y h:i a', strtotime($item->created_at)) }}</td>
                                                </tr>
                                                @php
                                                    $i++;
                                                @endphp
                                            @endforeach

                                        </tbody>
                                    </table>
                                </div>

                            </div>
                        </div>
                    </div>
                    <!-- Responsive tables end -->
                </section>

                <!--/ Ajax Sourced Server-side -->



            </div>
        </div>
    </div>
    <!-- END: Content-->
@endsection
