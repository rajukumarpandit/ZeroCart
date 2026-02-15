<div class="dropdown">
    <button class="btn btn-sm btn-light border-0" type="button"
            data-bs-toggle="dropdown">
        <i class="bi bi-three-dots-vertical fs-6"></i>
    </button>

    <ul class="dropdown-menu dropdown-menu-end shadow-sm">

        @if(!$category->trashed())
            <li>
                <a class="dropdown-item"
                   href="{{ route('admin.categories.edit', $category->id) }}">
                    <i class="bi bi-pencil me-2 text-primary"></i> Edit
                </a>
            </li>

            <li><hr class="dropdown-divider"></li>

            <li>
                <form method="POST"
                      action="{{ route('admin.categories.destroy', $category->id) }}"
                      onsubmit="return confirm('Move this category to trash?')">
                    @csrf
                    @method('DELETE')
                    <button class="dropdown-item text-danger">
                        <i class="bi bi-trash me-2"></i> Delete
                    </button>
                </form>
            </li>
        @else
            <li>
                <form method="POST"
                      action="{{ route('admin.categories.restore', $category->id) }}">
                    @csrf
                    <button class="dropdown-item text-success">
                        <i class="bi bi-arrow-counterclockwise me-2"></i> Restore
                    </button>
                </form>
            </li>

            <li>
                <form method="POST"
                      action="{{ route('admin.categories.forceDelete', $category->id) }}"
                      onsubmit="return confirm('Permanent delete?')">
                    @csrf
                    @method('DELETE')
                    <button class="dropdown-item text-danger">
                        <i class="bi bi-x-circle me-2"></i> Delete Permanently
                    </button>
                </form>
            </li>
        @endif

    </ul>
</div>
