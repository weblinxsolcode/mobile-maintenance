{{-- Submit Offer Modal --}}
<div class="modal fade" id="submitOfferModal{{ $appliedJobs->id }}" tabindex="-1" aria-labelledby="submitOfferModalLabel"
    aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="submitOfferModalLabel">Submit Offer</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="{{ route('shop.appliedJobs.submitOffer', $appliedJobs->id) }}" method="POST">
                    @csrf
                    <input type="hidden" name="user_id" value="{{ $appliedJobs->user_id }}">

                    <div class="mb-3">
                        <div class="row g-3">
                            <div class="col-md-6">
                                <label for="price" class="form-label">Price</label>
                                <input type="number" class="form-control" id="price" placeholder="Enter Price"
                                    name="price" required>
                            </div>
                            <div class="col-md-6">
                                <label for="time" class="form-label">Time</label>
                                <input type="number" class="form-control" id="time"
                                    placeholder="Enter Time in hour" name="time" required>
                            </div>
                            <div class="col-md-6" id="warrantyCol">
                                <label for="warranty" class="form-label">Warranty</label>
                                <select name="warranty" id="warranty" class="form-control">
                                    <option value="1">Yes</option>
                                    <option value="0" selected>No</option>
                                </select>
                            </div>

                            <!-- Months column – appears only when Yes -->
                            <div class="col-md-6" id="monthsCol" style="display: none;">
                                <label for="warranty_months" class="form-label">Warranty Period (months)</label>
                                <input type="number" class="form-control" id="warranty_months" name="warranty_months"
                                    placeholder="Enter months">
                            </div>
                        </div>




                    </div>
                    <div class="mb-3">
                        <label for="description" class="form-label">Description</label>
                        <textarea style="height: 100px" class="form-control" placeholder="Enter Description" id="description" name="description"
                            rows="3" required></textarea>
                    </div>
                    <button type="submit" class="btn btn-primary"><i class="fe fe-save"></i>Submit Offer</button>
                </form>
            </div>
        </div>
    </div>
</div>
<script>
    const warrantySelect = document.getElementById('warranty');
    const warrantyCol = document.getElementById('warrantyCol');
    const monthsCol = document.getElementById('monthsCol');

    function adjustLayout() {
        if (warrantySelect.value === '1') { // Yes
            // Show months column
            monthsCol.style.display = 'block';
            // Warranty column takes half width (col-md-6)
            warrantyCol.className = 'col-md-6';
        } else { // No
            // Hide months column
            monthsCol.style.display = 'none';
            // Clear months value
            document.getElementById('warranty_months').value = '';
            // Warranty column takes full width (col-md-12)
            warrantyCol.className = 'col-md-12';
        }
    }

    warrantySelect.addEventListener('change', adjustLayout);
    adjustLayout(); // initial run
</script>


@if($existingOffer)
    

<div class="modal fade" id="editOfferModal{{ $appliedJobs->id }}" tabindex="-1">
    <div class="modal-dialog">
        <form action="{{ route('shop.appliedJobs.submitOfferUpdate', $existingOffer->id ?? 0) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Edit Offer for {{ $appliedJobs->brand }} {{ $appliedJobs->model }}</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label>Price</label>
                                <input type="number" name="price" class="form-control" placeholder="Enter Price"
                                    value="{{ $existingOffer->price }}" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label>Time (hours)</label>
                                <input type="number" name="time" class="form-control" placeholder="Enter Time"
                                    value="{{ $existingOffer->time }}" required>
                            </div>
                        </div>
                    </div>

                    <div class="row">

                        <div class="col-md-6" id="warrantyselect">
                            <div class="mb-3">
                                <label>Warranty</label>
                                <select name="warranty" id="warranty_edit_{{ $appliedJobs->id }}"
                                    class="form-control">

                                    <option value="1" {{ $existingOffer->warranty == 1 ? 'selected' : '' }}>Yes
                                    </option>
                                    <option value="0" {{ $existingOffer->warranty == 0 ? 'selected' : '' }}>No
                                    </option>

                                </select>
                            </div>
                        </div>

                        <div class="col-md-6" id="warranty_months_edit_{{ $appliedJobs->id }}"
                            style="display: {{ $existingOffer->warranty == 1 ? 'block' : 'none' }}">

                            <div class="mb-3">
                                <label>Warranty Period (months)</label>
                                <input type="number" name="warranty_months" placeholder="Enter months"
                                    class="form-control" value="{{ $existingOffer->warranty_months }}">
                            </div>

                        </div>

                    </div>

                    <div class="row">
                        <div class="col-md-12">
                            <div class="mb-3">
                                <label>Description</label>
                                <textarea name="description" placeholder="Enter Description" style="height: 100px" class="form-control" rows="3" required>{{ $existingOffer->description }}</textarea>
                            </div>
                        </div>
                    </div>
                </div>


                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Update Offer</button>
                </div>
            </div>
        </form>
    </div>
</div>
@endif
<script>
    document.addEventListener('DOMContentLoaded', function () {
    
        const select = document.getElementById('warranty_edit_{{ $appliedJobs->id }}');
        const months = document.getElementById('warranty_months_edit_{{ $appliedJobs->id }}');
        const warrantyCol = document.getElementById('warrantyselect');
    
        function toggleWarranty() {
            const isYes = select.value === '1';
    
            months.style.display = isYes ? 'block' : 'none';
    
            if (!isYes) {
                const input = months.querySelector('input');
                if (input) input.value = '';
            }
    
            // IMPORTANT FIX
            warrantyCol.className = isYes ? 'col-md-6' : 'col-md-12';
        }
    
        if (select) {
            select.addEventListener('change', toggleWarranty);
    
            // 🔥 THIS LINE WAS MISSING (your main bug)
            toggleWarranty();
        }
    
    });
    </script>
