<div id="sidebar" class="c-sidebar c-sidebar-fixed c-sidebar-lg-show">

    <div class="c-sidebar-brand d-md-down-none">
        <a class="c-sidebar-brand-full h4" href="#">
            {{ trans('panel.site_title') }}
        </a>
    </div>

    <ul class="c-sidebar-nav">
        <li>
            <select class="searchable-field form-control">

            </select>
        </li>
        <li class="c-sidebar-nav-item">
            <a href="{{ route("admin.home") }}" class="c-sidebar-nav-link">
                <i class="c-sidebar-nav-icon fas fa-fw fa-tachometer-alt">

                </i>
                {{ trans('global.dashboard') }}
            </a>
        </li>
        @can('user_management_access')
            <li class="c-sidebar-nav-dropdown {{ request()->is("admin/permissions*") ? "c-show" : "" }} {{ request()->is("admin/roles*") ? "c-show" : "" }} {{ request()->is("admin/users*") ? "c-show" : "" }} {{ request()->is("admin/audit-logs*") ? "c-show" : "" }} {{ request()->is("admin/locals*") ? "c-show" : "" }}">
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
                    @can('local_access')
                        <li class="c-sidebar-nav-item">
                            <a href="{{ route("admin.locals.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/locals") || request()->is("admin/locals/*") ? "c-active" : "" }}">
                                <i class="fa-fw fas fa-home c-sidebar-nav-icon">

                                </i>
                                {{ trans('cruds.local.title') }}
                            </a>
                        </li>
                    @endcan
                </ul>
            </li>
        @endcan
        @can('secretary_access')
            <li class="c-sidebar-nav-dropdown {{ request()->is("admin/information-reports*") ? "c-show" : "" }} {{ request()->is("admin/memo-reports*") ? "c-show" : "" }}">
                <a class="c-sidebar-nav-dropdown-toggle" href="#">
                    <i class="fa-fw fas fa-user-alt c-sidebar-nav-icon">

                    </i>
                    {{ trans('cruds.secretary.title') }}
                </a>
                <ul class="c-sidebar-nav-dropdown-items">
                    @can('information_report_access')
                        <li class="c-sidebar-nav-item">
                            <a href="{{ route("admin.information-reports.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/information-reports") || request()->is("admin/information-reports/*") ? "c-active" : "" }}">
                                <i class="fa-fw fas fa-address-book c-sidebar-nav-icon">

                                </i>
                                {{ trans('cruds.informationReport.title') }}
                            </a>
                        </li>
                    @endcan
                    @can('memo_report_access')
                        <li class="c-sidebar-nav-item">
                            <a href="{{ route("admin.memo-reports.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/memo-reports") || request()->is("admin/memo-reports/*") ? "c-active" : "" }}">
                                <i class="fa-fw fas fa-address-book c-sidebar-nav-icon">

                                </i>
                                {{ trans('cruds.memoReport.title') }}
                            </a>
                        </li>
                    @endcan
                </ul>
            </li>
        @endcan
        @can('treasurer_access')
            <li class="c-sidebar-nav-dropdown {{ request()->is("admin/invoices*") ? "c-show" : "" }} {{ request()->is("admin/reports*") ? "c-show" : "" }}">
                <a class="c-sidebar-nav-dropdown-toggle" href="#">
                    <i class="fa-fw fas fa-user-alt c-sidebar-nav-icon">

                    </i>
                    {{ trans('cruds.treasurer.title') }}
                </a>
                <ul class="c-sidebar-nav-dropdown-items">
                    @can('invoice_access')
                        <li class="c-sidebar-nav-item">
                            <a href="{{ route("admin.invoices.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/invoices") || request()->is("admin/invoices/*") ? "c-active" : "" }}">
                                <i class="fa-fw fas fa-calculator c-sidebar-nav-icon">

                                </i>
                                Bill Management
                            </a>
                        </li>
                        <li class="c-sidebar-nav-item">
                            <a href="{{ route("price") }}" class="c-sidebar-nav-link {{ request()->is("admin/invoices") || request()->is("admin/invoices/*") ? "c-active" : "" }}">
                                <i class="fa-fw fas fa-calculator c-sidebar-nav-icon">
                                </i>
                                Bill Price
                            </a>
                        </li>
                    @endcan
                    @can('report_access')
                        <li class="c-sidebar-nav-item">
                            <a href="{{ route("admin.reports.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/reports") || request()->is("admin/reports/*") ? "c-active" : "" }}">
                                <i class="fa-fw fas fa-book-open c-sidebar-nav-icon">

                                </i>
                                {{ trans('cruds.report.title') }}
                            </a>
                        </li>
                    @endcan
                </ul>
            </li>
        @endcan
        @can('auditor_access')
            <li class="c-sidebar-nav-dropdown {{ request()->is("admin/audits*") ? "c-show" : "" }}">
                <a class="c-sidebar-nav-dropdown-toggle" href="#">
                    <i class="fa-fw fas fa-user c-sidebar-nav-icon">

                    </i>
                    {{ trans('cruds.auditor.title') }}
                </a>
                <ul class="c-sidebar-nav-dropdown-items">
                    @can('audit_access')
                        <li class="c-sidebar-nav-item">
                            <a href="{{ route("admin.audits.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/audits") || request()->is("admin/audits/*") ? "c-active" : "" }}">
                                <i class="fa-fw fas fa-calculator c-sidebar-nav-icon">

                                </i>
                                {{ trans('cruds.audit.title') }}
                            </a>
                        </li>
                    @endcan
                </ul>
            </li>
        @endcan
        @can('bookkeeper_access')
            <li class="c-sidebar-nav-dropdown {{ request()->is("admin/list-of-names*") ? "c-show" : "" }}">
                <a class="c-sidebar-nav-dropdown-toggle" href="#">
                    <i class="fa-fw fas fa-user c-sidebar-nav-icon">

                    </i>
                    {{ trans('cruds.bookkeeper.title') }}
                </a>
                <ul class="c-sidebar-nav-dropdown-items">
                    @can('list_of_name_access')
                        <li class="c-sidebar-nav-item">
                            <a href="{{ route("admin.list-of-names.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/list-of-names") || request()->is("admin/list-of-names/*") ? "c-active" : "" }}">
                                <i class="fa-fw fas fa-address-book c-sidebar-nav-icon">

                                </i>
                                Client
                            </a>
                        </li>
                    @endcan
                </ul>
            </li>
        @endcan
        @can('message_access')
            <li class="c-sidebar-nav-item">
                <a href="{{ route("admin.messages.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/messages") || request()->is("admin/messages/*") ? "c-active" : "" }}">
                    <i class="fa-fw fas fa-envelope c-sidebar-nav-icon">

                    </i>
                    {{ trans('cruds.message.title') }}
                </a>
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