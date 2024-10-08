@extends('layout.admin')
@section('content')



    <div class="row">
        <!-- data table start -->
        <div class="col-12 mt-5">
            <div class="card">
                <div class="card-body list-grid">

                    <div class="row">
                        <div class="col-12">
                            <div class="grid-col control-bar">

                                <div class="row control">
                                    <div class="col-6 left-control">

                                        <button type="button" class="btn btn-flat btn-secondary mb-3"
                                            onclick="checkAll(1)">Check All</button>
                                        <button type="button" class="btn btn-flat btn-secondary mb-3"
                                            onclick="checkAll(0)">Uncheck</button>

                                        <button type="button" class="btn btn-flat btn-danger mb-3"
                                            onclick="deleteAll('deleteAllApplication','Delete these Application\'s details?','Are you sure you want to delete these Application\'s details?');">
                                            Delete</button>

                                        <div class="loading"></div>


                                    </div>

                                    <div class="col-6 right-control">

                                        <a href="javascript:void(0);" onclick="window.history.back();">
                                            <button type="button" class="btn btn-flat btn-secondary mb-3">Back</button>
                                        </a>


                                        <a href="{{ route('application.index') }}">
                                            <button type="button" class="btn btn-flat btn-secondary mb-3">Refresh</button>
                                        </a>

                                        <a href="{{ route('application.create') }}">
                                            <button type="button" class="btn btn-flat btn-secondary mb-3">Add
                                                Application</button>
                                        </a>

                                        <div class="filter-button">
                                            <i class="ti-settings"></i>
                                        </div>

                                        <div class="settings-btn2">
                                            <i class="ti-settings"></i>
                                        </div>


                                    </div>

                                </div>

                            </div>
                        </div>
                    </div>

                    <form method="post" id="deleteAllApplication">

                        <div class="data-tables">
                            <table id="applicationTable" class="text-center">
                                <thead class="bg-light text-capitalize">
                                    <tr>
                                        <th width="5%">Seq.</th>
                                        <th style="width:2px;max-width:2px;"></th>




                                        @foreach ($finalColumnSettings as $columnSetting)
                                        @if($columnSetting['visibleStatus'])
                                            <th>{{ $columnSetting['title'] }}</th>
                                        @endif    
                                        @endforeach




                                        <th>Status</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($application as $value)
                                        <tr id="item{{ $value->id }}">
                                            <td> {{ $loop->iteration }} </td>
                                            <td>
                                                <input type="checkbox" class="checkBoxClass" name="deleterecords[]"
                                                    value="{{ $value->id }}">
                                            </td>

                                            @foreach ($finalColumnSettings as $columnSetting)

                                             @if($columnSetting['visibleStatus'])
                                                <td>


                                                    @if ($columnSetting['column'] === 'full_name')
                                                       
                                                        {{-- Handle concatenation for Fullname --}}


                                                           @php
                                                                $finalValue = $value->student->first_name . " " . $value->student->last_name;

                                                            @endphp

                                                    @elseif (strpos($columnSetting['column'], '.') !== false)
                                                            {{-- Handle related fields --}}
                                                            @php
                                                                $relatedFields = explode('.', $columnSetting['column']);

                                                                $finalValue = $value->{$relatedFields[0]}->{$relatedFields[1]};
                                                            @endphp
                                                        @else
                                                            {{-- Non-related fields --}}
                                                            @php
                                                                $finalValue = $value->{$columnSetting['column']};

                                                            @endphp
                                                        @endif

                                                        {{ $finalValue }}
                                                </td>
                                                @endif
                                            @endforeach

                                            <td>

                                                <label class="label-switch switch-success">
                                                    <input type="checkbox" class="switch switch-bootstrap status"
                                                        name="status" data-id="{{ $value->id }}"
                                                        @if ($value->status == 1) checked="checked" @endif />
                                                    <span class="lable"></span>
                                                </label>

                                            </td>

                                            <td>
                                                <button class="btn btn-secondary btn-sm dropdown-toggle" type="button"
                                                    data-toggle="dropdown">
                                                    Action
                                                </button>
                                                <div class="dropdown-menu">
                                                    <a class="dropdown-item"
                                                        href="{{ route('application.edit', $value->id) }}">Edit</a>
                                                    <a class="dropdown-item"
                                                        onclick="deleteRecord('{{ $value->id }}','Delete this Application details?','Are you sure you want to delete this Application details?');">Delete</a>
                                                </div>
                                            </td>

                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>

                    </form>
                </div>
            </div>
        </div>
        <!-- data table end -->
    </div>

@section('js')
    <script src="{{ asset('assets/admin/js/console/application.js') }}"></script>
@append

@endsection
