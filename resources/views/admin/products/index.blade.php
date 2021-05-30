@extends("admin.layout.master")
@section('title','مدیریت محصولات')
@section("content",)
<div class="main-content">
    <div class="data-table-area">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12 box-margin">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title mb-2">محصولات</h4>
                            <a class="btn btn-success font-14 mb-4" href="{{ route("products.create") }}">
                                اضافه کردن محصول جدید
                            </a>

                            @if(session()->has('success'))
                                <div class="alert alert-success">
                                    <span class="closebtn" onclick="this.parentElement.style.display='none';">× </span>
                                    <strong>{{session()->get('success')}}</strong>
                                </div>
                            @endif

                            <table id="datatable-buttons" class="table table-striped dt-responsive nowrap w-100">
                                <thead>
                                <tr>
                                    <th>#</th>
                                    <th>عنوان</th>
                                    <th>قیمت</th>
                                    <th>تصویر</th>
                                    <th>برند</th>
                                    <th>موضوع</th>
                                    <th>تاریخ ایجاد</th>
                                    <th></th>
                                    <th></th>
                                    <th></th>
                                    <th></th>

                                </tr>
                                </thead>

                                <tbody>
                                @foreach($products as $product)
                                    <tr>
                                        <td>{{ $product->id }}</td>
                                        <td>{{ $product->title }}</td>
                                        <td> تومان{{ $product->cost }}</td>
                                        <td>
                                            <img width="100px" src="{{ str_replace('public','/storage',$product->image) }}" alt="product image">
                                        </td>
                                        <td> {{ $product->brand->name }}</td>
                                        <td> {{ $product->category->title }}</td>
                                        <td>{{ $product->created_at }}</td>
                                        <td>
                                            @if($product->discount)
                                                <a class="btn btn-fill-info" href="{{route('discount.edit',$product)}}">تخفیف: {{$product->discount->value}}%</a>
                                            @else
                                                <a class="btn btn-fill-info" href="{{route('discount.create',$product)}}">تخفیف</a>
                                            @endif
                                        </td>
                                        <td><a class="btn btn-fill-warning" href="{{route('products.pictures',$product)}}">تصاویر</a></td>
                                        <td>
                                                <!-- Button trigger modal -->
                                                    <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#exampleModalScrollable{{ $product->id }}">
                                                        حذف
                                                    </button>

                                                    <!-- Modal -->
                                                    <div class="modal fade" id="exampleModalScrollable{{ $product->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalScrollableTitle" aria-hidden="true">
                                                        <div class="modal-dialog modal-dialog-scrollable" role="document">
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <h5 class="modal-title" id="exampleModalScrollableTitle">آیا از حذف محصول  {{ $product->title }} مطمنئید؟</h5>
                                                                    <button type="button" class="close" data-dismiss="modal" aria-label="بستن">
                                                                        <span aria-hidden="true">×</span>
                                                                    </button>
                                                                </div>
                                                                <div class="modal-body">
                                                                    توجه داشته باشید که برای حذف یک محصول از قبل باید تمامی محصولات موجود در آن محصول را حذف کرده باشید در غیر اینصورت محصول حذف نخواهد شد.
                                                                </div>
                                                                <div class="modal-footer">
                                                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">بستن</button>
                                                                    <form action="{{route('products.destroy',$product)}}" method="POST">
                                                                        @csrf
                                                                        @method("DELETE")
                                                                        <button type="submit" class="btn btn-danger">حذف</button>
                                                                    </form>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                        </td>
                                        <td>
                                            <a class="btn btn-primary" href="{{route('products.edit',$product)}}">
                                                ویرایش
                                            </a>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>

                        </div> <!-- end card body-->
                    </div> <!-- end card -->
                </div><!-- end col-->
            </div>
            <!-- end row-->
        </div>
    </div>
</div>

@endsection
