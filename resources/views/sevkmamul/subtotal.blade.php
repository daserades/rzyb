<tr>
    <td colspan="2">Ara Toplam</td>
    <td>{{ $list->where('order_id', $no)->where('sevkmamul_id', $id)->count('metre') }} ad.</td>
    <td>{{ $list->where('order_id', $no)->where('sevkmamul_id', $id)->sum('metre') }} mt.</td>
</tr>
<tr>
    <td colspan="7"></td>
</tr>