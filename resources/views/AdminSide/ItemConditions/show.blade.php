@extends('layout.Admin-Side')
<title>@yield('title', 'DCP Conditions')</title>

@section('content')
    <div class="mx-5 my-5">
        <div id="page-title" class="text-lg font-bold "></div>
        <div>
            <select id="select-condition" class="px-3 py-1 border border-gray-300, shadow-md  rounded-sm mb-2"
                onchange="showCondition()">
                @php
                    $condition_list = App\Models\DCPItemCondition::with('dcpCurrentCondition')
                        ->get()
                        ->groupBy('current_condition_id')
                        ->map(function ($group) {
                            return [
                                'condition' => $group->first()->dcpCurrentCondition->name,
                                'id' => $group->first()->current_condition_id,
                                'count' => $group->count(),
                            ];
                        })
                        ->values()
                        ->toArray();
                @endphp
                <option>Select Condition</option>
                <option value="0">All</option>
                @foreach ($condition_list as $list)
                    <option value="{{ $list['id'] }}">
                        {{ $list['condition'] }} ({{ $list['count'] }})
                    </option>
                @endforeach
            </select>
        </div>
        <div id="card-container" class="  grid grid-cols-1 md:grid-cols-3 gap-2">

        </div>
    </div>
    <script>
        function showCondition() {
            const dropDown = document.getElementById('select-condition');
            const cardId = dropDown.value;
            window.location.href = `/Admin/ItemConditions/${cardId}`


        }
        // document.addEventListener("DOMContentLoaded", showCondition);
        const myConditions = @json($condition);
        console.log(myConditions);
        const bgColors = [
            "bg-green-100", // green-100
            "bg-yellow-100", // yellow-100
            "bg-gray-100", // gray-100
            "bg-red-100", // red-100
            "bg-indigo-100", // indigo-100
            "bg-gray-100", // gray-200
        ];
        // const dropDown = document.getElementById('select-condition').value =const condition = params.get("condition");;

        myConditions.forEach((data, index) => {
            console.log(data.dcp_batch_item_id);
            document.getElementById('page-title').innerHTML =
                `DCP Item Current Conditions : ${data.condition ==0 ?  'All': data.condition}`;
            const newCard = document.createElement("div");
            newCard.className =
                "px-5 py-5 border border-gray-500 bg-white    w-full";
            newCard.innerHTML = `
                   
            <div>
                        <div class="flex justify-start">
                            <span class="${bgColors[data.condition_id-1]} font-semibold text-gray-700 border border-gray-800 px-2 py-0">
                            ${index + 1}.</span>
                        </div>
                        <div class="text-gray-700">
                            <b> Product:</b>
                            ${data.item_type ?? ''}
                        </div>
                        <div>
                            <span class="font-normal text-gray-700">
                                <b> DCP Item:</b>
                            </span>
                        ${data.generated_code ?? ''}
                        </div>
                        <div class="font-normal text-gray-700"> <b>From Batch:</b>
                            ${data.batch_label ?? ''}
                        </div>


                        <div class="${bgColors[data.condition_id-1]} px-4   rounded-sm text-gray-800 border border-gray-800">
                           ${data.condition ?? ''}
                        </div>
                    </div>
            `;
            document.getElementById("card-container").appendChild(newCard);
        });
    </script>
@endsection
