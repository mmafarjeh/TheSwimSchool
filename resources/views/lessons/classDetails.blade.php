@extends('layouts.app-uikit')

@section('heading')
Lessons
@endsection

@section('content')
<div class="uk-section-default uk-section-overlap uk-section">
    <div class="uk-container ">
        @foreach($lessons as $lesson)
        <div class="uk-card uk-card-default uk-margin-top">
            <div class="uk-card-header">
                <div class="uk-card-title f-24 uk-heading-bullet">{{$lesson->class_type}}</div>
            </div>
            <div class="uk-card-body">
                <div class="uk-child-width-expand@s" uk-grid>
                    <div><i class="fa fa-users fa-lg" aria-hidden="true"></i> <strong>Class Size:</strong> {{$lesson->class_size}}</div>
                    <div><i class="fa fa-money fa-lg" aria-hidden="true"></i> <strong>Price:</strong> ${{$lesson->price}}</div>
                    <div><i class="fa fa-calendar fa-lg" aria-hidden="true"></i> <strong>Meeting Days:</strong> {{$lesson->days}}</div>
                </div>

                <div class="uk-child-width-expand@s" uk-grid>
                    <div><i class="fa fa-user fa-lg" aria-hidden="true"></i> <strong>Spots Remaining:</strong> {{$lesson->class_size - $lesson->Swimmers->count()}}</div>
                    <div><i class="fa fa-calendar-o fa-lg" aria-hidden="true"></i> <strong>Dates:</strong> {{$lesson->class_start_date->toFormattedDateString()}} - {{$lesson->class_end_date->toFormattedDateString()}}</div>
                    <div><i class="fa fa-clock-o fa-lg" aria-hidden="true"></i> <strong>Times:</strong> {{$lesson->class_start_time->format('H:i A')}} - {{$lesson->class_end_time->format('H:i A')}}</div>
                </div>

                @if (Auth::guest())
                    
                @else
                    <ul class="uk-list uk-list-striped">
                        <li><strong>Swimmers</strong></li>
                        @foreach($lesson->Swimmers as $swimmer)
                            <li><a href="/swimmers/{{{$swimmer->id}}}" class="list-group-item list-group-item-action justify-content-between">
                            @if($swimmer->paid == 1)
                                {{$swimmer->name}} 
                            @elseif($swimmer->paid == 0)
                                {{$swimmer->name}} 
                            @endif
                            </a></li>
                        @endforeach
                    </ul>
                @endif
            </div>
            <div class="uk-card-footer">
                @if($lesson->class_size - $lesson->Swimmers->count() > 0)
                    <a href="/lessons/{{{$lesson->class_type}}}/{{{$lesson->id}}}" class="uk-button uk-button-primary">Sign Up</a>
                @else
                    <button class="uk-button uk-button-primary" disabled>Class Full</button>
                @endif
            </div>
        </div>
        @endforeach
    </div>
</div>
@endsection

