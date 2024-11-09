<x-app-layout>
    <div class="container mt-5">
        <div class="row">
            <form action="{{ route('purchase.store') }}" method="POST" id="form" class="mb-3">
                @csrf
                <div class="card mb-5">
                    <div class="card-header">
                        <h1 class="supplier_name">All Supplier</h1>
                    </div>
                    <div class="card-body">
                        <div class="col-md-4 mb-3">
                            <select name="supplier_id" id="" class="form-control">
                                @foreach ($suppliers as $supplier)
                                <option value="{{ $supplier->id }}">{{ $supplier->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>
                <div id="form-rows">
                    <div class="flex row">
                        <div class="col-3 mr-1">
                            <label for="product_name" class="mb-2 font-bold">Product<span class="text-danger">*</span></label>
                            <select name="product_id[]" class="form-control name">
                                <option value="">Search Supplier Name</option>
                                @foreach ($products as $product)
                                    <option value="{{ $product->id }}" data-price="{{ $product->price }}">{{ $product->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-2 mr-1">
                            <label for="qty" class="mb-2 font-bold">QTY <span class="text-danger">*</span></label>
                            <input type="number" name="qty[]" placeholder="Qty" class="form-control qty" min="1">
                        </div>
                        <div class="col-2 mr-1">
                            <label for="price" class="mb-2 font-bold">Unit Price <span class="text-danger">*</span></label>
                            <input type="number" name="price[]" placeholder="Unit Price" class="form-control price" readonly>
                        </div>
                        <div class="col-3 mr-1">
                            <label for="subtotal" class="mb-2 font-bold">Sub Total <span class="text-danger">*</span></label>
                            <input type="number" name="subtotal[]" placeholder="Sub Total" class="form-control subtotal" readonly>
                        </div>
                        <div class="col-2 mr-1 mt-4">
                            <a href="javascript:void(0)" class="btn btn-primary add">+</a>
                            <a href="javascript:void(0)" class="btn btn-danger remove">-</a>
                        </div>
                    </div>
                </div>
                {{-- <input type="submit" value="Save" class="btn btn-primary mt-3"> --}}
                <button type="submit" class="btn btn-primary mt-3">Save</button>
            </form>
        </div>
        <div class="row mt-5">
            <div class="card">
                <div class="card-header">
                    <h1 class="totalAmount">Total Amount</h1>
                </div>
                <div class="card-body">
                    <div id="totalShow" style="font-size: 20px;">0</div>
                </div>
            </div>
        </div>
    </div>
    @push('script')
    <script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>

    <script type="text/javascript">
        $(document).ready(function() {
            // Set initial price when product is selected
            $(document).on('change', '.name', function() {
                const row = $(this).closest('.row');
                const price = $(this).find(':selected').data('price');
                row.find('.price').val(price);
                row.find('.qty').val(1); // Set default quantity to 1
                updateSubtotal(row); // Calculate subtotal for the row
            });

            // Update subtotal when quantity changes
            $(document).on('change', '.qty', function() {
                const row = $(this).closest('.row');
                updateSubtotal(row);
            });


            $(document).on('click', '.add', function() {
                const newTable = `
                    <div class="flex row mb-3">
                        <div class="col-3 mr-1">
                            <label for="product_name" class="mb-2 font-bold">Product<span class="text-danger">*</span></label>
                            <select name="product_id[]" class="form-control name">
                                <option value="">Select Product</option>
                                @foreach ($products as $product)
                                    <option value="{{ $product->id }}" data-price="{{ $product->price }}">{{ $product->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-2 mr-1">
                            <label for="qty" class="mb-2 font-bold">QTY <span class="text-danger">*</span></label>
                            <input type="number" name="qty[]" placeholder="Qty" class="form-control qty" min="1">
                        </div>
                        <div class="col-2 mr-1">
                            <label for="price" class="mb-2 font-bold">Unit Price <span class="text-danger">*</span></label>
                            <input type="number" name="price[]" placeholder="Unit Price" class="form-control price" readonly>
                        </div>
                        <div class="col-3 mr-1">
                            <label for="subtotal" class="mb-2 font-bold">Sub Total <span class="text-danger">*</span></label>
                            <input type="number" name="subtotal[]" placeholder="Sub Total" class="form-control subtotal" readonly>
                        </div>
                        <div class="col-2 mr-1 mt-4">
                            <a href="javascript:void(0)" class="btn btn-primary add">+</a>
                            <a href="javascript:void(0)" class="btn btn-danger remove">-</a>
                        </div>
                    </div>`;

                // Append the new row to the container that holds the form rows
                $('#form-rows').append(newTable);
            });

            // Remove row functionality
            $(document).on('click', '.remove', function() {
                if ($('#form-rows .row').length > 1) {
                    $(this).closest('.row').remove();
                } else {
                    alert("At least one row must remain.");
                }
            });













            // Add new row
            /* $(document).on('click', '.add', function() {
                const rowCount = $('#form-rows .row').length; // Get current row count
                const firstRow = $('#form-rows .row:first').clone();

                // Update input names dynamically to avoid overwriting
                firstRow.find('[name^="order["]').each(function() {
                    const name = $(this).attr('name');
                    const newName = name.replace(/\[\d+\]/, `[${rowCount}]`); // Replace index with the current row count
                    $(this).attr('name', newName);
                });

                firstRow.find('input').val(''); // Clear input values in new row
                $('#form-rows').append(firstRow); // Append the new row
            });


            // Remove row
            $(document).on('click', '.remove', function() {
                if ($('#form-rows .row').length > 1) {
                    $(this).closest('.row').remove();
                    updateTotalAmount();
                } else {
                    alert("At least one row must remain.");
                }
            });
 */

            // Function to update subtotal for a row
            function updateSubtotal(row) {
                const qty = row.find('.qty').val();
                const price = row.find('.price').val();
                const subtotal = qty * price;
                row.find('.subtotal').val(subtotal.toFixed(2));
                updateTotalAmount();
            }

            // Function to calculate and display the total amount
            function updateTotalAmount() {
                let totalAmount = 0;
                $('.subtotal').each(function() {
                    totalAmount += parseFloat($(this).val()) || 0;
                });
                $('#totalShow').text(totalAmount.toFixed(2));
            }
        });
    </script>
    @endpush
</x-app-layout>

