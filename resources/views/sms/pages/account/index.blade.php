@extends('sms.pages.account.layout')

@section('page-content')
    <div class="tab-content" id="custom-content-above-tabContent">
        <div class="tab-pane fade show active" id="custom-content-above-home" role="tabpanel"
            aria-labelledby="custom-content-above-home-tab">

            @if (session('role') == 'admin')
                <div class="col-md-12">
                    <button type="button" class="btn btn-default bg-gradient-primary" data-toggle="modal"
                        data-target="#payMaintenanceModal">
                        Pay Maintenance
                    </button>
                    @if (session('role') == 'admin')
                    <button type="button" class="btn btn-default bg-gradient-primary" data-toggle="modal"
                        data-target="#setMaintenanceModal">
                        Set Maintenance
                    </button>
                    <button type="button" class="btn btn-default bg-gradient-primary" data-toggle="modal"
                    data-target="#withdrawFundModal">
                    Withdraw from Fund
                </button>
                    @endif
                </div>
            @endif

            <div class="col-md-12">
                {{-- session flash success and error alerts --}}
                @if (session()->has('error'))
                    <div class="alert alert-danger alert-dismissible fade show mt-2" role="alert">
                        <strong>Error</strong> {{ session('error') }}
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                @endif
                @if (session()->has('success'))
                    <div class="alert alert-success alert-dismissible fade show mt-2" role="alert">
                        <strong>Success!</strong> {{ session('success') }}
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                @endif
            </div>

            <div class="card mt-2">
                <div class="card-header">
                    <h3 class="card-title">{{ 'Available Balance: '.money_format_india($data['available_balance']).' INR' }}</h3>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                    <table id="example1" class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th data-orderable="false">Date & Time</th>
                                <th data-orderable="false">Purpose</th>
                                <th data-orderable="false">Details</th>
                                <th data-orderable="false">Amount DR/CR</th>
                                <th data-orderable="false">Balance</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($data['accounts'] as $value)
                                <tr>
                                    <td>{{ date('d-m-Y h:i:s', strtotime($value->created_at)) }}</td>
                                    @if (isset($value['transaction']))
                                        <td>{{ $value['transaction']->reason }}</td>
                                        <td>{{ 'Received from '.$value['transaction']['user']->first_name.' '.$value['transaction']['user']->last_name }}</td>
                                    @else
                                        <td>Withdraw</td>
                                        <td>Withdrawal by Admin</td>
                                    @endif
                                    @if ($value->credit_debit == 'cr')
                                    <td class="text-success">{{ 'Rs. '.money_format_india($value->amount).' Cr' }}</td>
                                    @else
                                    <td class="text-danger">{{ 'Rs. '.money_format_india($value->amount).' Cr' }}</td>
                                    @endif
                                    <td class="text-success">{{ 'Rs. '.money_format_india($value->balance) }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                        <tfoot>
                            <tr>
                                <th style="display: none">No.</th>
                                <th>Date & Time</th>
                                <th>Purpose</th>
                                <th>Details</th>
                                <th>Amount DR/CR</th>
                                <th>Balance</th>
                            </tr>
                        </tfoot>
                    </table>
                </div>
                <!-- /.card-body -->
            </div>
            <!-- /.card -->
        </div>
    </div>
    
    {{-- Add Pay Maintenance Modal --}}
    <div class="modal fade" id="payMaintenanceModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content">
                <form id="payMaintenanceForm" enctype="multipart/form-data">
                    @csrf
                    <input name="reason" type="hidden" class="form-control" value="maintenance">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Pay Maintenance</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="form-row">
                            <div class="col-sm-12 my-1">
                                <input type="text" class="form-control"
                                    value="{{ 'For Month: ' . \Carbon\Carbon::now()->format('M') }}" readonly>
                            </div>
                            <div class="col-sm-12 my-1">
                                <input name="amount" type="hidden" class="form-control" value="{{ $data['maintenance_amount'] }}">
                                <input type="text" class="form-control" value="{{ 'Amount: '.$data['maintenance_amount'].' INR' }}" readonly>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button id="btnFetchPayMaintenance" type="button" class="btn btn-primary btn-block">Pay</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    {{-- /.Add Pay Maintenance Modal --}}

    {{-- Add Withdraw Fund Modal --}}
    <div class="modal fade" id="withdrawFundModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content">
                <form id="withdrawFundForm" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Withdraw from Fund</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="form-row">
                            <div class="col-sm-12 my-1">
                                <input type="number" name="amount" class="form-control" placeholder="Amount in INR">
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button id="btnFetchWithdrawFund" type="button" class="btn btn-primary btn-block">Withdraw</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    {{-- /.Add Withdraw Fund Modal --}}

    {{-- Add Set Maintenance Modal --}}
    <div class="modal fade" id="setMaintenanceModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content">
                <form id="setMaintenanceForm" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Set Maintenance</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="form-row">
                            <div class="col-sm-12 my-1">
                                <input type="number" name="amount" class="form-control" placeholder="Amount in INR">
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button id="btnFetchSetMaintenance" type="button" class="btn btn-primary btn-block">Confirm</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    {{-- /.Add Set Maintenance Modal --}}
@endsection

@section('script')
<script>
    let data = {
        0: {
            btnId: "btnFetchPayMaintenance",
            modalId: "payMaintenanceModal",
            formId: "payMaintenanceForm",
            route: "{{ route('payment.cashfree.vindicate') }}"
        },
        1: {
            btnId: "btnFetchWithdrawFund",
            modalId: "withdrawFundModal",
            formId: "withdrawFundForm",
            route: "{{ route('account.withdraw') }}"
        },
        2: {
            btnId: "btnFetchSetMaintenance",
            modalId: "setMaintenanceModal",
            formId: "setMaintenanceForm",
            route: "{{ route('account.set.maintenance') }}"
        }
    }
    for (const key in data) {
        let btn = document.getElementById(data[key]['btnId']);
        btn.addEventListener('click', (e) => {
            let bindData = {
                btnId: '#' + data[key]['btnId'],
                modalId: '#' + data[key]['modalId'],
                route: data[key]['route'],
                method: "POST",
                formId: "#" + data[key]['formId'],
                csrfToken: "{{ csrf_token() }}",
            };
            server_validation(bindData);
        });
    }
</script>
@endsection
