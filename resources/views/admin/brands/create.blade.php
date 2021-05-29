@extends("admin.layout.master")
@section('title','ایجاد برند جدید')

@section("content")
    <!-- Main Content Area -->
    <div class="main-content">
        <!-- Basic Form area Start -->
        <div class="container-fluid">
            <!-- Form row -->
            <div class="row">
                <div class="col-xl-12 box-margin height-card">
                    <div class="card">
                        <div class="card-body">
                            <div class="stacked-form-area">
                                <h4 class="card-title">برند جدید </h4>
                                <form action="{{route('brands.store')}}" method="POST" enctype="multipart/form-data">
                                    @csrf
                                    @if($errors)
                                        @foreach ($errors->all() as $error)
                                            <div class="alert bg-danger">
                                                <span class="closebtn" onclick="this.parentElement.style.display='none';">× </span>
                                                <strong>خطا -</strong> {{$error}}
                                            </div>
                                        @endforeach
                                    @endif
                                    <label for="name">نام برند</label>
                                    <input type="text" id="name" name="name" placeholder="نام برند را وارد کنید">
                                    <label for="image">لوگو برند</label>
                                    <input class="file" type="file" name="image" id="image">
                                    <input class="btn btn-primary btn-block mt-15" type="submit" value="ارسال">
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- end row -->
        </div>
    </div>
@endsection
