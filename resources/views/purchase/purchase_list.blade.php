<x-app-layout>
    @push('css')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/fontawesome.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/2.1.5/css/dataTables.dataTables.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/3.1.2/css/buttons.dataTables.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    @endpush
    <div class="container mt-5">
        <div class="row">
            <div class="card">
                <div class="card-header">
                    <a href="{{ route('purchase.create') }}" class="btn btn-primary">Create Purchase +</a>
                </div>
                <div class="card-body">
                    <div class="col-12 row">
                        <form action="" method="POST">
                            <div class="col-12 row">
                                <div class="col-3 mr-2">
                                    <label for="supplier_name" class="font-bold mb-2">Supplier <span class="text-danger">*</span> </label>
                                    <select name="supplier_name" id="supplier_name" class="form-control">
                                        <option value="" selected disabled>All Supplier</option>
                                        <option value="1">Kajal Bormon</option>
                                    </select>
                                </div>
                                <div class="col-3 mr-2">
                                    <label for="start_date" class="font-bold mb-2">Start Date <span class="text-danger">*</span></label>
                                    <input type="date" class="form-control" name="start_date" id="start_date">
                                </div>
                                <div class="col-3 mr-2">
                                    <label for="end_date" class="font-bold mb-2">End Date <span class="text-danger">*</span></label>
                                    <input type="date" class="form-control" name="end_date" id="end_date">
                                </div>
                                <div class="col-2">
                                    <label class="mb-2">&nbsp;</label>
                                    <input type="submit" value="Search" class="btn btn-primary form-control">
                                </div>
                            </div>
                        </form>
                    </div>
                    <br><br>
                    <div class="col-md-12 row">
                        <table class="tabel table-bordered" id="example">
                            <thead>
                                <th>Supplier</th>
                                <th>Order No</th>
                                <th>Product</th>
                                <th>Price</th>
                                <th>Date</th>
                                <th>Quantity</th>
                                <th>Subtotal</th>
                                <th>Status</th>
                                <th>Action</th>
                            </thead>
                            <tbody>
                                @foreach ($orders as $order)
                                
                                <tr>
                                    <td>{{ $order->supplier->name }}</td>
                                    <td>{{ $order->order_no }}</td>
                                    <td>{{ $order->product->name }}</td>
                                    <td>{{ $order->price }}</td>
                                    <td>{{ $order->created_at }}</td>
                                    <td>{{ $order->qty }}</td>
                                    <td>{{ $order->subtotal }}</td>
                                    <td>
                                        @if($order->status == '1')
                                        <span class="badge badge-info">
                                            Pending
                                        </span>
                                        @elseif($order->status == '2')
                                        <span class="badge badge-success">
                                            Delivered
                                        </span>
                                        @elseif($order->status == '3')
                                        <span class="badge badge-danger">
                                            Failed
                                        </span>
                                        @endif

                                    </td>
                                    <td>
                                       <a href="{{ route('purchase.delete', $order->id) }}" >
                                            <span class="bg-danger p-2 rounded ">
                                                <i class="fa fa-trash text-white"></i>
                                            </span>
                                       </a>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="card-footer">

                </div>
            </div>
        </div>
    </div>
    @push('script')
    <script src="https://code.jquery.com/jquery-3.7.1.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <script src="https://cdn.datatables.net/2.1.5/js/dataTables.js"></script>
    <script src="https://cdn.datatables.net/buttons/3.1.2/js/dataTables.buttons.js"></script>
    <script src="https://cdn.datatables.net/buttons/3.1.2/js/buttons.dataTables.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.10.1/jszip.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.7/pdfmake.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.7/vfs_fonts.js"></script>
    <script src="https://cdn.datatables.net/buttons/3.1.2/js/buttons.html5.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/3.1.2/js/buttons.print.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/3.1.2/js/buttons.colVis.min.js"></script>

    <script>
      new DataTable('#example', {
        layout: {
            topStart: {
                buttons: [
                    {
                        extend: 'copyHtml5',
                        text: '<i class="fa fa-files-o"></i> Copy',
                        titleAttr: 'Copy'
                    },
                    {
                        extend: 'csvHtml5',
                        text: '<i class="fa fa-file-text-o"></i> Export to CSV',
                        titleAttr: 'CSV'
                    },
                    {
                        extend: 'excelHtml5',
                        text: '<i class="fa fa-file-excel-o"></i> Export to Excel',
                        titleAttr: 'Excel'
                    },
                    {
                        extend: 'print',
                        text: '<i class="fa fa-print"></i> Print',
                        titleAttr: 'Print'
                    },
                    {
                        extend: 'colvis',
                        text: '<i class="fa fa-columns"></i> Column visibility',
                        titleAttr: 'Column visibility'
                    }
                ]
            }
        }
    });

    // CSS for button background color
    const style = document.createElement('style');
    style.innerHTML = `
        div.dt-buttons > .dt-button {
            background-color: #7629F3; /* Change this color as needed */
            color: white;
            border: none;
        }
        div.dt-buttons > .dt-button:hover:not(.disabled),
        div.dt-buttons > div.dt-button-split .dt-button:hover:not(.disabled) {
            background-color: #7629F3; /* Change this color as needed */
            color: white;
            border: none;
        }
        #example_info{
            color: #7629F3;
        }
        div.dt-container .dt-paging .dt-paging-button.current{
            background: #7629F3;
            color: white !important;
        }
    `;
    document.head.appendChild(style);

    </script>
    @endpush
</x-app-layout>
