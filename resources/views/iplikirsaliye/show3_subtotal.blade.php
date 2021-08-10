<tr>
    <td colspan="17">Ara Toplam</td>
    <td>{{ $list->where('iplikirsaliye_id', $id)->count('miktar') }} ad.</td>
    <td>{{ $list->where('iplikirsaliye_id', $id)->sum('miktar') }} </td>
    <td>{{ $list->where('iplikirsaliye_id', $id)->sum('brutmiktar') }} </td>
</tr>
<tr>
    <td colspan="20"></td>
</tr>