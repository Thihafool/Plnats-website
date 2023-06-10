@extends('admin.layouts.app')
@section('content')
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Trend List Page</h3>

                <div class="card-tools">
                    <div class="input-group input-group-sm" style="width: 150px;">
                        <input type="text" name="table_search" class="form-control float-right" placeholder="Search">

                        <div class="input-group-append">
                            <button type="submit" class="btn btn-default">
                                <i class="fas fa-search"></i>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
            <!-- /.card-header -->
            <div class="card-body table-responsive p-0">
                <table class="table table-hover text-nowrap text-center">
                    <thead>
                        <tr>
                            <th> ID</th>
                            <th>Post Title</th>
                            <th>Image</th>
                            <th>View Count</th>

                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($post as $p)
                            <tr>

                                <td>{{ $p->post_id }}</td>
                                <td>{{ $p->title }}</td>
                                <td><img class="rounded shadow-sm" width="100px"
                                        @if ($p->image == null) src="{{ asset('defaultImg/photo_gallery.webp') }}"
                                @else
                                src="{{ asset('storage/' . $p->image) }}" @endif
                                        alt=""></td>
                                <td><i class="fa-solid fa-eye"></i> {{ $p->post_count }}</td>
                                <td>
                                    <a href="{{ route('admin#trendPostDetails', $p['post_id']) }}">
                                        <button class="btn btn-sm bg-dark text-white"><i
                                                class="fa-solid fa-memo-circle-info"></i></button>

                                    </a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                <div class="d-flex justify-content-center">
                    {{-- {{ $post->links() }} --}}

                </div>
            </div>
            <!-- /.card-body -->
        </div>
        <!-- /.card -->
    </div>
@endsection
