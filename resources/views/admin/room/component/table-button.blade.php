<div class="d-flex justify-content-center">
    <a href="{{ route('admin.room.show', $item->id) }}" class="btn btn-sm btn-light-primary me-2">
        <i class="ki-duotone ki-eye fs-6 me-1">
            <span class="path1"></span>
            <span class="path2"></span>
        </i>
        Detay
    </a>
    <a href="{{ route('admin.room.edit', $item->id) }}" class="btn btn-sm btn-light-warning me-2">
        <i class="ki-duotone ki-pencil fs-6 me-1">
            <span class="path1"></span>
            <span class="path2"></span>
        </i>
        Düzenle
    </a>
    <a href="{{ route('admin.room.destroy', $item->id) }}" class="btn btn-sm btn-light-danger" onclick="return confirm('Bu odayı silmek istediğinizden emin misiniz?')">
        <i class="ki-duotone ki-trash fs-6 me-1">
            <span class="path1"></span>
            <span class="path2"></span>
        </i>
        Sil
    </a>
</div>

