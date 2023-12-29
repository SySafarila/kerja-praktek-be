<!-- Dibuat dengan hati oleh Syahrul Safarila, M Dagistan Silawane, dan M Linggar Hadistiawandi-->
<!doctype html>
<html lang="en" class="scroll-pt-[72px] lg:scroll-pt-[68px] scroll-smooth">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link
        href="https://fonts.googleapis.com/css?family=Material+Icons|Material+Icons+Outlined|Material+Icons+Two+Tone|Material+Icons+Round|Material+Icons+Sharp"
        rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

    <link rel="shortcut icon" href="{{ asset('images/logos/logo1a.png') }}" type="image/x-icon">
    <title>SMA MA'ARIF PACET CIANJUR</title>

    <style>
        td, th {
            border: solid 1px black;
        }
    </style>

    @vite('resources/css/app.css')
</head>

<body class="p-5">
    <table class="w-full">
        <tbody>
            <tr>
                <th colspan="2">Payment</th>
            </tr>
            <tr>
                <td>PPDB ID</td>
                <td>{{ $student->transaction->order_id ?? '-' }}</td>
            </tr>
            <tr>
                <td>Status</td>
                @if ($student->transaction)
                    @switch(@$student->transaction->transaction_status)
                        @case('pending')
                            <th>Pending</th>
                            @break
                        @case('settlement')
                            <th>Lunas ({{ \Carbon\Carbon::parse($student->transaction->settlement_time)->format('H:i/d-m-Y') }})</th>
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
                @if ($student->transaction)
                    @switch(@$student->transaction->payment_method)
                        @case('qris')
                            <th>QRIS {{ $student->transaction->issuer ? '/' . Str::upper($student->transaction->issuer) : '' }}</th>
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
                <td>Rp {{ @number_format($student->transaction->gross_amount) }}</td>
            </tr>
            <tr>
                <th colspan="2">Files</th>
            </tr>
            <tr>
                <td>Kartu Keluarga</td>
                <td>
                    @if ($student->files->where('file_type', 'kk')->first())
                        <a target="__blank" href="{{ route('admin.ppdb.download-private-files', ['file_path' => $student->files->where('file_type', 'kk')->first()->file_name]) }}">Download</a>
                    @else
                        -
                    @endif
                </td>
            </tr>
            <tr>
                <td>Akta Kelahiran</td>
                <td>
                    @if ($student->files->where('file_type', 'akta')->first())
                        <a target="__blank" href="{{ route('admin.ppdb.download-private-files', ['file_path' => $student->files->where('file_type', 'akta')->first()->file_name]) }}">Download</a>
                    @else
                        -
                    @endif
                </td>
            </tr>
            <tr>
                <td>KIP</td>
                <td>
                    @if ($student->files->where('file_type', 'kip')->first())
                        <a target="__blank" href="{{ route('admin.ppdb.download-private-files', ['file_path' => $student->files->where('file_type', 'kip')->first()->file_name]) }}">Download</a>
                    @else
                        -
                    @endif
                </td>
            </tr>
            <tr>
                <td>PKH</td>
                <td>
                    @if ($student->files->where('file_type', 'pkh')->first())
                        <a target="__blank" href="{{ route('admin.ppdb.download-private-files', ['file_path' => $student->files->where('file_type', 'pkh')->first()->file_name]) }}">Download</a>
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
                <td>{{ $student->full_name }}</td>
            </tr>
            <tr>
                <td>Gender</td>
                <td>{{ $student->gender == 'male' ? 'L' : 'P' }}</td>
            </tr>
            <tr>
                <td>Birth</td>
                <td>{{ $student->birth_place }} - {{ \Carbon\Carbon::parse($student->birth_date)->format('d-m-Y') }}</td>
            </tr>
            <tr>
                <td>Religion</td>
                <td style="text-transform: capitalize;">{{ Str::replace('_', ' ', $student->religion) }}</td>
            </tr>
            <tr>
                <td>Address</td>
                <td>{{ $student->address }}</td>
            </tr>
            <tr>
                <td>Email</td>
                <td>{{ $student->email }}</td>
            </tr>
            <tr>
                <td>Whatsapp</td>
                <td>{{ $student->whatsapp }}</td>
            </tr>
            <tr>
                <td>Last School</td>
                <td>{{ $student->last_school }}</td>
            </tr>
            <tr>
                <td>Organitaion Experience</td>
                <td>{{ $student->org_experience ?? '-' }}</td>
            </tr>
            <tr>
                <td>Height/Weight</td>
                <td>{{ $student->height }}cm/{{ $student->weight }}kg</td>
            </tr>
            <tr>
                <td>History Illness</td>
                <td>{{ $student->history_illness ?? '-' }}</td>
            </tr>
            <tr>
                <th colspan="2">Parent</th>
            </tr>
            <tr>
                <td>Full Name</td>
                <td>{{ $student->parent->full_name }}</td>
            </tr>
            <tr>
                <td>Gender</td>
                <td>{{ $student->parent->gender == 'male' ? 'L' : 'P' }}</td>
            </tr>
            <tr>
                <td>Job</td>
                <td>{{ $student->parent->job }}</td>
            </tr>
            <tr>
                <td>Income Per Month</td>
                <td>Rp {{ number_format($student->parent->income_per_month, 0) }}</td>
            </tr>
            <tr>
                <td>Whatsapp</td>
                <td>{{ $student->parent->whatsapp }}</td>
            </tr>
            <tr>
                <td>Email</td>
                <td>{{ $student->parent->email }}</td>
            </tr>
        </tbody>
    </table>

    <script>
        window.print();
    </script>
</body>

</html>
