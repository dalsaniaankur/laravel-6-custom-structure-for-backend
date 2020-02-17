<div class="table-responsive with-soring mt-4 student">
    <table class="table data-table">
        <thead>
        <tr>
            @include('backend.partials.table.generate_th')
        </tr>
        </thead>
        <tbody>
        @if(!empty($exams) && count($exams) > 0)
            @foreach($exams as $examKey => $exam)
                <tr>
                    <td class="data-id"><span>{{ ++$recordStart  }}</span></td>
                    <td><b>{{ $exam->exam_name  }}</b></td>
                    <td><b>{{ $exam->school->school_name  }}</b></td>
                    <td>
                        <b>{{ DateFacades::dateFormat($exam->exam_date,'format-3') }}</b>
                    </td>
                    <td>
                        <b>{{ DateFacades::dateFormat($exam->created_at,'format-3') }}</b><br>
                        {{ DateFacades::dateFormat($exam->created_at,'time-format-1') }}
                    </td>
                    <td class="action_div">
                        <div class="action_club">
                            <a href="javascript:void(0);"  onclick="openEditModal({{ $exam->exam_id }})" class="viewbtn">view</a>
                            @include('backend.partials.table.generate_delete_btn',['id' => $exam->exam_id,'route' => 'school.exam.delete','moduleName' => 'exam',])
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
