<x-app-layout>
    <div class="container mt-5">
        <div class="row flex justify-center">
            <form action="{{ route('category.update',$category->id) }}" method="post">
                @csrf
                @method('PUT')
                <div class="card col-5">
                    <div class="card-header">Category Information</div>
                    <div class="card-body">
                        <label for="name" class="font-bold mb-2">Category Name</label>
                        <input type="text" name="category_name" placeholder="Category Name" class="form-control" id="" value="{{ $category->name }}" {{ old('category_name') }}>
                        @error('category_name')
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
