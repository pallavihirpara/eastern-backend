@if (@$type == 1)

    <h1>{{$title}} is register</h1>
    
    You can see {{$title}} details below:
    <table class="border">
        <thead>
            <tr>
                <th>Name :- </th>
                <td>{{$en_name}}</td>
            </tr>
            <tr>
                <th>Email :- </th>
                <td>{{$email}}</td>
            </tr>
            <tr>
                <th>Mobile No :- </th>
                <td>{{$mobile_no}}</td>
            </tr>
        </thead>
    </table>

@else

    <h1>Contact Us Detail</h1>
            
    You can see User details below:
    <table class="border">
        <thead>
            <tr>
                <th>Name :- </th>
                <td>{{$name}}</td>
            </tr>
            <tr>
                <th>Email :- </th>
                <td>{{$email}}</td>
            </tr>
            <tr>
                <th>Mobile No :- </th>
                <td>{{$mobile_no}}</td>
            </tr>
            <tr>
                <th>MSG :- </th>
                <td>{{$msg}}</td>
            </tr>
        </thead>
    </table>
@endif