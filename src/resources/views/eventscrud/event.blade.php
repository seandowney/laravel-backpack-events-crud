@extends('layouts.default')

{{-- Page title --}}
@section('title')
{{{ $event->title }}} ::
@parent
@stop

{{-- Update the Meta Description --}}
@section('meta_description')
{{{ !is_null($event->meta_description) ? $event->meta_description : ''}}}
@stop

{{-- Page content --}}
@section('content')
<article class="page" itemscope itemtype="http://schema.org/Event">
	<h1 itemprop="name">{{ $event->title }} @if(!is_null($event->speaker)) <span>by {{ $event->speaker }}</span>@endif</h1>
	<div class="event-date">
        <time itemprop="startDate" datetime="{{ $event->start_time->format('c') }}"></time>
        @if($event->end_time !== null)<time itemprop="endDate" datetime="{{ $event->end_time->format('c') }}"></time>@endif
        {{ $event->start_time->format('g:ia D jS F\ Y') }}
        @if($event->end_time !== null) to {{ $event->end_time->format('g:ia D jS F\ Y') }}@endif
    </div>

	@if($display_ticket_form)
	<h2>Book your tickets now</h2>
	<div style="width:100%; text-align:left;" >
		@include('seandowney::eventscrud.ticket_vendors.'.$ticket_vendors[$event->ticket_vendor], array('event' => $event))
	</div>
	@endif

	{!! $event->body !!}

    @if(isset($venue))
	<h2>Venue</h2>
	<div class="event-venue" itemprop="location" itemscope itemtype="http://schema.org/Place">
		<strong itemprop="name">{{ $venue['title'] }}</strong>
		@if(isset($venue['description']))<p>{{ $venue['description'] }}</p>@endif
		<address itemprop="address" itemscope itemtype="http://schema.org/PostalAddress">
			<span itemprop="streetAddress">{{ $venue['address']['address1'] }}@if(isset($venue['address']['address2'])),<br/>{{ $venue['address']['address2'] }}@endif</span>,<br/>
			<span itemprop="addressLocality">{{ $venue['address']['town'] }}</span>,<br/>
			<span itemprop="addressRegion">{{ $venue['address']['county'] }}</span><br/>
		</address>
		<p>W: <a href="{{ $venue['url'] }}" itemprop="url">{{ $venue['url'] }}</a><br/>
			T: <span itemprop="telephone">{{ $venue['phone'] }}</span><br/>
			<span itemprop="geo" itemscope itemtype="http://schema.org/GeoCoordinates">
				C: {{ $venue['coordinates']['lat'] }}, {{ $venue['coordinates']['lon'] }}
				<meta itemprop="latitude" content="{{ $venue['coordinates']['lat'] }}" />
				<meta itemprop="longitude" content="{{ $venue['coordinates']['lon'] }}" />
			</span>
		</p>
		<div class="Flexible-container">
		{!! $venue['map'] !!}
		</div>
		<style>

/* Flexible iFrame */

.Flexible-container {
    position: relative;
    padding-bottom: 56.25%;
    padding-top: 30px;
    height: 0;
    overflow: hidden;
}

.Flexible-container iframe,
.Flexible-container object,
.Flexible-container embed {
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
}
		</style>
	</div>
    @endif
</article>
@stop
