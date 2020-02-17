@extends('backend.layouts.app')
@section('title', 'Messages | '.trans('admin.backend_title'))
@section('content')
    <div class="main_section">

        <div class="container">
            <div class="page-wrap bx-shadow mt-5 mb-5">
                <div class="row user-dt-wrap">
                    <div class="col-lg-12 col-md-12 pb-5">
                        <h1 class="admin_bigheading mb-5 inlinebtn">Messages ({{ $totalRecordCount }})</h1>
                        <a href="javascript:void(0)" onclick="openMessageModal('#message_model')"
                           class="btn light_blue float-right newbtn">New Message</a>
                        <div class="clear-both"></div>

                        {!! Form::open(['method' => 'GET','name'=>'admin-message-search', 'id' =>'admin_message_search_form', 'class'=>'top-search-options form-row pb-4','route' => ['teacher.messages']]) !!}
                        {{--{!! Form::hidden('sorted_by_for_sent', $sortedByForSent, array('id' => 'sortedBy')) !!}
                        {!! Form::hidden('sorted_order_for_sent', $sortedOrderForSent, array('id' => 'sortedOrder')) !!}
                        {!! Form::hidden('sorted_by', $sortedBy, array('id' => 'sortedBy')) !!}
                        {!! Form::hidden('sorted_order', $sortedOrder, array('id' => 'sortedOrder')) !!}--}}
                        {!! Form::hidden('current_tab', $currentTab, array('id' => 'current_tab')) !!}

                        <div class="col-md-3 col-lg-2">
                            <a href="{{ url('teacher/messages') }}">
                                <button type="button" class="btn btn_green resetbtn mb-3">Reset</button>
                            </a>
                        </div>

                        <div class="col-md-3 col-lg-3">
                            {!! Form::text('start_date', $createdStartDate, ['id' =>'start_date', 'class' => 'form-control date-field mb-3', 'placeholder' => 'From date','autocomplete' => 'Off', 'data-toggle'=>'datepicker']) !!}
                        </div>

                        <div class="col-md-3 col-lg-3">
                            {!! Form::text('end_date', $createdEndDate, ['id' =>'end_date', 'class' => 'form-control date-field mb-3', 'placeholder' => 'Send date','autocomplete' => 'Off', 'data-toggle'=>'datepicker']) !!}
                        </div>

                        <div class="col-md-3 col-lg-2">
                            {!! Form::select('role_id', ['' => 'User type','1' => 'Admin','4' => 'Student','5' => 'Parent','6' => 'PTA Member'], $roleId, ['class' => 'form-control mb-3']) !!}
                        </div>

                        <div class="col-md-3 col-lg-2">
                            {!! Form::Submit(trans('admin.qa_search'), ['class' => 'btn btn_green resetbtn']) !!}
                        </div>
                        {!! Form::close() !!}

                        <ul class="nav nav-tabs mt-5">
                            <li class="nav-item">
                                <a class="received-tab nav-link {{ $currentTab =='received' ? 'active' : '' }}"
                                   href="#received" data-toggle="tab">Received</a></li>
                            <li class="nav-item">
                                <a class="sent-tab nav-link {{ $currentTab =='sent' ? 'active' : '' }}" href="#sent"
                                   data-toggle="tab">Sent</a>
                            </li>
                        </ul>

                        <div class="tab-content">
                            <div class="tab-pane mt-4 {{ $currentTab=='received' ? 'active' : '' }}" id="received">
                                <div class="table-responsive">
                                    <table class="table sorting data-table messages" id="classes">
                                        <thead>
                                        <tr>
                                            {{--@php($shortClass = ( strtolower($sortedOrder) == 'asc') ? 'up' : 'down' )
                                            @php($sortDefault = '<i class="fas fa-sort"></i>')
                                            @php($sorting = '<i class="fas fa-caret-'.$shortClass.'"></i>')--}}

                                            <th>@lang('admin.user.fields.id')</th>
                                            <th>DATE</th>
                                            <th>SENDER</th>
                                            <th class="msgwidth">MESSAGE</th>
                                            <th>READ/UNREAD</th>
                                            <th class="actionwidth">@lang('admin.user.fields.action')</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @if(!empty($messages) && count($messages) > 0)
                                            @foreach($messages as $messageKey => $message)
                                                <tr>
                                                    <td class="data-id"><span>{{ ++$recordStart  }}</span></td>
                                                    <td>
                                                        <b>{{ DateFacades::dateFormat($message->created_at,'format-3') }}</b><br>
                                                        {{ DateFacades::dateFormat($message->created_at,'time-format-1') }}
                                                    </td>
                                                    <td>
                                                        @if($message->sender->role_id == 2)
                                                            <b>{{ $message->sender->school_name }}</b><br>
                                                        @else
                                                            <b>{{ $message->sender->name }}</b><br>
                                                        @endif
                                                        <a href="mailto:{{ $message->sender->email  }}"
                                                           class="mail">{{ $message->sender->email  }}</a> <br>
                                                        {{ Common:: getPhoneFormat($message->sender->phone)  }}
                                                    </td>
                                                    <td>
                                                        <div class="elips">{{ $message->getLastMessage($message->sender_id,$message->receiver_id)->message }}</div>
                                                    </td>
                                                    @php($isUnReadCount = $message->getIsUnReadCount($message->sender_id,$message->receiver_id))
                                                    <td class="{{ $isUnReadCount > 0 ? 'inactive' : 'green' }} read_unread_{{$message->sender_id}}">
                                                        <b>{{ $isUnReadCount > 0 ? 'Unread' : 'Read' }}
                                                            @if($isUnReadCount > 0)
                                                                ({{$isUnReadCount}})
                                                            @endif
                                                        </b></td>
                                                    <td class="action_div">
                                                        <div class="action_club">
                                                            <a href="javascript:void(0)"
                                                               onclick="openViewMessageModal('#view_message_model', {{ $message->sender_id }}, {{ $message->receiver_id }})"
                                                               class="viewbtn">view</a>
                                                            {!! Form::open(array(
                                                                    'method' => 'DELETE',
                                                                     'onsubmit' => "return confirm('".trans("admin.qa_are_you_sure_delete")." message?');",
                                                                    'route' => ['teacher.message.delete'])) !!}
                                                            {!! Form::hidden('sender_id',$message->sender_id ) !!}
                                                            {!! Form::hidden('receiver_id',$message->receiver_id ) !!}

                                                            <button type="submit" value="Delete" class="delete_btn"><i
                                                                    class="far fa-trash-alt"></i></button>

                                                            {!! Form::close() !!}
                                                        </div>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        @else
                                            <tr>
                                                <td colspan="10">@lang('admin.qa_no_entries_in_table')</td>
                                            </tr>
                                        @endif
                                        </tbody>
                                    </table>
                                </div>
                                {!! $paging !!}
                            </div>
                            <div class="tab-pane mt-4 {{ $currentTab=='sent' ? 'active' : '' }}" id="sent">
                                <div class="table-responsive">
                                    <table class="table sorting data-table messages" id="classes">
                                        <thead>
                                        <tr>
                                            {{--@php($shortClass = ( strtolower($sortedOrder) == 'asc') ? 'up' : 'down' )
                                            @php($sortDefault = '<i class="fas fa-sort"></i>')
                                            @php($sorting = '<i class="fas fa-caret-'.$shortClass.'"></i>')--}}

                                            <th>@lang('admin.user.fields.id')</th>
                                            <th>DATE</th>
                                            <th>RECEIVER</th>
                                            <th class="msgwidth">MESSAGE</th>
                                            <th class="actionwidth">@lang('admin.user.fields.action')</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @if(!empty($messagesForSent) && count($messagesForSent) > 0)
                                            @foreach($messagesForSent as $messageKey => $message)
                                                <tr>
                                                    <td class="data-id"><span>{{ ++$recordStartForSent  }}</span></td>
                                                    <td>
                                                        <b>{{ DateFacades::dateFormat($message->created_at,'format-3') }}</b><br>
                                                        {{ DateFacades::dateFormat($message->created_at,'time-format-1') }}
                                                    </td>
                                                    <td>
                                                        @if($message->receiver->role_id == 2)
                                                            <b>{{ $message->receiver->school_name }}</b><br>
                                                        @else
                                                            <b>{{ $message->receiver->name }}</b><br>
                                                        @endif
                                                        <a href="mailto:{{ $message->receiver->email  }}"
                                                           class="mail">{{ $message->receiver->email  }}</a> <br>
                                                        {{ Common:: getPhoneFormat($message->receiver->phone)  }}
                                                    </td>
                                                    <td>
                                                        <div
                                                            class="elips">{{ $message->getLastMessageForReceiver($message->receiver_id)->message }}</div>
                                                    </td>
                                                    <td class="action_div">
                                                        <div class="action_club">
                                                            <a href="javascript:void(0)"
                                                               onclick="openViewMessageModal('#view_message_model', {{ $message->receiver_id }}, {{ $message->sender_id }})"
                                                               class="viewbtn">view</a>
                                                            {!! Form::open(array(
                                                                    'method' => 'DELETE',
                                                                     'onsubmit' => "return confirm('".trans("admin.qa_are_you_sure_delete")." message?');",
                                                                    'route' => ['teacher.message.delete'])) !!}

                                                            {!! Form::hidden('sender_id',$message->sender_id ) !!}
                                                            {!! Form::hidden('receiver_id',$message->receiver_id ) !!}

                                                            <button type="submit" value="Delete" class="delete_btn"><i
                                                                    class="far fa-trash-alt"></i></button>

                                                            {!! Form::close() !!}
                                                        </div>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        @else
                                            <tr>
                                                <td colspan="10">@lang('admin.qa_no_entries_in_table')</td>
                                            </tr>
                                        @endif
                                        </tbody>
                                    </table>
                                </div>
                                {!! $pagingForSent !!}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @include('teacher.message.add_edit_model')
    @include('admin.message.view_model')
@endsection
@section('javascript')
    <script>
        var form = 'form#admin_message_search_form';

        /*----------------------------------  Message  -----------------------------------*/

        var addEditMessageForm = 'form#add_edit_message_model_form';
        window.addEditMessageUrl = "{{ URL::to('teacher/message/save_ajax') }}";
        window.getMessageDataForEditUrl = "{{ URL::to('teacher/message/get_data') }}";

        addEditMessageModelIdElement = $(addEditMessageForm + " #add_edit_message_model_id");
        senderIdElement = $(addEditMessageForm + " #sender_id");
        receiverIdElement = $(addEditMessageForm + " #receiver_id");
        messageElement = $(addEditMessageForm + " #message");
        customMessageErrorMessageElement = $(addEditMessageForm + " .custom-error-message");
        customMessageSuccessMessageElement = $(addEditMessageForm + " .custom-success-message");

        var sendMessageForm = 'form#send_message_model_form';
        senderIdElementForSendMessage = $(sendMessageForm + " .sender_id_message_model");
        receiverIdElementForSendMessage = $(sendMessageForm + " .receiver_id_message_model");
        messageElementForSendMessage = $(sendMessageForm + " #message");
        customSendMessageErrorMessageElement = $(sendMessageForm + " .custom-reply-error-message");
        customSendMessageSuccessMessageElement = $(sendMessageForm + " .custom-reply-success-message");

        receiverIdElement.multiselect({
            columns: 1,
            search: true,
            selectAll: true,
            placeholder: 'Select user',
        });

        /* Message Reset Form */
        function resetMessageForm() {
            $(addEditMessageForm).parsley().reset();
            customMessageErrorMessageElement.hide();
            customMessageSuccessMessageElement.hide();
            addEditMessageModelIdElement.val(0);
            receiverIdElement.val("");
            messageElement.val("");
        }

        /* Add Edit Ajax Call */
        $(addEditMessageForm).submit(function (event) {

            if ($(addEditMessageForm).parsley().validate()) {

                event.preventDefault();
                customMessageErrorMessageElement.hide();
                customMessageSuccessMessageElement.hide();
                showLoader();

                var formData = new FormData($(this)[0]);
                jQuery.ajax({
                    url: window.addEditMessageUrl,
                    enctype: 'multipart/form-data',
                    method: 'post',
                    dataType: 'JSON',
                    processData: false,
                    contentType: false,
                    cache: false,
                    data: formData,
                    success: function (response) {
                        if (response.success == true) {
                            customMessageSuccessMessageElement.html(response.message);
                            customMessageSuccessMessageElement.show();
                            hideLoader();
                            setTimeout(function () {
                                location.reload();
                            }, 2000);
                        } else {
                            customMessageErrorMessageElement.html(response.message);
                            customMessageErrorMessageElement.show();
                            hideLoader();
                        }
                    },
                    error: function (xhr, status) {
                        customMessageErrorMessageElement.html(window._ajax_error_msg_common);
                        customMessageErrorMessageElement.show();
                        hideLoader();
                    }
                });
            }
        });

        /* Open Message Model */
        function openMessageModal(modelSelector) {
            resetMessageForm();
            openModal(modelSelector);
        }

        /*----------------------------------  Sent Message  -----------------------------------*/

        /* Message Reset Form */
        function resetSendMessageForm() {
            $(sendMessageForm).parsley().reset();
            customSendMessageErrorMessageElement.hide();
            customSendMessageSuccessMessageElement.hide();
            receiverIdElementForSendMessage.val("");
            messageElementForSendMessage.val("");
            jQuery("#attachment_file").val("");
            jQuery(".send-message-attachment").html("");
        }

        /* Open View Message Model */
        function openViewMessageModal(modelSelector, senderId, receiverId) {
            resetSendMessageForm();
            showLoader();
            jQuery.ajax({
                url: window.getMessageDataForEditUrl,
                method: 'post',
                dataType: 'JSON',
                data: {
                    '_token': window._token,
                    'sender_id': senderId,
                    'receiver_id': receiverId,
                },
                success: function (response) {
                    if (response.success == true) {
                        jQuery(".view_message").html(response.data.message);
                        jQuery("#sender_id_message_model").val(response.data.receiver_id);
                        jQuery("#receiver_id_message_model").val(response.data.sender_id);
                        window.senderId = response.data.receiver_id;
                        window.receiverId = response.data.sender_id
                        jQuery(".read_unread_" + response.data.sender_id).addClass("green");
                        jQuery(".read_unread_" + response.data.sender_id).removeClass("inactive");
                        jQuery(".read_unread_" + response.data.sender_id).html("<b>Read</b>");
                        openModal(modelSelector);
                        hideLoader();
                    } else {
                        hideLoader();
                        resetSendMessageForm();
                    }
                },
                error: function (xhr, status) {
                    customSendMessageErrorMessageElement.html(window._ajax_error_msg_common);
                    customSendMessageErrorMessageElement.show();
                    hideLoader();
                }
            });
        }

        /* Send Message Ajax Call */
        $(sendMessageForm).submit(function (event) {

            if ($(sendMessageForm).parsley().validate()) {

                event.preventDefault();
                customSendMessageErrorMessageElement.hide();
                customSendMessageSuccessMessageElement.hide();
                showLoader();

                var formData = new FormData($(this)[0]);
                jQuery.ajax({
                    url: window.addEditMessageUrl,
                    enctype: 'multipart/form-data',
                    method: 'post',
                    dataType: 'JSON',
                    processData: false,
                    contentType: false,
                    cache: false,
                    data: formData,
                    success: function (response) {
                        if (response.success == true) {
                            resetSendMessageForm();
                            customSendMessageSuccessMessageElement.html(response.message);
                            customSendMessageSuccessMessageElement.show();
                            hideLoader();
                            /*setTimeout(function () {
                                location.reload();
                            }, 2000);*/
                            /*window.senderId = jQuery("#sender_id_message_model").val();
                            window.receiverId = jQuery("#receiver_id_message_model").val();*/
                            openViewMessageModal('#view_message_model', window.receiverId, window.senderId);
                        } else {
                            customSendMessageErrorMessageElement.html(response.message);
                            customSendMessageErrorMessageElement.show();
                            hideLoader();
                        }
                    },
                    error: function (xhr, status) {
                        customSendMessageErrorMessageElement.html(window._ajax_error_msg_common);
                        customSendMessageErrorMessageElement.show();
                        hideLoader();
                    }
                });
            }
        });

        jQuery(".sent-tab").click(function () {
            jQuery("#current_tab").val("sent");
            var changeUrl = "current_tab=sent";
            var currentUrl = window.location.href;
            var url = new URL(currentUrl);
            url.searchParams.set("current_tab", "sent");
            history.pushState({}, null, url.href);
        });
        jQuery(".received-tab").click(function () {
            jQuery("#current_tab").val("received");
            var changeUrl = "current_tab=sent";
            var currentUrl = window.location.href;
            var url = new URL(currentUrl);
            url.searchParams.set("current_tab", "received");
            history.pushState({}, null, url.href);
        });
    </script>
@endsection
