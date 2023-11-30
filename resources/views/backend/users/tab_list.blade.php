<ul class="page-link-list">
  <li>
    <a href="{{ route('admin.user.index') }}" class="{{ Config::activeMenu(route('admin.user.index')) }}">
      <i class="las la-user"></i> 
      {{ __('All Users') }}
    </a>
  </li>
  <li>
    <a href="{{ route('admin.user.filter', 'active') }}" class="{{ Config::activeMenu(route('admin.user.filter', 'active')) }}">
      <i class="las la-user-check"></i> 
      {{ __('Active Users') }}
    </a>
  </li>
  <li>
    <a href="{{ route('admin.user.filter', 'deactive') }}" class="{{ Config::activeMenu(route('admin.user.filter', 'deactive')) }}">
      <i class="las la-user-slash"></i> 
      {{ __('Deactive Users') }}
      @if (Config::sidebarData()['deactiveUser'])
          <span class="noti-count">{{ Config::sidebarData()['deactiveUser'] }}</span>
      @endif
    </a>
  </li>
  <li>
    <a href="{{ route('admin.user.filter', 'email-unverified') }}" class="{{ Config::activeMenu(route('admin.user.filter', 'email-unverified')) }}">
      <i class="las la-envelope"></i> 
      {{ __('Email Unverified') }}
      @if (Config::sidebarData()['emailUnverified'])
          <span class="noti-count">{{ Config::sidebarData()['emailUnverified'] }}</span>
      @endif
    </a>
  </li>
  <li>
    <a href="{{ route('admin.user.filter', 'sms-unverified') }}" class="{{ Config::activeMenu(route('admin.user.filter', 'sms-unverified')) }}">
      <i class="las la-comments"></i> 
      {{ __('Sms Unverified') }}
      @if (Config::sidebarData()['smsUnverified'])
          <span class="noti-count">{{ Config::sidebarData()['smsUnverified'] }}</span>
      @endif
    </a>
  </li>
  <li>
    <a href="{{ route('admin.user.kyc.req') }}" class="{{ Config::activeMenu(route('admin.user.kyc.req')) }}">
      <i class="las la-user-shield"></i> 
      {{ __('KYC Verify') }}
      @if (Config::sidebarData()['kyc_req'])
          <span class="noti-count">{{ Config::sidebarData()['kyc_req'] }}</span>
      @endif
    </a>
  </li>
  <li>
    <a href="{{ route('admin.user.filter', 'kyc-unverified') }}" class="{{ Config::activeMenu(route('admin.user.filter', 'kyc-unverified')) }}">
      <i class="las la-user-times"></i> 
      {{ __('KYC Unverified') }}
      @if (Config::sidebarData()['kycUnverified'])
          <span class="noti-count">{{ Config::sidebarData()['kycUnverified'] }}</span>
      @endif
    </a>
  </li>
</ul>