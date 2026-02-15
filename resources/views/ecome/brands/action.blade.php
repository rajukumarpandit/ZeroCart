<div class="dropdown">
    <button class="btn btn-sm btn-light border-0" data-bs-toggle="dropdown">
        <i class="bi bi-three-dots-vertical"></i>
    </button>

    <ul class="dropdown-menu dropdown-menu-end">
        @if(!$brand->trashed())
            <li>
                <a class="dropdown-item" href="{{ route('admin.brands.edit',$brand->id) }}">
                    <i class="bi bi-pencil me-2 text-primary"></i>Edit
                </a>
            </li>

            <li><hr class="dropdown-divider"></li>

            <li>
                <form method="POST"
                      action="{{ route('admin.brands.destroy',$brand->id) }}"
                      onsubmit="return confirm('Move to trash?')">
                    @csrf @method('DELETE')
                    <button class="dropdown-item text-danger">
                        <i class="bi bi-trash me-2"></i>Delete
                    </button>
                </form>
            </li>
        @else
            <li>
                <form method="POST" action="{{ route('admin.brands.restore',$brand->id) }}">
                    @csrf
                    <button class="dropdown-item text-success">
                        <i class="bi bi-arrow-counterclockwise me-2"></i>Restore
                    </button>
                </form>
            </li>

            <li>
                <form method="POST"
                      action="{{ route('admin.brands.forceDelete',$brand->id) }}"
                      onsubmit="return confirm('Permanent delete?')">
                    @csrf @method('DELETE')
                    <button class="dropdown-item text-danger">
                        <i class="bi bi-x-circle me-2"></i>Delete Permanently
                    </button>
                </form>
            </li>
        @endif
    </ul>
</div>
