@extends('layouts.admin_layout')

@section('title','Всі категорії')

@section('content')

    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
          <div class="row mb-2">
            <div class="col-sm-6">
              <h1 class="m-0">Всі категорії</h1>
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
                        Назва категорії
                    </th>

                </tr>
            </thead>
            @foreach ($categories as $category)
                <tbody>
                    <tr>
                        <td>
                            {{$category['id']}}
                        </td>
                        <td>
                            <a>
                                {{$category['title']}}
                            </a>
                        </td>
                        <td class="project-actions text-right">
                            <a class="btn btn-info btn-sm" href="{{route('category.edit', $category['id'])}}">
                                <i class="fas fa-pencil-alt">
                                </i>
                                Редагувати
                            </a>
                            <form action="{{route('category.destroy', $category['id'])}}" method="POST" style="display: inline-block">
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
      <section class="content">
        <div class="container-fluid">

          </div>
      </section>

@endsection
