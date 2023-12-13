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
                <h5 class="modal-title" id="detailModal-{{ $model->id }}Label">Detail {{ $model->full_name }} - {{ $model->nisn }}</h5>
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
                            <td>{{ $model->transaction->order_id ?? '-' }}</td>
                        </tr>
                        <tr>
                            <td>Status</td>
                            @if ($model->transaction)
                                @switch(@$model->transaction->transaction_status)
                                    @case('pending')
                                        <th>Pending</th>
                                        @break
                                    @case('settlement')
                                        <th>Lunas ({{ \Carbon\Carbon::parse($model->transaction->settlement_time)->format('H:i/d-m-Y') }})</th>
                                        @break
                                    @case('expire')
                                        <th>Kadaluarsa</th>
                                        @break
                                    @default
                                        <th>-</th>
                                @endswitch
                            @else
                                <th>-</th>
                            @endif
                        </tr>
                        <tr>
                            <td>Payment Method</td>
                            @if ($model->transaction)
                                @switch(@$model->transaction->payment_method)
                                    @case('qris')
                                        <th>QRIS {{ $model->transaction->issuer ? '/' . Str::upper($model->transaction->issuer) : '' }}</th>
                                        @break
                                    @case('va_bca')
                                        <th>BCA Virtual Account</th>
                                        @break
                                    @case('va_bni')
                                        <th>BNI Virtual Account</th>
                                        @break
                                    @case('va_bri')
                                        <th>BRI Virtual Account</th>
                                        @break
                                    @case('va_permata')
                                        <th>Permata Virtual Account</th>
                                        @break
                                    @case('va_cimb')
                                        <th>CIMB Virtual Account</th>
                                        @break
                                    @case('gopay')
                                        <th>GoPay</th>
                                        @break
                                    @case('shopeepay')
                                        <th>ShopeePay</th>
                                        @break
                                    @case('offline')
                                        <th>Bayar Di Sekolah</th>
                                        @break
                                    @default
                                        <th>-</th>
                                @endswitch
                            @else
                                <th>-</th>
                            @endif
                        </tr>
                        <tr>
                            <td>Amount</td>
                            <td>Rp {{ @number_format($model->transaction->gross_amount) }}</td>
                        </tr>
                        <tr>
                            <th colspan="2">Files</th>
                        </tr>
                        <tr>
                            <td>Kartu Keluarga</td>
                            <td>
                                @if ($model->files->where('file_type', 'kk')->first())
                                    <a target="__blank" href="{{ route('admin.ppdb.download-private-files', ['file_path' => $model->files->where('file_type', 'kk')->first()->file_name]) }}">Download</a>
                                @else
                                    -
                                @endif
                            </td>
                        </tr>
                        <tr>
                            <td>Akta Kelahiran</td>
                            <td>
                                @if ($model->files->where('file_type', 'akta')->first())
                                    <a target="__blank" href="{{ route('admin.ppdb.download-private-files', ['file_path' => $model->files->where('file_type', 'akta')->first()->file_name]) }}">Download</a>
                                @else
                                    -
                                @endif
                            </td>
                        </tr>
                        <tr>
                            <td>KIP</td>
                            <td>
                                @if ($model->files->where('file_type', 'kip')->first())
                                    <a target="__blank" href="{{ route('admin.ppdb.download-private-files', ['file_path' => $model->files->where('file_type', 'kip')->first()->file_name]) }}">Download</a>
                                @else
                                    -
                                @endif
                            </td>
                        </tr>
                        <tr>
                            <td>PKH</td>
                            <td>
                                @if ($model->files->where('file_type', 'pkh')->first())
                                    <a target="__blank" href="{{ route('admin.ppdb.download-private-files', ['file_path' => $model->files->where('file_type', 'pkh')->first()->file_name]) }}">Download</a>
                                @else
                                    -
                                @endif
                            </td>
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
                            <td style="text-transform: capitalize;">{{ Str::replace('_', ' ', $model->religion) }}</td>
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
                            <td>{{ $model->org_experience ?? '-' }}</td>
                        </tr>
                        <tr>
                            <td>Height/Weight</td>
                            <td>{{ $model->height }}cm/{{ $model->weight }}kg</td>
                        </tr>
                        <tr>
                            <td>History Illness</td>
                            <td>{{ $model->history_illness ?? '-' }}</td>
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
            @if ($model->transaction)
                @if ($model->transaction->payment_method == 'offline' && $model->transaction->transaction_status == 'pending')
                    <form action="{{ route('admin.ppdb.confirm-offline-payment', $model->id) }}" method="POST" class="modal-footer" id="confirm-{{ $model->id }}">
                        @csrf
                        @method('PATCH')
                        <button type="submit" class="btn btn-primary" id="confirm" onclick="event.preventDefault()">Konfirmasi Pembayaran</button>
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    </form>
                @endif
            @endif
        </div>
    </div>
</div>
@if ($model->transaction)
    @if ($model->transaction->payment_method == 'offline' && $model->transaction->transaction_status == 'pending')
        <script>
            const confirmOfflinePaymentForm = document.getElementById('confirm-{{ $model->id }}')
            confirmOfflinePaymentForm.querySelector('#confirm').addEventListener('click', (e) => {
                e.preventDefault()
                swal({
                    title: "Konfirmasi Pembayaran?",
                    // text: "Once deleted, you will not be able to recover this data!",
                    icon: "warning",
                    buttons: true,
                    dangerMode: true,
                }).then((willDelete) => {
                        if (willDelete) {
                            confirmOfflinePaymentForm.submit()
                        } else {
                            // swal("Your data is safe!");
                        }
                    });
            })
        </script>
    @endif
@endif
