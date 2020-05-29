<h2>Hi {{$overtime->creator->name}} !</h2>

<p>Your request created was {{$statusApprove}} from <b>{{$overtime->approver->name}}</b></p>
<h3>Information Your Request OverTime</h3>
<table>
    <tr>
        <th>ID</th>
        <td>{{$overtime->id}}</td>
    </tr>
    <tr>
        <th>Member</th>
        <td>{!! $overtime->member_ids !!}</td>
    </tr>
    <tr>
        <th>From</th>
        <td>{{$overtime->from}}</td>
    </tr>
    <tr>
        <th>To</th>
        <td>{{$overtime->to}}</td>
    </tr>
    <tr>
        <th>Reason</th>
        <td>{{$overtime->reason}}</td>
    </tr>
</table>


<p>Thank You,</p>
