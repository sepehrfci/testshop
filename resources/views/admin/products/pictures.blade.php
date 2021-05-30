@extends('admin.layout.master')
@section('title','اضافه کردن عکس')
@section('content')
    <div class="main-content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12 height-card box-margin">
                    <div class="card">
                        <div class="m-4">
                            <h5>مدیریت تصویر های محصول</h5>

                            <form action="{{route('products.pictures.store',$product)}}" method="post" enctype="multipart/form-data">
                                @csrf
                                    <label for="file" >اضافه کردن تصویر جدید</label>
                                    <input type="file" class="form-control-file mb-10" name="picture" id="file">
                                    @error('picture')
                                        <p class="text-danger">{{ $message }}</p>
                                    @enderror
                                    <input type="submit" class="btn btn-primary" value="آپلود">
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row justify-content-center">
                <div class="col-md-6 col-xl-4 height-card box-margin">
                    <div class="card">
                        <img src="{{str_replace('public','/storage',$product->image)}}" class="card-img-top" alt="عکس محصول">
                        <div class="card-body">
                            <div class="card-title">
                                <p>عکس اصلی</p>
                            </div>
                        </div>
                    </div>
                </div>
                @foreach($pictures as $picture)
                    <div class="col-md-6 col-xl-4 height-card box-margin">
                        <div class="card">
                            <img src="{{str_replace('public','/storage',$picture->path)}}" class="card-img-top" alt="عکس محصول">
                            <div class="card-body">
                                <form method="post" action="{{route('products.pictures.destroy',['picture'=>$picture,'product'=>$product])}}">
                                    @csrf
                                    @method("DELETE")
                                    <input type="submit" class="btn btn-danger" value="حذف">
                                </form>
                            </div>
                        </div>
                    </div>
                @endforeach

            </div>
        </div>
    </div>
@endsection
