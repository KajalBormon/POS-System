<x-app-layout>
    <div class="container mt-5">
        <div class="row flex justify-center">
            <form action="{{ route('category.store') }}" method="post">
                @csrf
                <div class="card col-5">
                    <div class="card-header">Category Information</div>
                    <div class="card-body">
                        <label for="name" class="font-bold mb-2">Category Name</label>
                        <input type="text" name="category_name" placeholder="Category Name" class="form-control" id="">
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
