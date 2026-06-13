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

        <div class="row">
            <div class="col-md-12">

                <div class="card">
                    <div class="card-body">

                        <form action="{{ route('shop.services.store') }}" method="POST" enctype="multipart/form-data">
                            @csrf

                            <div class="row g-3">

                                <!-- Title -->
                                <div class="col-md-4">
                                    <label class="form-label">Service Title</label>
                                    <input type="text" name="title" class="form-control" required>
                                </div>

                                <!-- Description -->
                                <div class="col-md-8">
                                    <label class="form-label">Description</label>
                                    <textarea name="description" class="form-control" required></textarea>
                                </div>

                                <!-- Cover Image -->
                                <div class="col-md-4">
                                    <label class="form-label">Cover Image</label>
                                    <input type="file" name="cover_image" class="form-control" accept="image/*" required>
                                </div>

                                <!-- Status -->
                                <div class="col-md-4">
                                    <label class="form-label">Status</label>
                                    <select name="status" class="form-control" required>
                                        <option value="active">Active</option>
                                        <option value="pending">Pending</option>
                                    </select>
                                </div>


                                <hr>

                                <!-- BRAND -->
                                <div class="col-md-4">
                                    <label class="form-label">Brand</label>
                                    <select name="brand" id="brand-select" class="form-select" required>
                                        <option value="">Select Brand</option>
                                        @foreach($brandsWithModels as $brandOption)
                                            <option value="{{ $brandOption->name }}">{{ $brandOption->name }}</option>
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
                                    <input type="number" name="price" class="form-control">
                                </div>

                                <!-- DISCOUNT -->
                                <div class="col-md-4">
                                    <label class="form-label">Discount</label>
                                    <input type="number" name="discount" class="form-control">
                                </div>

                                <!-- SKILLS (MULTIPLE) -->
                                <div class="col-md-8">
                                    <label class="form-label">Skills (comma separated)</label>
                                    <input type="text" name="skills" class="form-control"
                                           placeholder="Glass Replacement, LCD Repair">
                                </div>

                                <!-- SUBMIT -->
                                <div class="col-md-12 text-end">
                                    <button type="submit" class="btn btn-primary">
                                        <i class="fa fa-save me-2"></i> Save Service
                                    </button>
                                </div>

                            </div>
                        </form>

                    </div>
                </div>

            </div>
        </div>

    </div>
    <script>
        const brandsData = @json($brandsWithModels);
        
        document.getElementById('brand-select').addEventListener('change', function() {
            const brandName = this.value;
            const modelSelect = document.getElementById('model-select');
            
            modelSelect.innerHTML = '<option value="">Select Model</option>';
            
            if (brandName) {
                const selectedBrand = brandsData.find(b => b.name === brandName);
                if (selectedBrand && selectedBrand.child) {
                    selectedBrand.child.forEach(model => {
                        const option = document.createElement('option');
                        option.value = model.name;
                        option.textContent = model.name;
                        modelSelect.appendChild(option);
                    });
                }
            }
        });
    </script>
</div>
@endsection