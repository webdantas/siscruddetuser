<div>
    {{-- Success is as dangerous as failure. --}}
</div>

@forelse ($salaries as $salary)
    <p>Salario: {{ $salary->salary }}</p>
@empty
    <p>Nenhum salário cadastrado ainda</p>
@endforelse

