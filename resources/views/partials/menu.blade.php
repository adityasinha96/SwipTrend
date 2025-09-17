<div id="sidebar" class="c-sidebar c-sidebar-fixed c-sidebar-lg-show">

    <div class="c-sidebar-brand d-md-down-none">
        <a class="c-sidebar-brand-full h4" href="#">
            {{ trans('panel.site_title') }}
        </a>
    </div>

    <ul class="c-sidebar-nav">
        <li class="c-sidebar-nav-item">
            <a href="{{ route("admin.home") }}" class="c-sidebar-nav-link">
                <i class="c-sidebar-nav-icon fas fa-fw fa-tachometer-alt">

                </i>
                {{ trans('global.dashboard') }}
            </a>
        </li>
        @can('user_management_access')
            <li class="c-sidebar-nav-dropdown {{ request()->is("admin/permissions*") ? "c-show" : "" }} {{ request()->is("admin/roles*") ? "c-show" : "" }} {{ request()->is("admin/users*") ? "c-show" : "" }} {{ request()->is("admin/audit-logs*") ? "c-show" : "" }}">
                <a class="c-sidebar-nav-dropdown-toggle" href="#">
                    <i class="fa-fw fas fa-users c-sidebar-nav-icon">

                    </i>
                    {{ trans('cruds.userManagement.title') }}
                </a>
                <ul class="c-sidebar-nav-dropdown-items">
                    @can('permission_access')
                        <li class="c-sidebar-nav-item">
                            <a href="{{ route("admin.permissions.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/permissions") || request()->is("admin/permissions/*") ? "c-active" : "" }}">
                                <i class="fa-fw fas fa-unlock-alt c-sidebar-nav-icon">

                                </i>
                                {{ trans('cruds.permission.title') }}
                            </a>
                        </li>
                    @endcan
                    @can('role_access')
                        <li class="c-sidebar-nav-item">
                            <a href="{{ route("admin.roles.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/roles") || request()->is("admin/roles/*") ? "c-active" : "" }}">
                                <i class="fa-fw fas fa-briefcase c-sidebar-nav-icon">

                                </i>
                                {{ trans('cruds.role.title') }}
                            </a>
                        </li>
                    @endcan
                    @can('user_access')
                        <li class="c-sidebar-nav-item">
                            <a href="{{ route("admin.users.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/users") || request()->is("admin/users/*") ? "c-active" : "" }}">
                                <i class="fa-fw fas fa-user c-sidebar-nav-icon">

                                </i>
                                {{ trans('cruds.user.title') }}
                            </a>
                        </li>
                    @endcan
                    @can('audit_log_access')
                        <li class="c-sidebar-nav-item">
                            <a href="{{ route("admin.audit-logs.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/audit-logs") || request()->is("admin/audit-logs/*") ? "c-active" : "" }}">
                                <i class="fa-fw fas fa-file-alt c-sidebar-nav-icon">

                                </i>
                                {{ trans('cruds.auditLog.title') }}
                            </a>
                        </li>
                    @endcan
                </ul>
            </li>
        @endcan
        @can('contact_us_message_access')
            <li class="c-sidebar-nav-item">
                <a href="{{ route("admin.contact-us-messages.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/contact-us-messages") || request()->is("admin/contact-us-messages/*") ? "c-active" : "" }}">
                    <i class="fa-fw far fa-comments c-sidebar-nav-icon">

                    </i>
                    {{ trans('cruds.contactUsMessage.title') }}
                </a>
            </li>
        @endcan
        @can('quick_service_request_access')
            <li class="c-sidebar-nav-item">
                <a href="{{ route("admin.quick-service-requests.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/quick-service-requests") || request()->is("admin/quick-service-requests/*") ? "c-active" : "" }}">
                    <i class="fa-fw fab fa-servicestack c-sidebar-nav-icon">

                    </i>
                    {{ trans('cruds.quickServiceRequest.title') }}
                </a>
            </li>
        @endcan
        @can('highlight_access')
            <li class="c-sidebar-nav-item">
                <a href="{{ route("admin.highlights.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/highlights") || request()->is("admin/highlights/*") ? "c-active" : "" }}">
                    <i class="fa-fw fas fa-helicopter c-sidebar-nav-icon">

                    </i>
                    {{ trans('cruds.highlight.title') }}
                </a>
            </li>
        @endcan
        @can('core_service_access')
            <li class="c-sidebar-nav-item">
                <a href="{{ route("admin.core-services.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/core-services") || request()->is("admin/core-services/*") ? "c-active" : "" }}">
                    <i class="fa-fw fas fa-taxi c-sidebar-nav-icon">

                    </i>
                    {{ trans('cruds.coreService.title') }}
                </a>
            </li>
        @endcan
        @can('catalogue_access')
            <li class="c-sidebar-nav-dropdown {{ request()->is("admin/catalogue-categories*") ? "c-show" : "" }} {{ request()->is("admin/catalogu-datas*") ? "c-show" : "" }}">
                <a class="c-sidebar-nav-dropdown-toggle" href="#">
                    <i class="fa-fw fas fa-atlas c-sidebar-nav-icon">

                    </i>
                    {{ trans('cruds.catalogue.title') }}
                </a>
                <ul class="c-sidebar-nav-dropdown-items">
                    @can('catalogue_category_access')
                        <li class="c-sidebar-nav-item">
                            <a href="{{ route("admin.catalogue-categories.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/catalogue-categories") || request()->is("admin/catalogue-categories/*") ? "c-active" : "" }}">
                                <i class="fa-fw fas fa-angle-double-right c-sidebar-nav-icon">

                                </i>
                                {{ trans('cruds.catalogueCategory.title') }}
                            </a>
                        </li>
                    @endcan
                    @can('catalogu_data_access')
                        <li class="c-sidebar-nav-item">
                            <a href="{{ route("admin.catalogu-datas.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/catalogu-datas") || request()->is("admin/catalogu-datas/*") ? "c-active" : "" }}">
                                <i class="fa-fw fas fa-angle-double-right c-sidebar-nav-icon">

                                </i>
                                {{ trans('cruds.cataloguData.title') }}
                            </a>
                        </li>
                    @endcan
                </ul>
            </li>
        @endcan
        @can('legal_access')
            <li class="c-sidebar-nav-dropdown {{ request()->is("admin/privacy-policies*") ? "c-show" : "" }} {{ request()->is("admin/terms-conditions*") ? "c-show" : "" }}">
                <a class="c-sidebar-nav-dropdown-toggle" href="#">
                    <i class="fa-fw fas fa-balance-scale c-sidebar-nav-icon">

                    </i>
                    {{ trans('cruds.legal.title') }}
                </a>
                <ul class="c-sidebar-nav-dropdown-items">
                    @can('privacy_policy_access')
                        <li class="c-sidebar-nav-item">
                            <a href="{{ route("admin.privacy-policies.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/privacy-policies") || request()->is("admin/privacy-policies/*") ? "c-active" : "" }}">
                                <i class="fa-fw fas fa-angle-double-right c-sidebar-nav-icon">

                                </i>
                                {{ trans('cruds.privacyPolicy.title') }}
                            </a>
                        </li>
                    @endcan
                    @can('terms_condition_access')
                        <li class="c-sidebar-nav-item">
                            <a href="{{ route("admin.terms-conditions.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/terms-conditions") || request()->is("admin/terms-conditions/*") ? "c-active" : "" }}">
                                <i class="fa-fw fas fa-angle-double-right c-sidebar-nav-icon">

                                </i>
                                {{ trans('cruds.termsCondition.title') }}
                            </a>
                        </li>
                    @endcan
                </ul>
            </li>
        @endcan
        @can('setting_access')
            <li class="c-sidebar-nav-dropdown {{ request()->is("admin/locations*") ? "c-show" : "" }} {{ request()->is("admin/company-details*") ? "c-show" : "" }}">
                <a class="c-sidebar-nav-dropdown-toggle" href="#">
                    <i class="fa-fw fas fa-cogs c-sidebar-nav-icon">

                    </i>
                    {{ trans('cruds.setting.title') }}
                </a>
                <ul class="c-sidebar-nav-dropdown-items">
                    @can('location_access')
                        <li class="c-sidebar-nav-item">
                            <a href="{{ route("admin.locations.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/locations") || request()->is("admin/locations/*") ? "c-active" : "" }}">
                                <i class="fa-fw fas fa-angle-double-right c-sidebar-nav-icon">

                                </i>
                                {{ trans('cruds.location.title') }}
                            </a>
                        </li>
                    @endcan
                    @can('company_detail_access')
                        <li class="c-sidebar-nav-item">
                            <a href="{{ route("admin.company-details.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/company-details") || request()->is("admin/company-details/*") ? "c-active" : "" }}">
                                <i class="fa-fw fas fa-angle-double-right c-sidebar-nav-icon">

                                </i>
                                {{ trans('cruds.companyDetail.title') }}
                            </a>
                        </li>
                    @endcan
                </ul>
            </li>
        @endcan
        @if(file_exists(app_path('Http/Controllers/Auth/ChangePasswordController.php')))
            @can('profile_password_edit')
                <li class="c-sidebar-nav-item">
                    <a class="c-sidebar-nav-link {{ request()->is('profile/password') || request()->is('profile/password/*') ? 'c-active' : '' }}" href="{{ route('profile.password.edit') }}">
                        <i class="fa-fw fas fa-key c-sidebar-nav-icon">
                        </i>
                        {{ trans('global.change_password') }}
                    </a>
                </li>
            @endcan
        @endif
        <li class="c-sidebar-nav-item">
            <a href="#" class="c-sidebar-nav-link" onclick="event.preventDefault(); document.getElementById('logoutform').submit();">
                <i class="c-sidebar-nav-icon fas fa-fw fa-sign-out-alt">

                </i>
                {{ trans('global.logout') }}
            </a>
        </li>
    </ul>

</div>