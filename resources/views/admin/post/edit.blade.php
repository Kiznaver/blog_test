@extends('layouts.admin_layout')

@section('title','Редагувати статтю')


@section('content')


    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
          <div class="row mb-2">
            <div class="col-sm-6">
              <h1 class="m-0">Редагувати статтю: {{$post['title']}}</h1>
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
        <form action="{{ route('post.update', $post['id'])}}" method="POST">

            @csrf
            @method('PUT')
          <div class="card-body">
            <div class="form-group">
              <label for="exampleInputtext1">Назва статті</label>
              <input type="text" value="{{$post['title']}}" name="title" class="form-control" id="exampleInputEmail1" placeholder="Введіть назву статті" required>
            </div>

            <div class="form-group">
                <label>Виберіть категорію</label>
                <select name="cat_id" class="custom-select" required>
                    @foreach ($categories as $category)
                        <option value="{{$category['id']}}" @if($category['id']==$post['cat_id']) seelected @endif>{{$category['title']}}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group">
                <label for="exampleInputtext1">Тег статті</label>
                <input type="text" name="tag"  value="{{$post['tag']}}" class="form-control" id="exampleInputEmail1" placeholder="Введіть тег до статті" required>
            </div>

              <div  class="form-group">
                  <textarea name="text" class="editor">{{$post['text']}} </textarea>
              </div>
              <div class="form-group">
                <label for="feature_image">Зображення статті</label>
                <input name="img" type="text" class="form-control" id="feature_image" name="feature_image" value="{{$post['img']}}" readonly>
                <a href="" class="btn btn-primary mt-2 popup_selector"  data-inputid="feature_image">Вибрати зображення</a>
              </div>
              <div class="form-group">
                <label>Опублікувати?</label>
                <select name="chbox" class="form-control" required>
                  <option value="1">Так</option>
                  <option value="0" >Ні</option>
                </select>
              </div>

          </div>
          <!-- /.card-body -->
          <div class="card-footer">
            <button type="submit" class="btn btn-primary">Зберегти</button>
          </div>
        </form>
      </div>
      <!-- Main content -->
      <section class="content">
        <div class="container-fluid">

          </div>
      </section>

@endsection
