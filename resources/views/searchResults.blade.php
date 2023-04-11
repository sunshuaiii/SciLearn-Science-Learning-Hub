@extends('layouts.app')

@section('content')
<br>
<h3>Search Results</h3>
<hr>
@if (count($results) > 0)
<ul>
    @foreach ($results as $result)
    <div class="col-md-3">
        <div class="card cartoonish-card">
            <img class="card-img" src="{{ $result['image'] }}" alt="Card image">
            <div class="card-body">
                <h5 class="card-title">{{ $result['name']}}</h5>
            </div>
            <div class="card-btn">
                <a href="{{ url('/modules/{moduleId}/{topicId}', ['moduleId'=>$result['module_id']],['id'=> $result['id']]) }}"
                    class=" btn cartoonish-btn">Start
                    Learning</a>
            </div>
        </div>
    </div>
    @endforeach
</ul>
@else
<h4>No results found.</h4>
@endif
@endsection