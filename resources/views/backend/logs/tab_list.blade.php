<ul class="page-link-list">
    <li>
        <a href="{{ route('admin.transaction') }}" class="{{ Config::activeMenu(route('admin.transaction')) }}">
            <i class="las la-user"></i>
            {{ __('Transction Log') }}
        </a>
    </li>
    <li>
        <a href="{{ route('admin.trade') }}" class="{{ Config::activeMenu(route('admin.trade')) }}">
            <i class="las la-user"></i>
            {{ __('Trade Log') }}
        </a>
    </li>
    
    <li>
        <a href="{{ route('admin.commision') }}"
            class="{{ Config::activeMenu(route('admin.commision')) }}">
            <i class="las la-user-check"></i>
            {{ __('Refferal Commission') }}
        </a>
    </li>
    <li>
        <a href="{{ route('admin.deposit.log') }}"
            class="{{ Config::activeMenu(route('admin.deposit.log')) }}">
            <i class="las la-user-slash"></i>
            {{ __('Deposit report') }}
           
        </a>
    </li>
    <li>
        <a href="{{ route('admin.payment.report') }}"
            class="{{ Config::activeMenu(route('admin.payment.report')) }}">
            <i class="las la-envelope"></i>
            {{ __('Payment report') }}
           
        </a>
    </li>
    <li>
        <a href="{{ route('admin.withdraw.report') }}"
            class="{{ Config::activeMenu(route('admin.withdraw.report')) }}">
            <i class="las la-comments"></i>
            {{ __('Withdraw Report') }}
            
        </a>
    </li>
    <li>
        <a href="{{ route('admin.transfer.report') }}" class="{{ Config::activeMenu(route('admin.transfer.report')) }}">
            <i class="las la-user-shield"></i>
            {{ __('Money Transfer Report') }}
            
        </a>
    </li>
   
</ul>
