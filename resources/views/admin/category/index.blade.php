@extends("admin.layout.master")
@section('title','مدیریت موضوعات')
@section("content",)
<div class="main-content">
    <div class="data-table-area">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12 box-margin">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title mb-2">موضوعات</h4>
                            <a class="btn btn-success font-14 mb-4" href="{{ route("category.create") }}">
                                اضافه کردن موضوع جدید
                            </a>


                            <table id="datatable-buttons" class="table table-striped dt-responsive nowrap w-100">
                                <thead>
                                <tr>
                                    <th>#</th>
                                    <th>عنوان</th>
                                    <th>موضوع والد</th>
                                    <th>تایخ ایجاد</th>
                                    <th>حذف</th>
                                    <th>ویرایش</th>

                                </tr>
                                </thead>

                                <tbody>
                                @foreach($categories as $parent)
                                    <tr>
                                        <td>{{ $parent->id }}</td>
                                        <td>------- {{ $parent->title }} -------</td>
                                        <td>
                                            @if(!empty($parent->category_id))
                                                {{$parent->parent->title}}
                                            @else
                                                ندارد
                                            @endif
                                        </td>
                                        <td>{{ $parent->created_at }}</td>
                                        <td>
                                                <!-- Button trigger modal -->
                                                    <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#exampleModalScrollable{{ $parent->id }}">
                                                        حذف
                                                    </button>

                                                    <!-- Modal -->
                                                    <div class="modal fade" id="exampleModalScrollable{{ $parent->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalScrollableTitle" aria-hidden="true">
                                                        <div class="modal-dialog modal-dialog-scrollable" role="document">
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <h5 class="modal-title" id="exampleModalScrollableTitle">آیا از حذف موضوع  {{ $parent->title }} مطمنئید؟</h5>
                                                                    <button type="button" class="close" data-dismiss="modal" aria-label="بستن">
                                                                        <span aria-hidden="true">×</span>
                                                                    </button>
                                                                </div>
                                                                <div class="modal-body">
                                                                    توجه داشته باشید که برای حذف یک موضوع از قبل باید تمامی محصولات موجود در آن موضوع را حذف کرده باشید در غیر اینصورت موضوع حذف نخواهد شد.
                                                                </div>
                                                                <div class="modal-footer">
                                                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">بستن</button>
                                                                    <form action="{{route('category.destroy',$parent)}}" method="POST">
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
                                            <a class="btn btn-primary" href="{{route('category.edit',$parent)}}">
                                                ویرایش
                                            </a>
                                        </td>
                                    </tr>
                                    @if(!is_null($parent->children))
                                        @foreach($parent->children as $child)
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
                                                                    <h5 class="modal-title" id="exampleModalScrollableTitle">آیا از حذف موضوع  {{ $child->title }} مطمنئید؟</h5>
                                                                    <button type="button" class="close" data-dismiss="modal" aria-label="بستن">
                                                                        <span aria-hidden="true">×</span>
                                                                    </button>
                                                                </div>
                                                                <div class="modal-body">
                                                                    توجه داشته باشید که برای حذف یک موضوع از قبل باید تمامی محصولات موجود در آن موضوع را حذف کرده باشید در غیر اینصورت موضوع حذف نخواهد شد.
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
                                                                            <h5 class="modal-title" id="exampleModalScrollableTitle">آیا از حذف موضوع  {{ $child2->title }} مطمنئید؟</h5>
                                                                            <button type="button" class="close" data-dismiss="modal" aria-label="بستن">
                                                                                <span aria-hidden="true">×</span>
                                                                            </button>
                                                                        </div>
                                                                        <div class="modal-body">
                                                                            توجه داشته باشید که برای حذف یک موضوع از قبل باید تمامی محصولات موجود در آن موضوع را حذف کرده باشید در غیر اینصورت موضوع حذف نخواهد شد و همچنین در صورتی که موضوع والد باشد باید تمامی موضوعات مولد آن حذف شده تا قابل حذف کردن باشد.
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
