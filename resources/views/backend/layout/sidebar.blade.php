<!-- Sidebar start -->
<div class="quixnav">
    <div class="quixnav-scroll">
        <ul class="metismenu" id="menu">
            <li>
                <a href="{{ route('admin.home') }}" aria-expanded="false">
                    <i data-feather="home"></i>
                    <span class="nav-text">{{ __('Dashboard') }}</span>
                </a>
            </li>

            @if (auth()->guard('admin')->user()->can('manage-plan'))
                <li><a href="{{ route('admin.plan.index') }}" aria-expanded="false"><i data-feather="box"></i><span
                            class="nav-text">{{ __('Manage Plans') }}</span></a>
                </li>
            @endif

            @if (auth()->guard('admin')->user()->can('signal'))
                <li><a class="has-arrow" href="javascript:void()" aria-expanded="false"><i
                            data-feather="activity"></i><span class="nav-text">{{ __('Signal Tools') }}</span></a>
                    <ul aria-expanded="false">


                        <li><a href="{{ route('admin.markets.index') }}"
                                aria-expanded="false">{{ __('Markets Type') }}</a>
                        </li>

                        <li><a href="{{ route('admin.currency-pair.index') }}"
                                aria-expanded="false">{{ __('Currency Pair') }}</a>
                        </li>

                        <li><a href="{{ route('admin.frames.index') }}"
                                aria-expanded="false">{{ __('Time Frames') }}</a>
                        </li>

                        <li><a href="{{ route('admin.signals.index') }}" aria-expanded="false">{{ __('Signals') }}</a>
                        </li>
                    </ul>
                </li>
            @endif

            @if (auth()->guard('admin')->user()->can('manage-referral'))
                <li><a href="{{ route('admin.refferal.index') }}" aria-expanded="false"><i
                            data-feather="link"></i><span class="nav-text">{{ __('Manage Affiliates') }}</span></a>
                </li>
            @endif


            

            @if (auth()->guard('admin')->user()->can('payments'))
                <li><a class="has-arrow" href="javascript:void()" aria-expanded="false"><i data-feather="list"></i><span
                            class="nav-text">{{ __('Manage Payments') }}</span></a>
                    <ul aria-expanded="false">

                        <li><a href="{{ route('admin.payments.index', 'online') }}">{{ __('Online payments') }}</a>
                        </li>

                        <li><a href="{{ route('admin.payments.index', 'offline') }}">{{ __('Offline payments') }}</a>
                        </li>

                    </ul>
                </li>
            @endif

            @if (auth()->guard('admin')->user()->can('manage-deposit'))
                <li><a class="has-arrow" href="javascript:void()" aria-expanded="false"><i
                            data-feather="credit-card"></i><span class="nav-text">{{ __('Manage Deposit') }}</span></a>
                    <ul aria-expanded="false">

                        <li><a href="{{ route('admin.deposit', 'online') }}">{{ __('Online Deposit') }}</a></li>
                        <li><a href="{{ route('admin.deposit', 'offline') }}">{{ __('Offline Deposit') }}</a></li>
                    </ul>
                </li>
            @endif

            @if (auth()->guard('admin')->user()->can('manage-withdraw'))
                <li><a class="has-arrow" href="javascript:void()" aria-expanded="false"><i
                            data-feather="package"></i><span class="nav-text">{{ __('Manage Withdraw') }}</span></a>
                    <ul aria-expanded="false">
                        <li><a href="{{ route('admin.withdraw.index') }}">{{ __('Withdraw Methods') }}</a></li>
                        <li><a href="{{ route('admin.withdraw.filter') }}">{{ __('All Withdraw') }}</a></li>
                        <li><a href="{{ route('admin.withdraw.filter', 'pending') }}">{{ __('Pending Withdraw') }}
                                <span class="noti-count">{{Config::sidebarData()['pendingWithdraw'] }}</span></a></li>
                        <li><a
                                href="{{ route('admin.withdraw.filter', 'accepted') }}">{{ __('Accepted Withdraw') }}</a>
                        </li>
                        <li><a
                                href="{{ route('admin.withdraw.filter', 'rejected') }}">{{ __('Rejected Withdraw') }}</a>
                        </li>
                    </ul>
                </li>
            @endif

            @if (auth()->guard('admin')->user()->can('manage-user'))
                <li><a href="{{ route('admin.user.index') }}"><i data-feather="user"></i><span
                            class="nav-text">{{ __('Manage Users') }}</span></a>
                </li>
            @endif

            @if (auth()->guard('admin')->user()->can('manage-setting') ||
                    auth()->guard('admin')->user()->can('manage-email') ||
                    auth()->guard('admin')->user()->can('manage-theme') ||
                    auth()->guard('admin')->user()->can('manage-gateway'))
                <li class="nav-label">{{ __('Application Settings') }}</li>
            @endif


            @if (auth()->guard('admin')->user()->can('manage-gateway'))
                <li><a class="has-arrow" href="javascript:void()" aria-expanded="false"><i data-feather="tool"></i><span
                            class="nav-text">{{ __('Payment Gateways') }}</span></a>
                    <ul aria-expanded="false">

                        <li><a href="{{ route('admin.payment.index') }}">{{ __('Online Gateway') }}</a>
                        </li>
                        <li><a href="{{ route('admin.payment.offline') }}">{{ __('Offline Gateway') }}</a>
                        </li>

                    </ul>
                </li>
            @endif


            @if (auth()->guard('admin')->user()->can('manage-setting'))
                <li><a href="{{ route('admin.general.index') }}" aria-expanded="false"><i
                            data-feather="settings"></i><span class="nav-text">{{ __('Manage Settings') }}</span></a>
                </li>
            @endif

            @if (auth()->guard('admin')->user()->can('manage-email'))
                <li><a class="has-arrow" href="javascript:void()" aria-expanded="false"><i data-feather="mail"></i><span
                            class="nav-text">{{ __('Email Config') }}</span></a>
                    <ul aria-expanded="false">

                        <li><a href="{{ route('admin.email.config') }}">{{ __('Email Configure') }}</a></li>

                        <li><a href="{{ route('admin.email.templates') }}">{{ __('Email Templates') }}</a></li>
                    </ul>
                </li>
            @endif

            @if (auth()->guard('admin')->user()->can('manage-theme'))
                <li><a href="{{ route('admin.manage.theme') }}" aria-expanded="false"><i
                            data-feather="layers"></i><span class="nav-text">{{ __('Manage Theme') }}</span></a>
                </li>
            @endif


            @if (auth()->guard('admin')->user()->can('manage-frontend') ||
                    auth()->guard('admin')->user()->can('manage-language'))
                <li class="nav-label">{{ __('Theme Settings') }}</li>
            @endif

            @if (auth()->guard('admin')->user()->can('manage-frontend'))
                <li><a href="{{ route('admin.frontend.pages') }}" aria-expanded="false"><i
                            data-feather="book-open"></i><span class="nav-text">{{ __('Manage Pages') }}</span></a>
                </li>

                

                <li><a href="{{ route('admin.frontend.section.manage', 'banner') }}" aria-expanded="false"><i
                            data-feather="layout"></i><span class="nav-text">{{ __('Manage Frontend') }}</span></a>
                </li>
            @endif

            @if (auth()->guard('admin')->user()->can('manage-language'))
                <li><a href="{{ route('admin.language.index') }}" aria-expanded="false"><i
                            data-feather="globe"></i><span class="nav-text">{{ __('Manage Language') }}</span></a>
                </li>
            @endif

            @if (auth()->guard('admin')->user()->can('manage-role') ||
                    auth()->guard('admin')->user()->can('manage-admin'))
                <li class="nav-label">{{ __('Administration') }}</li>
            @endif

            @if (auth()->guard('admin')->user()->can('manage-role'))
                <li>
                    <a href="{{ route('admin.roles.index') }}" aria-expanded="false">
                        <i data-feather="users"></i>
                        <span class="nav-text">{{ __('Manage Roles') }}</span>
                    </a>
                </li>
            @endif

            @if (auth()->guard('admin')->user()->can('manage-admin'))
                <li>
                    <a href="{{ route('admin.admins.index') }}" aria-expanded="false">
                        <i data-feather="user-check"></i>
                        <span class="nav-text">{{ __('Manage Admins') }}</span>
                    </a>
                </li>
            @endif



            <li class="nav-label">{{ __('Others') }}</li>
            @if (auth()->guard('admin')->user()->can('manage-logs'))
                <li>
                    <a href="{{ route('admin.transaction') }}" aria-expanded="false">
                        <i data-feather="file-text"></i>
                        <span class="nav-text">{{ __('Manage Logs') }}</span>
                    </a>
                </li>
            @endif

            @if (auth()->guard('admin')->user()->can('manage-ticket'))
                <li><a class="has-arrow" href="javascript:void()" aria-expanded="false"><i
                            data-feather="inbox"></i><span class="nav-text">{{ __('Support Ticket') }}</span></a>
                    <ul aria-expanded="false">

                        <li><a href="{{ route('admin.ticket.index') }}">{{ __('All Tickets') }}</a></li>

                        <li><a href="{{ route('admin.ticket.status', 'pending') }}">{{ __('Pending Ticket') }}
                                @if (Config::sidebarData()['pendingTicket'] > 0)
                                    <span class="noti-count">{{ Config::sidebarData()['pendingTicket'] }}</span>
                                @endif
                            </a></li>

                        <li><a href="{{ route('admin.ticket.status', 'answered') }}">{{ __('Answered Ticket') }}</a>
                        </li>

                        <li><a href="{{ route('admin.ticket.status', 'closed') }}">{{ __('Closed Ticket') }}</a>
                        </li>


                    </ul>
                </li>
            @endif

            @if (auth()->guard('admin')->user()->can('manage-subscriber'))
                <li><a href="{{ route('admin.subscribers') }}" aria-expanded="false"><i
                            data-feather="at-sign"></i><span class="nav-text">{{ __('Subscribers') }}</span></a>
                </li>
            @endif

            <li><a href="{{ route('admin.notifications') }}" aria-expanded="false"><i
                        data-feather="feather"></i><span class="nav-text">{{ __('All Notification') }}</span></a>
            </li>

            <li><a href="{{ route('admin.general.cacheclear') }}" aria-expanded="false"><i
                        data-feather="feather"></i><span class="nav-text">{{ __('Clear Cache') }}</span></a>
            </li>

            <li class="nav-label">{{__('Current Version') .' - '. Config::APP_VERSION }}</li>
        </ul>
    </div>
</div>
<!-- Sidebar end -->
