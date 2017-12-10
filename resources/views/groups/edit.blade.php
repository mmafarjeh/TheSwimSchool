@extends('layouts.app-uikit')

@section('heading')
    Edit {{$group->type}}
@endsection

@section('content')
    <div class="uk-section-default uk-section-overlap uk-section">
        <div class="uk-container">
            <div class="uk-card uk-card-default">
                <div class="uk-card-body">
                    <form method="POST" action="/groups/{{{$group->id}}}" class="uk-form-stacked">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        <input type="hidden" name="_method" value="PATCH">
                        <h3 class="uk-heading-bullet">Lesson</h3>
                        <div class="uk-margin">
                            <label for="name"  class="uk-form-label">Lesson Name</label>
                            <input type="text" class="uk-input" id="type" name="type" placeholder="Type" value="{{ old('name') ?? $group->type }}" required>
                        </div>
                        <div class="uk-margin">
                            <label for="age"  class="uk-form-label">Lesson Age</label>
                            <input type="text" class="uk-input" id="ages" name="ages" placeholder="Ages" value="{{ old('age') ?? $group->ages }}" required>
                        </div>
                        <div class="uk-margin">
                            <label for="parent"  class="uk-form-label">Lesson Description</label>
                            <textarea class="uk-textarea" rows="5" id="description" name="description">{{ old('notes') ?? $group->description }}</textarea>
                        </div>
                        <hr>

                        <div>
                            <button type="submit" class="uk-button uk-button-primary">Update</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection


