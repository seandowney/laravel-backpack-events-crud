@extends('layouts.default')

{{-- Page content --}}
@section('content')
@if (isset($events))
<h1>Events</h1>
@foreach ($events as $event)
<div class="row">
	<div class="span8">
		<!-- Post Title -->
		<div class="row">
			<div class="span8" itemscope itemtype="http://schema.org/Event">
				<a href="{{ $event->url() }}" itemprop="url"><h4 itemprop="name"><strong>{{ $event->title }} @if(!empty($event->speaker)) by {{ $event->speaker }}@endif</strong></h4></a>
				<p><time itemprop="startDate" datetime="{{ $event->start_time->format('c') }}"></time>{{ $event->start_time->format('g:ia D jS F Y') }}</p>
			</div>
		</div>
	</div>
</div>

<hr />
@endforeach

{{ $events->links() }}
@endif
@stop
