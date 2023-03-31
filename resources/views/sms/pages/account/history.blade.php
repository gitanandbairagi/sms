@extends('sms.pages.account.layout')

@section('page-content')
    <div class="tab-content" id="custom-content-above-tabContent">
        <div class="tab-pane fade show active" id="custom-content-above-home" role="tabpanel"
            aria-labelledby="custom-content-above-home-tab">

            <form action="" method="get">
                <div class="row mt-2">
                    <div class="col-md-3">
                        <input type="text" name="from" class="form-control date" placeholder="From Date" />
                    </div>
                    <div class="col-md-3">
                        <input type="text" name="to" class="form-control date" placeholder="To Date" />
                    </div>
                    <div class="col-md-3">
                        <button type="submit" class="btn btn-primary">Search</button>
                    </div>
                </div>
            </form>

            @if (actual_link() != url('account/history'))
                <div class="card mt-3">
                    <div class="card-header">
                        <h3 class="card-title">History</h3>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <table id="example1" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>Date & Time</th>
                                    <th>Purpose</th>
                                    <th>Details</th>
                                    <th>Amount DR/CR</th>
                                    <th>Balance</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($data['accounts'] as $value)
                                    <tr>
                                        <td>{{ date('d-m-Y h:i:s', strtotime($value->created_at)) }}</td>
                                        @if (isset($value['transaction']))
                                            <td>{{ $value['transaction']->reason }}</td>
                                            <td>{{ 'Received from ' . $value['transaction']['user']->first_name . ' ' . $value['transaction']['user']->last_name }}
                                            </td>
                                        @else
                                            <td>Withdraw</td>
                                            <td>Withdrawal by Admin</td>
                                        @endif
                                        @if ($value->credit_debit == 'cr')
                                            <td class="text-success">{{ 'Rs. ' . money_format_india($value->amount) . ' Cr' }}
                                            </td>
                                        @else
                                            <td class="text-danger">{{ 'Rs. ' . money_format_india($value->amount) . ' Cr' }}
                                            </td>
                                        @endif
                                        <td class="text-success">{{ 'Rs. ' . money_format_india($value->balance) }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                            <tfoot>
                                <tr>
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
            @else
                <div class="col-md-12 mt-2">
                    <h6 class="text-muted text-emphasis">Please search with any field to get data</h6>
                </div>
            @endif
        @endsection
