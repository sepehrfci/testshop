@extends("admin.layout.master")
@section('title','ایجاد تخفیف جدید')

@section("content")
    <!-- Main Content Area -->
    <div class="main-content">
        <!-- Basic Form area Start -->
        <div class="container-fluid">
            <!-- Form row -->
            <div class="row">
                <div class="col-xl-6 box-margin height-card">
                    <div class="card">
                        <div class="card-body">
                            <div class="stacked-form-area">
                                <h4 class="card-title">ایجاد تخفیف برای {{ $product->title }}</h4>
                                <form action="{{route('discount.store',$product)}}" method="POST" >
                                    @csrf
                                    <label for="discount">درصد تخفیف : </label>
                                    <input class="black" type="number" min="1" max="100" id="discount" name="discount" >
                                    @error('discount') <p class="text-danger">{{$message}}</p> @enderror
                                    <input class="btn btn-primary form-control mt-15" type="submit" value="ارسال">
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
