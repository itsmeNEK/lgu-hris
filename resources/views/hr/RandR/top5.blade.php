@extends('layouts.app')

@section('title', 'Top 5 Offices')
@section('content')
    <hr-pms-top></hr-pms-top>
    {{-- <div class="row justify-content-center">
        <h3>Top 5 Offices</h3>
        <div class="col-12 col-md-10 mt-3">

            <div class="row justify-content-end">
                <div class="col-12 col-md text-end">
                    <form action="{{ route('hr.top5.index') }}" method="get">
                        @csrf
                        <div class="input-group mb-3">
                            <input type="month" class="form-control" name="from" placeholder="From">
                            <input type="month" class="form-control" name="to" placeholder="To">
                            <button class="btn btn-outline-warning fw-bold"><i
                                    class="fa-solid fa-magnifying-glass me-1"></i>Search</button>
                        </div>
                    </form>
                </div>
            </div>

            <div class="table-responsive" id="no-more-tables">
                <table class="table table-hover table-striped smnall table-sm text-center">
                    <thead>
                        <tr class="table-light">
                            <th class="numeric">Rank</th>
                            <th class="numeric" width="30%">Office</th>
                            <th class="numeric" width="10%">From</th>
                            <th class="numeric" width="10%">to</th>
                            <th class="numeric" width="20%">Rating</th>
                            <th class="numeric" width="20%">Equivalent</th>
                            <th class="numeric" width="10%"></th>
                        </tr>
                    </thead>
                    <tbody class="table-group-divider">
                        @forelse ($all_ipcr as $ipcr)
                            <tr @if ($loop->iteration == 1) class="table-danger text-white" @endif>
                                @if ($ipcr->user->role == 3)
                                    <td data-title="Rank">{{ $loop->iteration }}</td>
                                    <td>
                                        @if ($ipcr->user->empPlantilla)
                                            {{ $ipcr->user->empPlantilla->department->name }}
                                        @endif
                                    </td>
                                    <td>{{ $ipcr->from }}</td>
                                    <td>{{ $ipcr->to }}</td>
                                    <td>{{ $ipcr->rating }}</td>
                                    <td>{{ $ipcr->equivalent }}</td>
                                    <td>
                                        <form action="#" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger btn-sm text-white"
                                                onclick="return confirm('Are you sure?')"><i
                                                    class="fa-solid fa-trash-can me-1"></i> </button>
                                        </form>
                                    </td>
                                @endif
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="text-center">No Records</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
                <div class="d-flex justify-content-center">
                    {{ $all_ipcr->links('pagination.custom') }}
                </div>
            </div>
        </div>
    </div> --}}


@endsection
