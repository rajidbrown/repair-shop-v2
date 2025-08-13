@extends('layouts.admin')

@section('title', 'View Customers')

@section('content')
<main class="max-w-6xl mx-auto p-6 text-white">
    <h2 class="text-center font-bebas text-3xl text-yellow-400">Registered Customers</h2>

    @php
        // Normalize input:
        // - Preferred: $customers = collection of customers, each having ->bikes (array/collection)
        // - Fallback:  $customerRows = flat rows from a LEFT JOIN (like the legacy PHP)
        $hasStructured = isset($customers) && count($customers ?? []) > 0;
        $hasFlatRows   = !$hasStructured && isset($customerRows) && count($customerRows ?? []) > 0;
    @endphp

    @if(!$hasStructured && !$hasFlatRows)
        <p class="text-center text-gray-300 mt-6">No customers found.</p>
    @else
        <div class="mt-6 overflow-x-auto rounded-lg border border-orange-600">
            <table class="w-full border-collapse bg-[#1f1f1f]">
                <thead>
                    <tr class="bg-[#333] text-yellow-400">
                        <th class="p-3 border border-[#444]">Name</th>
                        <th class="p-3 border border-[#444]">Email</th>
                        <th class="p-3 border border-[#444]">Phone</th>
                        <th class="p-3 border border-[#444]">Registered On</th>
                        <th class="p-3 border border-[#444]">Bike(s)</th>
                    </tr>
                </thead>

                <tbody>
                @if($hasStructured)
                    @foreach ($customers as $c)
                        <tr class="even:bg-[#292929] hover:bg-[#3a3a3a]">
                            <td class="p-3 border border-[#444]">
                                {{ $c->FirstName ?? $c['FirstName'] ?? '' }}
                                {{ $c->LastName ?? $c['LastName'] ?? '' }}
                            </td>
                            <td class="p-3 border border-[#444]">
                                {{ $c->Email ?? $c['Email'] ?? '' }}
                            </td>
                            <td class="p-3 border border-[#444]">
                                {{ $c->PhoneNumber ?? $c['PhoneNumber'] ?? '' }}
                            </td>
                            <td class="p-3 border border-[#444]">
                                @php
                                    $created = $c->CreatedAt ?? $c['CreatedAt'] ?? null;
                                @endphp
                                {{ $created ? \Carbon\Carbon::parse($created)->format('M d, Y') : '' }}
                            </td>
                            <td class="p-3 border border-[#444]">
                                @php
                                    $bikes = $c->bikes ?? $c['bikes'] ?? [];
                                @endphp

                                @if(empty($bikes))
                                    <span class="text-gray-400">—</span>
                                @else
                                    @foreach ($bikes as $b)
                                        <div>
                                            {{ ($b->Make ?? $b['Make'] ?? '') }}
                                            {{ ($b->Model ?? $b['Model'] ?? '') }}
                                            @php $mileage = $b->Mileage ?? $b['Mileage'] ?? null; @endphp
                                            @if(!is_null($mileage))
                                                — {{ number_format((int)$mileage) }} miles
                                            @endif
                                        </div>
                                    @endforeach
                                @endif
                            </td>
                        </tr>
                    @endforeach

                @elseif($hasFlatRows)
                    @php $currentId = null; @endphp
                    @foreach ($customerRows as $row)
                        @php
                            $cid = $row['CustomerID'] ?? $row->CustomerID ?? null;
                            $first = $row['FirstName'] ?? $row->FirstName ?? '';
                            $last  = $row['LastName']  ?? $row->LastName  ?? '';
                            $email = $row['Email']     ?? $row->Email     ?? '';
                            $phone = $row['PhoneNumber'] ?? $row->PhoneNumber ?? '';
                            $created = $row['CreatedAt'] ?? $row->CreatedAt ?? null;

                            $make  = $row['Make']   ?? $row->Make   ?? null;
                            $model = $row['Model']  ?? $row->Model  ?? null;
                            $miles = $row['Mileage']?? $row->Mileage?? null;
                        @endphp

                        @if ($cid !== $currentId)
                            @if (!is_null($currentId))
                                    </td>
                                </tr>
                            @endif

                            <tr class="even:bg-[#292929] hover:bg-[#3a3a3a]">
                                <td class="p-3 border border-[#444]">{{ $first }} {{ $last }}</td>
                                <td class="p-3 border border-[#444]">{{ $email }}</td>
                                <td class="p-3 border border-[#444]">{{ $phone }}</td>
                                <td class="p-3 border border-[#444]">
                                    {{ $created ? \Carbon\Carbon::parse($created)->format('M d, Y') : '' }}
                                </td>
                                <td class="p-3 border border-[#444]">
                            @php $currentId = $cid; @endphp
                        @endif

                        @if($make || $model || $miles)
                            <div>
                                {{ $make }} {{ $model }}
                                @if(!is_null($miles)) — {{ number_format((int)$miles) }} miles @endif
                            </div>
                        @endif
                    @endforeach
                        </td>
                    </tr>
                @endif
                </tbody>
            </table>
        </div>
    @endif
</main>
@endsection