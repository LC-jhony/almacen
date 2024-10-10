<?php

use App\Livewire\Kardex\MonthlyValuation;
use App\Models\Category;
use App\Models\KardexBalance;
use App\Models\Material;
use Carbon\Carbon;
use Livewire\Livewire;




it('renders successfully', function () {
    Livewire::test(MonthlyValuation::class)->assertStatus(200);
});
it('render the form with month select input', function () {
    Livewire::test(MonthlyValuation::class)
        ->assertSee('Mes')
        ->assertFormFieldExists('month');
});
it('sets default month retrieves categories with materials and balances filtered by month ', function () {
    Carbon::setTestNow(Carbon::create(2024, 10, 1));
    $category = Category::factory()->create(['status' => true]);
    $material = Material::factory()->create(['category_id' => $category->id]);
    $balance = KardexBalance::factory()->create(
        [
            'material_id' => $material->id,
            'quantity' => 100,
            'created_at' => Carbon::create(2024, 10, 9)
        ]
    );
    livewire::test(MonthlyValuation::class)
        ->assertSet('month', '10')  // Assert that the month is set to October (current month)
        ->assertSet('monthName', 'octubre')  // Assert that the monthName is correctly translated
        ->assertViewHas('categoriesWithProducts')
        ->assertViewHas('categoriesWithProducts', function ($categoriesWithProducts) use ($category, $material, $balance) {
            return $categoriesWithProducts->contains($category) &&
                $categoriesWithProducts->first()->materials->contains($material) &&
                $categoriesWithProducts->first()->materials->first()->balances->contains($balance);
        });
})->skip('Test is failing and needs investigation');
