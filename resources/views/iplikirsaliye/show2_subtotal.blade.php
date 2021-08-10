<tr>
    <td colspan="6">Ara Toplam</td>
    <td>{{ $list->where('partino', $iplikcins_id)->where('iplikirsaliye_id', $id)->count('miktar') }} ad.</td>
    <td>{{ $list->where('partino', $iplikcins_id)->where('iplikirsaliye_id', $id)->sum('miktar') }} </td>
</tr>
<tr>
    <td colspan="8"></td>
</tr>