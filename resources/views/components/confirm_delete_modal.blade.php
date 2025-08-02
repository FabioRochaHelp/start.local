<!-- Modal HTML -->
<div class="modal fade" id="confirmDeleteModal" tabindex="-1" role="dialog"  aria-labelledby="confirmDeleteModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header bg-danger">
                <h3 class="modal-title has-icon text-white"><i class="flaticon-alert-1"></i> Informação Importante!</h3>
                <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true" class="text-white">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                {{ $message }}
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-light" data-bs-dismiss="modal">Cancelar</button>
                <form action="{{ $route }}"  style="display:inline;">
                    @csrf
                    {{-- @method('DELETE') --}}
                    <button type="submit" class="btn btn-primary">Confirmar</button>
                </form>
            </div>
        </div>
    </div>
</div>


<!-- Trigger Script -->
<script>
    function showModal(route, message) {
        $('#confirmDeleteModal form').attr('action', route);
        $('#confirmDeleteModal .modal-body').text(message || 'Are you sure you want to delete this record?');
        $('#confirmDeleteModal').modal('show');
    }
</script>
