@extends('layouts.admin')

@section('title', 'View Customers')

@section('content')
<main class="max-w-6xl mx-auto p-6 text-white">
    <h2 class="text-center font-bebas text-3xl text-yellow-400">Registered Customers</h2>

    @php
        // Normalize input sources
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
                {{-- ✅ Structured collection of customers (each has ->bikes) --}}
                @if($hasStructured)
                    @foreach ($customers as $c)
                        <tr class="even:bg-[#292929] hover:bg-[#3a3a3a]">
                            <td class="p-3 border border-[#444]">
                                {{ $c->FirstName ?? '' }} {{ $c->LastName ?? '' }}
                            </td>
                            <td class="p-3 border border-[#444]">
                                {{ $c->Email ?? '' }}
                            </td>
                            <td class="p-3 border border-[#444]">
                                {{ $c->PhoneNumber ?? '' }}
                            </td>
                            <td class="p-3 border border-[#444]">
                                {{ $c->CreatedAt ? \Carbon\Carbon::parse($c->CreatedAt)->format('M d, Y') : '' }}
                            </td>
                            <td class="p-3 border border-[#444]">
                                @php $bikes = $c->bikes ?? []; @endphp
                                @if(empty($bikes))
                                    <span class="text-gray-400">—</span>
                                @else
                                    @foreach ($bikes as $b)
                                        <div>
                                            {{ $b->Make ?? '' }} {{ $b->Model ?? '' }}
                                            @if(!empty($b->Mileage))
                                                — {{ number_format((int)$b->Mileage) }} miles
                                            @endif
                                        </div>
                                    @endforeach
                                @endif
                            </td>
                        </tr>
                    @endforeach

                {{-- ✅ Flat JOIN-based dataset fallback --}}
                @elseif($hasFlatRows)
                    @php $currentId = null; @endphp
                    @foreach ($customerRows as $row)
                        @php
                            $cid     = $row->CustomerID ?? null;
                            $first   = $row->FirstName ?? '';
                            $last    = $row->LastName ?? '';
                            $email   = $row->Email ?? '';
                            $phone   = $row->PhoneNumber ?? '';
                            $created = $row->CreatedAt ?? null;
                            $make    = $row->Make ?? null;
                            $model   = $row->Model ?? null;
                            $miles   = $row->Mileage ?? null;
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