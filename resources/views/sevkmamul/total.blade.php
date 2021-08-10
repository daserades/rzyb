<tr>
    <td colspan="2">Toplam</td>
    <td>{{ $list->where('sevkmamul_id', $id)->count('metre') }} ad.</td>
    <td>{{ $list->where('sevkmamul_id', $id)->sum('metre') }} mt.</td>
</tr>