<div class="btn-group mb-4 container-fluid" role="group" aria-label="Basic outlined example">
    <a href="{{'/'}}" class="btn btn-outline-primary ">Всі статті</a>
    @foreach ($categories as $category)
    <a href="{{route('postcategory',$category['id'])}}" class="btn btn-outline-primary ">{{$category->title}}</a>
    @endforeach

</div>
