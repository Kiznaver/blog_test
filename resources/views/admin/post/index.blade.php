@extends('layouts.admin_layout')

@section('title','Всі статті')

@section('content')

    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
          <div class="row mb-2">
            <div class="col-sm-6">
              <h1 class="m-0">Всі статті</h1>

            </div><!-- /.col -->
          </div><!-- /.row -->
          @if (session('success'))
            <div class="alert alert-success" role="alert">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">x</button>
                <h4><i class="icon fa fa-check"></i>{{session('success')}}</h4>

            </div>
          @endif
        </div><!-- /.container-fluid -->
      </div>
      <!-- /.content-header -->

      <div class="card-body p-0">
        <table class="table table-striped projects">
            <thead>
                <tr>
                    <th style="width: 1%">
                        ID
                    </th>
                    <th style="width: 20%">
                        Заголовок
                    </th>
                    <th style="width: 20%">
                        Категорія
                    </th>
                    <th style="width: 20%">
                        Дата створення
                    </th>
                </tr>
            </thead>
            @foreach ($posts as $post)
                <tbody>
                    <tr>
                        <td style="width: 1%">
                            {{$post['id']}}
                        </td>
                        <td style="width: 20%">
                            {{$post['title']}}
                        </td>
                        <td style="width: 20%">
                            @if ( $post->category == null )
                                Категорія була видалена
                            @else
                            {{ $post->category->title }}
                            @endif
                        </td>
                        <td style="width: 20%">
                            {{$post['created_at']}}
                        </td>
                        <td class="project-actions text-right">
                            <a class="btn btn-info btn-sm" href="{{route('post.edit', $post['id'])}}">
                                <i class="fas fa-pencil-alt">
                                </i>
                                Редагувати
                            </a>
                            <form action="{{route('post.destroy', $post['id'])}}" method="POST" style="display: inline-block">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm delete-btn" href="#">
                                    <i class="fas fa-trash">
                                    </i>
                                   Видалити
                                </button>
                            </form>
                        </td>
                    </tr>
                </tbody>
            @endforeach
        </table>
      </div>

      <!-- Main content -->
      {{-- <section class="content">
        <div class="container-fluid">
            @for ($i=0; $i>=$posts_count; $i++)

                <form action="{{ route('post.update', $post['id'])}}" method="POST">

                    @csrf
                    @method('PUT')
                        $replaced=$post->text;
                        @foreach($posts as $add_tags)
                            @if ($add_tags['tag_id']!==$add_tags->tag['id'])
                                $data='<a href="{{route('getpost',[$add_tags[cat_id],$add_tags[id]])}}">{{$add_tags->tag}}</a>';
                                $replaced = Str::replace($add_tags->tag->title, $data, $replaced);
                            @endif
                        @endforeach
                </form>
            @endfor
            <li class="nav-item">
                <button class="nav-link submit">
                    <i class="nav-icon fas fa-tachometer-alt"></i>
                    <p>
                        Оновити теги
                    </p>
                </button>
            </li>
        </div>
        $fsfdsf=
        $sdasd=Post::where('id',3)->update(['title'=>'Updated title']);
      </section> --}}

@endsection


