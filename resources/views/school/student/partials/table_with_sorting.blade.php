<div class="table-responsive with-soring mt-4 student">
    <table class="table data-table">
        <thead>
        <tr>
            @include('backend.partials.table.generate_th')
        </tr>
        </thead>
        <tbody>
        @if(!empty($students) && count($students) > 0)
            @foreach($students as $studentKey => $student)
                <tr>
                    @include('backend.partials.table.generate_td_with_start_record',['recordStart' => ++$recordStart ])
                    <td>
                        <b>{{ $student->name }}</b>
                        <br>
                        <a href="mailto:{{ $student->email  }}" class="mail">{{ $student->email  }}</a>
                        <br>
                        {{ Common:: getPhoneFormat($student->phone)  }}
                    </td>
                    <td>
                        <b>{{ DateFacades::dateFormat($student->created_at,'format-3') }}</b>
                        <br>
                        {{ DateFacades::dateFormat($student->created_at,'time-format-1') }}
                    </td>
                    <td><b>{{ $student->grade->grade_name ?? ""}}</b></td>
                    <td class="bigfonts"><b>{{ $student->gender_type  }}</b></td>
                    <td class="{{ $student->status == 1 ? 'green' : 'inactive' }}">
                        <b>{{ $student->status_string }}</b>
                    </td>
                    <td class="action_div">
                        <div class="third_btn">
                            <a href="javascript:void(0)" onclick="openContactModal({{ $student->user_id }})" class="viewbtn contact">Contact</a>
                            <a href="{{ url('school/student/profile')}}/{{ Common::getEncryptId($student->user_id) }}" class="viewbtn">view</a>
                            @include('backend.partials.table.generate_delete_btn',['id' => $student->user_id,'route' => 'school.student.delete','moduleName' => 'student',])
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
