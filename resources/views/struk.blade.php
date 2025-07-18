<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Struk Transaksi</title>
    <style>
        body {
            font-family: monospace;
            width: 320px;
            margin: 0 auto;
            padding: 10px;
            font-size: 14px;
        }
        .header, .footer {
            text-align: center;
        }
        .line {
            border-bottom: 1px dashed #000;
            margin: 8px 0;
        }
        .detail {
            display: flex;
            justify-content: space-between;
        }
        .total {
            font-weight: bold;
            margin-top: 4px;
        }
        .center {
            text-align: center;
        }

        /* CSS untuk mode cetak */
        @media print {
            body {
                font-size: 12px;
                color: black;
            }
        }
    </style>
</head>
<body onload="window.print()">

    <div class="header">
        <h3>TOKO SERBA ADA</h3>
        <p>Jl. Raya No. 123, Bekasi</p>
        <p>Telp: (021) 12345678</p>
    </div>

    <div class="line"></div>

    <div>
        <p>Struk No. : {{ str_pad($transaction->id, 6, '0', STR_PAD_LEFT) }}</p>
        <p>Tanggal   : {{ now()->format('d-m-Y H:i') }}</p>
    </div>

    <div class="line"></div>

    @foreach ($transaction->items as $item)
        <div class="detail">
            <span>{{ $item->name }}</span>
            <span>Rp {{ number_format($item->price, 0, ',', '.') }}</span>
        </div>
    @endforeach

    <div class="line"></div>

    <div class="total">
        <div class="detail">
            <span>Total</span>
            <span>Rp {{ number_format($transaction->total, 0, ',', '.') }}</span>
        </div>
        <div class="detail">
            <span>Dibayar</span>
            <span>Rp {{ number_format($transaction->paid, 0, ',', '.') }}</span>
        </div>
        <div class="detail">
            <span>Kembali</span>
            <span>Rp {{ number_format($transaction->paid - $transaction->total, 0, ',', '.') }}</span>
        </div>
    </div>

    <div class="line"></div>

    <div class="center">
        <p>Terima Kasih</p>
        <p>www.tokoserbaada.com</p>
    </div>

    <div class="line"></div>

</body>
</html>