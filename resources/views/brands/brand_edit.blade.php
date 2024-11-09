<x-app-layout>
    <div class="container mt-5">
        <div class="row flex justify-center">
            <form action="{{ route('brand.update', $brand->id) }}" method="post">
                @csrf
                @method('put')
                <div class="card col-5">
                    <div class="card-header">Brand Update</div>
                    <div class="card-body">
                        <label for="name" class="font-bold mb-2">Brand Name</label>
                        <input type="text" name="brand_name" placeholder="Brand Name" class="form-control" id="" value="{{ $brand->name }}" {{ old('brand_name') }}>
                        @error('brand_name')
                            <span class="alert alert-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="card-footer">
                        <input type="submit" value="Save" class="btn btn-primary">
                        <a href="" class="btn btn-danger float-end">Cancel</a>
                    </div>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>
