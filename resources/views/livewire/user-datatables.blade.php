
@forelse ($salaries as $salar)
@php
    dd($salar);
@endphp
    <p>Salario: {{ $salar->salary }}</p>
@empty
    <p>Nenhum salário cadastrado ainda</p>
@endforelse

