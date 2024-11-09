<x-app-layout>
    <div class="container mt-5">
        <div class="row">
            <div class="create-heading">Product Create</div>
            <div class="card">
                <div class="card-header">
                    <div style="font-size: 20px">Product Information</div>
                </div>
                <div class="card-body form-design">
                    <form action="{{ route('product.store') }}" method="post" id="form">
                        @csrf
                        <div class="row">
                            <div class="col-2 mb-2">
                                <div class="md-2">
                                    <label for="name" class="font-bold">Name <span class="text-danger">*</span></label>
                                </div>
                            </div>

                            <div class="col-9 mb-2">
                                <input type="text" name="name" id="name" class="form-control" placeholder="Enter Name">
                            </div>

                            <div class="col-2 mb-2">
                                <div class="md-2">
                                    <label for="name" class="font-bold">Price <span class="text-danger">*</span></label>
                                </div>
                            </div>

                            <div class="col-9 mb-2">
                                <input type="text" name="price" id="price" class="form-control" placeholder="Enter Price">
                            </div>

                            <div class="col-2 mb-2">
                                <div class="md-2">
                                    <label for="name" class="font-bold">Brand Name <span class="text-danger">*</span></label>
                                </div>
                            </div>

                            <div class="col-9 mb-2">
                                <select name="brand_name" id="" class="form-control">
                                    @foreach ($brands as $brand)
                                    <option value="{{ $brand->name }}">{{ $brand->name }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="col-2 mb-2">
                                <div class="md-2">
                                    <label for="name" class="font-bold">Category Name <span class="text-danger">*</span></label>
                                </div>
                            </div>

                            <div class="col-9 mb-2">
                                <select name="category_name" id="" class="form-control">
                                    @foreach ($categories as $category)
                                    <option value="{{ $category->name }}">{{ $category->name }}</option>
                                    @endforeach
                                </select>
                            </div>


                            <div class="col-2 mb-2">
                                <div class="md-2">
                                    <label for="status">Status <span class="text-danger">*</span></label>
                                </div>
                            </div>
                            <div class="col-9 mb-2">
                                <div class="d-inline-flex align-items-center">
                                    <input type="radio" name="status" id="status-active" class="custom-radio d-none" value="1">
                                    <label for="status-active" class="custom-label mr-2">Active</label>

                                    <input type="radio" name="status" id="status-inactive" class="custom-radio d-none" value="0">
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
