@extends('layouts.admin_layout')

@section('title','Створити категорію')


@section('content')


    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
          <div class="row mb-2">
            <div class="col-sm-6">
              <h1 class="m-0">Додати статтю</h1>
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
      <div class="card card-primary">
        <!-- form start -->
        <form action="{{route('post.store')}}" method="POST">
            @csrf
          <div class="card-body">
            <div class="form-group">
              <label for="exampleInputtext1">Назва статті</label>
              <input type="text" name="title" class="form-control" id="exampleInputEmail1" placeholder="Введіть назву статті" required>
            </div>

            <div class="form-group">
                <label>Виберіть категорію</label>
                <select name="cat_id" class="custom-select" required>
                    @foreach ($categories as $category)
                        <option value="{{$category['id']}}">{{$category['title']}}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group">
              <label for="exampleInputtext1">Тег статті</label>
              <input type="text" name="tag" class="form-control" id="exampleInputEmail1" placeholder="Введіть тег до статті" required>

            </div>
            {{-- <div class="form-group">
                <label for="exampleInputtext1">Силка тега</label>
                <input type="text" name="link" value="{{route('getpost',[$post[cat_id],$post[id]])}}" class="form-control" id="exampleInputEmail1" placeholder="" readonly>

            </div> --}}

              <div  class="form-group">
                  <textarea name="text" class="editor"> </textarea>
              </div>
              <div class="form-group">
                <label for="feature_image">Зображення до статті статті</label>
                <input name="img" type="text" class="form-control" id="feature_image" name="feature_image" value="" readonly>
                <a href="" class="btn btn-primary mt-2 popup_selector"  data-inputid="feature_image">Вибрати зображення</a>
              </div>

          </div>
          <!-- /.card-body -->
          <div class="form-group">
            <label>Опублікувати?</label>
            <select name="chbox" class="form-control" required>
              <option value="1">Так</option>
              <option value="0" >Ні</option>
            </select>
          </div>
          <div class="card-footer">
            <button type="submit" class="btn btn-primary">Додати</button>
          </div>
        </form>
      </div>
      <!-- Main content -->
      <section class="content">
        <div class="container-fluid">

          </div>
      </section>

@endsection
