<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Payroll') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">

                    <ul>
                        @foreach($payrolls as $payroll)
                            <li class="shadow p-4 mt-6 border border-gray-200 rounded">
                                <div class="flex items-center gap-4">
                                    <span>{{ $payroll->employer->name }}</span>
                                    <span>{{ $payroll->start_period }}</span>
                                    <span>{{ $payroll->end_period }}</span>
                                </div>

                                <div class="overflow-x-auto mt-2">
                                    <div class="inline-block min-w-full align-middle bg-white
                                        [&_thead]:bg-gray-100
                                        [&_th]:border [&_th]:p-2
                                        [&_td]:border [&_td]:p-2
                                    ">
                                        <table class="w-full">
                                            {{-- Todo: refactor --}}
                                            @php($incomes = $payroll->incomes->unique('name')->pluck('name'))
                                            @php($outcomes = $payroll->outcomes->unique('name')->pluck('name'))
                                            <thead>
                                                <tr>
                                                    <th>Empleado</th>
                                                    <th>Días trabajados</th>
                                                    <th>Salario Diario</th>
                                                    <th>Total</th>
                                                    @if (count($incomes))
                                                        <th colspan="{{count($incomes)}}">Ingresos</th>
                                                    @endif
                                                    <th>Total Ingresos</th>
                                                    @if (count($outcomes))
                                                        <th colspan="{{count($outcomes)}}">Deducciones</th>
                                                    @endif
                                                    <th>Total Deducciones</th>
                                                    <th>Total a Pagar</th>
                                                    <th>Total a transferir</th>
                                                    <th>Total a otros</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach($payroll->employeePayrolls as $employeePayroll)
                                                    <tr>
                                                        <td>{{ $employeePayroll->employee->name }}</td>
                                                        <td>{{ $employeePayroll->worked_days }}</td>
                                                        <td>${{ number_format($employeePayroll->daily_salary, 2) }}</td>
                                                        <td>${{ number_format($employeePayroll->total_salary, 2) }}</td>
                                                        @foreach($employeePayroll->incomes->where('employee_id', $employeePayroll->employee_id) as $income)
                                                            <td>
                                                                <small>{{ $income->name }}</small> <br>
                                                                <span>${{ number_format($income->amount, 2) }}</span>
                                                            </td>
                                                        @endforeach
                                                        <td>${{ number_format($employeePayroll->total_income, 2) }}</td>

                                                        @foreach($employeePayroll->outcomes->where('employee_id', $employeePayroll->employee_id) as $outcome)
                                                            <td>
                                                                <small>{{ $outcome->name }}</small> <br>
                                                                ${{ number_format($outcome->amount, 2) }}
                                                            </td>
                                                        @endforeach
                                                        <td>${{ number_format($employeePayroll->total_outcome, 2) }}</td>
                                                        <td>${{ number_format($employeePayroll->amount_to_pay, 2) }}</td>
                                                        <td>${{ number_format($employeePayroll->amount_to_transfer, 2) }}</td>
                                                        <td>${{ number_format($employeePayroll->amount_to_other_income, 2) }}</td>
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
