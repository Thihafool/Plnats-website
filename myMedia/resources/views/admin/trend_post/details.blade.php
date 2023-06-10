@extends('admin.layouts.app')
@section('content')
    <div class="col-6 offset-3">
        <div class="card-header">
            <a href="{{ route('admin#trendPost') }}"> <i class="fa-solid fa-arrow-left text-dark"></i>
            </a>
            <div class="text-center">
                <img class="rounded shadow-sm" width="200px"
                    @if ($post->image == null) src="{{ asset('defaultImg/photo_gallery.webp') }}"
                @else
                src="{{ asset('storage/' . $post->image) }}" @endif
                    alt="">
            </div>
        </div>
        <div class="card-body">
            <h3 class="text-center">{{ $post['title'] }}</h3>
            <p class="text-center">{{ $post->description }}</p>
        </div>
        <!-- /.card -->
    </div>
@endsection
{{-- onclick= "history.back()" --}}
