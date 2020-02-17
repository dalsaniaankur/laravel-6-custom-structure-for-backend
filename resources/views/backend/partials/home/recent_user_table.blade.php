<div class="table-responsive recent-user">
    <table class="table data-table">
        <thead>
        <tr>
            @include('backend.partials.table.generate_th',['label' => 'NAME',])
            @include('backend.partials.table.generate_th',['label' => 'EMAIL',])
            @include('backend.partials.table.generate_th',['label' => 'JOINED'])
        </tr>
        </thead>
        <tbody>
        @if(!empty($recentUsers) && count($recentUsers) > 0)
            @foreach($recentUsers as $recentUserKey => $recentUser)
                <tr>
                    <td class="name">{{ $recentUser->first_name }}<br>{{ $recentUser->last_name }}</td>
                    <td class="email">
                        <div><a href="mailto:{{ $recentUser->email }}" title="{{ $recentUser->email }}" class="email">{{ $recentUser->email }}</a></div>
                    </td>
                    <td class="date">{{ DateFacades::dateFormat($recentUser->signup_date,'format-3') }}</td>
                </tr>
            @endforeach
        @else
            <tr>
                <td colspan="3" class="no-record-found">@lang('admin.qa_no_entries_in_table')</td>
            </tr>
        @endif
        </tbody>
    </table>
</div>
