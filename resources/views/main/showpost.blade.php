@extends ( ' layouts.app ' )


@section ( 'content' )

    @include('includes.categoryes')
    <div class="container">
        <h1 class="mt-5 mb-4 text-center">{{$post->title}}</h1>
        <div class="div"><img src="/{{$post->img}}" class="img-fluid" style="height: 250px; width: 100%; display: block;" alt="Responsive image"></div>
        <article class="mt-5 mb-4">
            {!!$post->text!!}
        </article>
    </div>

    </div>


@endsection
