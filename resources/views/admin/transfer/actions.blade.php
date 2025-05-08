<div class="d-flex justify-content-end flex-shrink-0">
    <a href="{{ route('admin.transfer.edit', $transfer->id) }}" class="btn btn-icon btn-bg-light btn-active-color-primary btn-sm me-1">
        <i class="ki-duotone ki-pencil fs-2">
            <span class="path1"></span>
            <span class="path2"></span>
        </i>
    </a>
    <a href="{{ route('admin.transfer.destroy', $transfer->id) }}" class="btn btn-icon btn-bg-light btn-active-color-primary btn-sm delete-confirm">
        <i class="ki-duotone ki-trash fs-2">
            <span class="path1"></span>
            <span class="path2"></span>
            <span class="path3"></span>
            <span class="path4"></span>
            <span class="path5"></span>
        </i>
    </a>
</div>

@push('scripts')
<script>
    $(document).ready(function() {
        $('.delete-confirm').on('click', function(e) {
            e.preventDefault();
            var url = $(this).attr('href');
            
            Swal.fire({
                title: 'Emin misiniz?',
                text: "Bu işlem geri alınamaz!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Evet, sil!',
                cancelButtonText: 'İptal',
                buttonsStyling: false,
                customClass: {
                    confirmButton: 'btn btn-danger',
                    cancelButton: 'btn btn-light'
                }
            }).then((result) => {
                if (result.isConfirmed) {
                    window.location.href = url;
                }
            });
        });
    });
</script>
@endpush 