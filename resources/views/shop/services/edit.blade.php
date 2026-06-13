@extends('shop.layout.main')

@section('section')
<div class="page-wrapper">
    <div class="content container-fluid">

        <div class="page-header">
            <div class="row">
                <div class="col-sm-12">
                    <h3 class="page-title">{{ $title }}</h3>
                </div>
            </div>
        </div>

        @php
            $getMeta = fn($type) => optional($metas->where('type', $type)->first())->value;
            $skills = $metas->where('type', 'skill')->pluck('value')->toArray();
        @endphp

        <div class="card">
            <div class="card-body">

                <form action="{{ route('shop.services.update', $service->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('post')

                    <div class="row g-3">

                        <!-- Title -->
                        <div class="col-md-6">
                            <label class="form-label">Service Title</label>
                            <input type="text" name="title" class="form-control"
                                   value="{{ $service->title }}" required>
                        </div>

                        <!-- Cover Image -->
                        <div class="col-md-6">
                            <label class="form-label">Cover Image</label>
                            <input type="file" name="cover_image" class="form-control" accept="image/*">

                            @if($service->cover_image)
                                <img src="{{ asset( 'jobs/' . $service->cover_image ) }}" width="120" class="mt-2">
                            @endif
                        </div>

                        <!-- Description -->
                        <div class="col-md-12">
                            <label class="form-label">Description</label>
                            <textarea style="height: 100px;" name="description" class="form-control" required>{{ $service->description }}</textarea>
                        </div>

                        <hr>

                        <!-- BRAND -->
                        <div class="col-md-4">
                            <label class="form-label">Brand</label>
                            <select name="brand" id="brand-select" class="form-select" required>
                                <option value="">Select Brand</option>
                                @foreach($brandsWithModels as $brandOption)
                                    <option value="{{ $brandOption->name }}" {{ $getMeta('brand') == $brandOption->name ? 'selected' : '' }}>
                                        {{ $brandOption->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <!-- MODEL -->
                        <div class="col-md-4">
                            <label class="form-label">Model</label>
                            <select name="model" id="model-select" class="form-select" required>
                                <option value="">Select Model</option>
                            </select>
                        </div>

                        <!-- PRICE -->
                        <div class="col-md-4">
                            <label class="form-label">Price</label>
                            <input type="number" name="price" class="form-control"
                                   value="{{ $getMeta('price') }}">
                        </div>

                        <!-- DISCOUNT -->
                        <div class="col-md-6">
                            <label class="form-label">Discount</label>
                            <input type="number" name="discount" class="form-control"
                                   value="{{ $getMeta('discount') }}">
                        </div>

                        <!-- SKILLS -->
                        <div class="col-md-6">
                            <label class="form-label">Skills (comma separated)</label>
                            <input type="text" name="skills" class="form-control"
                                   value="{{ implode(',', $skills) }}"
                                   placeholder="Glass Replacement, LCD Repair">
                        </div>

                        <!-- SUBMIT -->
                        <div class="col-md-12 text-end">
                            <button type="submit" class="btn btn-primary">
                                Update Service
                            </button>
                        </div>

                    </div>
                </form>

            </div>
        </div>

    </div>
    <script>
        const brandsData = @json($brandsWithModels);
        const currentBrand = "{{ $getMeta('brand') }}";
        const currentModel = "{{ $getMeta('model') }}";

        const brandSelect = document.getElementById('brand-select');
        const modelSelect = document.getElementById('model-select');

        function populateModels(brandName, selectedModel = '') {
            modelSelect.innerHTML = '<option value="">Select Model</option>';
            if (brandName) {
                const selectedBrand = brandsData.find(b => b.name === brandName);
                if (selectedBrand && selectedBrand.child) {
                    selectedBrand.child.forEach(model => {
                        const option = document.createElement('option');
                        option.value = model.name;
                        option.textContent = model.name;
                        if (model.name === selectedModel) {
                            option.selected = true;
                        }
                        modelSelect.appendChild(option);
                    });
                }
            }
        }

        // Initialize if brand is selected
        if (currentBrand) {
            populateModels(currentBrand, currentModel);
        }

        // Handle changes
        brandSelect.addEventListener('change', function() {
            populateModels(this.value);
        });
    </script>
</div>
@endsection