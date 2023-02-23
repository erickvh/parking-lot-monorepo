<table>
    <thead>
        <tr>
            <th>Num. Placa</th>
            <th>Tiempo estacionado (min.) </th>
            <th>Cantidad a pagar </th>
        </tr>
    </thead>
    <tbody>
        @foreach ($totals as $total)
            <tr>
                <td>{{ $total->plate }}</td>
                <td>{{ $total->minutes }}</td>
                <td>{{ $total->amount }}</td>
            </tr>
        @endforeach
    </tbody>
</table>
