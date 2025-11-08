@extends('layout.SchoolSideLayout')

@section('title', 'DCPMS Dashboard')

@section('content')

    <div class="py-5 px-5 ">
        <div
            class="flex justify-between items-center bg-white mb-4 shadow-md border border-gray-300 rounded-md overflow-hidden px-4 py-2">
            <div class="text-2xl font-bold ">Condition of DCP Items
                <div class="text-lg font-normal text-gray-500 ">Here are the List of Items</div>
            </div>

            <div class="py-5 px-5">
                <span class="text-md text-gray-600">You Can Filter By Condition</span>
                <form id="conditionForm" action="{{ route('schools.item.condition.combo') }}" method="POST">
                    @csrf
                    @method('POST')
                    <select
                        class="py-1 px-2 w-full border border-gray-300 bg-white rounded-sm shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm"
                        name="condition_id" onchange="document.getElementById('conditionForm').submit()">
                        @php
                            $conditions = App\Models\DCPCurrentCondition::all();
                        @endphp
                        <option value="0" {{ request('condition_id') == 0 ? 'selected' : '' }}>All </option>
                        @foreach ($conditions as $condition)
                            <option value="{{ $condition->pk_dcp_current_conditions_id }}"
                                {{ $id == $condition->pk_dcp_current_conditions_id ? 'selected' : '' }}>
                                {{ $condition->name }}
                            </option>
                        @endforeach
                    </select>
                </form>
            </div>
        </div>

        @php
            $bgColors = [
                'bg-green-200',
                'bg-yellow-200',
                'bg-red-200',
                'bg-blue-200',
                'bg-indigo-200',
                'bg-purple-200',
                'bg-pink-200',
                'bg-teal-200',
                'bg-cyan-200',
            ];
        @endphp

        @if ($items_result->count() > 0)
            <div class="grid md:grid-cols-3 grid-cols-1 gap-2 border mb-2">
                @foreach ($items_result as $item)
                    @php
                        $batch_items = App\Models\DCPBatchItem::where(
                            'pk_dcp_batch_items_id',
                            $item->dcp_batch_item_id,
                        )->first();

                    @endphp

                    <div class="px-5 py-5 border border-gray-500 bg-white    w-full ">
                        <div class="text-gray-700">
                            <b>Product:</b>
                            {{ $batch_items->dcpItemType->name }}
                        </div>
                        <div>
                            <span class="font-normal text-gray-700">
                                <b> DCP Item:</b>
                            </span>
                            {{ $batch_items->generated_code ?? '' }}
                        </div>
                        <div class="font-normal text-gray-700"> <b>From Batch:</b>
                            {{ $batch_items->dcpBatch->batch_label ?? '' }}
                        </div>
                        @php
                            $process = $batch_items->dcpItemCurrentCondition->dcpCurrentCondition;
                            if ($process->pk_dcp_current_conditions_id == 1) {
                                $bgColor = 'bg-green-200';
                            } elseif ($process->pk_dcp_current_conditions_id == 2) {
                                $bgColor = 'bg-yellow-200';
                            } elseif ($process->pk_dcp_current_conditions_id == 4) {
                                $bgColor = 'bg-red-200';
                            } elseif ($process->pk_dcp_current_conditions_id == 5) {
                                $bgColor = 'bg-purple-200';
                            } else {
                                $bgColor = 'bg-gray-200';
                            }
                        @endphp

                        <div class="{{ $bgColor }} px-4   rounded-sm text-gray-800 border border-gray-800">
                            {{ $batch_items->dcpItemCurrentCondition->dcpCurrentCondition->name ?? '' }}
                        </div>
                    </div>
                @endforeach
            </div>
        @else
            <div class="bg-gray-200  text-gray-900 border border-gray-800 px-4 py-2 rounded-sm">
                No Items Found
            </div>
        @endif

    @endsection
