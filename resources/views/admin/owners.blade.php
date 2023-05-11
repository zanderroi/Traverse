@include('components.header')
@section('content')
    <h1 class="pt-4 pb-2">All Car Owners</h1>
    <table class="table">
        <thead>
            <tr>
                <th scope="col" class="py-3 px-6">ID</th>
                <th scope="col" class="py-3 px-6">Name</th>
                <th scope="col" class="py-3 px-6">Email</th>
                <th scope="col" class="py-3 px-6">Address</th>
                <th scope="col" class="py-3 px-6">Contact Number</th>
                <th scope="col" class="py-3 px-6">Contact Persons</th>
                <th scope="col" class="py-3 px-6">Phone # of Contacts</th>
                <th scope="col" class="py-3 px-6">Documents Provided</th>
                <th scope="col" class="py-3 px-6">Car Owned</th>
                <th scope="col" class="py-3 px-6">Account Status</th>
                <th scope="col" class="py-3 px-6"> </th>
                <th scope="col" class="py-3 px-6"> </th>
            </tr>
        </thead>
        <tbody>
            @foreach ($users as $index => $user)
                <tr>
                    <td>{{ $user->id }}</td>
                    <td>{{ $user->first_name }}{{ $user->last_name }}</td>
                    <td>{{ $user->email }}</td>
                    <td>{{ $user->address }}</td>
                    <td>{{ $user->phone_number }}</td>
                    <td><ul>
                        <li>{{ $user->contactperson1 }}</li>
                        <li>{{ $user->contactperson2 }}</li>
                    </ul></td>
                    <td><ul>
                        <li>{{ $user->contactperson1number }}</li>
                        <li>{{ $user->contactperson2number }}</li>
                    </ul></td>
                    <td><ul>
                        <li>{{ $user->govtid }}</li>
                        <li>{{ $user->driverslicense }}</li>
                    </ul></td>
                    <td>
                        <ul>
                            @foreach ($carsWithOwners as $car)
                                @if ($car->car_owner_id == $user->id)
                                    <li>{{ $car->car_brand }} {{ $car->car_model }} {{ $car->year }}</li>
                                @endif
                            @endforeach
                        </ul>
                    </td>
                    <td>{{ $user->account_status }}</td> 

                </tr>
               
            @endforeach
        </tbody>
    </table>
@include('components.footer')