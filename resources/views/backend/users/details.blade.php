@extends('backend.layout.master')

@section('element')
    {{-- <div class="row">
        <div class="col-md-12">
            <div class="card mb-4">
                <div class="card-body">
                    <ul class="page-link-list">
                        <li>
                            <a href="{{ route('admin.user.index') }}"
                                class="{{ Config::activeMenu(route('admin.user.index')) }}">
                                <i class="las la-user"></i>
                                {{ __('Live Account') }}
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('admin.user.filter', 'active') }}"
                                class="{{ Config::activeMenu(route('admin.user.filter', 'active')) }}">
                                <i class="las la-user-check"></i>
                                {{ __('Personal Details') }}
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('admin.user.filter', 'deactive') }}"
                                class="{{ Config::activeMenu(route('admin.user.filter', 'deactive')) }}">
                                <i class="las la-money-check"></i>
                                {{ __('Bank details') }}

                            </a>
                        </li>
                        <li>
                            <a href="{{ route('admin.user.filter', 'email-unverified') }}"
                                class="{{ Config::activeMenu(route('admin.user.filter', 'email-unverified')) }}">
                                <i class="las la-file-alt"></i>
                                {{ __('Document') }}

                            </a>
                        </li>

                        <li>
                            <a href="{{ route('admin.user.kyc.req') }}"
                                class="{{ Config::activeMenu(route('admin.user.kyc.req')) }}">
                                <i class="las la-credit-card"></i>
                                {{ __('Deposit') }}

                            </a>
                        </li>
                        <li>
                            <a href="{{ route('admin.user.filter', 'kyc-unverified') }}"
                                class="{{ Config::activeMenu(route('admin.user.filter', 'kyc-unverified')) }}">
                                <i class="las  la-credit-card"></i>
                                {{ __('Withdraw') }}

                            </a>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="card">

            </div>
        </div>
    </div> --}}
    <!-- Tabs navs -->
    <ul class="nav nav-tabs mb-3" id="ex-with-icons" role="tablist">
        <li class="nav-item" role="presentation">
            <a data-mdb-tab-init class="nav-link active" id="ex-with-icons-tab-1" href="#ex-with-icons-tabs-1" role="tab"
                aria-controls="ex-with-icons-tabs-1" aria-selected="true"><i
                    class="fas fa-chart-pie fa-fw me-2"></i>Sales</a>
        </li>
        <li class="nav-item" role="presentation">
            <a data-mdb-tab-init class="nav-link" id="ex-with-icons-tab-2" href="#ex-with-icons-tabs-2" role="tab"
                aria-controls="ex-with-icons-tabs-2" aria-selected="false"><i
                    class="fas fa-chart-line fa-fw me-2"></i>Subscriptions</a>
        </li>
        <li class="nav-item" role="presentation">
            <a data-mdb-tab-init class="nav-link" id="ex-with-icons-tab-3" href="#ex-with-icons-tabs-3" role="tab"
                aria-controls="ex-with-icons-tabs-3" aria-selected="false"><i
                    class="fas fa-cogs fa-fw me-2"></i>Settings</a>
        </li>
    </ul>
    <!-- Tabs navs -->

    <!-- Tabs content -->
    <div class="tab-content" id="ex-with-icons-content">
        <div class="tab-pane fade show active" id="ex-with-icons-tabs-1" role="tabpanel"
            aria-labelledby="ex-with-icons-tab-1">
            Tab 1 content
        </div>
        <div class="tab-pane fade" id="ex-with-icons-tabs-2" role="tabpanel" aria-labelledby="ex-with-icons-tab-2">
            Tab 2 content
        </div>
        <div class="tab-pane fade" id="ex-with-icons-tabs-3" role="tabpanel" aria-labelledby="ex-with-icons-tab-3">
            Tab 3 content
        </div>
    </div>
    <!-- Tabs content -->
@endsection
<script>
    // Initialization for ES Users
    import {
        Tab,
        initMDB
    } from "mdb-ui-kit";

    initMDB({
        Tab
    });
</script>
