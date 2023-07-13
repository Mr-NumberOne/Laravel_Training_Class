<style>

</style>

<table class="table table-striped" style="direction: rtl">
    <thead>
    <tr >
        <th style="background: #ffd65b">#</th>
        <th style="width: 150px;background: #ffd65b">Name</th>
        <th style="background: #ffd65b">Role</th>
        <th  style="width: 200px;background: #ffd65b">Email</th>
        <th style="background: #ffd65b">Phone</th>
        <th style="background: #ffd65b">status</th>
    </tr>
    </thead>
    <tbody>
    @foreach($users as $user)
        <tr>
            <td>{{$user->id}}</td>
            <td>{{$user->name}}</td>
            <td><div >
                    @foreach($user->roles as $role)
                        <span class="mx-1"> {{$role->name}} </span>
                    @endforeach
                </div>

            </td>
            <td >{{$user->email}}</td>
            <td>{{$user->phone}}</td>

            <td>{{$user->status}}</td>

        </tr>
    @endforeach
    </tbody>
</table>
