@component('mail::message')
Hello  {{ $carOwnerName}},

Great news! {{ $customerName->first_name}} {{ $customerName->last_name}} just booked your {{ $carBrand }} {{ $carModel }}.

Check it now at [your Dashboard](https://traversecarrentals2023.duckdns.org/car_owner/rentedcars).

Thanks,<br>
Traverse
@endcomponent
