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
	@if(!empty($event->image))
	<div class="event-image">
		<img src="{{ url($event->image) }}" title="{{ $event->title }}" alt="{{ $event->title }}" />
	</div>
	@endif

	@if($display_ticket_form)
	<h2>Book your tickets now</h2>
	<div style="width:100%; text-align:left;" >
		@include('seandowney::eventscrud.ticket_vendors.'.$ticket_vendors[$event->ticket_vendor], array('event' => $event))
	</div>
	@endif

	{!! $event->body !!}

    @if(isset($event->venue))
	<h2>Venue</h2>
	<div class="event-venue" itemprop="location" itemscope itemtype="http://schema.org/Place">
		<strong itemprop="name">{{ $event->venue->title }}</strong>
		@if(isset($event->venue->description)){!! $event->venue->description !!}@endif
		<address itemprop="address" itemscope itemtype="http://schema.org/PostalAddress">
			@if(!empty($event->venue->address1) || !empty($event->venue->address2))
			<span itemprop="streetAddress">{{ $event->venue->address1 }}@if(!empty($event->venue->address2)),<br/>{{ $event->venue->address2 }}@endif</span>,<br/>
			@endif
			@if(isset($event->venue->city))
			<span itemprop="addressLocality">{{ $event->venue->city }}</span>,<br/>
			@endif
			@if(isset($event->venue->state))
			<span itemprop="addressRegion">{{ $event->venue->state }}</span><br/>
			@endif
			@if(isset($event->venue->postcode))
			<span itemprop="postalCode">{{ $event->venue->postcode }}</span><br/>
			@endif
			@if(isset($event->venue->country))
			<span itemprop="addressCountry">{{ $event->venue->country }}</span><br/>
			@endif
		</address>
		<p>
			@if(!empty($event->venue->url))
			W: <a href="{{ $event->venue->url }}" itemprop="url">{{ $event->venue->url }}</a><br/>
			@endif
			@if(!empty($event->venue->phone))
			T: <span itemprop="telephone">{{ $event->venue->phone }}</span><br/>
			@endif
			@if(isset($event->venue->latitude) && isset($event->venue->longitude))
			<span itemprop="geo" itemscope itemtype="http://schema.org/GeoCoordinates">
				C: {{ $event->venue->latitude }}, {{ $event->venue->longitude }}
				<meta itemprop="latitude" content="{{ $event->venue->latitude }}" />
				<meta itemprop="longitude" content="{{ $event->venue->longitude }}" />
			</span>
			@endif
		</p>
		<div class="Flexible-container">
		<iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d2360.7531368800155!2d{{ $event->venue->longitude }}!3d{{ $event->venue->latitude }}!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0x0!2zNTPCsDQzJzIxLjYiTiA2wrAxOSczMy41Ilc!5e0!3m2!1sen!2sie!4v1488119023181" width="600" height="450" frameborder="0" style="border:0" allowfullscreen></iframe>
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
