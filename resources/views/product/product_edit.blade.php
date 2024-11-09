<x-app-layout>
    <div class="container mt-5">
        <div class="row">
            <div class="create-heading">Supplier Create</div>
            <div class="card">
                <div class="card-header">
                    <div style="font-size: 20px">Supplier Information</div>
                </div>
                <div class="card-body form-design">
                    <form action="{{ route('product.update', $product->id) }}" method="post" id="form">
                        @csrf
                        @method('PUT')
                        <div class="row">
                            <div class="col-2 mb-2">
                                <div class="md-2">
                                    <label for="name" class="font-bold">Name <span class="text-danger">*</span></label>
                                </div>
                            </div>
                            <div class="col-9 mb-2">
                                <input type="text" name="name" id="name" class="form-control" placeholder="Enter Name" {{ old('name') }} value="{{ $product->name }}">
                            </div>
                            @error('name')
                                <span class="alert alert-danger">{{ $message }}</span>
                            @enderror

                            <div class="col-2 mb-2">
                                <div class="md-2">
                                    <label for="name" class="font-bold">Price <span class="text-danger">*</span></label>
                                </div>
                            </div>
                            <div class="col-9 mb-2">
                                <input type="text" name="price" id="price" class="form-control" placeholder="Enter Name" {{ old('name') }} value="{{ $product->price }}">
                            </div>
                            @error('name')
                                <span class="alert alert-danger">{{ $message }}</span>
                            @enderror

                            <div class="col-2 mb-2">
                                <div class="md-2">
                                    <label for="status">Status <span class="text-danger">*</span></label>
                                </div>
                            </div>
                            <div class="col-9 mb-2">
                               {{--  {{ ($supplier->status=='1') ? "Active" : "Inactive" }} --}}

                                <div class="d-inline-flex align-items-center">
                                    <input type="radio" name="status" value="1" id="status-active" class="custom-radio d-none" {{ old('status') }} {{ ($product->status=='1') ? "checked" : "" }}>
                                    <label for="status-active" class="custom-label mr-2">Active</label>

                                    <input type="radio" name="status" value="0" id="status-inactive" class="custom-radio d-none" {{ old('status') }} {{ ($product->status=='0') ? "checked" : "" }}>
                                    <label for="status-inactive" class="custom-label">Inactive</label>
                                </div>
                            </div>
                        </div>
                </div>
                        <div class="card-footer">
                            <button type="submit" class="btn btn-primary btn-sm save">Save</button>
                            <a href="" class="btn btn-danger float-end">Cancel</a>
                        </div>
                    </form>
            </div>
        </div>
    </div>
</x-app-layout>
