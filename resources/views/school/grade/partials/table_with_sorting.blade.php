<div class="table-responsive with-soring mt-4 grade">
    <table class="table data-table">
        <thead>
        <tr>
            @include('backend.partials.table.generate_th')
        </tr>
        </thead>
        <tbody>
        @if(!empty($grades) && count($grades) > 0)
            @foreach($grades as $gradeKey => $grade)
                <tr>
                    <td class="data-id"><span>{{ ++$recordStart  }}</span></td>
                    <td><b>{{ $grade->grade_name  }}</b></td>
                    <td>
                        <b>{{ DateFacades::dateFormat($grade->created_at,'format-3') }}</b><br>
                        {{ DateFacades::dateFormat($grade->created_at,'time-format-1') }}
                    </td>
                    <td class="action_div">
                        <div class="action_club">
                            <a href="javascript:void(0);"  onclick="openEditModal({{ $grade->grade_id }})"
                               class="viewbtn">view</a>
                            @include('backend.partials.table.generate_delete_btn',['id' => $grade->grade_id,'route' => 'school.grade.delete','moduleName' => 'grade',])
                        </div>
                    </td>
                </tr>
            @endforeach
        @else
            @include('backend.partials.table.generate_tr_no_record_found',['colspan' => '7'])
        @endif
        </tbody>
    </table>
</div>
@include('backend.partials.table.generate_pagination')
