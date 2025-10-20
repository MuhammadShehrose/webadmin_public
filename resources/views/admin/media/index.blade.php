@extends('admin.layouts.app')

@section('title', 'Media')

@section('content')
    <div class="page-header">
        <div class="page-leftheader">
            <h4 class="page-title mb-0 text-primary">Media</h4>
        </div>
        <div class="page-rightheader">
            <div class="btn-list">
                <a class="btn btn-outline-primary" href="{{ route('admin.media.index') }}">
                    <i class="mdi mdi-refresh me-2"></i> Refresh
                </a>
            </div>
        </div>
    </div>

    <div class="card shadow-sm">
        <div class="card-header d-flex justify-content-between align-items-center flex-wrap">
            <h5 class="mb-0">Uploaded Files</h5>
            @include('admin.media.filters')
        </div>

        <div class="card-body">
            @if (count($mediaFiles) > 0)
                <style>

                </style>

                {{-- Group by folder --}}
                @foreach ($groupedMedia as $folder => $files)
                    <div class="folder-section">
                        <div class="folder-header">
                            <div class="d-flex align-items-center gap-2">
                                <i class="mdi mdi-folder"></i>
                                <h6 class="mb-0 fw-bold text-dark">{{ ucfirst($folder) }}</h6>
                                <span class="badge bg-light text-dark ms-2">{{ count($files) }} files</span>
                            </div>
                            @can('media.delete_folder')
                                {{-- Delete Folder Button --}}
                                <form action="{{ route('admin.media.deleteFolder') }}" method="POST" class="confirmable-form">
                                    @csrf
                                    @method('post')
                                    <input type="hidden" name="name" value="{{ $folder }}">
                                    <button type="submit" class="btn btn-sm btn-outline-danger d-flex align-items-center">
                                        <i class="mdi mdi-delete me-1"></i> Delete Folder
                                    </button>
                                </form>
                            @endcan
                        </div>

                        <div class="row g-3">
                            @foreach ($files as $file)
                                <div class="col-xl-2 col-lg-3 col-md-4 col-sm-6 col-12">
                                    <div class="card media-card h-100 border-0 shadow-sm">
                                        <div class="card-body text-center p-2 d-flex flex-column justify-content-between">

                                            {{-- File Preview --}}
                                            @if (preg_match('/\.(jpg|jpeg|png|gif|webp|svg)$/i', $file['path']))
                                                <a href="{{ $file['url'] }}" target="_blank">
                                                    <img src="{{ $file['url'] }}" alt="media">
                                                </a>
                                            @else
                                                <div class="d-flex justify-content-center align-items-center bg-light rounded mb-2"
                                                    style="height: 140px;">
                                                    <i class="mdi mdi-file fs-1 text-secondary"></i>
                                                </div>
                                            @endif

                                            {{-- File Info --}}
                                            <div class="mt-2 text-truncate file-info" title="{{ $file['path'] }}">
                                                {{ basename($file['path']) }}
                                            </div>
                                            <div class="text-muted small">
                                                {{ number_format($file['size'] / 1024, 2) }} KB
                                            </div>
                                        </div>

                                        {{-- Delete Button --}}
                                        @can('media.delete')
                                            <div class="card-footer bg-transparent border-0 text-center p-2">
                                                <form action="{{ route('admin.media.destroy') }}" method="POST" class="confirmable-form">
                                                    @csrf
                                                    @method('post')
                                                    <input type="hidden" name="path" value="{{$file['path']}}">
                                                    <button type="submit" class="btn btn-sm btn-outline-danger w-100">
                                                        <i class="mdi mdi-delete me-1"></i> Delete
                                                    </button>
                                                </form>
                                            </div>
                                        @endcan
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                @endforeach
            @else
                <div class="text-center p-5 text-muted">
                    <i class="mdi mdi-folder-open-outline fs-1"></i>
                    <p class="mt-2 mb-0">No media files found.</p>
                </div>
            @endif
        </div>

    </div>
@endsection

@section('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            document.querySelectorAll('.confirmable-form').forEach(form => {
                form.addEventListener('submit', function(e) {
                    e.preventDefault(); // stop immediate submit

                    let actionType = this.dataset.action;
                    let title = "Are you sure?";
                    let text = "You want to delete this permanently?";
                    let icon = "warning";
                    let confirmButtonText = "Yes, delete it!";

                    Swal.fire({
                        title: title,
                        text: text,
                        icon: icon,
                        showCancelButton: true,
                        confirmButtonColor: '#3085d6',
                        cancelButtonColor: '#d33',
                        confirmButtonText: confirmButtonText
                    }).then((result) => {
                        if (result.isConfirmed) {
                            form.submit();
                        }
                    });
                });
            });
        });
    </script>
@endsection
