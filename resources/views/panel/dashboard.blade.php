@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">

	        <form action="{{ route('add-task') }}" method="POST">
	        	@csrf
	        	<input type="hidden" name="parent_id" value="1">
	        	
	        	<input type="text" name="task">
				
				<button>send</button>
	        </form>

        </div>
		
		<div class="col-md-8">
			<table-todo></table-todo>
		</div>
    </div>
</div>

@if(!empty($qr))
	
	<pre>{{ print_r($qr, true) }}</pre>

@endif




@endsection
