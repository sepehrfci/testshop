@extends("admin.layout.master")

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
                                @foreach($categories as $category)
                                    <tr>
                                        <td>{{ $category->id }}</td>
                                        <td>{{ $category->title }}</td>
                                        <td>
                                            @if(!empty($category->category_id))
                                                {{$category->parent->title}}
                                            @else
                                                ندارد
                                            @endif
                                        </td>
                                        <td>{{ $category->created_at }}</td>
                                        <td>
                                                <!-- Button trigger modal -->
                                                    <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#exampleModalScrollable{{ $category->id }}">
                                                        حذف
                                                    </button>

                                                    <!-- Modal -->
                                                    <div class="modal fade" id="exampleModalScrollable{{ $category->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalScrollableTitle" aria-hidden="true">
                                                        <div class="modal-dialog modal-dialog-scrollable" role="document">
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <h5 class="modal-title" id="exampleModalScrollableTitle">آیا از حذف موضوع  {{ $category->title }} مطمنئید؟</h5>
                                                                    <button type="button" class="close" data-dismiss="modal" aria-label="بستن">
                                                                        <span aria-hidden="true">×</span>
                                                                    </button>
                                                                </div>
                                                                <div class="modal-body">
                                                                    توجه داشته باشید که برای حذف یک موضوع از قبل باید تمامی محصولات موجود در آن موضوع را حذف کرده باشید در غیر اینصورت موضوع حذف نخواهد شد.
                                                                </div>
                                                                <div class="modal-footer">
                                                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">بستن</button>
                                                                    <form action="{{route('category.destroy',$category)}}" method="POST">
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
                                            <a class="btn btn-primary" href="{{route('category.edit',$category)}}">
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
