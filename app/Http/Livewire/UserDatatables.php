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
use App\Models\Salary;
use Illuminate\Support\Str;
use Mediconesystems\LivewireDatatables\Column;
use Mediconesystems\LivewireDatatables\NumberColumn;
use Mediconesystems\LivewireDatatables\DateColumn;
use Mediconesystems\LivewireDatatables\Http\Livewire\LivewireDatatable;

class UserDatatables extends LivewireDatatable
{
    public $model = User::class;

    public function builder()
    {
        return User::query()
        ->leftJoin('salaries as s1', 'users.id', 's1.user_id');
    }

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
                ->linkTo('api/salary', 1)
                ->sortBy('id'),

            // Column::callback(['id', 'name'], function ($id, $name) {
            //     return view('table-actions', ['id' => $id, 'name' => $name]);
            // })->unsortable()

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

            Column::name('s1.salary')
                 ->label('Salario'),

            DateColumn::name('birth_date')
                ->label('Aniversário')
        ];
    }
}
