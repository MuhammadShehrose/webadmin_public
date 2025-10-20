@can($viewPermission)
    @if ($viewUrl)
        <a class="btn bg-secondary-transparent btn-sm" href="{{ $viewUrl }}">Detail</a>
    @endif
@endcan

@can($editPermission)
    @if ($editUrl)
        <a class="btn bg-warning-transparent btn-sm" href="{{ $editUrl }}">Edit</a>
    @endif
@endcan

@can($deletePermission)
    @if ($deleteUrl)
        <form action="{{ $deleteUrl }}" class="d-inline confirmable-form" method="POST" data-action="delete">
            @csrf
            @method('DELETE')
            <button class="btn bg-danger-transparent btn-sm">Delete</button>
        </form>
    @endif
@endcan

@can($restorePermission)
    @if ($restoreUrl)
        <form action="{{ $restoreUrl }}" class="d-inline confirmable-form" method="POST" data-action="restore">
            @csrf
            <button class="btn bg-success-transparent btn-sm">Restore</button>
        </form>
    @endif
@endcan

@can($forceDeletePermission)
    @if ($forceDeleteUrl)
        <form action="{{ $forceDeleteUrl }}" class="d-inline confirmable-form" method="POST" data-action="force_delete">
            @csrf
            <button class="btn bg-danger-transparent btn-sm">Permanent Delete</button>
        </form>
    @endif
@endcan

@section('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            document.querySelectorAll('.confirmable-form').forEach(form => {
                form.addEventListener('submit', function(e) {
                    e.preventDefault(); // stop immediate submit

                    let actionType = this.dataset.action;
                    let title = "Are you sure?";
                    let text = "You want to delete this record permanently?";
                    let icon = "warning";
                    let confirmButtonText = "Yes, delete it!";

                    if (actionType === "restore") {
                        title = "Restore Record?";
                        text = "Do you want to restore this record?";
                        icon = "info";
                        confirmButtonText = "Yes, restore it!";
                    }
                    else if(actionType === "delete") {
                        title = "Delete Record?";
                        text = "Do you want to delete this record?";
                        icon = "info";
                        confirmButtonText = "Yes, delete it!";
                    }

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
