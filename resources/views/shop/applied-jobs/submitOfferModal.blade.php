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
                <form action="{{ route('shop.appliedJobs.submitOffer', $appliedJobs->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" name="user_id" value="{{ $appliedJobs->user_id }}">

                    <div class="mb-3">
                        <label for="title" class="form-label">Offer Title</label>
                        <input type="text" class="form-control" id="title" placeholder="Enter Offer Title (e.g. Premium Screen Replacement)" name="title" required>
                    </div>

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
                    <div class="mb-3">
                        <label class="form-label fw-bold text-dark">Supported Device Models (Optional)</label>
                        <div class="row g-2 mb-2">
                            <div class="col-md-5">
                                <select id="submit_offer_brand_select" class="form-control">
                                    <option value="">Select Brand</option>
                                    @foreach($brandsWithModels as $b)
                                        <option value="{{ $b->id }}">{{ $b->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-5">
                                <select id="submit_offer_model_select" class="form-control" disabled>
                                    <option value="">Select Model</option>
                                </select>
                            </div>
                            <div class="col-md-2">
                                <button type="button" id="btn_submit_add_device_model" class="btn btn-outline-primary w-100" disabled>
                                    <i class="fe fe-plus"></i>
                                </button>
                            </div>
                        </div>
                        <div id="submit_selected_models_list" class="d-flex flex-wrap gap-2 mt-2"></div>
                    </div>

                    <div class="mb-3">
                        <label for="image" class="form-label">Offer Image (optional)</label>
                        <input type="file" class="form-control" id="image" name="image" accept="image/*">
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
        <form action="{{ route('shop.appliedJobs.submitOfferUpdate', $existingOffer->id ?? 0) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Edit Offer for {{ $appliedJobs->brand }} {{ $appliedJobs->model }}</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="mb-3">
                                <label class="form-label">Offer Title</label>
                                <input type="text" name="title" class="form-control" placeholder="Enter Offer Title"
                                    value="{{ $existingOffer->title }}" required>
                            </div>
                        </div>
                    </div>
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

                    <div class="row mb-3">
                        <div class="col-md-12">
                            <label class="form-label fw-bold text-dark">Supported Device Models (Optional)</label>
                            <div class="row g-2 mb-2">
                                <div class="col-md-5">
                                    <select id="edit_offer_brand_select" class="form-control">
                                        <option value="">Select Brand</option>
                                        @foreach($brandsWithModels as $b)
                                            <option value="{{ $b->id }}">{{ $b->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-md-5">
                                    <select id="edit_offer_model_select" class="form-control" disabled>
                                        <option value="">Select Model</option>
                                    </select>
                                </div>
                                <div class="col-md-2">
                                    <button type="button" id="btn_edit_add_device_model" class="btn btn-outline-primary w-100" disabled>
                                        <i class="fe fe-plus"></i>
                                    </button>
                                </div>
                            </div>
                            <div id="edit_selected_models_list" class="d-flex flex-wrap gap-2 mt-2">
                                @if(!empty($existingOffer->device_models))
                                    @foreach($existingOffer->device_models_data as $model)
                                        <span class="badge bg-secondary text-white d-inline-flex align-items-center gap-2 px-3 py-2 me-1 mb-1" id="model_badge_edit_selected_models_list_{{ $model->id }}" style="border-radius: 20px;">
                                            {{ $model->brand->name ?? '' }} - {{ $model->name }}
                                            <i class="fe fe-x" style="cursor: pointer; font-size: 11px;" onclick="removeSelectedModelDevice('edit_selected_models_list', {{ $model->id }})"></i>
                                            <input type="hidden" name="device_models[]" value="{{ $model->id }}">
                                        </span>
                                    @endforeach
                                @endif
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-12">
                            <div class="mb-3">
                                <label class="form-label">Offer Image (optional)</label>
                                <input type="file" name="image" class="form-control" accept="image/*">
                                @if($existingOffer->image)
                                    <div class="mt-2">
                                        <label class="d-block text-muted small">Current Image:</label>
                                        <img src="{{ asset($existingOffer->image) }}" class="img-thumbnail" style="max-height: 100px; width: auto;">
                                    </div>
                                @endif
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

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const brandsData = @json($brandsWithModels ?? []);

        // Helper to setup Brand/Model selector
        function setupModelSelector(brandSelectId, modelSelectId, addButtonId, listId, inputName) {
            const brandSelect = document.getElementById(brandSelectId);
            const modelSelect = document.getElementById(modelSelectId);
            const addButton = document.getElementById(addButtonId);
            const listContainer = document.getElementById(listId);

            if (!brandSelect || !modelSelect || !addButton || !listContainer) return;

            // Keep track of selected model IDs
            const selectedIds = new Set();

            // Populate selectedIds from already rendered inputs if any (for edit mode)
            listContainer.querySelectorAll('input[type="hidden"]').forEach(input => {
                selectedIds.add(parseInt(input.value));
            });

            // Brand selection changed
            brandSelect.addEventListener('change', function () {
                const brandId = parseInt(this.value);
                modelSelect.innerHTML = '<option value="">Select Model</option>';
                addButton.disabled = true;

                if (brandId) {
                    const brand = brandsData.find(b => b.id === brandId);
                    if (brand && brand.child) {
                        brand.child.forEach(model => {
                            if (!selectedIds.has(model.id)) {
                                const opt = document.createElement('option');
                                opt.value = model.id;
                                opt.textContent = model.name;
                                modelSelect.appendChild(opt);
                            }
                        });
                        modelSelect.disabled = false;
                    }
                } else {
                    modelSelect.disabled = true;
                }
            });

            // Model selection changed
            modelSelect.addEventListener('change', function () {
                addButton.disabled = !this.value;
            });

            // Add button clicked
            addButton.addEventListener('click', function () {
                const brandId = parseInt(brandSelect.value);
                const modelId = parseInt(modelSelect.value);

                if (!brandId || !modelId) return;
                if (selectedIds.has(modelId)) return;

                const brandName = brandSelect.options[brandSelect.selectedIndex].text;
                const modelName = modelSelect.options[modelSelect.selectedIndex].text;

                // Add to tracking set
                selectedIds.add(modelId);

                // Create badge element
                const badge = document.createElement('span');
                badge.className = 'badge bg-secondary text-white d-inline-flex align-items-center gap-2 px-3 py-2 me-1 mb-1';
                badge.id = `model_badge_${listId}_${modelId}`;
                badge.style.borderRadius = '20px';
                badge.innerHTML = `
                    ${brandName} - ${modelName}
                    <i class="fe fe-x" style="cursor: pointer; font-size: 11px;" onclick="removeSelectedModelDevice('${listId}', ${modelId})"></i>
                    <input type="hidden" name="${inputName}" value="${modelId}">
                `;
                listContainer.appendChild(badge);

                // Reset selection
                brandSelect.value = '';
                modelSelect.innerHTML = '<option value="">Select Model</option>';
                modelSelect.disabled = true;
                addButton.disabled = true;
            });

            // Expose global remove handler for list
            window.removeSelectedModelDevice = function (targetListId, removeId) {
                const container = document.getElementById(targetListId);
                const badge = document.getElementById(`model_badge_${targetListId}_${removeId}`);
                if (badge) {
                    badge.remove();
                    selectedIds.delete(removeId);
                }
            };
        }

        setupModelSelector('submit_offer_brand_select', 'submit_offer_model_select', 'btn_submit_add_device_model', 'submit_selected_models_list', 'device_models[]');
        setupModelSelector('edit_offer_brand_select', 'edit_offer_model_select', 'btn_edit_add_device_model', 'edit_selected_models_list', 'device_models[]');
    });
</script>
