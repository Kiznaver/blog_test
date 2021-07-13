@extends ( ' layouts.app ' )

@section('title', 'Блог')

@section ( 'content' )

    @include('includes.categoryes')
    <div class="card mb-4">
        @foreach ($posts as $post)
        @if ($post->chbox=='1')
            <div class="card-header">
                @if ( $post->category == null )
                    Категорія була видалена
                @else
                    <a href="{{route('postcategory',$post->category['id'])}}">Категорія: {{$post->category->title}}</a>
                @endif

            </div>
            <div class="card-body mb-4">
                <h5 class="card-title">{{$post['title']}}</h5>
                <div class="card-text">
                    {!!$post['text']!!}
                    {{-- @php
                        echo Str::limit($post['text'], 500, ' (...)');

                    @endphp --}}
                      {{-- {!!Str::limit($post['text'], 500, ' (...)')!!} --}}
                </div>
                <a href="{{route('getpost',[$post->category['id'],$post->id])}}" class="btn btn-primary">Читати більше</a>
            </div>
        @endif

        @endforeach
    </div>
     {{$posts->links('vendor.pagination.bootstrap-4')}}
    </div>


@endsection
