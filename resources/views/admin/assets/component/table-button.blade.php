<button type="button" class="btn btn-icon btn-light-primary btn-sm me-1" data-bs-toggle="tooltip" title="Düzenle">
    <a href="{{ route('admin.assets.edit', $asset->id) }}">
        <i class="ki-duotone ki-pencil fs-2">
            <span class="path1"></span>
            <span class="path2"></span>
        </i>
    </a>
</button>

<form action="{{ route('admin.assets.destroy', $asset->id) }}" method="POST" class="d-inline">
    @csrf
    @method('DELETE')
    <button type="submit" class="btn btn-icon btn-light-danger btn-sm delete-asset" data-bs-toggle="tooltip" title="Sil">
        <i class="ki-duotone ki-trash fs-2">
            <span class="path1"></span>
            <span class="path2"></span>
            <span class="path3"></span>
            <span class="path4"></span>
            <span class="path5"></span>
        </i>
    </button>
</form> 