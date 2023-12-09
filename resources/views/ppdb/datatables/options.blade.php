<div class="d-flex flex-column flex-md-row justify-content-center" style="gap: 0.5rem">
    <button type="button" class="btn btn-sm btn-primary" data-toggle="modal"
        data-target="#detailModal-{{ $model->id }}">Detail</button>
    @can('ppdb-update')
    <a href="{{ route('admin.ppdb.edit', $model->id) }}" class="btn btn-sm btn-secondary">Edit</a>
    @endcan
    @can('ppdb-delete')
    <span class="btn btn-sm btn-danger" id="deleteButton" data-model-id="{{ $model->id }}">Delete</span>
    @endcan
</div>

{{-- modal --}}
<div class="modal fade" id="detailModal-{{ $model->id }}" tabindex="-1"
    aria-labelledby="detailModal-{{ $model->id }}Label" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="detailModal-{{ $model->id }}Label">Detail</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body p-0">
                <table class="table m-0">
                    <tbody>
                        <tr>
                            <th colspan="2">Payment</th>
                        </tr>
                        <tr>
                            <td>PPDB ID</td>
                            <td>{{ $model->user->transaction->order_id }}</td>
                        </tr>
                        <tr>
                            <td>Status</td>
                            @switch($model->user->transaction->transaction_status)
                                @case('pending')
                                    <th>Pending</th>
                                    @break
                                @case('settlement')
                                    <th>Lunas - {{ \Carbon\Carbon::parse($model->user->transaction->settlement_time)->format('d-m-Y') }}</th>
                                    @break
                                @case('expire')
                                    <th>Kadaluarsa</th>
                                    @break
                                @default
                                    <th>-</th>
                            @endswitch
                        </tr>
                        <tr>
                            <td>Payment Method</td>
                            {{-- qris,va_bca,va_bni,va_bri,va_permata,va_cimb,gopay,shopeepay,offline --}}
                            @switch($model->user->transaction->payment_method)
                                @case('qris')
                                    <td>QRIS</td>
                                    @break
                                @case('va_bca')
                                    <td>BCA Virtual Account</td>
                                    @break
                                @case('va_bni')
                                    <td>BNI Virtual Account</td>
                                    @break
                                @case('va_bri')
                                    <td>BRI Virtual Account</td>
                                    @break
                                @case('va_permata')
                                    <td>Permata Virtual Account</td>
                                    @break
                                @case('va_cimb')
                                    <td>CIMB Virtual Account</td>
                                    @break
                                @case('gopay')
                                    <td>GoPay</td>
                                    @break
                                @case('shopeepay')
                                    <td>ShopeePay</td>
                                    @break
                                @case('offline')
                                    <td>Bayar Di Sekolah</td>
                                    @break
                                @default
                                    <td>-</td>
                            @endswitch
                        </tr>
                        <tr>
                            <td>Amount</td>
                            <td>Rp {{ number_format($model->user->transaction->gross_amount) }}</td>
                        </tr>
                        <tr>
                            <th colspan="2">Student</th>
                        </tr>
                        <tr>
                            <td>Full Name</td>
                            <td>{{ $model->full_name }}</td>
                        </tr>
                        <tr>
                            <td>Gender</td>
                            <td>{{ $model->gender == 'male' ? 'L' : 'P' }}</td>
                        </tr>
                        <tr>
                            <td>Birth</td>
                            <td>{{ $model->birth_place }} - {{ \Carbon\Carbon::parse($model->birth_date)->format('d-m-Y') }}</td>
                        </tr>
                        <tr>
                            <td>Religion</td>
                            <td>{{ $model->religion }}</td>
                        </tr>
                        <tr>
                            <td>Address</td>
                            <td>{{ $model->address }}</td>
                        </tr>
                        <tr>
                            <td>Email</td>
                            <td>{{ $model->email }}</td>
                        </tr>
                        <tr>
                            <td>Whatsapp</td>
                            <td>{{ $model->whatsapp }}</td>
                        </tr>
                        <tr>
                            <td>Last School</td>
                            <td>{{ $model->last_school }}</td>
                        </tr>
                        <tr>
                            <td>Organitaion Experience</td>
                            <td>{{ $model->org_experience }}</td>
                        </tr>
                        <tr>
                            <td>Height/Weight</td>
                            <td>{{ $model->height }}cm/{{ $model->weight }}kg</td>
                        </tr>
                        <tr>
                            <td>History Illness</td>
                            <td>{{ $model->history_illness }}</td>
                        </tr>
                        <tr>
                            <th colspan="2">Parent</th>
                        </tr>
                        <tr>
                            <td>Full Name</td>
                            <td>{{ $model->parent->full_name }}</td>
                        </tr>
                        <tr>
                            <td>Gender</td>
                            <td>{{ $model->parent->gender == 'male' ? 'L' : 'P' }}</td>
                        </tr>
                        <tr>
                            <td>Job</td>
                            <td>{{ $model->parent->job }}</td>
                        </tr>
                        <tr>
                            <td>Income Per Month</td>
                            <td>Rp {{ number_format($model->parent->income_per_month, 0) }}</td>
                        </tr>
                        <tr>
                            <td>Whatsapp</td>
                            <td>{{ $model->parent->whatsapp }}</td>
                        </tr>
                        <tr>
                            <td>Email</td>
                            <td>{{ $model->parent->email }}</td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
