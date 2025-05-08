<div class="d-flex justify-content-end flex-shrink-0">
    <a href="{{ route('admin.staff.schedules.edit', $schedule->id) }}" class="btn btn-icon btn-bg-light btn-active-color-primary btn-sm me-1">
        <i class="fas fa-edit"></i>
    </a>
    <form action="{{ route('admin.staff.schedules.destroy', $schedule->id) }}" method="POST" class="d-inline">
        @csrf
        @method('DELETE')
        <button type="submit" class="btn btn-icon btn-bg-light btn-active-color-primary btn-sm" onclick="return confirm('Bu çalışma programını silmek istediğinizden emin misiniz?')">
            <i class="fas fa-trash"></i>
        </button>
    </form>
</div> 