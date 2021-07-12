@extends('layouts.admin_layout')

@section('title','Створити категорію')

@section('content')

    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
          <div class="row mb-2">
            <div class="col-sm-6">
              <h1 class="m-0">Додати категорію</h1>
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
        <form action="{{route('category.store')}}" method="POST">
            @csrf
          <div class="card-body">
            <div class="form-group">
              <label for="exampleInputtext1">Назва категорії</label>
              <input type="text" name="title" class="form-control" id="exampleInputEmail1" placeholder="Введіть назву категорії" required>
            </div>
          </div>
          <!-- /.card-body -->

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
