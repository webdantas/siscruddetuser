<?php

// namespace App\Http\Livewire;

// use Livewire\Component;

// class UserDatatables extends Component
// {
//     public function render()
//     {
//         return view('livewire.user-datatables');
//     }
// }

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\User;
use Illuminate\Support\Str;
use Mediconesystems\LivewireDatatables\Column;
use Mediconesystems\LivewireDatatables\NumberColumn;
use Mediconesystems\LivewireDatatables\DateColumn;
use Mediconesystems\LivewireDatatables\Http\Livewire\LivewireDatatable;

class UserDatatables extends LivewireDatatable
{
    public $model = User::class;

    /**
     * Write code on Method
     *
     * @return response()
     */
    public function columns()
    {
        return [
            NumberColumn::name('id')
                ->label('ID')
                ->sortBy('id'),

            Column::name('name')
                ->label('Name'),

            Column::name('email'),

            Column::name('CPF'),

            Column::name('RG'),

            Column::name('address')
                ->label('Endereço'),

            Column::name('number')
                ->label('Nº'),

            Column::name('neighborhood')
                ->label('Bairro'),

            Column::name('postal_code')
                ->label('CEP'),

            Column::name('city')
                ->label('Cidade'),

            Column::name('state')
                ->label('Estado'),

            Column::name('salary')
                ->label('Salario'),

            DateColumn::name('birth_date')
                ->label('Aniversário')
        ];
    }
}
