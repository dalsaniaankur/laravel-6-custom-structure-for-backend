{{--
toastr.options = {"closeButton": true,};
--}}

@if (!empty($errors) && count($errors) > 0)
    @foreach ($errors->all() as $error)
        toastr.error("Error : {{ $error }}");
    @endforeach
@endif

@if(session('error'))
    toastr.error("Error : {{ session('error') }}");
@endif

@if(session('success'))
    toastr.success("{{ session('success') }}");
@endif
