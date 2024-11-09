<x-app-layout>
    <div class="container mt-5">
        <div class="row">
            <form action="" method="post" id="form">
                <div id="form-rows">
                    <div class="flex row">
                        <div class="col-3 mr-1">
                            <label for="product_name" class="mb-2 font-bold">Product<span class="text-danger">*</span></label>
                            <select name="product_name[]" class="form-control name" id="name">
                                @foreach ($products as $product)
                                    <option value="{{ $product->id }}" data-price="{{ $product->price }}">{{ $product->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-2 mr-1">
                            <label for="qty" class="mb-2 font-bold">QTY <span class="text-danger">*</span></label>
                            <input type="number" name="qty[]" placeholder="Qty" class="form-control qty" min="1" onchange="subTotal();" id="qty">
                        </div>
                        <div class="col-2 mr-1">
                            <label for="price" class="mb-2 font-bold">Unit Price <span class="text-danger">*</span></label>
                            <input type="number" name="price[]" placeholder="Unit Price" class="form-control" id="price" readonly value="{{ $product->price }}">
                        </div>
                        <div class="col-3 mr-1">
                            <label for="subtotal" class="mb-2 font-bold">Sub Total <span class="text-danger">*</span></label>
                            <input type="number" name="subtotal[]" placeholder="Sub Total" class="form-control" id="subtotal" readonly>
                        </div>
                        <div class="col-2 mr-1 mt-4">
                            <a href="javascript:void(0)" class="btn btn-primary add">+</a>
                            <a href="javascript:void(0)" class="btn btn-danger remove">-</a>
                        </div>
                    </div>
                </div>
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

            // Add new row
            $(document).on('click', '.add', function() {
                const firstRow = $('#form-rows .row:first').clone();
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



{{-- <x-app-layout>
    <div class="container mt-5">
        <div class="row">
            <div class="col-8">
                    <div class="card">
                        <div class="card-header">
                            <h1>Purchase Information</h1>
                        </div>
                        <div class="card-body">
                        <form action="" method="post" id="form">
                            <div class="flex">
                                <div class="col-3 mr-2">
                                    <label for="Product Name" class="mb-2 font-bold">Product<span class="text-danger">*</span></label>
                                    <select name="product_name[]" id="name" class="form-control name">
                                        @foreach ($products as $product)
                                            <option value="{{ $product->id }}" data-price="{{ $product->price }}">{{ $product->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-2 mr-2">
                                    <label for="qty" class="mb-2 font-bold qty">QTY <span class="text-danger">*</span></label>
                                    <input type="number" name="qty[]" placeholder="Qty" id="qty" class="form-control" min="1">
                                </div>
                                <div class="col-2 mr-2">
                                    <label for="Unit Price" class="mb-2 font-bold price">Unit Price <span class="text-danger">*</span></label>
                                    <input type="number" name="price[]" placeholder="Unit Price" id="price" class="form-control price" value="{{ $product->price }}" readonly>
                                </div>

                                <div class="col-3 mr-2">
                                    <label for="Unit Price" class="mb-2 font-bold price">Sub Total  <span class="text-danger">*</span></label>
                                    <input type="number" name="subtotal[]" placeholder="Sub Total" id="subtotal" class="form-control price" value="" readonly>
                                </div>
                                <div class="col-2 mr-2 mt-4">
                                    <a href="javascript:void(0)" class="btn btn-primary add">+</a>
                                    <a href="javascript:void(0)" class="btn btn-danger remove">-</a>
                                </div>
                            </div>
                        </form>
                            <div class="table mt-5">
                                <table class="table table-bordered">
                                    <thead>
                                        <th>S/L</th>
                                        <th>Items Details</th>
                                        <th>Qty</th>
                                        <th>Unit Price</th>
                                        <th>Total Price</th>
                                        <th></th>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>1</td>
                                            <td name="title">Coconut Biscuit Alachy</td>
                                            <td>10</td>
                                            <td>1000</td>
                                            <td>100000</td>
                                            <td>
                                                <a href="#" class="delete">
                                                    <span class="bg-danger p-2 rounded ">
                                                        <i class="fa fa-trash text-white"></i>
                                                    </span>
                                                </a>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="card-footer">
                            <input type="submit" value="Save" class="btn btn-primary">
                            <a href="" class="btn btn-danger float-end">Cancel</a>
                        </div>
                    </div>
                </form>
            </div>
            <div class="col-4">
                <div class="card">
                    <div class="card-header">Ohter Information</div>
                    <div class="card-body">
                        <form action="" method="post">
                            <div class="mb-2">
                                <label for="date" class="font-bold mb-2">Date <span class="text-danger">*</span></label>
                                <input type="date" name="date" placeholder="31-11-24" id="" class="form-control">
                            </div>
                            <div class="mb-2">
                                <label for="date" class="font-bold mb-2">Supplier <span class="text-danger">*</span></label>
                                <select name="supplier" id="" class="form-control">
                                    <option value="">Search Name of Supplier</option>
                                    @foreach ($suppliers as $supplier)
                                    <option value="">{{ $supplier->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="mb-2">
                                <label for="date" class="font-bold mb-2">Notes</label>
                                <textarea name="notes" id="" rows="5" class="form-control"></textarea>
                            </div>
                        </form>
                        <div class="total" id="total">0</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @push('script')
        <script type="text/javascript">
            $('.name').on('change', function() {
                document.getElementById('qty').value = 1;
                $('.price').val($(this).find(':selected').data('price'));
            });

            $('#qty').on('change', function(){
                let qty = document.getElementById('qty').value;
                let unitPrice = document.getElementById('price').value;
                let subTotal = document.getElementById('subtotal');
                subtotal.value = (unitPrice * qty);
                let total = subtotal.value;
                /* document.getElementById('total').innerText = total; */
            });

            document.addEventListener('click', function(e) {
                if (e.target.classList.contains('add')) {
                    // Clone the first row in form-rows
                    let firstRow = document.querySelector('#form-rows .row');
                    let newRow = firstRow.cloneNode(true);

                    // Clear input values in the cloned row
                    newRow.querySelectorAll('input').forEach(input => input.value = '');

                    // Append the new row to form-rows
                    document.getElementById('form-rows').appendChild(newRow);

                    // Add data to the table
                    /* addToTable(firstRow); */

                    // Update the total price
                    updatePrice();
                }

                if (e.target.classList.contains('remove')) {
                    let row = e.target.closest('.row');

                    // Ensure there's at least one row remaining
                    if (document.querySelectorAll('#form-rows .row').length > 1) {
                        row.remove();
                        // Remove the corresponding row in the table and update the total
                        document.getElementById('data-table').querySelector('tbody').deleteRow(row.rowIndex - 1);
                        updatePrice();
                    } else {
                        alert("At least one row must remain.");
                    }
                }
            });


        </script>

    @endpush
</x-app-layout> --}}
