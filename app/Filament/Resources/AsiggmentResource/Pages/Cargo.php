<?php

namespace App\Filament\Resources\AsiggmentResource\Pages;

use App\Filament\Resources\AsiggmentResource;
use App\Models\Asiggment;
use App\Models\Employe;
use App\Models\Tool;
use Filament\Resources\Pages\Page;
use Filament\Forms\Form;
use Filament\Forms;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Forms\Components\Section;
use Filament\Notifications\Notification;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

use function Pest\Laravel\options;

class Cargo extends Page implements HasForms
{
    use InteractsWithForms;

    protected static string $resource = AsiggmentResource::class;
    protected static ?string $header = 'Cargo';

    protected static string $view = 'filament.resources.asiggment-resource.pages.assigmentcreate';

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }

    protected function getCreatedNotificationTitle(): ?string
    {
        return 'Asignacion registrada Correctamente!';
    }

    public $tool_id = '';
    public $employe_id = '';
    public $description = '';
    public $quantity = '';
    public $code = '';
    public $status = '';

    public function mount(): void
    {
        $this->form->fill();
    }

    public function getFormSchema(): array
    {
        return [
            Section::make('Registrar Cargo de heramienta')
                ->description('Formulario para registra las herramientas asignadas alos trabajadores')
                ->schema([
                    Section::make()
                        ->schema([
                            Forms\Components\Select::make('tool_id')
                                ->label('Herramienta')
                                ->relationship('tool', 'name')
                                ->options(Tool::all()->pluck('name', 'id'))
                                ->searchable()
                                ->required(),
                            Forms\Components\Select::make('employe_id')
                                ->label('Trabajador | DNI')
                                ->options(Employe::all()->pluck('dni', 'id'))
                                ->searchable(),
                            Forms\Components\TextInput::make('quantity')
                                ->label('Cantidad')
                                ->required(),
                            Forms\Components\TextInput::make('code')
                                ->label('Codigo')
                                ->default('CA-' . random_int(100000, 9999999))
                                ->dehydrated()
                                ->required()
                                ->maxLength(32)
                                ->unique(Asiggment::class, 'code', ignoreRecord: true),

                        ])->columns(4),
                    Forms\Components\MarkdownEditor::make('description')
                        ->label('Descripción')
                        ->required()
                        ->maxLength(150)
                        ->columnSpanFull(),

                ])->columns()
        ];
    }

    public function save()
    {

        Asiggment::create([
            'tool_id' => $this->tool_id,
            'employe_id' => $this->employe_id,
            'description' => $this->description,
            'quantity' => $this->quantity,
            'code' => $this->code,
            // 'status' => $this->status
        ]);
        $tool = Tool::findOrFail($this->tool_id);
        $tool->quantity -= $this->quantity;
        $tool->save();


        Notification::make()
            ->title('Asignación Registrada Correctamente')
            ->icon('heroicon-o-document-text')
            ->iconColor('success')
            ->send();

        return redirect()->to('asiggments');
    }
}
