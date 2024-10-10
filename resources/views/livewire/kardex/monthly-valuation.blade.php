<div>
    <form wire:submit="createPDF">
        <div class="flex justify-end mb-4">
            <x-filament::button type="submit" icon="heroicon-o-arrow-down-tray" color="success">
                PDF reporte
            </x-filament::button>
        </div>
        {{ $this->form }}
    </form>
    <table>
        <thead>
            <tr>
                <th rowspan="2" class="text-center">COD.</th>
                <th rowspan="2">
                    DESCRIPCIÓN
                </th>
                <th rowspan="2" class="text-center">P.U</th>
                <th rowspan="2" class="text-center">U.M</th>
                <th rowspan="2" class="text-center">INGRESO Y<br />EGRESO </th>
                <th rowspan="2">O/C</th>
                <th colspan="2" class="text-center">MES ANTERIOR
                </th>
                <th colspan="2" class="text-center">MES ACTUAL
                </th>
                <th colspan="2" class="text-center">ACUMULADO
                </th>
                <th colspan="2" class="text-center">SALDO</th>
            </tr>
            <tr>
                <th>CANTIDAD</th>
                <th>VALORIZADO</th>
                <th>CANTIDAD</th>
                <th>VALORIZADO</th>
                <th>CANTIDAD</th>
                <th>VALORIZADO</th>
                <th>CANTIDAD</th>
                <th>VALORIZADO</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($categoriesWithProducts as $category)
            <tr style="background-color: #e5e7eb;">
                <th class="bg-gray-300">{{ $category->id }}</th>
                <th class="bg-gray-300" colspan="100%">{{ $category->name }}</th>
            </tr>
                @foreach ($category->materials as $product)
                <tr>
                    <td rowspan="2" class="text-gray-900">{{ $product->code }}</td>
                    <td rowspan="2" class="text-gray-900">{{ $product->name }}</td>
                    <td rowspan="2" class="text-gray-900">{{ $product->pu }}</td>
                    <td rowspan="2" class="text-gray-900">{{ $product->um }}</td> 
                </tr>
                @endforeach
            @endforeach
       
        </tbody>
    </table>
</div>
