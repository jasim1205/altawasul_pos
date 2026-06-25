<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>User Documents</title>
    <style>
        body {
            font-family: DejaVu Sans, sans-serif;
            font-size: 12px;
            color: #111;
        }

        h2, p {
            margin: 0;
        }

        .header {
            margin-bottom: 18px;
            text-align: center;
        }

        .meta {
            margin-top: 6px;
            color: #555;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        th, td {
            border: 1px solid #777;
            padding: 8px;
            text-align: left;
            vertical-align: top;
        }

        th {
            background: #198754;
            color: #fff;
        }

        .text-center {
            text-align: center;
        }

        .document-image {
            max-width: 160px;
            max-height: 120px;
        }

        a {
            color: #0d6efd;
            text-decoration: none;
        }
    </style>
</head>
<body>
    <div class="header">
        <h2>Important Documents</h2>
        <p class="meta">User: {{ $selectedUser->name }}</p>
        <p class="meta">Print Date: {{ now()->format('d-m-Y') }}</p>
    </div>

    <table>
        <thead>
            <tr>
                <th style="width: 8%;">#SL</th>
                <th >User</th>
                <th >Name</th>
                <th >Expire Date</th>
                <th>File</th>
            </tr>
        </thead>
        <tbody>
            @forelse($document as $value)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $value->user?->name }}</td>
                    <td>{{ $value->name }}</td>
                    <td>{{ \Carbon\Carbon::parse($value->date)->format('d-m-Y') }}</td>
                    <td>
                        @php
                            $extension = strtolower(pathinfo($value->file, PATHINFO_EXTENSION));
                            $fileUrl = url('public/uploads/documents/' . $value->file);
                            $filePath = public_path('uploads/documents/' . $value->file);
                        @endphp

                        @if(in_array($extension, ['jpg', 'jpeg', 'png']) && file_exists($filePath))
                            <img src="{{ $filePath }}" alt="{{ $value->file }}" class="document-image">
                        @else
                            <a href="{{ $fileUrl }}">{{ $value->file }}</a>
                        @endif
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="4" class="text-center">No document found</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</body>
</html>
