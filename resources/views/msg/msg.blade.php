@if(session()->has('success'))
<div class="alert alert-success">
  <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
    {{ session()->get('success') }}
</div>
@endif

@if(session()->has('contactMsg'))
<div class="alert alert-success">
  <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
    {{ session()->get('contactMsg') }}
</div>
@endif

@if(session()->has('error'))
<div class="alert alert-danger">
  <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
    {{ session()->get('error') }}
</div>
@endif


@if ($errors->any())
<div class="alert alert-danger">
  <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>

    @foreach ($errors->all() as $error)
       <p> {{ $error }} </p>
    @endforeach

</div>
@endif


<!-- jsAlert_invalid_subscription session start from here-->
@if(Session::has('jsAlert_invalid_subscription'))

@php
echo "<script>";
echo "alert('Please Enter Valid Email.')";
echo '</script>';
@endphp

@endif
<!-- jsAlert_invalid_subscription session end from here-->