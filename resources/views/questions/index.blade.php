@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <div class="d-flex align-items-center">
                        <h2>Ask Questions</h2>
                        <div class="ml-auto">
                        <a href="{{route('questions.create')}}" class="btn btn-outline-secondary">Ask Question</a>
                        </div>
                    </div>
                </div>

                <div class="card-body">
                    @include('layouts._messages')

                   @foreach ($questions as $question)
                        <div class="media">
                            <div class="d-flex flex-column counters">
                                <div class="vote">
                                    <strong>{{ $question->votes }}</strong>{{ \Illuminate\Support\str::plural('vote',$question->votes) }}
                                </div>
                            <div class="status {{ $question->status }}">
                                    <strong>{{ $question->answers }}</strong>{{ \Illuminate\Support\str::plural('answer',$question->votes) }}
                                </div>
                                <div class="view">
                                    {{ $question->views . "" . \Illuminate\Support\str::plural('view',$question->views) }}
                                </div>
                            </div>
                            <div class="media-body">
                                <div class="d-flex align-items-center">
                                     <h3 class="mt-0"><a href="{{ $question->url }}">{{ $question->title }}</a></h3>
                                    <div class="ml-auto">
                                    <a href="{{ route('questions.edit', $question->id) }}"class="btn btn-sm btn-outline-info">Edit</a>
                                    <form class="form-delete" method="POST" action="{{route('questions.destroy',$question->id) }}" id="form-data-{{$question->id}}">
                                        @method('DELETE')
                                        @csrf
                                    </form>

                                        <a  href="" class="btn btn-sm btn-outline-danger"  onclick="if(confirm('Are you sure want to delete'))
                                        {
                                            event.preventDefault();
                                            document.getElementById('form-data-{{$question->id}}').submit();}
                                            else{
                                                event.preventDefault();
                                            }
                                            ">Delete</a>
                                    </div>
                                </div>
                                <p class="lead">
                                Asked by
                            <a href="{{ $question->user->url }}">{{ $question->user->name}}</a>
                            <small class="text-muted">{{ $question->created_date }}</small>
                            </p>
                            {{ Str::limit($question->body,200) }}
                            </div>
                        </div>
                        <hr>
                   @endforeach

                   {{ $questions->links() }}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
