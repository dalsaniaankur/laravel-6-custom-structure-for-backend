{!! Form::open(array('method' => 'DELETE', 'onsubmit' => "return confirm('".trans("admin.qa_are_you_sure_delete")." $moduleName?');", 'route' => [$route])) !!}
{!! Form::hidden('id',$id ) !!}
<button type="submit" value="Delete" class="delete_btn"><i class="far fa-trash-alt"></i></button>
{!! Form::close() !!}
