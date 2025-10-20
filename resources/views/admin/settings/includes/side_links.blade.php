<div class="card">
    <div class="card-body">
        <div class="panel panel-info">
            <div class="list-group">
                <a href="{{ route('admin.settings.index', 'general') }}" class="list-group-item {{ request()->is('admin/settings/general') ? 'active' : '' }}">
                    General
                </a>
                <a href="{{ route('admin.settings.index', 'smtp') }}" class="list-group-item {{ request()->is('admin/settings/smtp') ? 'active' : '' }}">
                    SMTP
                </a>
            </div>
        </div>
    </div>
</div>
