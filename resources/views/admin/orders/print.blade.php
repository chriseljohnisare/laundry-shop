<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Receipt #{{ $order->receipt_number }}</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;600;700;800&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Plus Jakarta Sans', sans-serif; }
        @media print {
            .no-print { display: none !important; }
            body { background: white; }
            .receipt-container { border: none !important; box-shadow: none !important; margin: 0; padding: 0; }
        }
    </style>
</head>
<body class="bg-slate-50 p-4 md:p-10">

    <div class="no-print max-w-lg mx-auto mb-6 flex justify-between items-center">
        <button onclick="window.history.back()" class="text-sm font-bold text-slate-500 hover:text-slate-800 transition">
            <i class="fas fa-arrow-left mr-2"></i> Back to Dashboard
        </button>
        <button onclick="window.print()" class="bg-indigo-600 text-white px-6 py-2 rounded-xl font-bold text-sm shadow-lg hover:bg-indigo-700 transition">
            Print Now
        </button>
    </div>

    <div class="receipt-container max-w-lg mx-auto bg-white border border-slate-200 shadow-sm p-8 md:p-12 rounded-3xl">
        
        <!-- Header -->
        <div class="text-center mb-10 border-b border-slate-100 pb-10">
            <div class="inline-flex items-center space-x-2 mb-4">
                <div class="h-8 w-8 bg-slate-900 rounded-lg flex items-center justify-center">
                    <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h18M7 15h1m4 0h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z"></path></svg>
                </div>
                <span class="text-xl font-extrabold tracking-tighter">LaundryPro</span>
            </div>
            <p class="text-xs text-slate-500 font-bold uppercase tracking-widest">Official Transaction Receipt</p>
        </div>

        <!-- Order Meta -->
        <div class="flex justify-between items-start mb-10 text-sm">
            <div>
                <p class="text-slate-400 font-bold uppercase text-[10px] tracking-widest mb-1">Receipt No.</p>
                <p class="font-black text-slate-900">#{{ $order->receipt_number }}</p>
            </div>
            <div class="text-right">
                <p class="text-slate-400 font-bold uppercase text-[10px] tracking-widest mb-1">Date Issued</p>
                <p class="font-black text-slate-900">{{ $order->created_at->format('M d, Y') }}</p>
            </div>
        </div>

        <!-- Client Info -->
        <div class="mb-10 bg-slate-50 rounded-2xl p-6 border border-slate-100">
            <p class="text-slate-400 font-bold uppercase text-[10px] tracking-widest mb-2">Billed To</p>
            <p class="text-base font-black text-slate-900 mb-1">{{ $order->customer->name }}</p>
            <p class="text-xs font-bold text-slate-500 mb-1">{{ $order->customer->contact_number }}</p>
            <p class="text-xs font-medium text-slate-400 leading-relaxed">{{ $order->customer->address }}</p>
        </div>

        <!-- Table -->
        <div class="mb-10">
            <table class="w-full text-left">
                <thead>
                    <tr class="text-[10px] font-black uppercase tracking-widest text-slate-400 border-b border-slate-100">
                        <th class="pb-4">Service Description</th>
                        <th class="pb-4 text-right">Details</th>
                        <th class="pb-4 text-right">Amount</th>
                    </tr>
                </thead>
                <tbody class="text-sm">
                    <tr class="border-b border-slate-50">
                        <td class="py-6">
                            <p class="font-black text-slate-900">{{ $order->service->name }}</p>
                            <p class="text-xs font-medium text-slate-400 mt-1">Professional Care</p>
                        </td>
                        <td class="py-6 text-right font-bold text-slate-600">
                            {{ $order->weight_kg }}kg &times; ${{ number_format($order->price_per_kg, 2) }}
                        </td>
                        <td class="py-6 text-right font-black text-slate-900">
                            ${{ number_format($order->total_amount, 2) }}
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>

        <!-- Totals -->
        <div class="space-y-4 border-t border-slate-100 pt-8 mb-10">
            <div class="flex justify-between items-center text-sm">
                <span class="text-slate-400 font-bold">Total Billable</span>
                <span class="font-black text-slate-900">${{ number_format($order->total_amount, 2) }}</span>
            </div>
            <div class="flex justify-between items-center text-sm">
                <span class="text-slate-400 font-bold">Total Paid</span>
                <span class="font-black text-emerald-600">-${{ number_format($order->paid_amount, 2) }}</span>
            </div>
            <div class="flex justify-between items-center pt-4 border-t border-slate-950">
                <span class="text-xs font-black uppercase tracking-[0.2em] text-slate-950">Amount Due</span>
                <span class="text-3xl font-black text-slate-950">${{ number_format(max(0, $order->total_amount - $order->paid_amount), 2) }}</span>
            </div>
        </div>

        <!-- Footer Note -->
        <div class="text-center">
            <p class="text-xs font-bold text-slate-400 mb-6 italic">Thank you for choosing LaundryPro!</p>
            <div class="bg-slate-950 text-white py-2 rounded-xl text-[10px] font-black uppercase tracking-[0.3em]">
                {{ $order->payment_status === 'full' ? 'Payment Confirmed' : 'Payment Pending' }}
            </div>
        </div>

    </div>

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    
    <script>
        // Auto-open print dialog if requested via URL
        if (window.location.search.includes('autoprint=true')) {
            window.print();
        }
    </script>
</body>
</html>
