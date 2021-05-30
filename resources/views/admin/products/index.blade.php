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
                                    <th>عکس ها</th>
                                    <th>حذف</th>
                                    <th>ویرایش</th>

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
                                        <td><a class="btn btn-fill-warning" href="{{route('products.pictures',$product)}}">مدریت عکس ها</a></td>
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
                                    @if(!is_null($product->children))
                                        @foreach($product->children as $child)
                                            <tr>
                                                <td>{{ $child->id }}</td>
                                                <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;- {{ $child->title }}</td>
                                                <td>
                                                    @if(!empty($child->category_id))
                                                        {{$child->parent->title}}
                                                    @else
                                                        ندارد
                                                    @endif
                                                </td>
                                                <td>{{ $child->created_at }}</td>
                                                <td>
                                                    <!-- Button trigger modal -->
                                                    <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#exampleModalScrollable{{ $child->id }}">
                                                        حذف
                                                    </button>

                                                    <!-- Modal -->
                                                    <div class="modal fade" id="exampleModalScrollable{{ $child->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalScrollableTitle" aria-hidden="true">
                                                        <div class="modal-dialog modal-dialog-scrollable" role="document">
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <h5 class="modal-title" id="exampleModalScrollableTitle">آیا از حذف محصول  {{ $child->title }} مطمنئید؟</h5>
                                                                    <button type="button" class="close" data-dismiss="modal" aria-label="بستن">
                                                                        <span aria-hidden="true">×</span>
                                                                    </button>
                                                                </div>
                                                                <div class="modal-body">
                                                                    توجه داشته باشید که برای حذف یک محصول از قبل باید تمامی محصولات موجود در آن محصول را حذف کرده باشید در غیر اینصورت محصول حذف نخواهد شد.
                                                                </div>
                                                                <div class="modal-footer">
                                                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">بستن</button>
                                                                    <form action="{{route('category.destroy',$child)}}" method="POST">
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
                                                    <a class="btn btn-primary" href="{{route('category.edit',$child)}}">
                                                        ویرایش
                                                    </a>
                                                </td>
                                            </tr>
                                            @if(!is_null($child->children))
                                                @foreach($child->children as $child2)
                                                    <tr>
                                                        <td>{{ $child2->id }}</td>
                                                        <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;- {{ $child2->title }}</td>
                                                        <td>
                                                            @if(!empty($child2->category_id))
                                                                {{$child2->parent->title}}
                                                            @else
                                                                ندارد
                                                            @endif
                                                        </td>
                                                        <td>{{ $child2->created_at }}</td>
                                                        <td>
                                                            <!-- Button trigger modal -->
                                                            <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#exampleModalScrollable{{ $child2->id }}">
                                                                حذف
                                                            </button>

                                                            <!-- Modal -->
                                                            <div class="modal fade" id="exampleModalScrollable{{ $child2->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalScrollableTitle" aria-hidden="true">
                                                                <div class="modal-dialog modal-dialog-scrollable" role="document">
                                                                    <div class="modal-content">
                                                                        <div class="modal-header">
                                                                            <h5 class="modal-title" id="exampleModalScrollableTitle">آیا از حذف محصول  {{ $child2->title }} مطمنئید؟</h5>
                                                                            <button type="button" class="close" data-dismiss="modal" aria-label="بستن">
                                                                                <span aria-hidden="true">×</span>
                                                                            </button>
                                                                        </div>
                                                                        <div class="modal-body">
                                                                            توجه داشته باشید که برای حذف یک محصول از قبل باید تمامی محصولات موجود در آن محصول را حذف کرده باشید در غیر اینصورت محصول حذف نخواهد شد و همچنین در صورتی که محصول والد باشد باید تمامی محصولات مولد آن حذف شده تا قابل حذف کردن باشد.
                                                                        </div>
                                                                        <div class="modal-footer">
                                                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">بستن</button>
                                                                            <form action="{{route('category.destroy',$child2)}}" method="POST">
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
                                                            <a class="btn btn-primary" href="{{route('category.edit',$child2)}}">
                                                                ویرایش
                                                            </a>
                                                        </td>
                                                    </tr>
                                                @endforeach
                                            @endif
                                        @endforeach
                                    @endif
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
