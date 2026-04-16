@foreach ($appliedJobs as $item)
    {{-- Delete Modal --}}
    <div class="modal fade" id="deleteManagement{{ $item->id }}" tabindex="-1"
        aria-labelledby="deleteManagementLabel{{ $item->id }}" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="deleteManagementLabel{{ $item->id }}">Confirm
                        Deletion</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body text-center">
                    Are you sure you want to delete this applied job?
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <a href="{{ route('shop.orders.delete', $item->id) }}" class="btn btn-danger">
                        Yes, Delete
                    </a>
                </div>
            </div>
        </div>
    </div>

    {{-- Update Status Modal --}}
    <div class="modal fade" id="updateStatus{{ $item->id }}" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header border-0">
                    <h5 class="modal-title">Update Job Status</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <form action="{{ route('shop.appliedJobs.status', $item->id) }}" method="POST">
                    @csrf

                    <div class="modal-body">
                        <div class="mb-3">
                            <label class="form-label fw-bold">Select Status</label>
                            <select name="status" id="statusSelect_{{ $item->id }}" class="form-select" required>

                                <option value="accepted" {{ $item->status == 'accepted' ? 'selected' : '' }}>
                                    Accepted
                                </option>

                                <option value="pending" {{ $item->status == 'pending' ? 'selected' : '' }}>Pending
                                </option>

                            </select>
                        </div>


                    </div>
                    <div class="modal-footer border-0">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-primary">
                            <i class="fa fa-save me-1"></i> Update Status
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endforeach
