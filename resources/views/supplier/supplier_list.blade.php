<x-app-layout>
    @push('css')
        <link rel="stylesheet" href="https://cdn.datatables.net/2.1.5/css/dataTables.dataTables.css">
        <link rel="stylesheet" href="https://cdn.datatables.net/buttons/3.1.2/css/buttons.dataTables.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
        <link rel="stylesheet" href="{{ asset('assets/sweetalert.min.css') }}">
        <link rel="stylesheet" href="{{ asset('assets/style.css') }}">
    @endpush
    <div class="container mt-5">
        <div class="row">
            <h2 class="supplier-heading">Supplier</h2>
           <x-message></x-message>
            <div class="card">
                <div class="card-header">
                    <a href="{{ route('supplier.create') }}" class="btn btn-primary">Create Supplier+</a>
                </div>
                <div class="card-body">
                    <table id="example" class="table table-bordered">
                        <thead>
                            <th>S/L</th>
                            <th>Name</th>
                            <th>Mobile No.</th>
                            <th>Email</th>
                            <th>Address</th>
                            <th>Status</th>
                            <th>Action</th>
                        </thead>
                        <tbody>
                            <?php $count=1; ?>
                            @foreach ($suppliers as $supplier)
                            <tr>
                                <td>{{ $count++ }}</td>
                                <td>{{ $supplier->name }}</td>
                                <td>{{ $supplier->phone }}</td>
                                <td>{{ $supplier->email }}</td>
                                <td>{{ $supplier->address }}</td>
                                <td>
                                    <span class="badge">
                                        @if($supplier->status == '1') Active @else Intactive @endif
                                    </span>
                                </td>
                                <td>
                                    <a href="{{ route('supplier.edit', $supplier->id) }}">
                                        <span class="bg-primary p-2 rounded text-white"><i class="fa fa-pen-to-square"></i></span>
                                    </a>

                                    <a href="{{ route('supplier.delete', $supplier->id) }}" class="delete alert">
                                        <span class="bg-danger p-2 rounded ">
                                            <i class="fa fa-trash text-white"></i>
                                        </span>
                                    </a>
                                    </form>

                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    @push('script')
        <script src="https://code.jquery.com/jquery-3.7.1.js"></script>
        {{-- Sweetalert  --}}
        <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js" integrity="sha512-AA1Bzp5Q0K1KanKKmvN/4d3IRKVlv9PYgwFPvm32nPO6QS8yH1HO7LbgB1pgiOxPtfeg5zEn2ba64MUcqJx6CA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
        {{-- ---------------------- --}}

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
        <script type="text/javascript">
            function Confirmation(e){
                e.preventDefault();
                var url = e.currentTarget.getAttribute('href');
                swal({
                    title : 'Are you sure to delete this?',
                    text : "This will be Permanat",
                    icon : 'warning',
                    buttons : true,
                    dangerMode : true,

                }).then(willCancel)=>{
                    if(willCancel){
                        window.location.href = url;
                    }
                };
            }
        </script>
    @endpush
</x-app-layout>

