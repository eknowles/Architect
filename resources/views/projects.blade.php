@extends('layouts.master')

@section('title', 'Projects')

@section('head')
@parent
@endsection

@section('content')
        <div class="container">
            <h2>Projects</h2>
            <hr>
            @foreach ($projects->chunk(3) as $projectChunks)
                <div class="row">
                    @foreach ($projectChunks as $project)
                        <div class="four columns thumbnail">
                            <a href="/projects/{{$project->slug}}">
                                <img src="{{ $project->photo }}" alt="{{$project->title}}" class="u-max-full-width">
                            </a>
                            <h6 style="margin-bottom: 0;"><strong>{{$project->title}}</strong></h6>
                            <p><em>{{$project->location}}</em></p>
                        </div>
                    @endforeach
                </div>
            @endforeach
        </div>
@endsection