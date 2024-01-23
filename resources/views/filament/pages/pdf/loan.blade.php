<x-guest-layout>
    {{-- @foreach ($loans as $loan)
        <tr>
            <td>{{ $loan->id }}</td>
            <td>{{ $loan->area->name }}</td>
            <td>
                @if ($loan->status == 0)
                    <p
                        class="inline-block max-w-[10rem] truncate whitespace-nowrap rounded-lg bg-blue-100 px-3 py-1.5 text-xs font-medium text-blue-800 dark:bg-blue-800/30 dark:text-blue-500">
                        Interno</p>
                @else
                    <p
                        class="inline-block max-w-[10rem] truncate whitespace-nowrap rounded-lg bg-rose-100 px-3 py-1.5 text-xs font-medium text-rose-800 dark:bg-rose-800/30 dark:text-rose-500">
                        Externo</p>
                @endif

        </tr>
    @endforeach --}}
    <div class="relative flex">
        <div class="w-2/3 bg-gray-800">
            <img src="https://upload.wikimedia.org/wikipedia/commons/thumb/9/9a/Laravel.svg/985px-Laravel.svg.png"
                class="h-20 p-2 px-6" alt="Logo" />
        </div>
        <div class="absolute right-0 top-0 flex h-28 w-1/3 flex-col justify-end rounded-bl-sm bg-blue-600 p-2">
            <h1 class="text-center text-3xl font-bold uppercase text-white">Almacen</h1>
        </div>
    </div>
    <!-- <div class="inv-metadata px-6 pt-4">
        <div class="text-xs">
          <h2 class="text-base font-semibold">Almacen</h2>
          <p>texto 1</p>
          <p>Texto 2</p>
          <p>Texto 3</p>
        </div>
      </div> -->
    <div class="inv-metadata px-6 pt-4">
        <div class="mt-16 flex items-end justify-between">
            <!-- Billing Details -->
            <div class="text-xs">
                <h3 class="mb-1 font-medium tracking-tight text-gray-600 dark:text-gray-400">BILL TO</h3>
                <p class="text-base font-bold text-blue-600">John Doe</p>
                <p>123 Main Street</p>
                <p>New York, New York 10001</p>
                <p>United States</p>
            </div>

            <div class="text-xs">
                <table class="min-w-full">
                    <tbody>
                        <tr>
                            <td class="pr-2 text-right font-semibold">Invoice Number:</td>
                            <td class="pl-2 text-left"> invoice_number </td>
                        </tr>
                        <tr>
                            <td class="pr-2 text-right font-semibold">Invoice Date:</td>
                            <td class="pl-2 text-left"> invoice_date </td>
                        </tr>
                        <tr>
                            <td class="pr-2 text-right font-semibold">Payment Due:</td>
                            <td class="pl-2 text-left"> invoice_due_date </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <div class="inv-line-items py-6">
        <table class="w-full table-fixed text-left">
            <thead class="text-sm leading-8">
                <tr class="bg-sky-100 text-blue-700 dark:text-gray-400">
                    <th class="pl-6 text-left"> item_name </th>
                    <th class="text-center"> unit_name </th>
                    <th class="text-right"> price_name </th>
                    <th class="pr-6 text-right"> amount_name </th>
                </tr>
            </thead>
            <tbody class="border-b-2 border-t-2 text-xs leading-8">
                <tr class="bg-gray-100 dark:bg-gray-800">
                    <td class="pl-6 text-left font-semibold">Item 1</td>
                    <td class="text-center">2</td>
                    <td class="text-right">$150.00</td>
                    <td class="pr-6 text-right">$300.00</td>
                </tr>
                <tr>
                    <td class="pl-6 text-left font-semibold">Item 2</td>
                    <td class="text-center">3</td>
                    <td class="text-right">$200.00</td>
                    <td class="pr-6 text-right">$600.00</td>
                </tr>
                <tr class="bg-gray-100 dark:bg-gray-800">
                    <td class="pl-6 text-left font-semibold">Item 3</td>
                    <td class="text-center">1</td>
                    <td class="text-right">$180.00</td>
                    <td class="pr-6 text-right">$180.00</td>
                </tr>
            </tbody>
            <tfoot class="text-xs leading-loose">
                <tr>
                    <td class="pl-6" colspan="2"></td>
                    <td class="text-right font-semibold">Subtotal:</td>
                    <td class="pr-6 text-right">$1080.00</td>
                </tr>
                <tr class="text-success-800 dark:text-success-600">
                    <td class="pl-6" colspan="2"></td>
                    <td class="text-right">Discount (5%):</td>
                    <td class="pr-6 text-right">($54.00)</td>
                </tr>
                <tr>
                    <td class="pl-6" colspan="2"></td>
                    <td class="text-right">Sales Tax (10%):</td>
                    <td class="pr-6 text-right">$102.60</td>
                </tr>
                <tr>
                    <td class="pl-6" colspan="2"></td>
                    <td class="border-t text-right font-semibold">Total:</td>
                    <td class="border-t pr-6 text-right">$1128.60</td>
                </tr>
                <tr>
                    <td class="pl-6" colspan="2"></td>
                    <td class="border-t-4 border-double text-right font-semibold">Amount Due (USD):</td>
                    <td class="border-t-4 border-double pr-6 text-right">$1128.60</td>
                </tr>
            </tfoot>
        </table>
    </div>

    <span class="text-center text-sm text-gray-500 dark:text-gray-400 sm:text-center">
        © 2024 <a href="https://flowbite.com/" class="hover:underline">Flowbite™</a>. All Rights Reserved. </span>


</x-guest-layout>
