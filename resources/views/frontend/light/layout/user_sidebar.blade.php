<aside class="user-sidebar">
    <a href="{{ route('user.dashboard') }}" class="site-logo">
        <img src="{{ Config::getFile('dark_logo', Config::config()->dark_logo, true) }}" alt="image">
    </a>

    <div class="user-sidebar-bottom">
        <div id="countdown"></div>
    </div>

    <ul class="sidebar-menu">
        <li class="{{ Config::singleMenu('user.dashboard') }}"><a href="{{ route('user.dashboard') }}" class="active"><i
                    class="fas fa-home"></i>
                {{ __('Dashboard') }}</a></li>

        <li class="{{ Config::singleMenu('user.deposit') }}"><a href="{{ route('user.deposit') }}"><i
                    class="fas fa-credit-card"></i>{{ __('Deposit') }}</a></li>
        
        <li class="{{ Config::singleMenu('user.withdraw') }}"><a href="{{ route('user.withdraw') }}"><i
                    class="fas fa-hand-holding-usd"></i> {{ __('Withdraw') }}</a></li>
        
        
        <li class="{{ Config::singleMenu('user.history') }}"><a href="{{ route('user.history') }}"><i
                    class="fas fa-history"></i> {{ __('Transactions History') }}</a></li>









        <li class="{{ Config::singleMenu('user.signal.all') }}"><a href="{{ route('user.signal.all') }}"><i
                    class="fas fa-chart-bar"></i> {{ __('All Signal') }}</a></li>

        <li><a href="{{ route('user.trade') }}" class="{{ Config::singleMenu('user.trade') }}"><i
                    class="fas fa-chart-line"></i></i>
                {{ __('Trade') }}</a></li>

        <li class="{{ Config::singleMenu('user.plans') }}"><a href="{{ route('user.plans') }}"><i
                    class="fas fa-clipboard-list"></i>{{ __('Plans') }}</a></li>

       

        

        <li class="{{ Config::singleMenu('user.transfer_money') }}"><a href="{{ route('user.transfer_money') }}"><i
                    class="fas fa-exchange-alt"></i> {{ __('Transfer Money') }}</a></li>


        <li
            class="has_submenu {{ in_array(url()->current(), [route('user.deposit.log'), route('user.withdraw.all'), route('user.invest.log'), route('user.transaction.log'), route('user.transfer_money.log'), route('user.receive_money.log'), route('user.commision'), route('user.subscription')]) ? 'open' : '' }}">
            <a href="#0"><i class="fas fa-chart-bar"></i> {{ __('Report') }}</a>
            <ul class="submenu">
                <li class="{{ Config::singleMenu('user.deposit.log') }}">
                    <a href="{{ route('user.deposit.log') }}">{{ __('Deposit Log') }}</a>
                </li>

                <li class="{{ Config::singleMenu('user.withdraw.all') }}">
                    <a href="{{ route('user.withdraw.all') }}">{{ __('Withdraw Log') }}</a>
                </li>

                <li class="{{ Config::singleMenu('user.invest.log') }}">
                    <a href="{{ route('user.invest.log') }}">{{ __('Investment Log') }}</a>
                </li>

                <li class="{{ Config::singleMenu('user.transaction.log') }}">
                    <a href="{{ route('user.transaction.log') }}">{{ __('Transaction Log') }}</a>
                </li>

                <li class="{{ Config::singleMenu('user.transfer_money.log') }}">
                    <a href="{{ route('user.transfer_money.log') }}">{{ __('Transfer Money Log') }}</a>
                </li>

                <li class="{{ Config::singleMenu('user.receive_money.log') }}">
                    <a href="{{ route('user.receive_money.log') }}">{{ __('Receive Money Log') }}</a>
                </li>

                <li class="{{ Config::singleMenu('user.commision') }}">
                    <a href="{{ route('user.commision') }}">{{ __('commision Log') }}</a>
                </li>

                <li class="{{ Config::singleMenu('user.subscription') }}">
                    <a href="{{ route('user.subscription') }}">{{ __('Subscription Log') }}</a>
                </li>
            </ul>
        </li>

        <li class="{{ Config::singleMenu('user.refferalLog') }}"><a href="{{ route('user.refferalLog') }}"><i
                    class="fas fa-user-cog"></i> {{ __('Refferal Log') }}</a></li>

        <li class="{{ Config::singleMenu('user.ticket.index') }}"><a href="{{ route('user.ticket.index') }}"><i
                    class="fas fa-ticket-alt"></i> {{ __('Support Ticket') }}</a></li>

        <li class="{{ Config::singleMenu('user.user-payment-method.index') }}"><a href="{{ route('user.user-payment-method.index') }}"><i
                        class="fas fa-exchange-alt"></i> {{ __('Payment Methods') }}</a></li>

        <li class="{{ Config::singleMenu('user.profile') }}"><a href="{{ route('user.profile') }}"><i
                        class="fas fa-user-cog"></i> {{ __('Profile Settings') }}</a></li>

        <li class="{{ Config::singleMenu('user.logout') }}"><a href="{{ route('user.logout') }}"><i
                    class="fas fa-sign-out-alt"></i> {{ __('Logout') }}</a></li>
    </ul>
</aside>

<!-- mobile bottom menu start -->
<div class="mobile-bottom-menu-wrapper">
    <ul class="mobile-bottom-menu">

        <li>
            <a href="{{ route('user.deposit') }}" class="{{ Config::activeMenu(route('user.deposit')) }}">
                <i class="fas fa-wallet"></i>
                <span>{{ __('Deposit') }}</span>
            </a>
        </li>

        <li>
            <a href="{{ route('user.history') }}"
                class="{{ Config::activeMenu(route('user.history')) }}">
                <i class="fas fa-history"></i>
                <span>{{ __('History') }}</span>
            </a>
        </li>
        
        <li>
            <a href="{{ route('user.dashboard') }}" class="{{ Config::activeMenu(route('user.dashboard')) }}">
                <i class="fas fa-home"></i>
                <span>Home</span>
            </a>
        </li>

        <li>
            <a href="{{ route('user.withdraw') }}" class="{{ Config::activeMenu(route('user.withdraw')) }}">
                <i class="fas fa-hand-holding-usd"></i>
                <span>{{ __('Withdraw') }}</span>
            </a>
        </li>

        <li class="sidebar-open-btn">
            <a href="#0" class="">
                <i class="fas fa-bars"></i>
                <span>{{ __('Menu') }}</span>
            </a>
        </li>
    </ul>
</div>

