@extends('layouts.master')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Quick Notes</h3>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="mb-5">
                                <textarea class="form-control" id="notes" rows="10" placeholder="Notlarınızı buraya yazabilirsiniz..."></textarea>
                            </div>
                            <div class="text-end">
                                <button type="button" class="btn btn-primary" id="saveNotes">
                                    <span class="indicator-label">Kaydet</span>
                                    <span class="indicator-progress">
                                        Lütfen bekleyin... <span class="spinner-border spinner-border-sm align-middle ms-2"></span>
                                    </span>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
    $(document).ready(function() {
        // Load saved notes
        const savedNotes = localStorage.getItem('quickNotes');
        if (savedNotes) {
            $('#notes').val(savedNotes);
        }

        // Save notes
        $('#saveNotes').on('click', function() {
            const notes = $('#notes').val();
            localStorage.setItem('quickNotes', notes);
            
            // Show success message
            toastr.success('Notlar başarıyla kaydedildi.');
        });
    });
</script>
@endpush 