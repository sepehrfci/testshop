@extends("admin.layout.master")
@section('title','ویرایش تخفیف')

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
                                <h4 class="card-title">ویرایش تخفیف برای {{ $product->title }}</h4>
                                <form action="{{route('discount.update',$product)}}" method="POST" >
                                    @csrf
                                    @method("patch")
                                    <label for="discount">درصد تخفیف : </label>
                                    <input value="{{$product->discount->value}}" type="number" min="1" max="100" id="discount" name="discount" >
                                    @error('discount') <p class="text-danger">{{$message}}</p> @enderror
                                    <input class="btn btn-primary form-control mt-15" type="submit" value="ارسال">
                                </form>
                                <form action="{{route('discount.destroy',$product)}}" method="post">
                                    @csrf
                                    @method("delete")
                                    <input type="submit" class="btn btn-danger form-control mt-15" value="حذف تخفیف">
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
